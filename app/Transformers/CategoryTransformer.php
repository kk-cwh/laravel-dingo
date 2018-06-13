<?php
/**
 * Created by PhpStorm.
 * User: ZY
 * Date: 2018/6/12
 * Time: 14:33
 */

namespace App\Transformers;


use App\Category;

use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
	protected $availableIncludes  = [
		'children','parent'
	];

	public function transform(Category $category)
	{
	 return $category->getAttributes();
	}

	public function includeParent(Category $category)
	{
		$category = $category->parent;
        if($category){
	        return $this->item($category, new CategoryTransformer);
        }
	}

	public function includeChildren(Category $category)
	{
		$categories = $category->children;

		return $this->collection($categories, new CategoryTransformer);
	}
}