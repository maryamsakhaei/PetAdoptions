<?php
require_once "../utils/crudStories.php";
require_once "../utils/formUtils.php";
session_start();
preventAdmin();
preventAgency();
$id = $_GET["id"];
$crud = new CRUD_STORY(); 
$crud->deleteStory($id);
header("refresh:1; url = ../user/profile.php"); 

