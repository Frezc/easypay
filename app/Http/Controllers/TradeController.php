<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Trade;

class TradeController extends Controller {

	public function trade(Request $request) {
		$this->validate($request, [
			'token'		=>	'required|string',
			'receiver'	=>	'required|integer',
			'money'		=>	'required|min:0|numeric'
		]);

		$sender = User::where('token', $request->input('token'))->first();

		# sender find and token not expired
		if (!empty($sender) && strtotime($sender->token_expired_at) > time()) {


			# check money
			if ($sender->money < $request->input('money')) {
				return response()->json(['msg' => 'Money does not enough.']);
			}

			# change sender's money
			$sender->money -= $request->input('money');
			$sender->save();

			# add into trade form
			$trade = Trade::create([
				'pay_user_id'		=>	$sender->id,
				'receive_user_id'	=>	$request->input('receiver'),
				'trade_py'			=>	$request->input('price')
			]);

			return response()->json($trade);
		} else {
			# user not find
			return response()->json(['msg' => 'Token error.']);
		}
	}
}