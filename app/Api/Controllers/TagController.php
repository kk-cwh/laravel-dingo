<?php

namespace App\Api\Controllers;

use App\Tag;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;

class TagController extends BaseController
{

    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tag->paginate();
        return $this->response->paginator($tags, new TagTransformer);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { $inputs = $request->all();
        $this->tag->fill($inputs)->save();
        return $this->response->created();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = $this->tag->find($id);
        return $this->response->item($tag, new TagTransformer);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updates = $request->only($this->tag->getFillable());
        $this->tag->where('id', $id)->update($updates);
        return $this->response->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tag->where('id', $id)->update(['status'=>0]);
        return $this->response->noContent();
    }
}
