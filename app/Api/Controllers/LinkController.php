<?php

namespace App\Api\Controllers;

use App\Link;
use App\Transformers\LinkTransformer;
use Illuminate\Http\Request;

class LinkController extends BaseController
{

    protected $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = $this->link->paginate();
        return $this->response->paginator($links, new LinkTransformer);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $this->link->fill($inputs)->save();
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
        $link = $this->link->find($id);
        return $this->response->item($link, new LinkTransformer);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updates = $request->only($this->link->getFillable());
        $this->link->where('id', $id)->update($updates);
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
        $this->link->where('id', $id)->update(['status'=>0]);
        return $this->response->noContent();
    }
}
