<?php
/**
 * Author: A & A Creation Co.
 * Date: 28/9/2020
 * Time: 3:15 PM
 */

namespace Modules\AgencyTemplate\Actions;


use Illuminate\Support\Str;
use Modules\AgencyTemplate\DataTransferObjects\TemplateData;
use Modules\AgencyTemplate\Entities\Template;

class CreateTemplate
{
    /**
     * @var \Modules\AgencyTemplate\Actions\TemplateWriter
     */
    private TemplateWriter $writer;

    /**
     * CreateTemplate constructor.
     * @param \Modules\AgencyTemplate\Actions\TemplateWriter $writer
     */
    public function __construct(TemplateWriter $writer) {
        $this->writer = $writer;
    }

    public function execute(TemplateData $dto): Template {
        $path = Str::snake($dto->getLabel()).'.blade.php';
        $this->writer->execute($path,
                               $dto->getContent());

        return Template::create([
                                    'label'     => $dto->getLabel(),
                                    'view_path' => $path,
                                    'tags'      => json_encode($dto->getTags()),
                                ]);
    }

}
