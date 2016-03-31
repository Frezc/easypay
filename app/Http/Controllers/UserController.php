<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Trade;

class UserController extends Controller {

	public function info($id) {
		$user = User::findOrFail($id);

		return response()->json($user);
	}

	public function recharge(Request $request) {
		$this->validate($request, [
			'userId' => 'required|integer',
			'money'  => 'required|integer|min:0'
		]);
		
		$user = User::findOrFail($request->input('userId'));
		$user->update(['money' => $user->money + $request->input('money')]);
		
		return 'success';
	}

	public function tradeList(Request $request, $id) {
		$this->validate($request, [
			'offset' => 'integer|min:0',
			'limit'  => 'integer|min:0'
		]);

		$offset = $request->input('offset', 0);
		$limit = $request->input('limit', 10);

		$tradeList = Trade::where('pay_user_id', $id)
			->orWhere('receive_user_id', $id)
			->orderBy('created_at', 'desc')
			->offset($offset)
			->limit($limit)
			->get();
		return response()->json($tradeList);
	}
}
