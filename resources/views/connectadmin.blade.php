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
	  type="text/css" title="perso_style" href="http://192.168.137.1/squidgame/resources/css/home.css">
	<link 
      rel="stylesheet"
	  type="text/css" title="boostrap" href="http://192.168.137.1/onedolars/resources/bootstrap/bootstrap.min.css">
    <link
      rel="shortcut icon"
	  href="http://192.168.137.1/squidgame/resources/logonglet.png">

    <title>Admin connection !</title>
  </head>

  <body class="container-fluid">
    <div id="back">
      <h1> Admin login<br/></h1>
     

      <div id="loginBox">
        <h3> Admin informations</h3>
        <p id="errorInfo"></p> 


      <form id="connectBox"> <!-- login_box to login to account -->
			 <p class="id focus">
				 <input type="email" name="email" id="email" placeholder="Email" required/>
		     </p>
			 <p>
				 <input type="password" name="password" id="password" placeholder="Yours password" required/>
		     </p>
			 <p>
				 <button type="button" id="submiteLogin">&#9675; &#9651; &#9633; </button>
		     </p>
		  </form>

      </div>
    </div>
    </body>
  <script src="http://192.168.137.1/squidgame/resources/js/jquery-3.6.0.js"></script>
  <script src="http://192.168.137.1/squidgame/resources/js/adminBoard.js"></script>
</html>