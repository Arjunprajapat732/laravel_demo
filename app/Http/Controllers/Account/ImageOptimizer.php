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
			$extension = $file->getClientOriginalExtension();
			$filename = time() . '.' . $extension;
			$filepath = public_path('profile_images/' . $filename);

			$file->move(public_path('profile_images/'), $filename);

			if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
				\Tinify\setKey("wNnKpnx4YD80k0NhD66QVqHdfzlvmjYy");
				$source = \Tinify\fromFile($filepath);
				$source->toFile($filepath);
			}

			$filesize = filesize($filepath);

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
				'filename' => $filename,
				'extension' => $extension,
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