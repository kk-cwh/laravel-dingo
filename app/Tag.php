<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = ['tag','title','meta_description'];


    public function articles(){
      return  $this->belongsToMany(Article::class,'tag_articles','tag_id','article_id');
    }


}
