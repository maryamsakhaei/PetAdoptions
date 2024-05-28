<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/formUtils.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('User', '../user/profile.php');
addBreadcrumb('Adoptions', '../adoptions/myadoptions.php');
addBreadcrumb('Apply');

$pageTitle = "New adoption";

$petID = $_GET["id"];

if (!isset($_SESSION["User"])) {
    header("Location: ../user/login.php");
}

$userID = $_SESSION["User"];

$crud = new CRUD_PET();

$crudAdoption = new CRUD_ADOPTION();

$result = $crud->selectPets("id = $petID");

$petDetails = viewPetDetails($result);

$adoptions = $crudAdoption->selectAdoptions("fk_adoptee_id = $userID AND fk_pet_id = $petID AND adopStatus = 'Apply'");

$showError = "hidden";
$hideForm = "";
if (!empty($adoptions)) {
    $showError = "";
    $hideForm = "hidden";
}

if (isset($_POST['adoption-submit'])) {

    $submitionDate = date('Y-m-d H:i:s');
    $adoptionDate = $_POST['adoptionDate'];
    $donation = $_POST['donation'];
    $reason = $_POST['reason'];

    $values = [$petID, $userID, $submitionDate, $donation, $reason, $adoptionDate, 'Apply'];

    $crudAdoption->createAdoption($values);
}



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
        <div class="card" <?= $showError ?>>
            <div class="card-body">
                <p class="applied-text">You have already applied for this pet! </p>
                <div class="gap-2 d-md-flex justify-content-center">
                    <a href="../pet/listings.php" class="btn btn-warning">Go back</a>
                </div>
            </div>
        </div>

        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="card" <?= $hideForm ?>>
                <div class="card-header">
                    <h2>New adoption</h2>
                </div>
                <div class="card-body">
                    <div class='mb-3'>
                        <label for='adoptionDate' class='form-label'>Adoption Date</label>
                        <input type='date' name='adoptionDate' class='form-control' id='adoptionDate' required>
                    </div>
                    <label for="donation" class="form-label">Adoption donation (optional)</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">€</span>
                        <input type="number" class="form-control" name="donation" placeholder="Give amount in euro" aria-label="Amount (to the nearest euro)">
                    </div>
                    <div class='mb-3'>
                        <label for='reason' class='form-label'>Adoption reason</label>
                        <textarea class="form-control" id='reason' name="reason" rows="4" cols="50" placeholder="Give an adoption reason"></textarea>
                    </div>
                    <div class="gap-2 d-md-flex justify-content-center">
                        <a href="../pet/listings.php" class="btn btn-warning">Go back</a>
                        <button type='submit' name='adoption-submit' class='btn btn-primary'>Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row">
            <h2 class="h2-header">Pet details</h2>
            <?= $petDetails ?>
        </div>
    </div>
</body>

</html>