<?php
namespace App\Tables;
	
use Illuminate\Support\Facades\DB;
	
class StausUser {
  	
  	//принимает id игры
	public function get($parametr) {
		return DB::table('status_user')->where('id', '=', $parametr)->get();
	}
  	
  	//принимает id user
  	public function getAllFromId($parametr) {
		return DB::table('status_user')->where('id', '=', $parametr)->first();
	}
  	

	public function getAll() {
		return DB::table('status_user')->get();
	}

	public function getStatus($parametr) {
		return DB::table('status_user')->select('name_status')->where('id', '=', $parametr)->first()->name_status;
	}


	//insert
	public function addstatus($id = null, $name_status = null) {
        
      	if ($id != null && $name_status != null) {
            return DB::table('status_user')->insertGetId(
                [
                    'id' => $id,
                    'name_status' => $name_status, 
                ]);
        } else {
			return null;
        }
	}

	//update
	public function updatestatus ($id, $parametrs) {

		$old_values = $this->getAllFromId($id);

		$name_status = $old_values->name_status;

		$update = false;

		if (array_key_exists('name_status', $parametrs)) {
			$name_status = $parametrs['name_status'];
			$update = true;
		} 
	

		if ($update) {
			DB::table('status_user')->where('id', $id)->update(
	            [
	            	'name_status' => $name_status
	            ]);
			return true;
		} else {
			return false;
		}
	}
	 
  	//delete
  	public function deleteStatus($parametr) {
    	DB::table('status_user')->where('id', '=', $parametr)->delete();
      	return true;
    }
  
  	public function deleteAll() {
      	DB::table('status_user')->delete();
      	return true;
    }

}
?>