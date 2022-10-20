<?php

    // Valida si existe una session de no existir te envia al login y si sirve extrae los datos del usuario para poder usarlos déspues

    session_start();

    $db = new Database();

    if (isset($_SESSION['user'])) {

        $records = $db -> connect() -> prepare('SELECT * FROM users WHERE id = :id');
        $records -> bindParam(':id', $_SESSION['user']);
        $records -> execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

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