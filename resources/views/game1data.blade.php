<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"  type="text/css" href="http://192.168.137.1/squidgame/resources/css/gamedata.css">
    <title>Game in running !</title>
</head>

<body>
    <p id="gameLink"><a href="http://192.168.137.1/squidgame/user/linkRequest">Here the link</a></p>
    <p id="gameInput">
	<input type="text" name="textval" id="gameText" placeholder="Place your answers here"/>
	</p>
    <button id="sendAnswer">&#9675; &#9651; &#9633;</button>
</body>
<script src="http://192.168.137.1/squidgame/resources/js/jquery-3.6.0.js"></script>
  <script src="http://192.168.137.1/squidgame/resources/js/game.js"></script>
</html>