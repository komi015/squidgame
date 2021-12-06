<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	  <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
      rel="stylesheet"
	  type="text/css" title="perso_style" href="http://192.168.137.1/squidgame/resources/css/dashboard.css">
    
    <link 
      rel="stylesheet"
	  type="text/css" title="boostrap" href="http://192.168.137.1/squidgame/resources/bootstrap/css/bootstrap.min.css">

    <title>Squid game, plays here !</title>
  </head>

  <body class="container-fluid dash" id="theMother">
      <div id="leftbar">
          <div id="timer">
              <h1 id="setTime">
                  Next game in </br><span id="nextTime"> </span>
              </h1>
          </div>
          <div id="gamerName">
            <h2>Gamer's Names<br>
          alive: <span id="alive"></span></h2>
            <div id="listName">
              
            </div>
          </div>
      </div>
      <div id="gameBoard">
        <h1>Wait for the game...</h1>
      </div>
      <div id="gameInfo">
          <div id="eliminatedInfo">
            <h3>Gamer </br><span id="idEliminated"></span></br> was eliminated</h3>
          </div>
          <div id="winCash">

             <div id= "inWin">
                <div id="barr">
                </div>
             </div>
             <p style="font-weigth:bold;">Current sum</p>
          </div>
      </div>    
</body>
<script src="http://192.168.137.1/squidgame/resources/js/jquery-3.6.0.js"></script>
  <script src="http://192.168.137.1/squidgame/resources/js/dashboard.js"></script>
</html>