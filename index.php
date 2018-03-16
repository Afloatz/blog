<?php
session_start();
require 'Controleur/Routeur.php';
$routeur = new Routeur();
$routeur->routerRequete();