<?php
require_once "../utils/crudStories.php";
require_once "../utils/formUtils.php";

session_start();

$id = $_GET["id"];

$crud = new CRUD_STORY();

$getMsg = $crud->selectMessages("id = $id");
$msg = $getMsg[0];
$status = ($msg['readmsg_agency'] == 0) ? 1 : 0;

$markread = $crud->changeMsgStatus($id, $status, "agency");

if ($markread) {
    header("refresh: 0; url = ../messages/seeMessages.php");
}
