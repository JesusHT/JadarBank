<?php

    class Main extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $this -> view -> render('main/index');
        }
    }

?>