<?php
/**
 * Created by PhpStorm.
 * User: jaak
 * Date: 2018/6/12
 * Time: 22:09
 */

namespace App\Transformers;


use App\Link;
use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract
{

    public function transform(Link $link)
    {
        return [
            'id' => $link->id,
            'link' => $link->link,
            'name' => $link->name,
            'status' => $link->status,
            'created_at' => $link->created_at->toDateTimeString(),
        ];
    }
}