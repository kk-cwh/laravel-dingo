<?php
/**
 * Created by PhpStorm.
 * User: ZY
 * Date: 2018/6/11
 * Time: 15:03
 */

namespace App\Api\Controllers;


use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends  Controller
{
	use Helpers;

	protected function validateRequest(Request $request, array $rules)
	{

		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			// $errorMessages = $validator->errors()->messages();
			//
			// foreach ($errorMessages as $key => $value) {
			// 	$errorMessages[$key] = $value[0];
			// }
			$errorMessages = $validator->errors()->first();
			return $this->response->error($errorMessages,400);
		}
		return true;
	}
}