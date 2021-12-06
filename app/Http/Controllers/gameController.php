<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class gameController extends Controller
{
    //insert alive player into the game
    public function insertAlivePlayer(){
        //First we clean the last gamer table
        $delete= DB::delete(/** @lang text */ 'delete from gamer');


        //After we select the alive player for the next game
        $tookInfo = DB::select(/** @lang text */ 'select id  from users where state = 1'); // Cours de 6eme ?
                            
        //Here we insert the alive player in the game table
            foreach ($tookInfo as $userId) {
                $ids = $userId->id;
                
                DB::insert(/** @lang text */ 'insert into gamer (gamerId, state) values (?, ?)',
                    [
                        $ids,
                        0
                    ]);
            } 
            
            return response()->json(['answer'=>1]);
    }

    //To make dead player who do not plays
    public function updateNoPlayGamer(){

        $tookInfo = DB::select(/** @lang text */ 'select gamerId  from gamer where state = 0'); 

            foreach($tookInfo as $userId){
                $ids = $userId->gamerId;

                $setUsers = DB::update(/** @lang text */ 'update users set state = 0 where id =:id ',
                    [
                        'id'=>$ids         
                       
                    ]);
            }
            return response()->json(['answer'=>1]);


    }

}