<?php
namespace App\Api\Controllers;

use App\Transformers\UserTransformer;


class AuthController extends BaseController
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//  放到路由文件 api.php中 此处不在需要
		// $this->middleware('auth:api', ['except' => ['login']]);
	}

	/**
	 * Get a JWT via given credentials.
	 * 用户登录
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \ErrorException
	 */
	public function login()
	{
		$credentials = request(['name','password']);
		// $credentials['status'] = 1 ; 用户启用
		if (! $token = auth()->attempt($credentials)) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}

		return $this->respondWithToken($token);
	}

	/**
	 * Get the authenticated User.
	 * 获取登录用户信息
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		return $this->response->item(auth()->user(),new UserTransformer);
	}

	/**
	 * Log the user out (Invalidate the token).
	 * 退出登录
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth()->logout();

		return response()->json(['message' => 'Successfully logged out']);
	}

	/**
	 * Refresh a token.
	 * 刷新token
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \ErrorException
	 */
	public function refresh()
	{
		return $this->respondWithToken(auth()->refresh());
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \ErrorException
	 */
	protected function respondWithToken($token)
	{
		// return response()->json();
		return  $this->response->array([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth()->factory()->getTTL() * 60
		]);
	}
}
