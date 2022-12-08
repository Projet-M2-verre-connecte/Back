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
//--- dbRequestUser ----------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère le nom et prenom des users

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
//--- dbRequestRunners -------------------------------------------------------
//----------------------------------------------------------------------------
// On récupère le nom, prénom

function dbRequestPatients($db) {
    
    try {
        $query = $db->prepare('SELECT p.id_patient, p.name, p.surname FROM Patient as p ;');
        $query->execute();
        $response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    catch (PDOExecption $exception) {
        error_log('Connection error: '.$exception->getMessage());
        return false;
    }
}