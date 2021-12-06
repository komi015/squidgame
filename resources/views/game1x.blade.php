<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"  type="text/css" href="http://192.168.137.1/squidgame/resources/css/gamestyle.css">
    <title>Game in running !</title>
</head>

<body>

<div id="gamex">
  <h2>1st game: Survivor</h2>
  <p id="task"><span class="task">Task: </span>For this first game, you will need to visit a link and find the numbers appearing </br>
       in the text of the link page. You will then have to
       enter these numbers in the field which will be</br> 
       indicated to you before the end time.Don't submit a blank answer !.</br> 
       Otherwise, you will die !!!</p>
       <button id="startButton">Start</button>   
</div>      
</body>
  <script src="http://192.168.137.1/squidgame/resources/js/jquery-3.6.0.js"></script>
  <script src="http://192.168.137.1/squidgame/resources/js/game.js"></script>
</html>
