<?php

	//On récupère le nom passé en paramètre
	$nomFrancais = $_POST['nomFrancais'];
	
	$informations = "";

	$db = new mysqli('udaleku', 'udaleku', 'udaleku', 'udaleku');
	if ($db -> connect_errno)
	{
		printf("Échec de la connexion : %s\n", $mysqli->connect_error);
		exit();
	}
	
	if($result = $db->query("SELECT * FROM liste_affaire WHERE nom_francais = '$nomFrancais'"))
	{
		while($row = $result->fetch_array(MYSQLI_NUM))
		{
			$informations[] = $row;
		}
		
		$result->close();
	}
	else
	{
		printf("Message d'erreur : %s\n", $db->error);
	}
	
	$informations = $informations[0]

	echo json_encode($informations);

?>