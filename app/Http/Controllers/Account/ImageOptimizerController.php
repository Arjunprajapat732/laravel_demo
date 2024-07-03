<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Models\ImageOptimizer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\file;
use Spatie\ImageOptimizer\OptimizerChainFactory;


class ImageOptimizerController extends Controller
{
	public function index(Request $request) {
		$all_images = ImageOptimizer::all();

		return view('account.image_optimizer.index', compact('all_images'));
	}

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'image' => 'required|file|mimes:jpg,jpeg,png,gif|max:10240',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$filename = time() . '.' . $extension;
			$tempPath = $file->getPathname();

			// Create a temporary directory if it doesn't exist
			$tempDirectory = public_path('temp');
			if (!File::exists($tempDirectory)) {
				File::makeDirectory($tempDirectory, 0755, true);
			}

			// Move the file to a temporary location
			$tempFilepath = $tempDirectory . '/' . $filename;
			$file->move($tempDirectory, $filename);

			$optimizerChain = OptimizerChainFactory::create();
			$optimizerChain->optimize($tempFilepath);

			$finalDirectory = public_path('image_optimizer');
			if (!File::exists($finalDirectory)) {
				File::makeDirectory($finalDirectory, 0755, true);
			}

			$finalPath = $finalDirectory . '/' . $filename;
			rename($tempFilepath, $finalPath);

			$filesize = filesize($finalPath);
			$size = formatFileSize($filesize);

			ImageOptimizer::create([
				'filename' => $filename,
				'extension' => $extension,
				'path' => $finalPath,
				'size' => $size,
			]);

		}

		return redirect()->back()->withErrors(['error' => 'No image file uploaded']);
	}
}