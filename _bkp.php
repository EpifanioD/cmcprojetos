<?php
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'cmcbusiness_rise';

    $mysqli = new mysqli($hostname, $username, $password, $database);

    if($mysqli->connect_errno){
        echo 'Falha ao conectar'.$mysqli->connect_errno;
    }else{
        echo 'conectado';
    }



?>