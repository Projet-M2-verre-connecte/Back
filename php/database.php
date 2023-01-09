<?php

  	require_once('request.php');

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

  	if ($requestRessource == 'select_patient'){
		$data = dbRequestPatient($db, $_GET["id"]);
	}

	else if($requestRessource == 'select_patients'){
		$data = dbRequestPatientsWithSameMonitor($db, $_GET["id"]);
	}

	else if ($requestRessource == 'select_datas'){
		$data = dbRequestDatas($db, $_GET["id"]);
	}

	else if ($requestRessource == 'select_DayConso'){
		$data = dbRequestDayConso($db, $_GET["id"]);
	}

	else if ($requestRessource == 'select_WeekConso'){
		$data = dbRequestWeekConso($db, $_GET["id"]);
	}

	else if ($requestRessource == 'select_MonthConso'){
		$data = dbRequestMonthConso($db, $_GET["id"]);
	}
	
	// Send data to the client.
	header('Content-Type: application/json; charset=utf-8');
	header('Cache-control: no-store, no-cache, must-revalidate');
	header('Pragma: no-cache');
	header('HTTP/1.1 200 OK');
	echo json_encode($data);
	exit;
?>
