<?php
  session_start();
  if(!isset($_SESSION['autorizzato']) || $_SESSION['autorizzato']!=1)
  {
    echo "<script>alert('Non sei loggato!')</script>";
    echo "<script>window.open('signin.html','_self')</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="icon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoundWeb-Homepage</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,500,500i">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.backstretch.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">

      function changeTrack(temp){
            $.ajax({
            type: "POST",
            url: 'changeTrack.php',
            data: { str: temp},
            success: function(data){
              var temp1= JSON.parse(data);
              $("#track").attr("src", temp1.path);
              document.getElementById("titoloS").innerHTML = temp1.titolo+" +";
              document.getElementById("track").className= temp1.id_tracce;
              random_img();
              inc_views();
              insert_ascolto();
              play();
            }
          });
      }

      function nextTrack() {
        var str=document.getElementById("track").className;
        $.ajax({
          type: "POST",
          url: 'randomtrack.php',
          data: { str: str},
          success: function(data){
            var temp= JSON.parse(data);
            $("#track").attr("src", temp.path);
            document.getElementById("titoloS").innerHTML = temp.titolo+" +";
            document.getElementById("track").className= temp.id_tracce;
            inc_views();
            random_img();
            insert_ascolto();
            play();
          }
        });
      }


      function random_img() {
        var str=document.getElementById("photocontainer").className;
        $.ajax({
          type: "POST",
          url: 'random_copertina.php',
          data: { str: str},
          success: function(data){
            var temp= JSON.parse(data);
            var str_temp=temp.path_copertina;
            document.getElementById("photocontainer").className=str_temp;
            document.getElementById("photocontainer").style.backgroundImage = "url("+str_temp+")";
          }
        });
      }

      function searchT(){
          str=document.getElementById("searchId").value;
          document.getElementById("trackcontainer").innerHTML="";
          document.getElementById("sezione").innerHTML="#Ricerca #Nessun Risultato";
          if(str.length!=0){
            $.ajax({
              type: "POST",
              url: 'livesearch.php',
              data: { str: str},
              success: function(data){
                var temp= JSON.parse(data);
                document.getElementById("sezione").innerHTML="#Ricerca #"+str;
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                     "<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td>"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td></td>";
              }
            });
          }
      }

      function ins_playlist(){
		    var trackID=document.getElementById("track").className;
      	var username=document.getElementById("utente").className;
      	var nome="Playlist 1";
	  	 $.ajax({
	        type: "POST",
	        url: 'insert_into_playlist.php',
	        data: { track: trackID, utente: username, nome: nome },
	        success: function(data){
	        	alert(data);
	        }
	      });
      }

       function inc_views(){
        var trackID=document.getElementById("track").className;
         $.ajax({
            type: "POST",
            url: 'view_globali.php',
            data: { track: trackID },
            success: function(data){}
          });
      }

      function insert_ascolto(){
        var trackID=document.getElementById("track").className;
        var utenteID=document.getElementById("utente").className;
         $.ajax({
            type: "POST",
            url: 'insert_ascolto.php',
            data: { track: trackID,  utente: utenteID },
            success: function(data){}
          });
      }

      function view_classifica_globale(){
      	 document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "GET",
            url: 'visualizza_classifica_globale.php',
            success: function(data){
            	document.getElementById("sezione").innerHTML="#Classifica Globale";
            	var temp= JSON.parse(data);
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                	"<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td></td>";
            }
          });
      }

      function view_classifica_mensile(){
         document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "GET",
            url: 'visualizza_classifica_mensile.php',
            success: function(data){
              document.getElementById("sezione").innerHTML="#Classifica Mensile";
              var temp= JSON.parse(data);
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                  "<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td></td>";
            }
          });
      }


      function view_tracce(){
         document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "GET",
            url: 'visualizza_tracce.php',
            success: function(data){
              document.getElementById("sezione").innerHTML="#Tracce";
              var temp= JSON.parse(data);
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                  "<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td></td>";
            }
          });
      }

      function view_album(){
         document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "GET",
            url: 'visualizza_album.php',
            success: function(data){
              document.getElementById("sezione").innerHTML="#Album";
              var temp= JSON.parse(data);
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                  "<td>"+(i+1)+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\"><font color=\"white\">"+temp[i].AL_nome+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td></td>";
            }
          });
      }

      function view_artisti(){
         document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "GET",
            url: 'visualizza_artisti.php',
            success: function(data){
              document.getElementById("sezione").innerHTML="#Artisti";
              var temp= JSON.parse(data);
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                  "<td>"+(i+1)+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\"><font color=\"white\">"+temp[i].nome+"</td><td></td>";
            }
          });
      }

      function view_select_album(temp1){
         document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "POST",
            url: 'visualizza_select_album.php',
            data: { album: temp1},
            success: function(data){
              var temp= JSON.parse(data);
              document.getElementById("sezione").innerHTML="#Album #"+temp[0].AL_nome+"";
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                    "<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td></td>";
            }
          });
      }

      function view_select_artista(temp1){
         document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "POST",
            url: 'visualizza_select_artista.php',
            data: { artista: temp1},
            success: function(data){
              var temp= JSON.parse(data);
              document.getElementById("sezione").innerHTML="#Artisti #"+temp[0].A_nome+"";
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                    "<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td></td>";
            }
          });
      }

      function view_consigliati(){
         document.getElementById("trackcontainer").innerHTML="";
         $.ajax({
            type: "GET",
            url: 'visualizza_consigliati.php',
            success: function(data){
              var temp= JSON.parse(data);
              document.getElementById("sezione").innerHTML="#Consigliati";
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                    "<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td></td>";
            }
          });
      }


      function view_playlist(){
         document.getElementById("trackcontainer").innerHTML="";
         var utenteID=document.getElementById("utente").className;
         $.ajax({
            type: "POST",
            url: 'visualizza_playlist.php',
            data: { nome: utenteID },
            success: function(data){
              var temp= JSON.parse(data);
              document.getElementById("sezione").innerHTML="#Playlist";
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                    "<td>"+(i+1)+"</td><td onclick=\"select_playlist('"+temp[i].nome+"')\"><font color=\"white\">"+temp[i].nome+"</td><td></td>";
            }
          });
      }

      function select_playlist(temp1){
         document.getElementById("trackcontainer").innerHTML="";
         document.getElementById("sezione").innerHTML="#Playlist #"+temp1+"";
         var utenteID=document.getElementById("utente").className;
         $.ajax({
            type: "POST",
            url: 'visualizza_select_playlist.php',
            data: { utente: utenteID, nome: temp1 },
            success: function(data){
              var temp= JSON.parse(data);
                for(i=0; i<temp.length;i++)
                    document.getElementById("trackcontainer").insertRow(i).innerHTML=
                    "<td>"+(i+1)+"</td><td onclick=\"changeTrack("+temp[i].id_tracce+")\"><font color=\"white\">"+temp[i].titolo+"</td><td onclick=\"view_select_artista("+temp[i].id_artisti+")\">"+temp[i].A_nome+"</td><td onclick=\"view_select_album("+temp[i].id_album+")\">"+temp[i].AL_nome+"</td><td onclick=\"remove_track_playlist("+temp[i].id_tracce+",'"+temp1+"')\">Rimuovi</td><td></td>";
            }
          });
      }

      function remove_track_playlist(temp1, temp2){
         var utenteID=document.getElementById("utente").className;
         $.ajax({
            type: "POST",
            url: 'rimuovi_dalla_playlist.php',
            data: { utente: utenteID, nome: temp2, traccia: temp1 },
            success: function(data){
              select_playlist(temp2);
            }
          });
      }

    </script>

    <style>

      html*{ font-size: 1em !important; font-family: "Helvetica Neue", Helvetica !important; color: white !important; }

		  body{ background-color: #572A72; overflow-x: hidden;}

		  ::-webkit-scrollbar { display: none; }

		  nav.navbar-fixed-bottom{background-color: #212121; height: 10%;}
		  nav.navbar-inverse{ background-color: #231633; border-radius: 0px; border: 0px; }

		  button.navbar-btn{ background-color: #37474F; border-radius: 0px; border: 0px; color: white; }
		  button.navbar-btn:active{ background-color: #37474F; border-radius: 0px; border: 0px; color: white; }
		  button.navbar-btn:hover{ background-color: #37474F; border-radius: 0px; border: 0px; color: white; }
		  button.navbar-btn:link{ background-color: #37474F; border-radius: 0px; border: 0px; color: white; }
		  button.navbar-btn:focus{ background-color: #37474F; border-radius: 0px; border: 0px; color: white; }

  		a:hover { text-decoration: none; }
  		a:active { text-decoration: none; }
  		a:link { color:inherit; }

  		div.navbar-header{ position: absolute; top: 50%; left:1%; transform: translate(0%, -50%); }

      #photocontainer{ background-color: transparent; background-image: url(""); background-size: contain; background-repeat: no-repeat; color: white;  display: block; width: 15%; height: 20%; position: absolute;
        top: 90%; left: 0%; transform: translate(0%, -100%); background-position: center bottom; }

  	  #trackcontainer{ background-color: transparent; color: white; display: block; width: 60%; white-space: nowrap;
        height: 60%; overflow-y: auto; position: absolute; text-align: left; top: 30%; left: 41%;  overflow-x: hidden; }
      #trackcontainer td:last-child { width: 100%; }
    	#trackcontainer tr{ border: hidden; }
    	#trackcontainer tr:nth-child(even) {background-color: rgba(255,255,255,0.1); color: rgba(255,255,255,0.5); }
    	#trackcontainer tr:nth-child(even):hover {background-color: rgba(255,255,255,0.2); color:white; }
    	#trackcontainer tr:nth-child(odd) {background-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.5);}
    	#trackcontainer tr:nth-child(odd):hover {background-color: rgba(255,255,255,0.25); color:white; }
      #trackcontainer td:hover { text-decoration: underline; }

      #categorie{ background-color: #231633; width: 15%; height: 100%; position: absolute; top: 0%; left: 0%; z-index: -9999; }

      #categorie_tab { background-color: transparent; color: rgba(255,255,255,0.5); position: absolute; text-align: left;
        	top: 20%; left: 0%; padding: 0px; }
    	#categorie_tab tr{ border:hidden; transition:background 0.5s;}
    	#categorie_tab tr:hover{ background-color: rgba(255,255,255,0.3); color:white; }

     	#sezione{ color:white !important; position:absolute; font-size: 2em !important;  top: 28%; left: 44%;
     		font-family: "Helvetica Neue", Helvetica; font-style: italic; transform: translate(0%, -100%); }

    	#titoloT{ color:rgba(255,255,255,0.5); position:absolute; top: 40%; left: 2%; text-align: left;
        display: block; width: 20%; transform: translate(0%, -50%);}
      #titoloT tr{ border:hidden; transition:font-size 0.15s; transition:color 0.25s; }
      #titoloT tr:hover{ color:white; font-size: 1.1em; }

	  	#pButton{ background-color: transparent; border: none; height: 4vh; width: 4vh; position: absolute; top: 25%;
	   		left: 50%; transform: translate(-50%, -50%); font-size: 1.2em;}

	  	#nButton{ background-color: transparent; border: none; height: 4vh; width: 4vh; position: absolute; top: 25%;
	    	left: 55%; transform: translate(-50%, -50%); font-size: 0.9em;}

    	#bButton{ background-color: transparent; border: none; height: 4vh; width: 4vh; position: absolute; top: 25%;
      	left: 45%; transform: translate(-50%, -50%); font-size: 0.9em;}

    	#volplusButton{ background-color: transparent; border: none; height: 4vh; width: 4vh; position: absolute; top: 40%;
      	left: 84%; transform: translate(0%, -50%);}

      #volButton{ background-color: transparent; border: none; height: 4vh; width: 4vh; position: absolute; top: 40%;
        left: 94%; transform: translate(0%, -50%); font-size: 0.8em;}
      #vol-Button{ background-color: transparent; border: none; height: 4vh; width: 4vh; position: absolute; top: 40%;
        left: 92%; transform: translate(0%, -50%); font-size: 0.8em;}

    	#voldiv{ border-radius: 25px; background:#263238; width:5% ; height:4px; position: absolute; top: 39%;
      	left: 87%; transform: translate(0%, -50%); }

    	#voldivhead{ border-radius: 25px; background:#BDBDBD; width:100% ; height:4px; position: absolute; left:0%;}

	    #timeline{ width:50%; border-radius: 25px; background:#263238; height:7%; position: absolute; top: 70%;
      	left: 50%; transform: translate(-50%, -50%); transition:height 0.15s; }
      #playhead{ width:0%; border-radius: 25px; background:#BDBDBD; height:100%; left: 0%; transition:background 0.25s;}

      #timeline:hover { height:12%;}

      #timeline:hover #playhead{ background:#572A72;}

      .glyphicon{ color:rgba(255,255,255,0.50); text-align:center; vertical-align: middle; transition:font-size 0.15s; transition:color 0.25s;  }
      .glyphicon:hover { color:white; font-size: 1.3em; }

    </style>
  </head>
  <body onload="view_tracce()">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header wow fadeIn">
        	<img src="img/logo_white.svg" width="80%" height="80%" align="left">
        </div>
        <div class="collapse navbar-collapse" id="top-navbar-1">
          <ul class="nav navbar-nav navbar-right navbar-search-button">
            <li><a class="search-button" href="#"><i class="fa fa-search"></i></a></li>
          </ul>
          <form class="navbar-form navbar-search-form disabled wow fadeInLeft" role="form" action="" method="post">
            <div class="form-group">
              <input type="text" name="search" placeholder="Search..." class="search form-control" id="searchId" onkeyup="searchT()" autocomplete="off">
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right navbar-menu-items wow fadeIn">
            <?php
              $username=$_SESSION['username'];
              $nome=$_SESSION['nome'];
              echo'<li><a id="utente" class="'.$username.'">Ciao '.$nome.'</a></li>';
              echo'<li><a href="home.php">Home</a></li>';
              if($_SESSION['tipo']==1)
              echo'<li><a href="insert.php">Inserimento</a></li>';
            ?>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
    </nav>

    <div id="photocontainer" class=""></div>

    <div id="categorie">
      <table class="table" id="categorie_tab">
        <tr><td onclick="view_artisti()">Artisti</td></tr>
        <tr><td onclick="view_album()">Album</td></tr>
        <tr><td onclick="view_classifica_globale()">Classifica Globale</td></tr>
        <tr><td onclick="view_classifica_mensile()">Classifica Mensile</td></tr>
        <tr><td onclick="view_consigliati()">Consigliati</td></tr>
        <tr><td onclick="view_playlist()">Playlist</td></tr>
        <tr><td onclick="view_tracce()">Tracce</td></tr>
      </table>
    </div>


    <div id="sezione"></div>
    <table class="table" id="trackcontainer"></table>

    <nav class="navbar navbar-default navbar-fixed-bottom">
      <audio id="track" class="" ontimeupdate="timeUpdate(this)">
        <source src=""type="audio/mpeg">
      </audio>

      <table class="table" id="titoloT">
        <tr><td id="titoloS" onclick="ins_playlist()">...</td>
        </tr>
      </table>

      <div class="container">
        <button id="pButton" class="play" onclick="play()"><span id="playicon" class="glyphicon glyphicon-play"></span></button>
        <button id="nButton" onclick="nextTrack()"><span class="glyphicon glyphicon-fast-forward"></span></button>
        <button id="bButton" onclick="backTrack()"><span class="glyphicon glyphicon-fast-backward"></span></button>
        <button id="volplusButton" onclick="muteVolume()" class="glyphicon glyphicon-volume-up"></button>
        <button id="volButton" onclick="incVolume()" class="glyphicon glyphicon-plus"></button>
        <button id="vol-Button" onclick="decVolume()" class="glyphicon glyphicon-minus"></button>

        <div id="voldiv">
          <div id="voldivhead"></div>
        </div>

        <div id="timeline">
          <div id="playhead"></div>
        </div>
        <script type="text/javascript" src="js/audio_player.js"></script>
      </div>
    </nav>
  </body>
</html>
