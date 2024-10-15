<?php



if (isset($_REQUEST['encender'])) {
	gpio(17,1);
	}
elseif (isset($_REQUEST['apagar'])) {
	gpio(17,0);
	}
elseif (isset($_REQUEST['cap'])) captura();

formulario();

function formulario(){
?>
<form method='get' action='?'>
<input type='submit' name='encender' value='Encender'>
<input type='submit' name='apagar' value='Apagar'>

</form>
<img src='?cap' width=800>
<?php
}


function gpio($pin,$valor){

file_put_contents("/sys/class/gpio/export",$pin);
file_put_contents("/sys/class/gpio/gpio".$pin,"out");
file_put_contents("/sys/class/gpio/gpio".$pin."/value",$valor);


}

function captura(){
	$a=`/usr/local/bin/cap.py`;
	header("Content-type: image/jpeg");
	echo file_get_contents("/tmp/cap.jpg");
	die;
}
