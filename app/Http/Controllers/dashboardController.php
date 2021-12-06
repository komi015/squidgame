<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class dashboardController extends Controller
{
    public function openDashboard(){
        
       
            //Firts check if email is already use
            $sessionId=session('gamerId');
            if(isset($sessionId)){

                $tookInfo = DB::select(/** @lang text */ 'select name, state from users where id = :id', // Cours de 6eme ?
                            
                    [
                        'id' =>$sessionId
                    ]);

                    foreach ($tookInfo as $userName) {
                        $name = $userName->name;
                        $state = $userName->state;
                    }    

                    return view('dashboard', ['name'=>$name, 'number'=>$sessionId]); //Envoyer au niveau de la vue, les classes du prof et cours.
                    }
        
    }

    public function getTime(){

        $sessionId=session('gamerId');
            if(isset($sessionId)){

                $tookInfo = DB::select(/** @lang text */ 'select state from users where id = :id', // Cours de 6eme ?
                            
                    [
                        'id' =>$sessionId
                    ]);

                    foreach ($tookInfo as $userName) {
                        $state = $userName->state;  //Recuvoer the state alive or not of the player
                    }    


                $tookInfo = DB::select(/** @lang text */ 'select id, startDate, timer from game where end = :end', // Cours de 6eme ?
                            
                    [
                        'end' =>0
                    ]);

                    foreach ($tookInfo as $startDate) {
                        $date = $startDate->startDate;
                        $timer= $startDate->timer;
                        $gameId= $startDate->id;
                    }
                    
                    $i=0;
                    $tookInfo = DB::select(/** @lang text */ 'select id, name, state from users');

                        foreach ($tookInfo as $info) {
                            $name[$i]=$info->name;  //Recuvoer the state alive or not of the player
                            $nameId[$i]=$info->id;
                            $nameState[$i]=$info->state;
                            $i++;
                        }    

                        $dead=0;
                        $tookIt = DB::select(/** @lang text */ 'select id from users where state =0');

                            foreach ($tookIt as $info) {
                                $dead++;
                            }   
                    $totalPlayer=checkLiveNumber();
                    return response()->json(['answer'=>$date, 'timer'=>$timer, 'gameId'=>$gameId, 'gamerState'=>$state, 'gamerId'=>$sessionId,
                    'nameId'=>$nameId, 'gamer'=>$name, 'nameState'=>$nameState, 'total'=>$totalPlayer, 'dead'=>$dead]);

                    }
        
    }

    public function updateGame(Request $request){

        if(isset($request)){


                $tookInfo = DB::update(/** @lang text */ 'update game set end = :end where id = :id', // update game status
                            
                    [
                        'end' =>0,
                        'id' =>$request->post('gameId')+1
                    ]);

                    $tookInfo = DB::update(/** @lang text */ 'update game set end = :end where id = :id', // update game status
                            
                        [
                            'end' =>1,
                            'id' =>$request->post('gameId')
                        ]);

        }
    }

    public function checkAnswer(Request $request){

        if(isset($request)){

            $tookInfo = DB::select(/** @lang text */ 'select gameData  from game where id = :id', // Cours de 6eme ?
                            
                [
                    'id' =>$request->post('gameId')
                ]);

                foreach ($tookInfo as $game_Date) {
                    $data = $game_Date->gameData;
                    
                }
                
                if($data==$request->post('answer')){
                    //The player win so make it Know
                    $setGamer = DB::update(/** @lang text */ 'update gamer set state = 1 where gamerId =:id ',
                        [
                            'id'=>$request->post('gamerId')
                            
                           
                        ]);
                    return response()->json(['state'=>1]);
                }

                else{ //When player FAIL !!!!!

                   $setGamer = DB::update(/** @lang text */ 'update gamer set state = 0 where gamerId =:id ',
                        [
                            'id'=>$request->post('gamerId')
                    
                           
                        ]);

                        $tookInfo = DB::update(/** @lang text */ 'update users set state = 0 where id = :id', // update game status
                            
                            [
                                'id' =>$request->post('gamerId') //Change the state in the users table
                            ]);
                            
                            return response()->json(['state'=>0]);
                }
        }
    }

    public function getDeadPlayer(){

        $tookInfo = DB::select(/** @lang text */ 'select gamerId  from gamer where state = 0');
            $i=0;

            foreach ($tookInfo as $game) {
                $data = $game->gamerId;
                $dead[$i]=$data;
                $i++;
                
            }

            return response()->json(['dead'=>$dead]);
    }

    public function ifAnswer(Request $request){

        $tookInfo = DB::select(/** @lang text */ 'select state from gamer where gamerId = :id', // update game status
                            
            [
                'id' =>$request->post('gamerId') //Change the state in the users table
            ]);


            foreach ($tookInfo as $game) {
                $dat = $game->state;
                
            }

            return response()->json(['answer'=>$dat]);

    }


    }//Last accolade of Controler class

    function checkLiveNumber(){ //Total player number

        $infoCheck = DB::select(/** @lang text */ 'select id from users order by id desc limit 1' // Cours de 6eme ? 
        );

            foreach($infoCheck as $user){
                $number=$user->id;
            }
            return $number;
    }

