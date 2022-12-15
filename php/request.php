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
//--- dbRequestPatient -------------------------------------------------------
//--- ROUTE : http://10.10.54.10/php/patient ---------------------------------
//----------------------------------------------------------------------------
// On récupère id, name, surname, d'un seul patient

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
//--- dbRequestPatients ------------------------------------------------------
//--- ROUTE : http://10.10.54.10/php/select_patients?id=1 --------------------
//----------------------------------------------------------------------------
// On récupère id, name, surname, des patients ayant le même observateur	

function dbRequestPatients($db,$id) {

    try {
        $query = $db->prepare('SELECT p.id_patient, p.name, p.surname  
            FROM Patient AS p 
            INNER JOIN Link_to AS l ON p.id_patient = l.id_patient 
            INNER JOIN Monitor as m ON m.id_monitor = l.id_monitor 
            WHERE m.id_monitor = ?;');
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
//--- dbRequestDatas ---------------------------------------------------------
//--- ROUTE : http://10.10.54.10/php/database.php/select_datas?id=1 ----------
//----------------------------------------------------------------------------
// On récupère id, name, surname, age, weight, objective d'un seul patient

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
//--- dbRequestTodayData -----------------------------------------------------
//--- ROUTE : http://10.10.54.10/php/today?id=1 ------------------------------
//----------------------------------------------------------------------------
// On récupère la date et le volume d'un patient en fonction de la date du jour	

function dbRequestTodayData($db, $id) {
    
    try {
        $query = $db->prepare('SELECT datetime,volume 
            FROM Data 
            INNER JOIN Patient ON Data.id_patient = Patient.id_patient
            WHERE DATE(datetime) = DATE(NOW())
            AND Data.id_patient = ?;');
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
//--- dbRequestSpecificDateData ----------------------------------------------
//--- ROUTE : http://10.10.54.10/php/dateX?id=1&date=2022-11-15 --------------
//----------------------------------------------------------------------------
// On récupère la date et le volume bu d'un patient en fonction d'une date spécifié


function dbRequestSpecificDateData($db, $id, $date) {
    
    try {
        $query = $db->prepare('SELECT datetime,volume 
            FROM Data
            INNER JOIN Patient ON Data.id_patient = Patient.id_patient
            WHERE DATE(datetime) = :date
            AND Data.id_patient = :id;');
        $query->execute(array(':date' => $date, ':id' => $id));
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}