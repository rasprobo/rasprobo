<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($_POST);
 include("Ssh.class.php");


if($_POST != null){
	$com = $_POST["comandos"];


$ssh = new Ssh("root", "127.0.0.1", "22", "rasp##");

$ssh->conectar();
$COM = explode(",",$com);


foreach($COM as $COMl){
	if(strpos($COMl,"up") !== FALSE){
		$ex = "python /home/pi/movimento/frente.py";
	}else if(strpos($COMl,"down") !== FALSE){
		$ex ="python /home/pi/movimento/tras.py";
	}else if(strpos($COMl,"left") !== FALSE){
		$ex = "python /home/pi/movimento/esquerda.py";
	}else if(strpos($COMl,"right") !== FALSE){
		$ex = "python /home/pi/movimento/direita.py";
	}
	$ssh->executarComando($ex);
	 echo $ssh->pegarSaida();

}
$ssh->desconectar();

}

