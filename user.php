<?php
use Illuminate\Support\Facades\DB;

class User {
  	
  	//принимает никнейм или почту
	public function getId($parametr) {
		if (stristr($parametr, '@') == true) {
			$where = 'email';
		} else {
			$where = 'nickname';
		}

		return DB::table('user')->select('id')->where($where, '=', $parametr)->first()->id;
	}

	//select
	public function getAll() {
		return DB::table('user')->get();
	}

	public function getAllFromId($parametr) {
		return DB::table('user')->where('id', '=', $parametr)->first();
	}

	public function getBalance($parametr) {
		return DB::table('user')->select('balance')->where('id', '=', $parametr)->first()->balance;
	}

	public function getIdStatus($parametr) {
		return DB::table('user')->select('id_status')->where('id', '=', $parametr)->first()->id_status;
	}

	public function getNickname($parametr) {
		return DB::table('user')->select('nickname')->where('id', '=', $parametr)->first()->nickname;
	}

	public function getEmail($parametr) {
		return DB::table('user')->select('email')->where('id', '=', $parametr)->first()->email;
	}

	//insert
	public function addUser($nickname, $email,  $password, $balance = 0, $link_image = null, $id_status = null) {
		return DB::table('user')->insertGetId(
    		[
    			'nickname' => $nickname,
    			'email' => $email, 
    			'balance' => $balance,
    			'link_image' => $link_image,
    			'password' => $password,
    			'id_status' => $id_status
    		]);
	}

	//update
	public function updateUser($user_id, $parametrs) {

		$old_values = $this->getAllFromId($user_id);

		$nickname = $old_values->nickname;
		$email = $old_values->email;
		$balance = $old_values->balance;
		$link_image = $old_values->link_image;
		$password = $old_values->password;
		$id_status = $old_values->id_status;

		$update = false;

		if (array_key_exists('nickname', $parametrs)) {
			$nickname = $parametrs['nickname'];
			$update = true;
		} 
		
		if (array_key_exists('email', $parametrs)) {
			$email = $parametrs['email'];
			$update = true;
		}
		
		if (array_key_exists('balance', $parametrs)) {
			$balance = $parametrs['balance'];
			$update = true;
		}
		
		if (array_key_exists('link_image', $parametrs)) {
			$link_image = $parametrs['link_image'];
			$update = true;
		}
		
		if (array_key_exists('password', $parametrs)) {
			$password = $parametrs['password'];
			$update = true;
		}
		
		if (array_key_exists('id_status', $parametrs)) {
			$id_status = $parametrs['id_status'];
			$update = true;
		}

		if ($update) {
			DB::table('user')->where('id', $user_id)->update(
	            [
	            	'nickname' => $nickname,
	    			'email' => $email, 
	    			'balance' => $balance,
	    			'link_image' => $link_image,
	    			'password' => $password,
	    			'id_status' => $id_status
	            ]);
			return true;
		} else {
			return false;
		}
	}
 	
  	//delete
  	public function deleteUser($parametr) {
    	DB::table('user')->where('id', '=', $parametr)->delete();
      	return true;
    }
  
  	public function deleteAll() {
      	DB::table('user')->delete();
      	return true;
    }

}

?>