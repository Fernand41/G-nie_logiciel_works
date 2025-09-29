<?php

$servername = "localhost";

$username = "root";

$password = "";

$dbname = "blockchain_jobs";

try {
 
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie";

} catch(PDOException $e) {

    echo "Erreur : " . $e->getMessage();
}

