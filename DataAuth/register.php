<?php 
session_start();
if( 
    isset($_POST["fname"]) && !empty(trim($_POST["fname"]))  &&
    isset($_POST["lname"]) && !empty(trim($_POST["lname"])) &&
    isset($_POST["address"]) && !empty(trim($_POST["address"])) &&
    isset($_POST["email"]) && !empty(trim($_POST["email"])) &&
    isset($_POST["password"]) && !empty(trim($_POST["password"])) &&
    isset($_POST["gender"]) && !empty(trim($_POST["gender"]))  && 
    isset($_POST["country"]) && !empty(trim($_POST["country"]))  
){
