<?php

require_once('constantes.php');

//----------------------------------------------------------------------------
//--- dbConnect --------------------------------------------------------------
//----------------------------------------------------------------------------
// Creation d'une connexion à la bdd
// Retourne faux et envoie un message d'erreur si la connexion échoue.

function dbConnect(){

    try{
        $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8',
        DB_USER, DB_PASSWORD);
    }

    catch (PDOException $exception){

        error_log('Connection error: '.$exception->getMessage());
        return false;
    }

    return $db;

}

//----------------------------------------------------------------------------
//--- dbRequestPatient ----------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère toutes les données d'un patient

function dbRequestPatient($db, $id) {

    try {
        $query = $db->prepare('SELECT * FROM Patient WHERE id_patient = ?;');
        $query->execute(array($id));
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}

//----------------------------------------------------------------------------
//--- dbRequestPatients -------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère les patients pour un moniteur choisi

function dbRequestPatients($db, $id) {
    
    try {
        $query = $db->prepare('SELECT p.id_patient, p.name, p.surname  FROM Patient AS p INNER JOIN link_to AS l ON p.id_patient = l.id_patient INNER JOIN Monitor as m ON m.id_monitor = l.id_monitor WHERE m.id_monitor = ?;');
        $query->execute(array($id));
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}

//----------------------------------------------------------------------------
//--- dbRequestDatas -------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère les datas relative à un patient

function dbRequestDatas($db, $id) {
    
    try {
        $query = $db->prepare('SELECT * FROM Data WHERE id_patient = ? ;');
        $query->execute(array($id));
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}

//----------------------------------------------------------------------------
//--- dbRequestDatas -------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère les datas relative à un patient

function dbRequestDayConso($db, $id) {
    
    try {
        $query = $db->prepare('SELECT d.volume, d.datetime FROM `data` AS d WHERE id_patient = ? AND DATE(d.datetime) = DATE(now());');
        $query->execute(array($id));
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}

//----------------------------------------------------------------------------
//--- dbRequestWeekConso -------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère la consommation hebdomadaire 

function dbRequestWeekConso($db, $id) {
    
    try {
        $query = $db->prepare('SELECT*
        FROM data AS d
        WHERE (DAYOFWEEK(now()) > 1 AND d.datetime >= date_sub(now(), INTERVAL (dayofweek(now()) - 1) DAY))
        OR (DAYOFWEEK(now()) = 1 AND d.datetime >= date_sub(now(), INTERVAL 6 DAY)) 
        AND id_patient = ?;');
        $query->execute(array($id));
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}

//----------------------------------------------------------------------------
//--- dbRequestMonthConso -------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère la consommation hebdomadaire 

function dbRequestMonthConso($db, $id) {
    
    try {
        $query = $db->prepare('SELECT*
        FROM data AS d
        WHERE MONTH(now()) = MONTH(d.datetime) AND YEAR(now()) = YEAR(d.datetime)
        AND id_patient = ?;');
        $query->execute(array($id));
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}