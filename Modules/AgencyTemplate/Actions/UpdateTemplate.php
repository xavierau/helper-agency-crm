<?php
/**
 * Author: A & A Creation Co.
 * Date: 28/9/2020
 * Time: 3:15 PM
 */

namespace Modules\AgencyTemplate\Actions;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\AgencyTemplate\DataTransferObjects\TemplateData;
use Modules\AgencyTemplate\Entities\Template;

class UpdateTemplate
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

    public function execute(Template $template, TemplateData $dto): Template {


        Storage::disk('template')->delete($template->view_path);

        $path = Str::snake($dto->getLabel()).'.blade.php';

        $this->writer->execute($path,
                               $dto->getContent());
        
        $template->update([
                              'label'     => $dto->getLabel(),
                              'view_path' => $path,
                              'tags'      => json_encode($dto->getTags()),
                          ]);

        return $template;
    }

}
