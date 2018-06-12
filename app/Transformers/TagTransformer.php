<?php
/**
 * Created by PhpStorm.
 * User: jaak
 * Date: 2018/6/12
 * Time: 22:09
 */

namespace App\Transformers;


use App\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{

    public function transform(Tag $tag)
    {
        return [
            'id' => $tag->id,
            'meta_description' => $tag->meta_description,
            'title' => $tag->title,
            'tag' => $tag->tag,
            'created_at' => $tag->created_at->toDateTimeString(),
        ];
    }
}