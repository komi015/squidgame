<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;


class userController extends Controller
{
    public function newUser(Request $request){
        
        if(isset($request)&&($request->post('name')!=NULL)&&($request->post('pass')!=NULL)&&
        ($request->post('email')!=NULL)){

            //Firts check if email is already use

            $emailCheck = DB::select(/** @lang text */ 'select id from users where email = :email', // Cours de 6eme ?
                            
                [
                    'email' => $request->post('email')
                ]);

                if(isset($emailCheck)&&$emailCheck==NULL){  //That means email not use

            DB::insert(/** @lang text */ 'insert into users (name, pass, email, state) values (?, ?, ?,?)',
                [
                    $request->post('name'),
                    $request->post('pass'),
                    $request->post('email'),
                    1
                ]);

                sendEmailAdmin($request->post('name'));
                sendEmailUser($request->post('email'),$request->post('name'));
               


                $emailCheck = DB::select(/** @lang text */ 'select id from users where email = :email', // Cours de 6eme ?
                            
                    [
                        'email' => $request->post('email')
                    ]);

                    foreach ($emailCheck as $userId) {
                        $id = $userId->id;
                    }

                session(['gamerId' => $id]);

                return response()->json(['answer'=>'creat1']);

            }

        else{
            return response()->json(['answer'=>'creat0']);
        }
    }
    else{
        return response()->json(['answer'=>'creat01']);
    }
}


    public function oldUser(Request $request){

        if(isset($request)){

            //Select the pass of the inseted email
            $infoCheck = DB::select(/** @lang text */ 'select * from users where email = :email', // Cours de 6eme ?
                            
                [
                    'email' => $request->post('email')
                ]);

                if(isset($infoCheck)&&$infoCheck!=NULL){

                    foreach($infoCheck as $user){
                        $truePass=$user->pass;
                        $id=$user->id;
                    }

                    if($truePass==$request->post('pass')){  //Si le mot de pass correspond au vrai

                      session(['gamerId' => $id]);

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

    public function checkLiveNumber(Request $request){

        $infoCheck = DB::select(/** @lang text */ 'select id from users order by id desc limit 1' // Cours de 6eme ? 
        );

            foreach($infoCheck as $user){
                $number=$user->id;
            }

            if((session('visito')==null)){
                session(['visito' => '0028']);


                $ip=getUserIP();

                DB::insert(/** @lang text */ 'insert into visitor (ip) values (?)',
                    [
                        $ip
                       
                    ]);
            }

            $infoCheck = DB::select(/** @lang text */ 'select id from visitor order by id desc limit 1' // Cours de 6eme ? 
            );
    
                foreach($infoCheck as $user){
                    $visitor=$user->id;
                }
            return response()->json(['answer'=>$number, 'visitor'=>$visitor]); //Incorrect information
    }
}

function sendEmailAdmin($name){

$headers ='From: squidgame@cilabss.com'."\n";
    $headers .='Reply-To: squidgame@cilabss.com'."\n";
    $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
    $headers .='Content-Transfer-Encoding: 8bit';
    mail('admin_email','New Account on Squid Game',
   'Hi Manou, new Squid game player : '.$name.' ...it comming', $headers);

}
function sendEmailUser($email, $name){

    $headers ='From: server_email'."\n";
    $headers .='Reply-To: server_email'."\n";
    $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
    $headers .='Content-Transfer-Encoding: 8bit';
    mail($email,'New Account on Squid Game',
   'Welcome to Squid Game '.$name.'!. Wait, Wait for the number of players to reach 456. We will send you an Email, but log in often to check. 
   https://sq.cilabss.com', $headers);
}

function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
