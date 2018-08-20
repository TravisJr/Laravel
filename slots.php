<?php
namespace App\Tables;
	
use Illuminate\Support\Facades\DB;
	
class Slots {
  	
  	//принимает id слота
	public function getIdFromID($parametr) {
		return DB::table('slots')->where('id', '=', $parametr)->get();
	}
  	
  	//принимает id слота
  	public function getAllFromID($parametr) {
		return DB::table('slots')->where('id', '=', $parametr)->first();
	}
  	

	public function getAll() {
		return DB::table('slots')->get();
	}

	public function getNumber($parametr) {
		return DB::table('slots')->select('number')->where('id', '=', $parametr)->first()->number;
	}

	public function getBuy($parametr) {
		return DB::table('slots')->select('buy')->where('id', '=', $parametr)->first()->buy;
	}

	//insert
	public function addSlots($id = null, $number = null,  $buy = null) {
        
      	if ($id != null && $number != null && $buy != null) {
            return DB::table('slots')->insertGetId(
                [
                    'id' => $id,
                    'number' => $number, 
                    'buy' => $buy,
                    
                ]);
        } else {
			return null;
        }
	}

	//update
	public function updateSlots($id, $parametrs) {

		$old_values = $this->getAllFromId($id);

		$number = $old_values->number;
		$buy = $old_values->buy;

		$update = false;

		if (array_key_exists('number', $parametrs)) {
			$number = $parametrs['number'];
			$update = true;
		} 
		
		if (array_key_exists('buy', $parametrs)) {
			$buy = $parametrs['buy'];
			$update = true;
		}


		if ($update) {
			DB::table('slots')->where('id', $id)->update(
	            [
	            	'number' => $number,
	    			'buy' => $buy, 
	    			
	            ]);
			return true;
		} else {
			return false;
		}
	}
	 
  	//delete
  	public function deleteSlots($parametr) {
    	DB::table('slots')->where('id', '=', $parametr)->delete();
      	return true;
    }
  
  	public function deleteAll() {
      	DB::table('slots')->delete();
      	return true;
    }

}
?>