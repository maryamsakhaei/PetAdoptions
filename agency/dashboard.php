<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../utils/crudAdoption.php";
require_once "../pet/viewAll.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Dashboard";

addBreadcrumb('Dashboard');

preventUser();
redirectAgencyToLogin();
preventAdmin();

$crud = new CRUD_PET();
$crudAdopt = new CRUD_ADOPTION();

$agencyId = $_SESSION["Agency"];

$agencyPets = $crud->selectPets("`fk_users_id` = $agencyId");
$petCount = count($agencyPets);

$adopted = $crud->selectPets("`fk_users_id` = $agencyId AND available = 0");
$adoptedCount = count($adopted);
$availableCount = $petCount - $adoptedCount;

$apply = count($crudAdopt->selectAdoptionsAndAgencyPets("fk_users_id = $agencyId AND adopStatus = 'Apply'"));
$approved = count($crudAdopt->selectAdoptionsAndAgencyPets("fk_users_id = $agencyId AND adopStatus = 'Approved'"));
$declined = count($crudAdopt->selectAdoptionsAndAgencyPets("fk_users_id = $agencyId AND adopStatus = 'Declined'"));
$cancelled = count($crudAdopt->selectAdoptionsAndAgencyPets("fk_users_id = $agencyId AND adopStatus = 'Cancelled'"));

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
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Adoption statistics</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Pending </h5>
                                    <h2 class="h2-header"><?= $apply ?></h2>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Approved </h5>
                                    <h2 class="h2-header"><?= $approved ?></h2>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Declined</h5>
                                    <h2 class="h2-header"><?= $declined ?></h2>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Cancelled</h5>
                                    <h2 class="h2-header"><?= $cancelled ?></h2>
                                </div>
                            </div>
                            <div class="gap-2 d-md-flex justify-content-center">
                                <a href="../agency/adoptions.php" class="btn btn-primary">See all adoptions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Pet statistics</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Listed pets </h5>
                                    <h2 class="h2-header"><?= $petCount ?></h2>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Adopted </h5>
                                    <h2 class="h2-header"><?= $adoptedCount ?></h2>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Available </h5>
                                    <h2 class="h2-header"><?= $availableCount ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="gap-2 d-md-flex justify-content-center">
                            <a href="../agency/repository.php" class="btn btn-primary">See all pets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>