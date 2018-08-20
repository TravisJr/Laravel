<?php
use Illuminate\Support\Facades\DB;

class game {
  	
  	//Получаем имя или id игры
	public function getId($parametr) {
		if (ctype_digit($parametr)) {
			$where = 'id';
			return DB::table('game')->select('name')->where($where, '=', $parametr)->first()->id;
		} else {
			$where = 'name';
			return DB::table('game')->select('id')->where($where, '=', $parametr)->first()->id;
		}

		
	} 