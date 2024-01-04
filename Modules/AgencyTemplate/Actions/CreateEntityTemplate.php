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
 * @package
 * @Date        : 6/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyTemplate\Actions;


use Illuminate\Support\Facades\File;
use Modules\AgencyTemplate\Contracts\HasTemplateInterface;
use Modules\AgencyTemplate\Entities\Template;

class CreateEntityTemplate
{
    /**
     * @var \Modules\AgencyTemplate\Actions\TemplateWriter
     */
    private TemplateWriter $writer;

    /**
     * CreateEntityTemplate constructor.
     * @param \Modules\AgencyTemplate\Actions\TemplateWriter $writer
     */
    public function __construct(TemplateWriter $writer) {
        $this->writer = $writer;
    }

    public function execute(
        HasTemplateInterface $entity, string $fileName, string $content): Template {

        $this->writer->execute($fileName,
                               $content);

        $previousTemplate = optional($entity->template)->view_path;

        $entity->template()->updateOrCreate([
                                                'entity_id'   => $entity->id,
                                                'entity_type' => get_class($entity),
                                            ],
                                            [
                                                'view_path' => $fileName,
                                            ]);

        if($previousTemplate) {
            File::delete(resource_path('views/templates/'.$previousTemplate));
        }


        return $entity->template;
    }
}
