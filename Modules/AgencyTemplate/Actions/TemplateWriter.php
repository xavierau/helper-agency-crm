<?php
/**
 * Author: A & A Creation Co.
 * Date: 28/9/2020
 * Time: 3:19 PM
 */

namespace Modules\AgencyTemplate\Actions;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TemplateWriter
{
    public function execute(string $fileName, string $content): void {

        Storage::disk('template')->put($fileName,
                                       $content);

    }


}
