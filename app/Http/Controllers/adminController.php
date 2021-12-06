<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class adminController extends Controller
{

    public function adminDash(){

        if((session('adminSec')!==null)){
            return view('adminboard');
        }
    }
    
    public function getTime(){

        $sessionId=session('adminSec');
            if(isset($sessionId)){

            
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
                   // $totalPlayer=checkLiveNumber();
                    return response()->json(['answer'=>$date, 'timer'=>$timer, 'gameId'=>$gameId,  'gamerId'=>$sessionId,
                    'nameId'=>$nameId, 'gamer'=>$name, 'nameState'=>$nameState, 'dead'=>$dead]);

                    }
        
    }

    public function admin(Request $request){

        if(isset($request)){

            //Select the pass of the inseted email
            $infoCheck = DB::select(/** @lang text */ 'select * from admin where email = :email', // Cours de 6eme ?
                            
                [
                    'email' => $request->post('email')
                ]);

                if(isset($infoCheck)&&$infoCheck!=NULL){

                    foreach($infoCheck as $user){
                        $truePass=$user->pass;
                        $id=$user->id;
                    }

                    if($truePass==$request->post('pass')){  //Si le mot de pass correspond au vrai

                      session(['adminSec' => $id]);

                      return response()->json(['answer'=>'conect1']);
                    }
                    else{
                        return response()->json(['answer'=>'conect0']);
                    }
                }
                else{
                    return response()->json(['answer'=>'conect0']); //Incorrect information
                }

        }

    }

}