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

		$username = $request->input('username');
		$password = $request->input('password');
		$user = User::where('username', $username)->firstOrFail();
		if (Hash::check($password, $user->password)) {
			$user->token = str_random(64);
			$user->token_expired_at = date('Y-m-d H:i:s', time() + 2592000);
			$user->save();
			return response()->json(['user' => $user, 'token' => $user->token, 'token_expired_at' => $user->token_expired_at]);
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