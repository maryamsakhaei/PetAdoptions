<?php
require_once "../utils/crudAdoption.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";

$pageTitle = "Edit adoption";

$crudAdoption = new CRUD_ADOPTION();

$adoptId = $_GET["id"];
$petId = $_GET["pid"];

$tablePet = "pet";
$columnsPet = "available";
$statusPet = "0";

$tableAdoption = "adoption";
$columnsAdoption = "adopStatus";
$statusAdoption = $_GET["status"];
$statusDeclined = "Declined";

if ($statusAdoption == "Approved") {

    $updateRejectOthers = $crudAdoption->updateAdoptionStatus($tableAdoption, $columnsAdoption, $statusDeclined, "WHERE fk_pet_id = $petId");

    $updateApproved = $crudAdoption->updateAdoptionStatus($tableAdoption, $columnsAdoption, $statusAdoption, "WHERE id = $adoptId");

    $updateAvailable = $crudAdoption->updateAdoptionStatus($tablePet, $columnsPet, $statusPet, "WHERE id = $petId");
}
if ($statusAdoption == "Declined") {
    $updateApproved = $crudAdoption->updateAdoptionStatus($tableAdoption, $columnsAdoption, $statusAdoption, "WHERE id = $adoptId");
}


if ($statusAdoption == "Cancelled") {
    $updateApproved = $crudAdoption->updateAdoptionStatus($tableAdoption, $columnsAdoption, $statusAdoption, "WHERE id = $adoptId");
}

echo "<div class='alert alert-success'>
               <p>The adoption status has been updated</p>
            </div>";


header("refresh: 3; url = ../agency/adoptions.php");
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
        <h1>Adoption status is changed!</h1>
        <h2>You will be send back to previous page</h2>
    </div>
</body>

</html>