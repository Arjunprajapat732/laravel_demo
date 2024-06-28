<?php

namespace App\Http\Controllers\account;

use App\Models\Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InterventionController extends Controller
{
	public function index(Request $request) {
		$all_images = Intervention::all();

		return view('account.intervention_image.index', compact('all_images'));
	}
	
	public function store(Request $request)
	{
		$request->validate([
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		if ($request->hasFile('image')) {
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			
			$originalPath = $file->getRealPath();
			
			$tempPath = sys_get_temp_dir() . '/' . uniqid() . '.' . $extension;
			
			// Compress the image (custom compression logic, assuming you have the function)
			$this->compressImage($originalPath, $tempPath, $extension);

			$compressedSize = filesize($tempPath);

			// Store on S3
			$path = Storage::disk('s3')->putFileAs(
			    'image/arjun_test',
			    new \Illuminate\Http\File($tempPath),
			    $name,
			    's3'
			);

			// Create entry in database
			Intervention::create([
				'filename' => $file->getClientOriginalName(),
				'extension' => $extension,
				'path' => $path,
				'size' => $compressedSize,
			]);

			// Clean up temp file
			unlink($tempPath);

			// Return success response
			return response()->json([
				'message' => 'Image uploaded successfully',
				'path' => Storage::disk('s3')->url($path),
				'size' => $compressedSize,
			]);
		}

		// If no image file uploaded, return with error
		return redirect()->back()->withErrors(['error' => 'No image file uploaded']);
	}

	// Function to compress image (assuming this is defined elsewhere)
	private function compressImage($sourcePath, $destinationPath, $extension)
	{
		if ($extension === 'jpeg' || $extension === 'jpg') {
			$image = imagecreatefromjpeg($sourcePath);
			imagejpeg($image, $destinationPath, 80); // 80% quality
			imagedestroy($image);
		} elseif ($extension === 'png') {
			$image = imagecreatefrompng($sourcePath);
			imagepng($image, $destinationPath, 8); // 8 is compression level, adjust as needed
			imagedestroy($image);
		}
	}
}
