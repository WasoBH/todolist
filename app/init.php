<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=Todo;host=localhost:8889','root', 'root');

if(!isset($_SESSION['user_id'])){
	die('Você não está logado.');
}