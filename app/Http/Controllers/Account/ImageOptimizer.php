<?php

namespace App\Http\Controllers\account;

use Spatie\ImageOptimizer\OptimizerChain as Image;
use App\Http\Controllers\Controller;
use App\Models\ImageOptimizerTable;
use Illuminate\Http\Request;
use ShortPixel\Client;
use ShortPixel\ShortPixel;
// use ShortPixel\ShortPixelException;
// use ShortPixel\ShortPixel\optimize\ImageOpt;
use Tinify\Tinify;
use Tinify\Source;

class ImageOptimizer extends Controller
{
	public function index(Request $request){
		$all_images = ImageOptimizerTable::all();

		return view('account.image_optimizer.index', compact('all_images'));
	}

	public function store(Request $request){
		$request->validate([
			'image' => 'required|image',
		]);

		$image = $request->file('image');
		$path = $image->getPathName();
		\Tinify\setKey(env('TINIFY_API_KEY'));

		$compressedPath = storage_path('app/compressed-' . $image->getClientOriginalName());
		$sourceData = file_get_contents($path);
		$resultData = \Tinify\fromBuffer($sourceData)->toBuffer();

		file_put_contents($compressedPath, $resultData);

		return response()->download($compressedPath);	

		// $request->validate([
		// 	'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		// ]);

		// $image = $request->file('image');
		// $path = $image->store('images', 'public');



		// try {
		// 	$imagePath = public_path('storage/' . $path);
		// 	$imagePathTwo = public_path('storage/short/' . $path);

		// 	$apiKey = config('shortpixel.api_key');
		// 	$client = new Client(['apiKey' => $apiKey]);
		// 	$result = $client->fromFile($imagePath)->optimize()->toFiles($imagePathTwo);
		// 	// dd($result);

		// 	if ($result->succeeded()) {
		// 		$optimizedImagePath = $result->getDestination();
		// 		return response()->json([
		// 			'success' => true,
		// 			'message' => 'Image optimized successfully!',
		// 			'data' => $optimizedImagePath,
		// 		]);
		// 	} else {
		// 		return response()->json([
		// 			'success' => false,
		// 			'message' => 'Image optimization failed!',
		// 		]);
		// 	}
		// } catch (\Exception $e) {
		// 	return response()->json([
		// 		'success' => false,
		// 		'message' => $e->getMessage(),
		// 	]);
		// }



		// try {
		// 	$imagePath = public_path('storage/' . $path);
		// 	$imagePathTwo = public_path('storage/short/' . $path);

		// 	$apiKey = config('shortpixel.api_key');
		// 	ShortPixel::setKey($apiKey);

		// 	$result = Image::fromFile($imagePath)->optimize();

		// 	if ($result->status['code'] == 2) { // Check if optimization succeeded
		// 		$result->toFiles($imagePathTwo);
		// 		$optimizedImagePath = $result->succeeded[0]->DestURL; // Get the optimized image path
		// 		return response()->json([
		// 			'success' => true,
		// 			'message' => 'Image optimized successfully!',
		// 			'data' => $optimizedImagePath,
		// 		]);
		// 	} else {
		// 		return response()->json([
		// 			'success' => false,
		// 			'message' => 'Image optimization failed!',
		// 		]);
		// 	}
		// } catch (\Exception $e) {
		// 	return response()->json([
		// 		'success' => false,
		// 		'message' => $e->getMessage(),
		// 	]);
		// }



		// try {
		//     $imagePath = public_path('storage/' . $path);
		//     $result = \ShortPixel\ShortPixel::fromUrls("https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.istockphoto.com%2Fphotos%2Fjodhpur&psig=AOvVaw0ZHdSc3j-PeLB11jNWcnFm&ust=1718095635019000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCPC7lpTT0IYDFQAAAAAdAAAAABAE")->wait(300)->optimize();
			
		//     if (isset($result->succeeded[0])) {
		//         $optimizedImagePath = $result->succeeded[0]->path;
		//         return response()->json([
		//             'success' => true,
		//             'message' => 'Image optimized successfully!',
		//             'data' => $optimizedImagePath,
		//         ]);
		//     } else {
		//         return response()->json([
		//             'success' => false,
		//             'message' => 'Image optimization failed!',
		//         ]);
		//     }
		// } catch (ShortPixelException $e) {
		//     return response()->json([
		//         'success' => false,
		//         'message' => $e->getMessage(),
		//     ]);
		// }
	}
}