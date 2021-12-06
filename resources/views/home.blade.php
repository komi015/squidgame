<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta property="og:url"           content="https://http://192.168.137.1/squidgame/public/" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Join Squid game !" />
<meta property="og:description"   content="Now Squid game still open for joining. Create your account before the limite of 456 players, and be the next winner of 455 Elife..." />
<meta property="og:image"         content="http://192.168.137.1/squidgame/resources/logonglet.png" />
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	  <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
      rel="stylesheet"
	  type="text/css" title="perso_style" href="http://192.168.137.1/squidgame/resources/css/home.css">
	<link 
      rel="stylesheet"
	  type="text/css" title="boostrap" href="http://192.168.137.1/onedolars/resources/bootstrap/bootstrap.min.css">
    <link
      rel="shortcut icon"
	  href="http://192.168.137.1/squidgame/resources/logonglet.png">

    <title>Squid game, plays here !</title>
  </head>

  <body class="container-fluid">
    <div id="back">
      <h1> Login to join <br/>the Squid Game</h1>
      <p id="ads">and  be the next winner to win 455 Elife (game life)<br/>
    that you can sell to players on the next tour of Squid game !!!.</p>
      <h2 id="livePlayerdisplays"><span id="liveNumber">...</span>/456 players </br>join now</h2>
      <h2 id="infoToPlayer">The game will start when 456 players register <br/>
      <button id="share" type="button"><a href="whatsapp://send?text=http://192.168.137.1/squidgame/public" id="shareLink">Share the Link</a></button> 

      <br/> to invite others to join the game</h2>

      <div id="loginBox">
        <h3> Yours informations</h3>
        <p id="errorInfo"></p> 

        <div id="anim"></div>

      <form id="connectBox"> <!-- login_box to login to account -->
			 <p class="id focus">
				 <input type="email" name="email" id="emailOld" placeholder="Email" required/>
		     </p>
			 <p>
				 <input type="password" name="password" id="passwordOld" placeholder="Yours password" required/>
		     </p>
			 <p>
				 <button type="button" id="submiteLogin">&#9675; &#9651; &#9633; </button>
         <span id="register">or register here</span>
		     </p>
		  </form>

      <form id="registBox"> <!-- login_box to create account -->
			 <p class="id focus">
				 <input type="text" name="name" id="name" placeholder="Yours Name" required/>
		     </p>
			 <p>
				 <input type="password" name="password" id="password" placeholder="Yours password" required/>
		     </p>
			 <p>
       <p>
				 <input type="email" name="email" id="email" placeholder="Yours email" required/>
		     </p>
			 <p>  
				 <button type="button" id="submiteRegister">&#9675; &#9651; &#9633; </button>
         <span id="loginNow">or Login</span>
		     </p>
		  </form>
      </div>

      <audio id="audioMaterial" src="http://192.168.137.1/squidgame/resources/audio/fonson.mp3"></audio>
      <h3 id="regulation"><a href="http://192.168.137.1/squidgame/public/regulation">Read game regulation</a></h3>
    </div>
    </body>
  <script src="http://192.168.137.1/squidgame/resources/js/jquery-3.6.0.js"></script>
  <script src="http://192.168.137.1/squidgame/resources/js/homeapp.js"></script>
</html>