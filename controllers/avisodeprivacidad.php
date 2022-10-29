<?php

    class AvisoDePrivacidad extends Controller{
        function __construct(){
            parent::__construct();
            $this -> view -> render('avisodeprivacidad/index');
        }

    }

?>