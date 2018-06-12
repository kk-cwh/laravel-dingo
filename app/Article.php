<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'type_id', 'user_id', 'is_show', 'content','content_md'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'tag_articles','article_id','tag_id');
    }
}
