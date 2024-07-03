<?php

namespace App\Http\Controllers\Account;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\file;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InterventionController extends Controller
{
	public function index(Request $request) {
		$all_images = Intervention::all();

		return view('account.intervention_image.index', compact('all_images'));
	}
	
	public function store(Request $request){
		$request->validate([
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
		]);

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$originalPath = $file->getRealPath();
			$tempPath = sys_get_temp_dir() . '/' . uniqid() . '.' . $extension;

			try {
				$this->compressImage($originalPath, $tempPath, $extension);
				$compressedSize = filesize($tempPath);

				$name = uniqid() . '.' . $extension;
				$path = Storage::disk('public')->putFileAs('intervention_compress', new File($tempPath), $name);

				Intervention::create([
					'filename' => $file->getClientOriginalName(),
					'extension' => $extension,
					'path' => $path,
					'size' => $compressedSize,
				]);

				unlink($tempPath);

				return redirect()->back()->with([
					'success' => 'Image compressed and added',
					'filename' => $file->getClientOriginalName(),
					'size' => $this->formatFileSize($compressedSize),
				]);
			} catch (\Exception $e) {
				if (file_exists($tempPath)) {
					unlink($tempPath);
				}
				return redirect()->back()->withErrors(['error' => 'An error occurred while processing the image.']);
			}
		}

		return redirect()->back()->withErrors(['error' => 'No image file uploaded']);
	}

	private function compressImage($sourcePath, $destinationPath, $extension)
	{
		try {
			if ($extension === 'jpeg' || $extension === 'jpg') {
				$image = imagecreatefromjpeg($sourcePath);
				imagejpeg($image, $destinationPath, 80); // 80% quality
				imagedestroy($image);
			} elseif ($extension === 'png') {
				$image = imagecreatefrompng($sourcePath);
				imagepng($image, $destinationPath, 8); // 8 is compression level, adjust as needed
				imagedestroy($image);
			} else {
				throw new \Exception('Unsupported image type');
			}
		} catch (\Exception $e) {
			throw new \Exception('Image compression failed: ' . $e->getMessage());
		}
	}

}
