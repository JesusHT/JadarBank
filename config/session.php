<?php

    // Valida si existe una session de no existir te envia al login y si sirve extrae los datos del usuario para poder usarlos déspues

    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $db = new Database();

    if (isset($_SESSION['user']) && isset($_SESSION['role'])) {

        $sql = $_SESSION['role'] === 'admin' ? 'SELECT * FROM ejecutivo WHERE id = :id' : 'SELECT * FROM cliente   WHERE id = :id';

        $query = $db -> connect() -> prepare($sql);
        $query -> execute(['id' => $_SESSION['user']]);
        
        $results  = $query  -> fetch(PDO::FETCH_ASSOC);

        $cliente = null;

        if (count($results) > 0) {
            $cliente = $results;
        }

    } else {
        session_unset();
        session_destroy();
        $session = new Controller();
        $session -> redirect('', ['error' => Errors::ERROR_SESSION]);
    }

?>