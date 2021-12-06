var gameTimer;
var gameStart=0;
var gameId;
var gamerState;
var gamerId;
var setAnswer;
var gamer;
var nameId;
var dead;
var NowCagnote;
var oldCagnote;
var win=0;
var alive=0;
var inc=0;
var incc=0;
var totalGamer;

$(function () {

    //Les hide du depart
    
    //Fonction pour mettre a jour l'heure du prochain jeu
    getRemainTime();
    
});


function getRemainTime(){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/get-remain-time',
        data:{ 

    },
        dataType:'json',
        success: function(data){

       if(data.answer!==null){
           remainDate = data.answer;
           gameTimer = data.timer;
           gameId=data.gameId;
           gamerState = data.gamerState;
           gamerId=data.gamerId;
           gamer = data.gamer;
           nameId= data.nameId;
           nameState=data.nameState;
           totalGamer = data.total;
           oldCagnote = data.dead;

           if(totalGamer==456){

           if(gamerState==1){

           setRemainCounter(remainDate);
           if(win==0){
           setCagnote(oldCagnote);
           }
           displayGamer(gamer, nameId, nameState);
           
        }
           //displayGamer(gamer, nameId, nameState);
           if(gamerState==0){
               loadGamerDead();
           }
        }
        else{
            $("#setTime").html('Waiting...');
            $("#gameBoard").append('<p>Wait for the number of players to reach 456. We will send you an Email, '+
            'but log in often to check. Send this link to invite others to join the game : <span style="color:red;">https://sq.cilabss.com</span></p>');
            displayGamer(gamer, nameId, nameState);

        }
        
        

      }

}



}); 
}


function updateGameStatus(gameVal){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaires
        type:'POST',
        url:'/squidgame/public/api/update-game-status',
        data:{ 
            'gameId':gameVal

    },
        dataType:'json',
        success: function(data){

       if(data.answer!==null){ 

      }

}



}); 
}

function checkIfAnswer(){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaires
        type:'POST',
        url:'/squidgame/public/api/checkIfAnswer',
        data:{ 
            'gamerId':gamerId

    },
        dataType:'json',
        success: function(data){

       if(data.answer!==null){ 
           if(data.answer==1){
           //alert("alo");
            loadYouWin();
           }
           else{
           
            checkAnswer("null");
           }

      }

}



}); 
}

function getDeadGamer(){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaires
        type:'POST',
        url:'/squidgame/public/api/get-dead-gamer',
        data:{ 

    },
        dataType:'json',
        success: function(data){

       if(data.dead!==null){ 
         dead = data.dead;
         $('#eliminatedInfo').show();
         loadInfoGame();
        }
        //getRemainTime();

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
        if(gameStart==0){
        $('#gameBoard').load('http://192.168.137.1/squidgame/resources/views/game'+gameId+'x.blade.php');
        runGamemanager();
        }
        else{
            gameStart=0;
            gameEndStatus();
        }
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


function runGamemanager(){
    gameStart=1;
    $("#setTime").html('Game will finish in </br><span id="nextTime"> </span>');
    setRemainCounter(gameTimer);

}

///When the game have end
function gameEndStatus(){
    $("#setTime").html('Next game in </br><span id="nextTime"> </span>');
    updateGameStatus(gameId);
    setTimeout(function(){ nothing(); }, 500);
    //updateGamerState();
    checkIfAnswer();
    
}

function nothing(){
    //nothing done here
    tempo=1;
}

//Function when gamer dead
function loadGamerDead(){
    $('#theMother').html('<div id="deadState"><p>You Dead !!!</p></div>');
}


function loadYouWin(){

    $('#gameBoard').load('http://192.168.137.1/squidgame/resources/views/youWin.blade.php');
    //Attendre que le temps de jeu soit epuiser

    
    getDeadGamer();    
    //setTimeout(function(){ loadYouWin(); }, 1000);
    

}

function loadInfoGame(){

    //First check the Dead in this game and load them
    
        
    
       if(inc<=dead.length){
            //alert(data.dead[4]);
            $('#idEliminated').html(dead[inc]);
            inc++;
            setTimeout(function(){ nextDisplays(); }, 1000);
       }
       if(inc==dead.length+1){
        $('#eliminatedInfo').hide();
        if(win==0){
        updateCagnote(dead);
        }
        
        win=1;
           getRemainTime();
       }

    //Now inform for news cagnote
    
}

function nextDisplays(){
    loadInfoGame();
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

function setCagnote(deadNb){
    $("#barr").html(deadNb+"<br/>Elife");
    $("#barr").css({
        width:'100%',
        height:((deadNb*100)/4)+'%' 

    });
}

function updateCagnote(dead){
    var elem = document.getElementById("barr");   
    var height = ((oldCagnote*100)/4);
    var id = setInterval(frame, 500);
    function frame() {
      if (height >= ((dead.length*100)/4)) {
        clearInterval(id);
      } else {
        height=height+((1*100)/4); 
        elem.style.height = height + '%'; 
        elem.innerHTML = height * 1  +'<br/> Elife';
      }
    }
}