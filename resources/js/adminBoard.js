var gameTimer;
var gameId;
var gamerState;
var gamerId;
var gamer;
var nameId;
var dead;
var inc=0;
var incc=0;

$(function () {

    //Les hide du depart
    
    //Fonction pour mettre a jour l'heure du prochain jeu
    getRemainTime();
    refreshPlayerNumber();
    $('#submiteLogin').click(function () { //Read son by submite login before account information
        
        var pass = $("#password").val();
        var email = $("#email").val();

        oldLogin(email, pass);
    });

    
    
    $('#insertPlayer').click(function () { //Read son by submite login before account information
        
       insertPlayer();
    });

    $('#killNotPlay').click(function () { //Read son by submite login before account information
        
        killNotPlays();
     });

    
});


//For admin login
function oldLogin(email, pass){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/adminlogin',
        data:{ 
        'pass':pass,
        'email': email

    },
        dataType:'json',
        success: function(data){

       if(data.answer=='conect1'){
        //alert('Good');
        window.location.href= "http://192.168.137.1/squidgame/public/user/admin-dashboard-safe/";
      }

    if(data.answer=='conect0'){

    $("#errorInfo").html('Incorrect login information, Please retry');
    }
}



}); 
}

function getRemainTime(){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/getAdmin',
        data:{ 

    },
        dataType:'json',
        success: function(data){

       if(data.answer!==null){ 
           remainDate = data.answer;
           gamer = data.gamer;
           nameId= data.nameId;
           nameState=data.nameState;
          
           setRemainCounter(remainDate);
           displayGamer(gamer, nameId, nameState);      
        
      }

}

}); 
}

function extractDateValue(date){

    years = new String;
    month = new String;
    days = new String;
    hours =new String;
    minut = new String;
    second = new String;

    for(i=0;i<date.length;i++){

        if((date[i]!='-')&&(date[i]!=' ')&&(i<4)) {  //Here get Year
            years+=date[i];
        } 
        if((date[i]!='-')&&(date[i]!=' ')&&(i>4)&&(i<7)) {  //Here get month
            month+=date[i];
        }
        if((date[i]!='-')&&(date[i]!=' ')&&(i>7)&&(i<10)) {  //Here get days
            days+=date[i];
        }  
        if((date[i]!='-')&&(date[i]!=' ')&&(i>10)&&(i<13)) {  //Here get hours
            hours+=date[i];
        }
        if((date[i]!='-')&&(date[i]!=' ')&&(i>13)&&(i<16)) {  //Here get minut
            minut+=date[i];
        } 
        if((date[i]!='-')&&(date[i]!=' ')&&(i>16)&&(i<19)) {  //Here get second
            second+=date[i];
        }             
    }


 var  dateVal = {
        Yy: years,
        Mm: month,
        Dd: days,
        Hh: hours,
        Mn: minut,
        Ss: second
        
    };
    return dateVal;
}

function setRemainCounter(date){

    setDate=(String(date));
    //alert(setDate);
    var dateValue = extractDateValue(setDate);

    //alert(dateValue.Mm+"ddd"+dateValue.Dd+"dd"+dateValue.Yy);
    let remain = Date.UTC(parseInt(dateValue.Yy), (parseInt(dateValue.Mm)-1), (parseInt(dateValue.Dd)), 
    (parseInt(dateValue.Hh)), (parseInt(dateValue.Mn)), (parseInt(dateValue.Ss)));

    let nowTime= Date.now();
    //alert(remain-nowTime);
    //$('#nextTime').html(remain-nowTime);

    setCounter(remain-nowTime);
}

function setCounter(mTime){

    var  Stime = Math.floor(mTime/1000); //This is the time in second
    var Htime = Math.floor(Stime/3600);
    var Rsecond = Stime%3600; 
    var Mtime = Math.floor(Rsecond/60);
    var Rsecond = Rsecond%60;


    $("#nextTime").html(Htime+": "+Mtime+": "+Rsecond);
    
    if((Htime<=0)&&(Mtime<=0)&&(Stime<=0)){ //
        $("#nextTime").html("Game was starting");

    }
    else{

    setTimeout(function(){ decrementTime(mTime); }, 1000);
    }

}

function decrementTime(time){

    var T;
    T=(parseInt(time)-1000);
  // alert("T :"+T);
    setCounter(T);
}

function displayGamer(gamer, nameId, nameState){
    if(incc<gamer.length){
        //alert(gamer.length);
        if(nameState[incc]==1){
        $("#listName").append('<p id="listNow">'+gamer[incc]+ '<span id="listId"> #'+nameId[incc]+'</span></p>');
        alive++;
        $("#alive").html(alive);
        }
        if(nameState[incc]==0){
            $("#listName").append('<p id="listNow" style="background-color:red;">'+gamer[incc]+ '<span id="listId"> #'+nameId[incc]+'</span></p>');
        }
        incc++;
        setTimeout(function(){ nextDisplaysName(); }, 700);
    }

}

function nextDisplaysName(){
    displayGamer(gamer, nameId, nameState);
}

function refreshPlayerNumber(){ //Refresh the already join number

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/check-player-number',
        data:{ 
        
    },
        dataType:'json',
        success: function(data){

       if(data.answer==456){
        $("#liveNumber").html(data.answer+"<br/>Join now"+"<br/>with<br/>"+data.visitor+"</br>Visitors");
      }

    if(data.answer<456){

    $("#liveNumber").html(data.answer+"<br/>Join now"+"<br/>with<br/>"+data.visitor+"</br>Visitors");
    }

    refreshAgainNumber();
}



}); 

}

function refreshAgainNumber(){
    setTimeout(function(){ refreshPlayerNumber(); }, 500);
}

function insertPlayer(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/insertAlivePlayers',
        data:{ 
        
    },
        dataType:'json',
        success: function(data){

       if(data.answer==1){
        alert("Players inserted !!!");
      }
}



});
}

function killNotPlays(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/killPlayersNotPlays',
        data:{ 
        
    },
        dataType:'json',
        success: function(data){

       if(data.answer==1){
           alert("Not plays players was killed !!!");
   
        }

}



});
}