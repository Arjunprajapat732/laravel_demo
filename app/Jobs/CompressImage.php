<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Tinify\Tinify;

class CompressImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filepath;
    protected $extension;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filepath, $extension)
    {
        $this->filepath = $filepath;
        $this->extension = $extension;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        \Tinify\setKey("wNnKpnx4YD80k0NhD66QVqHdfzlvmjYy");
        $source = \Tinify\fromFile($this->filepath);
        $source->toFile($this->filepath);
    }
}
