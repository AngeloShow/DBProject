<?php
  session_start();
  if(isset($_SESSION['autorizzato']) && $_SESSION['autorizzato']==1)
  {
    if($_SESSION['tipo']==0)
    {
      echo "<script>alert('Solo gli admin  possono accedere a questa pagina!')</script>";
      echo "<script>window.open('home.php','_self')</script>";

    }
  }
  else
  {
      echo "<script>alert('Non sei loggato!')</script>";
      echo "<script>window.open('signin.html','_self')</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="img/icon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoundWeb-Insert</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validator.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
    <link rel="stylesheet" href="select/dist/css/bootstrap-select.css">
    <script src="select/dist/js/bootstrap-select.js"></script>
    <script type="text/javascript"> function Home(){ window.location.replace("home.php"); } </script>
</head>
<style>
  	html*{ font-size: 1em !important; font-family: "Helvetica Neue", Helvetica !important; color: white !important; }
  	body {background: #241537; overflow-x: hidden; } 
  	#logo_img{ background-color: transparent; background-image: url("img/singer.svg"); background-size: contain; background-repeat: no-repeat; color: white;  display: block; width: 100%; height: 100%; position: absolute; top: 0%; left: 0%; }
  	#logo_sound{ width: 50%; height: 50%; transform: translate(50%,0%); margin-top: 5%; margin-bottom: 10%; }
    #login_panel_div{ position: absolute; top: 50%; left: 60%; transform: translate(-50%, -50%); }
    a:hover { text-decoration: inherit; }
    a:active { text-decoration: inherit;}
    a:link { color: inherit; }
    
  	.panel-login { background-color: #212121; border:2%; border-radius: 20px; border-color: transparent; }
   	.panel-login>.panel-heading { color: #00415d; text-align:center; }
  	.panel-login>.panel-heading a{ text-decoration: none; font-size: 1.2em; -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear; transition: all 0.1s linear; color:rgba(255,255,255,0.5); }
  	.panel-login>.panel-heading a.active{ color: white; font-size: 1.3em; font-weight: bold; }
  	.panel-login>.panel-heading hr{ margin-top: 10px; margin-bottom: 0px; clear: both; border: 0; height: 1px; }
	
	  .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"],.panel-login input[type="file"] {
        height: 45px; border:none; background-color: transparent; color:white; }
  	.panel-login input:hover, .panel-login input:focus { outline:none; }
        
  	.btn-login { background-color: #572A72; outline: none; color: rgba(255,255,255,0.5); font-size: 1em; height: auto;
        font-weight: bold; padding: 14px ; text-transform: uppercase; border-color: transparent; border-radius: 25px; }
  	.btn-login:hover, .btn-login:focus { color: white;  }
</style>

<script type="text/javascript">
    $(function() {

        $('#artista-form-link').click(function(e) {
            $("#artista-form").delay(100).fadeIn(100);
            $("#album-form").fadeOut(100);
            $('#album-form-link').removeClass('active');
            $("#traccia-form").fadeOut(100);
            $('#traccia-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#album-form-link').click(function(e) {
            $("#album-form").delay(100).fadeIn(100);
            $("#artista-form").fadeOut(100);
            $('#artista-form-link').removeClass('active');
            $("#traccia-form").fadeOut(100);
            $('#traccia-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#traccia-form-link').click(function(e) {
            $("#traccia-form").delay(100).fadeIn(100);
            $("#artista-form").fadeOut(100);
            $('#artista-form-link').removeClass('active');
            $("#album-form").fadeOut(100);
            $('#album-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });
</script>
<script>
    $(document).ready(function() {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })
</script>

</head>
<body>
  	<div id="logo_img"></div>
    <div class="container" id="login_panel_div">
        <div class="row">
            <div class="col-md-5 col-md-offset-5">
                <div class="panel panel-login">
                    <img src="img/logo_white.svg" id="logo_sound" onclick="Home()">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-4">
                                <a href="#" class="active" id="artista-form-link">Artista</a>
                            </div>
                            <div class="col-xs-4">
                                <a href="#" id="album-form-link">Album</a>
                            </div>
                            <div class="col-xs-4">
                                <a href="#" id="traccia-form-link">Traccia</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="artista-form" action="artist.php" method="post" role="form" data-toggle="validator" style="display: block;" enctype="multipart/form-data">
                                    <div class="form-group has-feedback">
                                        <input type="text" name="nome_art" id="nome_art" tabindex="1" class="form-control" placeholder="Nome artista" data-error="Inserisci un Artista" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="desc_art" id="desc_art" tabindex="2" class="form-control" placeholder="Commento" required>
                                        <div class="help-block with-errors"></div>

                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Immagine artista</label></br>
                                        <label class="custom-file">
                                          <input type="file" id="file_art" name="file_art" class="custom-file-input form-control" >
                                          <span class="custom-file-control"></span>
                      </label>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="artista-submit" id="artista-submit" tabindex="4" class="form-control btn btn-login " value="Inserisci artista">
                                            </div>
                                        </div>
                                    </div>

                                </form>



                                <form id="album-form" action="album.php" method="post" role="form" style="display: none;" data-toggle="validator"
                                enctype="multipart/form-data">
                                    <div class="form-group has-feedback">
                                        <input type="text" name="nome_alb" id="nome_alb" tabindex="1" class="form-control" placeholder="Nome album" data-error="Inserisci un nome all'album" value="" required>


                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">

                                        <input class="form-control" id="date" name="date" placeholder="data_pubblicazione" data-error="inserisci una  data" type="text" required>

                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Immagine album</label></br>
                                        <label class="custom-file">
                                          <input type="file" id="fileToUpload" name="fileToUpload" class="custom-file-input form-control" >
                                          <span class="custom-file-control"></span>


                                    </label>
                                    </div>
                                    <div class="form-group has-feedback">
                                    <label for="select_alb">Artista</label></br>

                                    <select id="select_alb" name="select_alb[]" class="selectpicker" multiple data-hide-disabled="true" data-live-search="true" data-error="inserisci almeno un artista " required>
                                      <?php //fai una query
                                      include("script/db_connect.php");
                                      $query = "SELECT id_artisti,nome FROM ARTISTI";
                                      if ($result = $mysqli->query($query)) {
                                        /* fetch associative array */
                                        while ($row = $result->fetch_assoc()) {
                                        	echo "<option value=\"".$row['id_artisti']."\">".$row['nome']."</option>";
                                        }
                                      /* free result set */
                                      $result->free();
                                      }
                                    ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                  </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="album-submit" id="album-submit" tabindex="4" class="form-control btn btn-login btn-primary" value="Inserisci album">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="traccia-form" action="track.php" method="post" role="form" style="display: none;" data-toggle="validator" enctype="multipart/form-data">
                                    <div class="form-group has-feedback">
                                        <input type="text" name="titolo_tra" id="titolo_tra" tabindex="1" class="form-control" placeholder="Titolo" data-error="Inserisci un titolo" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input class="form-control" id="date" name="date" placeholder="data_pubblicazione" type="text" />
                                        <div class="help-block with-errors"></div>
                                        <div class="form-group has-feedback">
                                        <label for="selectgen_tra">Genere</label></br>
                                        <select id="selectgen_tra" name="selectgen_tra" class="selectpicker show-tick form-control" multiple data-hide-disabled="false"    data-live-search="true"data-error="Inserisci  un genere "  required>
                                          <?php //fai una query
                                          include("script/db_connect.php");
                                          $query = "SELECT id_generi,nome FROM GENERI";

                                          if ($result = $mysqli->query($query)) {
                                            /* fetch associative array */
                                            while ($row = $result->fetch_assoc()) {
                                            	echo "<option value=\"".$row['id_generi']."\">".$row['nome']."</option>";
                                            }
                                          /* free result set */
                                          $result->free();
                                          }
                                        ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                      </div>
                                      <div class="form-group has-feedback">
                                      <label for="selectalb_tra">Album</label></br>
                                      <select id="selectalb_tra" class="selectpicker  form-control" name="selectalb_tra"   data-live-search="true" multiple data-hide-disabled="false" data-error="inserisci un album " required>
                                        <?php //fai una query
                                        include("script/db_connect.php");
                                        $query = "SELECT id_album,nome FROM ALBUM";
                                        if ($result = $mysqli->query($query)) {
                                          /* fetch associative array */
                                        	while ($row = $result->fetch_assoc()) {
                                        		echo "<option value=\"".$row['id_album']."\">".$row['nome']."</option>";
                                        	}
                                        /* free result set */
                                        $result->free();
                                        }
                                      ?>
                                      </select>
                                      <div class="help-block with-errors"></div>

                                    </div>
                                    <div class="form-group has-feedback">
                                    <label for="select_alb">Artista</label></br>

                                    <select id="selectart_tra" class="selectpicker" name="selectart_tra[]"  multiple data-hide-disabled="true" data-live-search="true" data-error="inserisci almeno un artista " required>
                                      <?php //fai una query
                                      include("script/db_connect.php");
                                      $query = "SELECT id_artisti,nome FROM ARTISTI";

                                      if ($result = $mysqli->query($query)) {

                                        /* fetch associative array */
                                      while ($row = $result->fetch_assoc()) {
                                      echo "<option value=\"".$row['id_artisti']."\">".$row['nome']."</option>";
                                      }
                                      /* free result set */
                                      $result->free();
                                      }

                                    ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <div class="form-group has-feedback">
                                      <label>File mp3</label></br>
                                      <label class="custom-file">
                                        <input type="file" id="file_tra" name="file_tra" class="custom-file-input form-control" data-error="inserisci una traccia " required>
                                        <span class="custom-file-control"></span>
                                      </label>
                                      <div class="help-block with-errors"></div>
                                  </div>             
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-sm-6 col-sm-offset-3">
                                        <input type="submit" name="traccia-submit" id="traccia-submit" tabindex="4" class="form-control btn btn-login" value="Inserisci traccia">
                                      </div>
                                    </div>
                                  </div>
                                </form>
                                <script>

                                  $(document).ready(function () {
                                    var mySelect = $('#select_alb');
                                    var mySelect1 = $('#selectart_tra');

                                    $('#selectgen_tra').selectpicker({

                                      maxOptions: 1
                                    });
                                    $('#selectalb_tra').selectpicker({

                                      maxOptions: 1
                                    });

                                  });
                                </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
