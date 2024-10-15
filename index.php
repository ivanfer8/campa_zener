<?php
	//die("Pantalla en mantenimiento. Disculpe las molestias CARLOS.");
	if(isset($_REQUEST["on"])){
		//echo "Abriendo";
		gpio(17, 1);
		sleep(5);
		gpio(17, 0);
		die;
	}
    function gpio($pin, $valor){
		file_put_contents("/sys/class/gpio/export",$pin);
		file_put_contents("/sys/class/gpio/gpio".$pin."/direction", "out");
		file_put_contents("/sys/class/gpio/gpio".$pin."/value",$valor);
	}

	function captura(){
		$a=`/usr/local/bin/cap.py`;
		header("content-type: image/jpeg");
		echo file_get_contents("/tmp/cap.jpg");
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="https://www.zener.es/favicon.ico" type="image/x-icon" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<!-- iOS meta tags & icons -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Zener Campa">
  <link rel="apple-touch-icon" href="img/icono_campa_2.png">
<!-- Android meta tags & icons -->
  <link rel="manifest" href="./manifest.json">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-status-bar-style" content="black">
  <meta name="mobile-web-app-title" content="Zener Campa">
  <link rel="icon" href="img/icono_campa_2.png" sizes="64x64" type="image/png">

<title>Campa Door</title>
<style>
    
    @charset "UTF-8";
    @import url(https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap);
/* @import url(https://cdnjs.cloudflare.com/ajax/libs/ionicons/7.1.0/esm/ionicons.min.js); */
    
    body{
	margin: 0px;
	font-family: "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }
  .diapositiva {
    width: 38vw;
    margin: 0 auto;
    text-align: center;
  }
  .diapositiva img {
    max-width: 25vw;
    max-height: 25vh;
  }
  .crecer{
	transform: scale(1.1);
  }
  .texto {
    margin-top: 0.1vh;
    margin-bottom: 0.9vh;
    font-size: 1rem;
    color: #232856;
    text-align: center; /* Alinea el texto al centro */
  }    
  

  #login-box {
        width: 72vw;
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #login-box h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    #login-box input[type="text"],
    #login-box input[type="number"] {
        width: 99%;
        border: 1px solid #ccc;
        border-radius: 1rem;
        font-size: 1.5rem; 
        padding-bottom: 1.5rem;
        padding-top: 1.5rem;
        margin-bottom: 2rem;
        
    }

    #login-box input[type="submit"] {
        width: 100%;
        padding: 1rem;
        background-color: #fc7344;
        color: #282957;
        cursor: pointer;
        font-size: 2rem;
        border-radius: 1rem;
        border: none;
    }

    #login-box input[type="submit"]:hover {
        background-color: #fc7344;
    }

    #login-box .error {
        color: red;
        margin-bottom: 10px;
    }

    /* Estilos para dispositivos móviles */
    @media only screen and (max-width: 600px) {
        #login-box {
            width: 72vw;
        }
    }

	#login-wrapper {
        /* position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center; */
    }

    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {
        visibility: hidden; /* Hidden by default. Visible on click */
        width: 80%;
        margin:10%;
        background-color: #ffe8e1; /* Black background color */
        border: 1px solid #fc7344;
        color: #fc7344; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 3rem; /* Rounded borders */
        position: fixed; /* Sit on top of the screen */
        z-index: 1; /* Add a z-index if needed */
        bottom: 30px; /* 30px from the bottom */
        padding-top: 1.2rem;
        padding-bottom: 1.2rem;
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    .show {
        visibility: visible !important; /* Show the snackbar */

    /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
    However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
</style>
</head>
<body>
    <div style="display: flex; align-items: center; justify-content: center;">
	<img style="height: 15vh;" src="img/campa.png"></img>
    </div>

	<?php
    session_start();
    if(isset($_POST["password"])){
		if(md5($_POST["password"]) == "c39e1a03859f9ee215bc49131d0caf33"){
			$_SESSION["entrar"] = 1;
		}
	}

	if($_SESSION["entrar"] != 1){
	?>
    <div id="login-wrapper">
        <div style=" display: grid; grid-template-columns: 1fr; grid-gap: 3vh; place-items: center; align-content: center; align-items: center;  height: 65vh;">
            <div>
                <div id="login-box" style=" display: grid; grid-template-columns: 1fr; place-items: center; align-content: center; align-items: center;">
                    <img width="80px" src="https://img.freepik.com/vector-gratis/armario_53876-25496.jpg?size=626&ext=jpg&ga=GA1.1.87170709.1706140800&semt=ais">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="number" name="password" placeholder="Contraseña candado">
                        <input type="submit" value="Acceder">
                    </form>
                </div>
            </div>
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; background-color: #333;  border-radius: 2rem; padding: 1rem; color:#EEEAE2; cursor: pointer">
                <img src="https://cdn-icons-png.flaticon.com/512/564/564442.png" width="45rem">
                <div onclick="window.location = './tutoriales/tutorial_iphone.html'">
                    <small>Descárgalo con</small><br><span style="font-size: 1.2rem;">iPhone</span><small> (tutorial)</small>
                </div>
            </div>
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; background-color: #333;  border-radius: 2rem; padding: 1rem; color:#EEEAE2; cursor: pointer;">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Google_Chrome_icon_%28February_2022%29.svg/2048px-Google_Chrome_icon_%28February_2022%29.svg.png" width="45rem">
                <div onclick="window.location = './tutoriales/tutorial_android.html'">
                    <small>Descárgalo con</small><br><span style="font-size: 1.2rem;">Android</span><small> (tutorial)</small>
                </div>
            </div>
        </div>
    </div>
	<?php
	die;
	}
  	?>
    <div style="display: grid; grid-template-columns: 1fr; grid-gap: 3vh; place-items: center; align-content: center; align-items: center;  height: 50vh;">
	
	<div class="contenedor" onclick="hacerGrande(this, 1);" style="background-color: #f0f0f0; border-radius: 25px; border-color: #232856; border-width: 2px; border-style: solid;  transition: transform 0.3s erase;">
	    <div class="diapositiva" style="transition: transform 0.3s erase;">
		<img src="./img/parking_car.png">
		<div class="texto">
		  <strong>Puerta</strong>
		</div>
	    </div>
	</div>
	<!-- <div onclick="hacerGrande(this, 0);" style="background-color: #f0f0f0; border-radius: 25px;" style="transition: transform 0.3s erase;">
	    <div class="diapositiva">
		<img src="img/interfaz.png">
		<div class="texto">
		  <strong>Forzar Cierre</strong>
		</div>
	    </div>
	</div> -->
	<!-- <div style="background-color: #f0f0f0; border-radius: 25px;">
	    <div class="diapositiva">
		<img src="./img/reloj.png" alt="Imagen de la diapositiva">
		<div class="texto">
		  <strong>Horarios</strong>
		</div>
	    </div>
	</div> -->
	<!-- <div style="background-color: #f0f0f0; border-radius: 25px;">
	    <div class="diapositiva">
		<img src="img/pantalla.png" alt="Imagen de la diapositiva">
		<div class="texto">
		 <strong>Accesos</strong>
		</div>
	    </div>
	</div>	 -->
	<?php
		$_SESSION["entrar"] = 0;
	?>
    </div>
    <div id="snackbar">Abriendo compuertas...</div>
    <!-- <footer style="background-color: #232856; bottom: 0; height: 5vh; color: white; display: flex; align-items: center; justify-content: center;">
	<p>2024</p>
    </footer> -->
    <script>
function hacerGrande(elemento, tipo){
	elemento.classList.add('crecer');
	setTimeout(function(){
		elemento.classList.remove('crecer');
		//windows.location.href('prueba.html');
		if(tipo == 1){
			let response = fetch("?on");
		}else if(tipo == 0){
			let response = fetch("?off");
		}
	}, 300);
    snackBar();
}

function snackBar() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar")

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
   </script>
</body>
</html>

