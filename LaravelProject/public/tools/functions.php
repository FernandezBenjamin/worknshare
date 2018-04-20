<?php
require_once "conf.inc.php";

function connectDB(){

	try{
		$db = new PDO(
		"mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER , DB_PWD );
	}catch(Exception $e){
		//Si ca ne marche pas die
		die("Erreur SQL : ". $e->getMessage() );
	}

	return $db;
}



function isConnected(){

	if ( !empty($_SESSION['token']) && 
		 !empty($_SESSION['email']) ){

		$db = connectDB();
		$query = $db->prepare("SELECT id FROM users WHERE email=:email AND token=:token");


		// Executer la requête avec les valeurs
		$query -> execute([
				'email' => $_SESSION['email'],
				'token' => $_SESSION['token']
			]);

		

		if($query->rowcount()){
			$_SESSION['token'] = regenerateAccessToken($_SESSION['email']);
			return true;
		} else {
			logout($_SESSION['email']);
			return false;
		}


	}

	return false;
}



function regenerateAccessToken($email){
	$token = md5(uniqid()."eifre2543ig .re325eor");

	$db = connectDB();
	$query = $db->prepare("UPDATE users SET token=:token WHERE email=:email");


	$query->execute([
		"token"=>$token,
		"email"=>$email
		]);

	return $token;
}


function logout($email, $redirect=false){
	// supprimer le token de l'utilisateur en bdd
	// On remplace par null
	$db = connectDB();

	$query = $db->prepare("UPDATE users SET token=null WHERE email=:email");

	$query -> execute([
				'email' => $email
			]);

	// Effacer les variables de session
	unset($_SESSION['email']);
	unset($_SESSION['token']);
	unset($_SESSION['pseudo']);

	if($redirect){
		header("Location: /projet/index.php");
	}
}




function isAdmin(){
	$db = connectDB();

	$query = $db->prepare("SELECT * FROM users WHERE email=:email AND token=:token");

	$query -> execute([
				'email' => $_SESSION['email'],
				'token' => $_SESSION['token']
			]);


	$userinfo = $query->fetch();

	if( $userinfo['admin'] == 1){
		return true;
	} else {
		return false;
	}



}



function isFirstConnection(){
	$db = connectDB();

	$query = $db->prepare("SELECT * FROM users WHERE email=:email AND token=:token");

	$query -> execute([
				'email' => $_SESSION['email'],
				'token' => $_SESSION['token']
			]);


	$userinfo = $query->fetch();

	if( $userinfo['first_connection'] == 1){
		return true;
	} else {
		return false;
	}



}





function isReceived(){
	
	if($_SESSION['notif'] == 1){
	  return false;
	  } else {
	  return true;
	}
}




