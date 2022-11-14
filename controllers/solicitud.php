<?php

    class Solicitud extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> redirectRole();

            $listRequests   = $this -> setListRequests();

            $this -> view -> render('solicitud/index',[
                'list' => $listRequests
            ]);
        }

        public function setListRequests(){
            $query = new ListaSolicitudesModel;
            return $query -> getListRequests();
        }

        public function aceptado(){
            if ($this -> existPOST(['aceptar'])) {

                if ($this -> validateData(['aceptar'])) {
                    $this->redirect('solicitud', ['error' => Errors::ERROR_DATA ]);
                    return;
                }

                $query = new UserModel();
                $query -> setNum_client();
                $num_client = $query -> getNum_client();
                $id = $this -> getPost('aceptar');

                if ($this -> model -> aceptado($num_client, $id) === NULL) {
                    $this->redirect('solicitud', ['error' => Errors::ERROR_REQUESTS_CUSTOMERS]);
                    return;
                }

                $query -> getUsers($id);
                if ($query -> createAccount()){
                    $this->redirect('solicitud', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
                    return;
                }
            }
        }

        public function rechazado(){
            if ($this -> existPOST(['rechazar'])) {
                
                if ($this -> validateData(['rechazar'])) {
                    $this -> redirect('solicitud', ['error' => Errors::ERROR_DATA ]);
                    return;
                }

                $id = $this -> getPost('rechazar');

                if ($this -> model -> rechazado($id) === NULL) {
                    $this->redirect('solicitud', ['error' => Errors::ERROR_REQUESTS_CUSTOMERS]);
                    return;
                }

                $this->redirect('solicitud', ['success' => Success::SUCCESS_REQUEST_DENIED]);
                return;
            }
        }
    }
?>