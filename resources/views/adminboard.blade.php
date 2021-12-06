<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"  type="text/css" href="http://192.168.137.1/squidgame/resources/css/adminstyle.css">
    <title>Squid game error !</title>
</head>

<body id="adminBoard">
    <div id="topTool">
   <div id="insertPlayer">Insert Player In game</div>
   <div id="killNotPlay">Kill those who do not plays</div>
   <div id="Remaining">Remaining time<br/><span id="nextTime"></span>
   </div>
</div>
   <div id="liveNumber">Live Player</div>
   <div id="gamerName">
            <h2>Gamer's Names<br>
          alive: <span id="alive"></span></h2>
            <div id="listName">
              
  </div>
</body>
<script src="http://192.168.137.1/squidgame/resources/js/jquery-3.6.0.js"></script>
<script src="http://192.168.137.1/squidgame/resources/js/adminBoard.js"></script>
</html>