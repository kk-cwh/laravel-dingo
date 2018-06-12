<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;


class UserTransformer extends TransformerAbstract
{
	protected $availableIncludes  = [
		'role'
	];

	public function transform(User $user)
	{
		return [
			'id' => $user->id,
			'avatar' => $user->avatar,
			'name' => $user->name,
			'status' => $user->status,
			'email' => $user->email,
			'nickname' => $user->nickname,
			'is_admin' => $user->is_admin,
			'github_name' => $user->github_name,
			'website' => $user->website,
			'description' => $user->description,
			'created_at' => $user->created_at->toDateTimeString(),
		];
	}

	public function includeRole(User $user)
	{
		$roles = $user->roles;

		return $this->collection($roles, new RoleTransformer);
	}

}
