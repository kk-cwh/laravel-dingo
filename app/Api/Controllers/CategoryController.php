<?php

namespace App\Api\Controllers;

use App\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{

	protected $category;

	public function __construct(Category $category)
	{
		$this->category = $category;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$categories = $this->category->paginate();
		return $this->response->paginator($categories, new CategoryTransformer());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validateRequest($request,[
			'name'=>'required',
			'path'=>'required',
		]);
		$inputs = $request->all();
		$parentId = array_get($inputs,'parent_id',0);
		$category = $this->category->find($parentId);
		if (!$category){
			$inputs['parent_id'] = 0;
		}
		$this->category->fill($inputs)->save();
		return $this->response->created();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$category =$this->category->find($id);
// return $category;
		return $this->response->item($category, new CategoryTransformer);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$updates = $request->only($this->category->getFillable());
		$this->category->where('id', $id)->update($updates);
		return $this->response->noContent();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$this->category->where('id', $id)->update(['status' => 0]);
		return $this->response->noContent();
	}
}
