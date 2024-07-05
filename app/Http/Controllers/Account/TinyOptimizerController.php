<?php

namespace App\Http\Controllers\Account;

use Tinify\Tinify;
use Illuminate\Http\Request;
use App\Models\TinyOptimizer;
use App\Http\Controllers\Controller;
use App\Jobs\CompressImage;
use Illuminate\Support\Facades\Storage;

class TinyOptimizerController extends Controller
{
	public function index(Request $request) {
		$all_images = TinyOptimizer::all();
		return view('account.tiny_optimizer.index', compact('all_images'));
	}

	public function store(Request $request) {
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$originalName = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();
			$file_name = time() . $originalName . $extension;
			$store_path = 'attachments_test/' . $file_name;

			Storage::disk('s3')->putFileAs('attachments_test', $file, $file_name);

			if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'WebP'])){
				$tempPath = $file->storeAs('temp', $file_name);
				CompressImage::dispatch($tempPath, $file_name, $store_path);
				// CompressImage::dispatch($store_path, $file_name);
			}

			$fileSize = $file->getSize();
			$size = formatFileSize($fileSize);

			TinyOptimizer::create([
				'filename' => $originalName,
				'extension' => $extension,
				'path' => $store_path,
				'filesize' => $size,
			]);

			return redirect()->back()->with([
				'success' => 'Image uploaded and compression job dispatched',
				'filename' => $originalName,
				'filesize' => $size,
			]);
		}

		return redirect()->back()->withErrors(['error' => 'No image file uploaded']);
	}
}
