<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Tinify\Tinify;

class CompressImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $s3Path;
    protected $filename;

    /**
     * Create a new job instance.
     *
     * @param string $s3Path
     * @param string $filename
     * @return void
     */
    public function __construct($s3Path, $filename)
    {
        $this->s3Path = $s3Path;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Tinify\setKey(env("TINIFY_API_KEY"));

        // Download the file from S3 to a temporary local file
        $tempFilePath = tempnam(sys_get_temp_dir(), 's3_');
        Storage::disk('s3')->getDriver()->getAdapter()->getClient()->getObject([
            'Bucket' => env('AWS_BUCKET'),
            'Key' => $this->s3Path,
            'SaveAs' => $tempFilePath,
        ]);

        // Compress the image
        $source = \Tinify\fromFile($tempFilePath);
        $compressedTempFile = tempnam(sys_get_temp_dir(), 'cmp_');
        $source->toFile($compressedTempFile);

        // Upload the compressed image back to S3, overwriting the original
        Storage::disk('s3')->putFileAs('attachments_test', new \Illuminate\Http\File($compressedTempFile), $this->filename);

        // Cleanup temporary files
        unlink($tempFilePath);
        unlink($compressedTempFile);
    }
}
