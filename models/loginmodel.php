<?php

    class LoginModel extends Model {

        function __construct(){
            parent::__construct();
        }

        function login($email, $pass){
            try{
                $query = $this->prepare('SELECT * FROM users WHERE email = :email');
                $query->execute(['email' => $email]);
                
                if($query->rowCount() == 1){
                    $item = $query->fetch(PDO::FETCH_ASSOC); 

                    $user = new UserModel();
                    $user -> from($item);

                    if (password_verify($pass, $user -> getPass())){
                        return $user;
                    }

                    return NULL;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }
    }

?>