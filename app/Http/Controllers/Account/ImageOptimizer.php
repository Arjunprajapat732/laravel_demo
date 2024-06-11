<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\ImageOptimizerTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tinify\Tinify;


class ImageOptimizer extends Controller
{
	public function index(Request $request){
		$all_images = ImageOptimizerTable::all();

		return view('account.image_optimizer.index', compact('all_images'));
	}

	public function store(Request $request) {
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$filename = time() . '.' . $file->getClientOriginalExtension();
			$filepath = public_path('profile_images/' . $filename);

			$file->move(public_path('profile_images/'), $filename);

			\Tinify\setKey("wNnKpnx4YD80k0NhD66QVqHdfzlvmjYy");
			$source = \Tinify\fromFile($filepath);
			$source->toFile($filepath);
			// $resized = $source->resize(array(
			// 	"method" => "scale",
			// 	"width" => $source->width() * 0.5, // Reduce width by 50%
			// 	"height" => $source->height() * 0.5 // Reduce height by 50%
			// ));
			// $resized->toFile($filepath);

			$filesize = filesize($filepath);
			$size = '';
			if ($filesize >= 1073741824) {
				$size = number_format($filesize / 1073741824, 2) . ' GB';
			} elseif ($filesize >= 1048576) {
				$size = number_format($filesize / 1048576, 2) . ' MB';
			} elseif ($filesize >= 1024) {
				$size = number_format($filesize / 1024, 2) . ' KB';
			} elseif ($filesize > 1) {
				$size = $filesize . ' bytes';
			} elseif ($filesize == 1) {
				$size = $filesize . ' byte';
			} else {
				$size = '0 bytes';
			}

			ImageOptimizerTable::create([
				'filename' => $file->getClientOriginalName(),
				'path' => $filepath,
				'filesize' => $size,
			]);

			return redirect()->back()->with([
				'success' => 'Image compressed and added',
				'filename' => $file->getClientOriginalName(),
				'filesize' => $size,
			]);
		}

		return redirect()->back()->withErrors(['error' => 'No image file uploaded']);
	}
}