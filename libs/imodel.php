<?php
    
    interface IModel {
        public function save();
        public function getUsers($id);
        public function get($id, $tabla);
        public function delete($id);
        public function update($id);
        public function from($array);
    }

?>