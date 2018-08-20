<?php
namespace App\Tables;
	
use Illuminate\Support\Facades\DB;
	
class TrandGames {
  	

	public function getGameFromName($parametr) {
		return DB::table('trand_games')->where('name', '=', $parametr)->get();
	}


  	
  	
  	public function getAllFromId($parametr) {
		return DB::table('trand_games')->where('id', '=', $parametr)->first();
	}
  	

	public function getAll() {
		return DB::table('trand_games')->get();
	}

	public function getName($parametr) {
		return DB::table('trand_games')->select('name')->where('id', '=', $parametr)->first()->name;
	}

	public function getAvatar($parametr) {
		return DB::table('trand_games')->select('avatar_image')->where('id', '=', $parametr)->first()->avatar_image;
	}

	public function getImages($parametr) {
		return DB::table('trand_games')->select('images')->where('id', '=', $parametr)->first()->images;
	}


	public function getLinkRes($parametr) {
		return DB::table('trand_games')->select('link_resources')->where('id', '=', $parametr)->first()->link_resources;
	}


	//insert
	public function AddTrand($name = null, $avatar_image = null,  $images = null, $link_resources = null) {
        
      	if ($name != null && $avatar_image != null && $link_resources != null) {
            return DB::table('trand_games')->insertGetId(
                [
                    'name' => $name,
                    'avatar_image' => $avatar_image, 
                    'link_resources' => $link_resources
                ]);
        } else {
			return null;
        }
	}

	//update
	public function UpdateTrand($trand_games_id, $parametrs) {

		$old_values = $this->getAllFromId($id);

		$date_change = $old_values->date_change;
		$date_end = $old_values->date_end;
		$game_id = $old_values->game_id;
		$winner = $old_values->winner;
		$slot_id = $old_values->slot_id;
		$status_id = $old_values->status_id;
      	$random_number = $old_values->random_number;

		$update = false;

		if (array_key_exists('date_change', $parametrs)) {
			$date_change = $parametrs['date_change'];
			$update = true;
		} 
		
		if (array_key_exists('date_end', $parametrs)) {
			$date_end = $parametrs['date_end'];
			$update = true;
		}
		
		if (array_key_exists('game_id', $parametrs)) {
			$game_id = $parametrs['game_id'];
			$update = true;
		}
		
		if (array_key_exists('winner', $parametrs)) {
			$winner = $parametrs['winner'];
			$update = true;
		}
		
		if (array_key_exists('slot_id', $parametrs)) {
			$slot_id = $parametrs['slot_id'];
			$update = true;
		}
		
		if (array_key_exists('status_id', $parametrs)) {
			$status_id = $parametrs['status_id'];
			$update = true;
		}
      
      if (array_key_exists('random_number', $parametrs)) {
			$random_number = $parametrs['random_number'];
			$update = true;
		}

		if ($update) {
			DB::table('trand_games')->where('id', $trand_games_id)->update(
	            [
	            	'date_change' => $date_change,
	    			'date_end' => $date_end, 
	    			'game_id' => $game_id,
	    			'winner' => $winner,
	    			'slot_id' => $slot_id,
	    			'status_id' => $status_id,
                  	'random_number' => $random_number
	            ]);
			return true;
		} else {
			return false;
		}
	}
	 
  	//delete
  	public function deletetrand_games($parametr) {
    	DB::table('trand_games')->where('id', '=', $parametr)->delete();
      	return true;
    }
  
  	public function deleteAll() {
      	DB::table('trand_games')->delete();
      	return true;
    }

}
?>