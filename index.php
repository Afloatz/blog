<?php
session_start();
require 'Controller/FrontController.php';
$routeur = new FrontController();
$routeur->routerRequete();