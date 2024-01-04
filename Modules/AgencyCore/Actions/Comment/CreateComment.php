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

namespace Modules\AgencyCore\Actions\Comment;


use Modules\AgencyCore\Contracts\HasCommentInterface;
use Modules\AgencyCore\DataTransferObject\CommentData;
use Modules\AgencyCore\Entities\Comment;

class CreateComment
{
    public function execute(HasCommentInterface $model, CommentData $dto): Comment {
        /** @var Comment $comment */
        $comment = $model->comments()->create([
                                                  'content' => $dto->getContent(),
                                                  'user_id' => auth()->user()->id,
                                              ]);

        return $comment;
    }
}
