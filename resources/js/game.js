
$(function () {

    //Fonction pour php:game1x.blade.php & game1data.blade.php-------------GAME 1
    $('#startButton').click(function () { //Read son by submite login before account information
        
        $('#gamex').load('http://192.168.137.1/squidgame/resources/views/game'+gameId+'data.blade.php');
    });

    //FOR GAME DATA

    $('#sendAnswer').click(function () { //Read son by submite login before account information
        var gameAnswer = $("#gameText").val();
        checkAnswer(gameAnswer);
    });
});   
   
function checkAnswer(gameAnswerText){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/checkAnswer',
        data:{ 
            'answer':gameAnswerText,
            'gameId':gameId,
            'gamerId':gamerId
    },
        dataType:'json',
        success: function(data){

       if(data.state!==null){
        
           if(data.state==1){
               //alert("jj");
               youWin();
               //setRemainCounter(remainDate); to chANGE THE REMAINNING TIME
        }
           if(data.state==0){
               loadGamerDead();
           }

           

      }

}

}); 
} 



function youWin(){

    $('#gameBoard').load('http://192.168.137.1/squidgame/resources/views/youWin.blade.php');
    //alert("kk");
    //Attendre que le temps de jeu soit epuiser

}
