<?php
/**
 * Created by PhpStorm.
 * User: ZY
 * Date: 2018/6/11
 * Time: 15:03
 */

namespace App\Api\Controllers;


use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * 用户列表
	 * @return \Dingo\Api\Http\Response
	 */
	public function index()
	{
		$users = $this->user->paginate();
		return $this->response->paginator($users, new UserTransformer);
	}

	/**
	 * 用户详情
	 * @param $id
	 * @return \Dingo\Api\Http\Response|void
	 */
	public function show($id)
	{
		$user = $this->user->find($id);
		if (!$user) {
			return $this->response->errorNotFound();
		}
		return $this->response->item($user, new UserTransformer)->addMeta('token', 'bar');
	}

	/**
	 * 创建新用户
	 * @param Request $request
	 * @return \Dingo\Api\Http\Response
	 */
	public function store(Request $request)
	{
		$inputs = $request->all();
		$inputs['password'] = Hash::make($inputs['password']);
		$this->user->fill($inputs)->save();
		return $this->response->created();
	}

	/**
	 * 更新用户信息
	 * @param Request $request
	 * @param         $id
	 * @return \Dingo\Api\Http\Response
	 */
	public function update(Request $request,$id)
	{
		$this->user->where('id',$id)->update($request->only($this->user->getFillable()));
		return $this->response->noContent();
	}

	/**
	 * 用户禁用
	 * @param $id
	 * @return \Dingo\Api\Http\Response
	 */
	public function destroy($id)
	{
		$this->user->where('id', $id)->update(['status' => 0]);
		return $this->response->noContent();
	}
}