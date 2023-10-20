<?php   
    $serveur="localhost";// localhost
	$bd="dob_test"; // securise_db
	$user="root";//securise_db
	$password="";
	$url = 'mysql:host='.$serveur.';dbname='.$bd.';charset=utf8';
	$connexion = new PDO($url,$user,$password);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>