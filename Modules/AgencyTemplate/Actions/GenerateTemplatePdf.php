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
 * @package     anacreation/agency-template
 * @Date        : 4/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyTemplate\Actions;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\AgencyTemplate\Entities\Template;

class GenerateTemplatePdf
{
    public function execute(Template $template, array $params = []): string {
        $viewPath = 'templates/'.str_replace('.blade.php',
                                             '',
                                             $template->view_path);

        $html = $this->createHtml($viewPath,
                                  $params);

        return $this->createPdf($html);

    }

    public function createHtml(string $viewPath, array $params = []): string {
        return view($viewPath, $params)->render();
    }

    public function createPdf(string $html): string {
        $fileName = Str::random(16).'.pdf';

        $tempDirectory = Str::random(16);

        if( !Storage::exists(storage_path($tempDirectory))) {
            Storage::disk('local')->makeDirectory($tempDirectory);
        }

        $path = storage_path("app/".$tempDirectory.'/'.$fileName);

        \PDF::loadHTML($html)
            ->setWarnings(false)
            ->save($path);

        return $path;
    }
}
