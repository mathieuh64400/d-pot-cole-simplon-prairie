<?php //traitement php de la page : le formulaire renvoie sur ce script !

	//test si le formulaire est soumis :
	//si oui, la variable $_POST n'est pas vide et contient les valeurs des input du formulaire
	if(!empty($_POST))
	{
		try{
			
			//recup des valeurs dans des variables
			$field1 = $_POST["field1"];
            $field2= $_POST["field2"];
            $field3= $_POST["field3"];
            $adresse= $_POST["adresse"];
            $field4= $_POST["field4"];
            $jour=$_POST["jour"];
            $mois=$_POST["mois"];
			echo "Infos : ", $field1, " ", $field2," ", $field3, " ", $adresse, $field4, " ", $jour," " ,$mois; //pour vérifier en debug !

			//connexion à la base de données
			$db="basereservation"; //le nom de la base de données
			$username="phpmyadmin"; //l'utilisateur mysql
			$password="root"; //et son pwd 
			$bdd = null;
			try {
				$bdd = new PDO("mysql:dbname=$db;host=localhost", $username, $password);
			}
			catch(exception $e) {
				die('Erreur :'.$e->getMessage());
			}
			
			//préparation de la requete d'insertion
			//c'est une "requête paramétrée"
			$rep=$bdd->prepare("insert into inf (nom,email,numtelephone,adresse,demande,jour,mois) values (:field1, :field2, :field3, :adresse, :field4, :jour, :mois)");
			$rep->bindParam('field1', $field1, PDO::PARAM_STR);
            $rep->bindParam('field2', $field2, PDO::PARAM_STR);
            $rep->bindParam('field3', $field3, PDO::PARAM_STR);
            $rep->bindParam('adresse',$adresse, PDO::PARAM_STR);
            $rep->bindParam('field4', $field4, PDO::PARAM_STR);
            $rep->bindParam('jour', $jour, PDO::PARAM_STR);
            $rep->bindParam('mois', $mois, PDO::PARAM_STR);
			$rep->execute();
			echo "Inscription effectuée !"; //pour vérifier en debug !
		}
		catch(Exception $e){
			die('Erreur :'.$e->getMessage());
		} 	
	}


?>