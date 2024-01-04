<?php
/**
 * Author: A & A Creation Co.
 * Date: 28/9/2020
 * Time: 3:16 PM
 */

namespace Modules\AgencyTemplate\DataTransferObjects;


class TemplateData
{
    private string $label;
    private array $tags;
    private string $content;

    public static function fromFormData(array $validatedData): TemplateData {
        $instance = new self;
        $instance->label = $validatedData['label'];
        $instance->tags = $validatedData['tags'] ?? [];
        $instance->content = $validatedData['content'];

        return $instance;
    }

    public function getData(): array {
        return [
            "label"   => $this->label,
            "tags"    => $this->tags,
            "content" => $this->content,
        ];
    }

    /**
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }

    /**
     * @return array
     */
    public function getTags(): array {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }
}
