<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Models\TinyOptimizer;
use App\Http\Controllers\Controller;
use App\Jobs\CompressImage;

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
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $filepath = public_path('tiny_images/' . $filename);

            $file->move(public_path('tiny_images/'), $filename);

            // Dispatch the job with the necessary parameters
            CompressImage::dispatch($filepath, $extension);

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

            TinyOptimizer::create([
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
