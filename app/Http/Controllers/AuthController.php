<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;

class AuthController extends Controller {

	public function auth(Request $request) {
		$this->validate($request, [
			'password'  => 'required',
            'username'  => 'required|exists:users,username'
		]);

		$user = User::where('username', $username)->firstOrFail();
		if ($user->password === Hash::make($password)) {
			$user->token = Hash::make($user->username);
			$user->token_expired_at = date('Y-m-d H:i:s', time() + 2592000);
			return response()->json($user);
		} else {
			return response()->json(['error' => 'password error']);
		}
	}

	public function register (Request $request) {
		$this->validate($request, [
			'password'  => 'required|between:6,64',
            'username'  => 'required|unique:users,username|max:32'
		]);

		$user = new User;
		$user->username = $request->input('username');
		$user->password = Hash::make($request->input('password'));
		$user->money = 0.0;
		$user->save();

		return response()->json($user);
	}
}