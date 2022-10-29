<?php

    class LoginModel extends Model {

        function __construct(){
            parent::__construct();
        }

        function login($email, $pass){
            $sql  = 'SELECT * FROM cliente WHERE email = :email';
            $item = $this -> userExist($email, $sql);

            if ($item === NULL) {
                $sql = 'SELECT * FROM ejecutivo WHERE email = :email';
                $item = $this -> userExist($email, $sql);
            }

            $user = new UserModel();
            $user -> from($item);

            if (password_verify($pass, $user -> getPass())){
                return $user;
            }

            return NULL;
        }

        function userExist($email,$sql){
            try {
                $query = $this -> prepare($sql);
                $query -> execute(['email' => $email]);

                if ($query->rowCount() == 1) {
                    $item = $query->fetch(PDO::FETCH_ASSOC); 
                    return $item;
                }

                return NULL;

            } catch (PDOException $e) {
                return NULL;
            }
        }
    }

?>