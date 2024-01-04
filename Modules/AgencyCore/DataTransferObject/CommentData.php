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
 * @Date        : 26/1/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyCore\DataTransferObject;


class CommentData
{
    private string $content;

    public static function fromFromRequest(array $validatedData): CommentData {
        $instance = new static;

        $instance->content = $validatedData['content'];

        return $instance;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }


}
