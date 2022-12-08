<?php

  	require_once('database.php');

  	// Connexion à la bdd.
  	$db = dbConnect();
	if (!$db){
		header ('HTTP/1.1 503 Service Unavailable');
		exit;
	}

	// verification de la requête.
	$requestMethod = $_SERVER['REQUEST_METHOD'];
	$request = substr($_SERVER['PATH_INFO'], 1);
	$request = explode('/', $request);
	$requestRessource = array_shift($request);
	// verification de l'id associé à la requête.
	
 	$id = array_shift($request);
	if ($id == ''){
		$id = NULL;
  	}
  	$data = false;

  	if ($requestRessource == 'select_user'){
		$data = dbRequestUser($db);
	}

	else if($requestRessource == 'select_test'){
		$data = dbRequestTest($db);
	}	
	
	// Send data to the client.
	header('Content-Type: application/json; charset=utf-8');
	header('Cache-control: no-store, no-cache, must-revalidate');
	header('Pragma: no-cache');
	header('HTTP/1.1 200 OK');
	echo json_encode($data);
	exit;
?>
