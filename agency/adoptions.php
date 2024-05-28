<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../adoptions/viewAll.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";



addBreadcrumb('Dashboard', '../agency/dashboard.php');
addBreadcrumb('Adoptions');

$pageTitle = "Adoption list";

preventUser();
preventAdmin();

$crud = new CRUD_ADOPTION();

$id = $_SESSION["Agency"];

$apply = $crud->selectAdoptionsAndAgencyPets("fk_users_id = $id AND adopStatus = 'Apply'");
$approved = $crud->selectAdoptionsAndAgencyPets("fk_users_id = $id AND adopStatus = 'Approved'");
$declined = $crud->selectAdoptionsAndAgencyPets("fk_users_id = $id AND adopStatus = 'Declined'");
$cancelled = $crud->selectAdoptionsAndAgencyPets("fk_users_id = $id AND adopStatus = 'Cancelled'");

$pending = viewAdoptions($apply);
$accepted = viewAdoptions($approved);
$rejected = viewAdoptions($declined);
$cancelled = viewAdoptions($cancelled);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">

        <?php include '../components/adoptionsAccordeon.php'; ?>
    </div>

</body>

</html>