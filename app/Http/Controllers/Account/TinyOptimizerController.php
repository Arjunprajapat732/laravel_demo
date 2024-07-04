<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Models\TinyOptimizer;
use App\Http\Controllers\Controller;
use App\Jobs\CompressImage;
use Illuminate\Support\Facades\Storage;

class TinyOptimizerController extends Controller
{
    public function index(Request $request)
    {
        $all_images = TinyOptimizer::all();
        return view('account.tiny_optimizer.index', compact('all_images'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $original_name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $new_name = time() . '.' . $extension; // Unique filename
            $s3Path = 'attachments_test/' . $new_name;

            // Upload the original image to S3
            Storage::disk('s3')->putFileAs('attachments_test', $file, $new_name);

            // Dispatch job to compress the image
            CompressImage::dispatch($s3Path, $new_name);

            // Get file size
            $filesize = $file->getSize();
            if ($filesize >= 1073741824) {
                $size = number_format($filesize / 1073741824, 2) . ' GB';
            } elseif ($filesize >= 1048576) {
                $size = number_format($filesize / 1048576, 2) . ' MB';
            } elseif ($filesize >= 1024) {
                $size = number_format($filesize / 1024, 2) . ' KB';
            } else {
                $size = $filesize . ' bytes';
            }

            TinyOptimizer::create([
                'filename' => $original_name,
                'extension' => $extension,
                'path' => $s3Path,
                'filesize' => $size,
            ]);

            return redirect()->back()->with([
                'success' => 'Image uploaded and compression job dispatched',
                'filename' => $original_name,
                'filesize' => $size,
            ]);
        }

        return redirect()->back()->withErrors(['error' => 'No image file uploaded']);
    }
}
