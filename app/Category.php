<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = [ 'parent_id','name', 'path', 'image_url', 'description'];

	public function parent()
	{
		return $this->belongsTo(Category::class, 'parent_id', 'id');
	}

	public function children()
	{
		return $this->hasMany(Category::class, 'parent_id', 'id');
	}
}
