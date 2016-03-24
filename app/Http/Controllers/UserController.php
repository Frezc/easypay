<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Trade;

class UserController extends Controller {

	public function info(Request $request, $id) {
		$user = User::findOrFail($id);

		return response()->json($user);
	}

	public function tradeList(Request $request, $id) {
		$this->validate($request, [
			'offset' => 'numeric',
			'limit'  => 'numeric'
		]);

		$offset = $request->input('offset');
		$limit = $request->input('limit');

		$tradeList = Trade::where('pay_user_id', $id)
			->orWhere('receive_user_id', $id)
			->orderBy('created_at', 'desc')
			->offset($offset)
			->limit($limit)
			->get();
		return response()->json($tradeList);
	}
}