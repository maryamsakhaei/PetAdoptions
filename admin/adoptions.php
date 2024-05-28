<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../adoptions/viewAll.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Adoptions";

preventUser();
preventAgency();

$crud = new CRUD_ADOPTION();

$apply = $crud->selectAdoptionsAndAgencyPets("adopStatus = 'Apply'");
$approved = $crud->selectAdoptionsAndAgencyPets("adopStatus = 'Approved'");
$declined = $crud->selectAdoptionsAndAgencyPets("adopStatus = 'Declined'");
$cancelled = $crud->selectAdoptionsAndAgencyPets("adopStatus = 'Cancelled'");

$pending = viewAdoptions($apply);
$accepted = viewAdoptions($approved);
$rejected = viewAdoptions($declined);
$cancelled = viewAdoptions($cancelled);

addBreadcrumb('Dashboard', "../admin/dashboard.php");
addBreadcrumb('Adoptions');
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