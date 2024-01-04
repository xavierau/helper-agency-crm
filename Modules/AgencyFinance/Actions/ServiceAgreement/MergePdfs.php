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
 * @package     anacreation/agency-finance
 * @Date        : 4/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyFinance\Actions\ServiceAgreement;


class MergePdfs
{
    private $merger;

    public function __construct() {
        $this->merger = \PDFMerger::init();
    }

    public function execute(array $filePaths): MergePdfs {
        foreach($filePaths as $path) {
            $this->merger->addPathToPDF($path,
                                        'all',
                                        'P');
        }

        return $this;
    }

    public function download(string $fileName) {
        $this->merger->setFileName($fileName);
        $this->merger->merge();

        return response($this->merger->download())
            ->header('Content-type',
                     'application/pdf');
    }
}
