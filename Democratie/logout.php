<?php
//Page réservé à la déconnexion
session_start();
session_unset();
header('Location: index.php?info=notlogged');
