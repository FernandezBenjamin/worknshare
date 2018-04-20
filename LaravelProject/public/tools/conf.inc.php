<?php


	define("DB_USER", "root");
	define("DB_PWD", "root");
	define("DB_NAME", "work_n_share");
	define("DB_HOST", "localhost");





	$listOfGender = 	[
							"m" => "Mr",
							"w" => "Mme",
							"g" => "Mlle",
							"o" => "Autres"
						];


	$listOfErrorsMsg = 		[
							1=>"Le pseudo doit faire entre 4 et 150 caractères",
							2=>"Le nom doit faire entre 2 et 50 caractères",
							3=>"Le prénom doit faire entre 2 et 50 caractères",
							4=>"Le mot de passe doit faire entre 8 et 25 caractères",
							5=>"Le mot de passe de confirmation ne correspond pas",
							6=>"Le numéro de téléphone doit faire 10 chiffres",
							7=>"Le métier doit faire entre 3 et 50 caractères",
							8=>"L'email n'est pas valide",
							9=>"Le pays ne correspond pas",
							10=>"Le genre n'est pas correct",
							11=>"Le format de date n'est pas correct",
							12=>"Le format de date doit faire 10 caractères",
							13=>"Vous devez avoir entre 16 et 70 ans",
							14=>"Le format de date n'est pas correct",
							15=>"Le captcha n'est pas correct",
							16=>"L'adresse email est déjà utilisé",
							17=>"L'adresse mail ou le mot de passe ne sont pas valide",
                            18=>"La localisation n'est pas valide",
                            19=>"La valeur des listes déroulantes ne sont pas valides",
                            20=>"Vous avez rentré un nombre de salle trop important, il ne peu excéder 20",
                            21=>"Vous avez renseigné un nombre d'imprimantes trop important ou trop faible, la limite pour les imprimantes est de 20",
                            22=>"Vous avez renseigné un nombre d'ordinateurs trop important ou trop faible, la limite pour les orinateurs est de 100"
						];

	$month = [
							"01"=>"Janvier",
							"02"=>"Février",
							"03"=>"Mars",
							"04"=>"Avril",
							"05"=>"Mai",
							"06"=>"Juin",
							"07"=>"Juillet",
							"08"=>"Août",
							"09"=>"Septembre",
							"10"=>"Octobre",
							"11"=>"Novembre",
							"12"=>"Décembre"
	];













