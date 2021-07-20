<?php 
require_once "env.php";

try {
  $db = new PDO("mysql:host=$host_name; dbname=$database; charset=utf8", $user_name, $password);
} catch (PDOException $e) {
  echo "Erreur!: " . $e->getMessage() . "<br/>";
  die();
}