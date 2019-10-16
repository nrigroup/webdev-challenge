<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Upload
{
    public $directory = 'uploads';
    public $disk = 'local';
    private $file;
    private $path;

    /**
     * Unique Id for the file
     *
     * @var null
     */
    private $uid;

    /**
     * Upload constructor.
     *
     * @param null $file
     * @param null $uid
     * @param null $directory
     */
    public function __construct($file = NULL, $uid = NULL, $directory = NULL)
    {
        if (!is_null($directory)) {
            $this->directory = $directory;
        }

        if (!is_null($uid)) {
            $this->uid = $uid;
        }

        if (!is_null($file)) {
            $this->file = $file;

            $this->handle();
        }
    }

    /**
     * Process
     *
     * Process uploaded file by moving
     * it to storage path and invoke CSV parser
     *
     */
    private function handle()
    {
        if ($this->file) {
            $extension = $this->file->getClientOriginalExtension();

            // Create Unique File name to avoid name conflict
            $filename = sprintf('%s.%s', $this->uid, $extension);

            /**
             * Move the uploaded file to Local disk
             * under Storage/App/Uploads which is not publicly accessible
             *
             * In the future, if we want to move the storage
             * to S3 or Google Cloud, we change the disk to s3 or google
             */
            $path = Storage::disk($this->disk)->putFileAs($this->directory, $this->file, $filename);


            $this->path = storage_path('app/' . $path);
        }
    }

    /**
     * Magic Class method to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->path;
    }
}
