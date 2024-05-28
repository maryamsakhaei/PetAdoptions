<?php

session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudPet.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Adoption Details";

preventAdmin();
preventAgency();

$userId = $_SESSION['User'];

$id = $_GET["id"];

$crud = new CRUD_ADOPTION();

$result = $crud->selectAdoptions("id = $id");

$layout = "";

if (!empty($result)) {

    $adoption = $result[0];
    $adoptId = $adoption['id'];
    $petId = $adoption["fk_pet_id"];

    $adoptee = $adoption["fk_adoptee_id"];

    if ($adoptee != $userId) {
        header("Location: ../home.php");
    }

    $crudpet = new CRUD_PET();

    $getPet = $crudpet->selectPets("id = $petId");

    $pet = $getPet[0];

    $name = $pet["name"];

    $status = $adoption["adopStatus"];

    $btnattr = "hidden";
    $cancelurl = "";
    if ($status == 'Apply') {
        $application = 'pending';
        $cancelurl = "../adoptions/edit.php?id={$adoptId}&status=Cancelled&pid={$petId}";
        $btnattr = "";
    } elseif ($status == 'Approved') {
        $application = 'approved';
    } elseif ($status == 'Declined') {
        $application = 'rejected';
    } elseif ($status == 'Cancelled') {
        $application = 'cancelled';
    }

    $submitted = $adoption["submitionDate"];
    $today = date("Y-m-d");
    $diff = strtotime($today) - strtotime($submitted);
    $daysAgo = floor($diff / (60 * 60 * 24));
    $daytext = ($daysAgo == 1) ? 'day' : 'days';

    $reason = $adoption["reason"];

    $layout .= <<<HTML
            <div class="card text-center">
                <div class="card-header">
                    My adoption application
                </div>

                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p>Your application is <b>$application</b>.</p>
            HTML;

    if ($status == 'Apply') {
        $layout .= <<<HTML
                        <p class="card-text">No information available.</p>
                HTML;
    } elseif ($status == 'Approved') {
        $layout .= <<<HTML
                            <p class="card-text"> Congratulations on choosing to adopt $name!</p>
                HTML;
    } elseif ($status == 'Declined') {
        $layout .= <<<HTML
                            <p class="card-text"> Sorry, your application is declined.</p>
                HTML;
    } elseif ($status == 'Cancelled') {
        $layout .= <<<HTML
                            <p class="card-text"> You cancelled the application yourself.</p>
                HTML;
    }

    $layout .= <<<HTML
               
                <a href={$cancelurl} class="btn btn-primary" $btnattr >Cancel Adoption</a>
                HTML;

    if (isset($_SESSION['Agency']) || isset($_SESSION['Adm'])) {
        $layout .= <<<HTML
                    <a href="../adoptions/myadoptions.php" class="btn btn-primary" $btnattr >Back to Adoptions</a>
                    </div>
                HTML;
    }

    if (isset($_SESSION['Agency'])) {
        $layout .= <<<HTML
                <a href="../agency/adoptions.php" class="btn btn-primary" $btnattr >Back to Adoptions</a>
                HTML;
    }

    $layout .= <<<HTML
                    </div>
            
                <div class="card-footer text-body-secondary">
                    Submitted $daysAgo $daytext ago
                </div>
            </div>
        HTML;
} else {
    $layout .= "No results";
}

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('User', '../user/profile.php?id=' . $_SESSION["User"]);
addBreadcrumb('Adoptions', '../adoptions/myadoptions.php');
addBreadcrumb('Details');
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
        <?= $layout ?>
    </div>

</body>

</html>