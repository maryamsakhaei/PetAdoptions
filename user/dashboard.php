<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";
$pageTitle = "User dashboard";

$crud = new CRUD_PET();

$resultPetOfDay = $crud->selectPets("`pet_day`=1");

$result = $crud->selectPets("");
$layout = viewPets($result);

addBreadcrumb('Home', '../user/dashboard.php');

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
        <div id="layout" class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
        
            <?= $layout ?>
        </div>
    </div>

</body>

</html>