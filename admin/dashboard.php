<?php
session_start();

require_once "../utils/formUtils.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/crudPet.php";
require_once "../utils/crudStories.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Dashboard";

preventUser();
preventAgency();
redirectToLogin();

$crudPet = new CRUD_PET();

$allPets = $crudPet->selectPets("");
$petCount = count($allPets);

$adopted = $crudPet->selectPets("available = 0");
$adoptedCount = count($adopted);

$availableCount = $petCount - $adoptedCount;

$crud = new CRUD_USER();
$crudAdoptions = new CRUD_ADOPTION();
$crudStories = new CRUD_STORY();

$users = $crud->selectUsers("role != 'Adm' and role != 'Agency'");
$agencies = $crud->selectUsers("role != 'Adm' and role != 'User'");
$applications = $crudAdoptions->selectAdoptions("");
$stories = $crudStories->selectStories("");

$userCount = count($users);
$agencyCount = count($agencies);
$applCount = count($applications);
$storyCount = count($stories);

addBreadcrumb('Dashboard');
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
                        <h2>User statistics</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Users </h5>
                                    <h2 class="h2-header"><?= $userCount ?></h2>
                                    <div class="gap-2 d-md-flex justify-content-center">
                                        <a href="users.php" class="btn btn-primary">See all users</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Agencies </h5>
                                    <h2 class="h2-header"><?= $agencyCount ?></h2>
                                    <div class="gap-2 d-md-flex justify-content-center">
                                        <a href="agencies.php" class="btn btn-primary">See all agencies</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Adoption applications </h5>
                                    <h2 class="h2-header"><?= $applCount ?></h2>
                                    <div class="gap-2 d-md-flex justify-content-center">
                                        <a href="adoptions.php" class="btn btn-primary">See all applications</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-statistics">
                                    <h5>Success stories </h5>
                                    <h2 class="h2-header"><?= $storyCount ?></h2>
                                    <div class="gap-2 d-md-flex justify-content-center">
                                        <a href="../stories/viewStories.php" class="btn btn-primary">See all stories</a>
                                    </div>
                                </div>
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
                                    <h5>Pets </h5>
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
                            <a href="../pet/listings.php" class="btn btn-primary">See all pets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>