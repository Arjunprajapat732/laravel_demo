<?php

namespace App\Jobs;

use Tinify\Tinify;
use App\Models\TinyOptimizer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class CompressImage implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $temp_path;
	protected $file_name;
	protected $store_path;

	/**
	 * Create a new job instance.
	 *
	 * @param string $store_path
	 * @param string $file_name
	 * @return void
	 */
	public function __construct($temp_path, $file_name, $store_path)
	{
		$this->temp_path = $temp_path;
		$this->file_name = $file_name;
		$this->store_path = $store_path;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */

	public function handle(): void
	{
		// This with temp file store in server and than compress
		\Tinify\setKey(env("TINIFY_API_KEY"));

		$source = \Tinify\fromFile(storage_path('app/' . $this->temp_path));
		$compressedBuffer = $source->toBuffer();
		Storage::disk('s3')->put('/attachments_test/' . $this->file_name, $compressedBuffer);

		Storage::delete($this->temp_path);

		
		// \Tinify\setKey(env('TINIFY_API_KEY'));
		// $source = \Tinify\fromUrl(s3Asset($this->store_path));
		// $source->store(array(
		// 	"service" => "s3",
		// 	"aws_access_key_id" => env("AWS_ACCESS_KEY_ID"),
		// 	"aws_secret_access_key" => env("AWS_SECRET_ACCESS_KEY"),
		// 	"region" => "us-west-1",
		// 	"headers" => array("Cache-Control" => "max-age=31536000, public"),
		// 	"path" => env('AWS_BUCKET'). '/attachments_test/' . $this->file_name
		// ));


		// with url of s3 image

		// \Tinify\setKey(env("TINIFY_API_KEY"));

		// $source = \Tinify\fromUrl(s3Asset($this->store_path));
		// $result = $source->store(array(
		// 	"service" => "s3",
		// 	"aws_access_key_id" => env("AWS_ACCESS_KEY_ID"),
		// 	"aws_secret_access_key" => env("AWS_SECRET_ACCESS_KEY"),
		// 	"region" => "us-west-1",
		// 	"headers" => array("Cache-Control" => "max-age=31536000, public"),
		// 	"path" => env('AWS_BUCKET'). '/attachments_test/' . $this->file_name
		// ));

		// $newFileSize = $result->size();
		// $newSize = formatFileSize($newFileSize);

		// $tinyOptimizer = TinyOptimizer::where('path', $this->store_path)->first();
		// if ($tinyOptimizer) {
		// 	$tinyOptimizer->filesize = $newSize;
		// 	$tinyOptimizer->save();
		// }
	}
}
