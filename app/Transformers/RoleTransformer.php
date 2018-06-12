<?php
/**
 * Created by PhpStorm.
 * User: ZY
 * Date: 2018/6/12
 * Time: 14:33
 */

namespace App\Transformers;


use App\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
	protected $availableIncludes  = [
		'user'
	];

	public function transform(Role $role)
	{
	 return $role->getAttributes();
	}

	public function includeUser(Role $role)
	{
		$users = $role->users;

		return $this->collection($users, new UserTransformer);
	}
}