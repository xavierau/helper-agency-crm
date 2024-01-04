<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     anacreation/sincere
 * @Date        : 1/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace App\Services;


use App\DataTransferObject\FileUploadResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DocumentStorageManager
{
    private $disk;

    /**
     * UploadManager constructor.
     */
    public function __construct() {
        $this->disk = Storage::disk('upload');
    }


    public function store(UploadedFile $file): FileUploadResponse {
        $fileName = $this->disk->putFile('/',
                                         $file);

        $originalName = $file->getClientOriginalName();

        return FileUploadResponse::fromUploadManager($fileName,
                                                     $originalName,
                                                     $file->getClientMimeType());
    }

    public function download(string $path, $name = null) {

        return $this->disk->download($path,
                                     $name,
                                     ['Content-Type' => $this->disk->mimeType($path)]);

    }

    public function get(string $path) {
        return $this->disk->get($path);
    }

    public function delete(string $path = null): void {
        if($path !== null) {
             $this->disk->delete($path);
        }

    }
}
