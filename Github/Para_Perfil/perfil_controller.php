<?php namespace perfil_html;

 session_start();
 
 if(!isset($_SESSION['acceso'])){
     header("location: login.php");
 }
 
 include_once("conexion.php");
 
 ?>