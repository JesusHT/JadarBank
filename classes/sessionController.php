<?php
    require_once 'classes/session.php';

    class SessionController extends Controller{
        
        private $userSession;
        private $username;
        private $userid;

        private $session;
        private $sites;

        private $user;
    
        function __construct(){
            parent::__construct();

            $this->init();
        }

        public function getUserSession(){
            return $this->userSession;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getUserId(){
            return $this->userid;
        }

        private function init(){
            $this->session = new Session();

            $json = $this->getJSONFileConfig();

            $this->sites = $json['sites'];

            $this->defaultSites = $json['default-sites'];
            
            $this->validateSession();
        }

        private function getJSONFileConfig(){
            $string = file_get_contents("config/access.json");
            $json = json_decode($string, true);

            return $json;
        }

        function validateSession(){
            if($this->existsSession()){
                $role = $this->getUserSessionData()->getRole();

                if($this->isPublic()){
                    $this->redirectDefaultSiteByRole($role);
                }else{
                    if($this->isAuthorized($role)){
                    }else{
                        $this->redirectDefaultSiteByRole($role);
                    }
                }
            }else{
                if($this->isPublic()){
                }else{
                    header('location: '. constant('URL') . '');
                }
            }
        }

        function existsSession(){
            if(!$this->session->exists()) 
                return false;

            if($this->session->getCurrentUser() == NULL) 
                return false;

            $userid = $this->session->getCurrentUser();

            if($userid) 
                return true;

            return false;
        }

        function getUserSessionData(){
            $id = $this->session->getCurrentUser();
            $this->user = new UserModel();
            $this->user->get($id);

            return $this->user;
        }

        public function initialize($user){
            $this->session->setCurrentUser($user->getId());
            $this->authorizeAccess($user->getRole());
        }

        private function isPublic(){
            $currentURL = $this->getCurrentPage();
            
            $currentURL = preg_replace( "/\?.*/", "", $currentURL); 

            for($i = 0; $i < sizeof($this->sites); $i++){
                if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
                    return true;
                }
            }
            return false;
        }

        private function redirectDefaultSiteByRole($role){
            $url = '';
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($this->sites[$i]['role'] === $role){
                    $url = '/expense-app/'.$this->sites[$i]['site'];
                break;
                }
            }
            header('location: '.$url);
            
        }

        private function isAuthorized($role){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/", "", $currentURL);
            
            for($i = 0; $i < sizeof($this->sites); $i++){
                if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
                    return true;
                }
            }
            return false;
        }

        private function getCurrentPage(){
            
            $actual_link = trim("$_SERVER[REQUEST_URI]");
            $url = explode('/', $actual_link);
            return $url[2];
        }

        function authorizeAccess($role){
            switch($role){
                case 'user':
                    $this->redirect($this->defaultSites['user']);
                break;
                case 'admin':
                    $this->redirect($this->defaultSites['admin']);
                break;
                default:
            }
        }

        function logout(){
            $this->session->closeSession();
        }
    }

?>