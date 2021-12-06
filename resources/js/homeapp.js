$(function () {
    

    
    //$("#errorInfo").hide();
    //$("#errorInfo2").hide();
    refreshPlayerNumber();
    $("#audioMaterial")[0].play(); //Read son automaticali on login page


    $('#submiteRegister').click(function () { //Read son by submite login register information
        
        $("#audioMaterial")[0].play();
        var name = $("#name").val();
        var pass = $("#password").val();
        var email = $("#email").val();

        sendCreateInfo(name, pass, email);

    });


 

    $('#submiteLogin').click(function () { //Read son by submite login before account information
        
        $("#audioMaterial")[0].play();
        var pass = $("#passwordOld").val();
        var email = $("#emailOld").val();

        oldLogin(email, pass);
    });

    //Open box for regist new user
    $("#register").click(function(){

        $("#connectBox").hide();
        loadinAnim(0);

    });

    //Open box to login if you have account
    $("#loginNow").click(function(){

        $("#registBox").hide();

        loadinAnim(1);
    });
}); 


//Generer affichage animation
function loadinAnim( i){

    $("#anim").show();
    $("#anim").css({
        'background-image' : 'url("http://192.168.137.1/squidgame/resources/image/anim.gif")',
        'background-color' : 'none',
        'background-size' : '100px',
        'background-repeat':'no-repeat',
        'height' : '125px',
        'width': '125px',
        'margin-left': '40%'
    });

    if(i==0){
    setTimeout(function(){ setCreateBox(); }, 500);
}
    if(i==1){   //Reaficher le box de connection
    setTimeout(function(){ setLoginBox(); }, 500);

    }
}


//Fermer l'animation
function setCreateBox(){
    $("#anim").hide();
    $("#registBox").css({
        'display':'block'
    });
}

//Fonction pour fermer l'animation
function setLoginBox(){
    $("#anim").hide();
    $("#connectBox").show(); 
}

//Cette fonction est pour faire enregistrer un nouveau utilisateur
function sendCreateInfo(name, pass, email){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement new
        type:'POST',
        url:'/squidgame/public/api/new-account',
        data:{ 
        'name':name , 
        'pass':pass,
        'email': email

    },
        dataType:'json',
        success: function(data){

       if(data.answer=='creat1'){

        window.location.href= "http://192.168.137.1/squidgame/public/user/game-dashboard/";
      }

    if(data.answer=='creat0'){

    $("#errorInfo").html('If this is your account, Please Login');
    }
    if(data.answer=='creat01'){

        $("#errorInfo").html('Incorrect login information, Please retry');
        }
}



}); 
}


//Fonction nto connect old user
function oldLogin(email, pass){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
        type:'POST',
        url:'/squidgame/public/api/old-account',
        data:{ 
        'pass':pass,
        'email': email

    },
        dataType:'json',
        success: function(data){

       if(data.answer=='conect1'){
        //alert('Good');
        window.location.href= "http://192.168.137.1/squidgame/public/user/game-dashboard/";
      }

    if(data.answer=='conect0'){

    $("#errorInfo").html('Incorrect login information, Please retry');
    }
}



}); 
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
        $("#liveNumber").html(data.answer);
        $("#infoToPlayer").html('The game has already started, if you have an account, please login')
        $("#register").hide();
      }

    if(data.answer<456){

    $("#liveNumber").html(data.answer);
    }

    refreshAgainNumber();
}



}); 

}

function refreshAgainNumber(){
    setTimeout(function(){ refreshPlayerNumber(); }, 500);
}