<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BlockIo;
use App\User;
use App\Wallet;
use Exception;

class HomeController extends Controller
{
	protected $pin = "Gimme1freakingbreak";
	protected $version = 2; 
	
    /**
     * Show the listing of all wallets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = [];
		
		$user = User::all()->first();
		foreach($user->wallets as $wallet){
			$apiKey = $wallet->api_key;
			$block_io = new BlockIo($apiKey, $this->pin, $this->version);
			$account_balance = $block_io->get_balance()->data;
			$account_balance->id = $wallet->id;
			array_push($data, $account_balance);
		}
		
		return response()->view('home',['data' => $data]);
    }
	
	/**
     * Show the details of one particular wallet.
	 *
     * @param  integer $wallet_id
     * @return \Illuminate\Http\Response
     */
    public function getWalletDetails($wallet_id)
    {
		$wallet = Wallet::find($wallet_id);
		/*
		*	Since there is only 1 user in the database right now, no authentication is implemented.
		*	In reality, there should be checks here to see if the user is logged in 
		*	and if the logged in user has access to this particular wallet.
		* 	This can be done easily by querying the record and check if the user_id of this wallet match 
		*   the id of the logged in user
		*/
		$block_io = new BlockIo($wallet->api_key, $this->pin, $this->version);
		$fetch_data = $block_io->get_my_addresses(array('page' => ''));
		
		if($fetch_data->status == 'success'){
			$data= $fetch_data->data;
			$data->wallet_id = $wallet_id;
			return response()->view('wallet',['data' => $data]);
		}else{
			return redirect()->route('home');
		}
    }
	
	/**
     * Show the form for sending money
     *
     * @param  integer $wallet_id
	 * @param  string $address
     * @return \Illuminate\Http\Response
     */
	public function openSendMoneyForm($wallet_id, $address)
    {
        $wallet = Wallet::find($wallet_id);
		$block_io = new BlockIo($wallet->api_key, $this->pin, $this->version);
		
		$get_address = $block_io->get_address_balance(array('addresses' => $address)); // validate the address first
		if($get_address->status === 'success'){
			$address = $get_address->data->balances[0];
			$address->wallet_id = $wallet_id;
			$address->minimum_amount = $this->getMinimumAmount($wallet->api_key);
			return response()->view('form',['address' => $address]);
		}else{
			return redirect()->route('wallet-details', ['wallet' => $wallet_id]);
		}
    }
	
	/**
     * Send money
     *
	 * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function sendMoney(Request $request)
    {
		$wallet_id = $request->wallet_id;
		$wallet = Wallet::find($wallet_id);

		$block_io = new BlockIo($wallet->api_key, $this->pin, $this->version);
		
		$success = '';
		$error = '';
		
		$validate_address = $block_io->is_valid_address(array('address' => $request->to_address));
		if($validate_address->status === 'fail' || ($validate_address->status === 'success' && $validate_address->data->is_valid == false)){
			$error = 'Invalid address!';
		}else{
			$send_money = $block_io->withdraw(array('amounts' => $request->amount, 'from_addresses' => $request->from_address, 'to_addresses' => $request->to_address));
			if($send_money->status === 'success'){
				$success = 'Money sent successfully!';
			}else{
				$error = $send_money->data->error_message;
			}
		}

		$get_address = $block_io->get_address_balance(array('addresses' => $request->from_address));
		$address = $get_address->data->balances[0];
		$address->wallet_id = $wallet_id;
		$address->minimum_amount = $this->getMinimumAmount($wallet->api_key);
		return redirect()->route('open-form', ['wallet_id' => $wallet_id, 'address' => $address->address])
			->with('success', $success) 
			->with('error', $error); 
    }
	
	/**
     * Get the minimum withdrawal amount for a specific network
     *
	 * @param  string $api_key
     * @return double
     */
	public function getMinimumAmount($api_key){
		switch ($api_key) {
			case "d691-d261-17e2-f3b5":
				return 0.0002;
				break;
			case "f987-9200-b80f-5e2f":
				return 0.00002;
				break;
			case "bd8e-4a98-6d26-dfd0":
				return 2;
				break;
			default:
				return 0;
		}
	}
	
	
}
