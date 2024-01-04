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

namespace App\DataTransferObject;


class FileUploadResponse
{


    /**
     * @var string
     */
    private string $path;

    /**
     * @var string
     */
    private string $fileName;
    /**
     * @var string
     */
    private string $mimeType;

    /**
     * @param string $path
     * @param string $fileName
     * @param string $mimeType
     * @return \App\DataTransferObject\FileUploadResponse
     */
    public static function fromUploadManager(
        string $path, string $fileName, string $mimeType): FileUploadResponse {
        $instance = new static;
        $instance->path = $path;
        $instance->fileName = $fileName;
        $instance->mimeType = $mimeType;


        return $instance;
    }


    public function getPath(): string {
        return $this->path;
    }


    public function getFileName(): string {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getMimeType(): string {
        return $this->mimeType;
    }
}
