<?php

session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

if (isset($_SESSION["Adm"])) {
    addBreadcrumb('Dashboard', '../admin/dashboard.php');
    addBreadcrumb('Pets', '../pet/listings.php');
    addBreadcrumb('Details');
} else if (isset($_SESSION["Agency"])) {
    addBreadcrumb('Dashboard', '../agency/dashboard.php');
    addBreadcrumb('Pets', '../agency/repository.php');
    addBreadcrumb('Details');
} else if (isset($_SESSION["User"])) {
    addBreadcrumb('Home', '../home.php');
    addBreadcrumb('Pets', '../pet/listings.php');
    addBreadcrumb('Details');
}

$pageTitle = "Pet details";

$id = $_GET["id"];

$crud = new CRUD_PET();

$result = $crud->selectPets("id = $id");

$petDetails = viewPetDetails($result);

if (!empty($result)) {

    $pet = $result[0];
    $userId = $pet["fk_users_id"];
    $status = ($pet['available'] == 1) ? 'Available' : 'Adopted';
    $petOfD = $pet['pet_day'];
    $POD = $pet['pet_day'];

    if ($POD == 1) {
        $btntxt = "Remove pet of the day";
        $btnname = "remove-POD";
    } else {
        $btntxt = "Make pet of the day";
        $btnname = "make-POD";
    }

    $hiddenAttr = ($pet['available'] == 0) ? 'hidden' : '';

    $layout = <<<HTML
                    <a href="../pet/listings.php" class="btn btn-warning">Go back</a>
                    <a href='../adoptions/new.php?id=$id' class='btn btn-primary' $hiddenAttr>Adopt</a> 
                    <a href='../agency/contact.php?id=$userId' class="btn btn-primary">Contact Agency</a>
                </div>
                HTML;
    if (isset($_SESSION["Adm"]) || isset($_SESSION["Agency"])) {
        $layout .= <<<HTML
                    <a href="update.php?id={$id}" class="btn btn-primary">Update</a>
                    <a href="delete.php?id={$id}" class="btn btn-danger">Delete</a>
                    </div>
                HTML;
    }

    if (isset($_SESSION["Adm"])) {
        $layout .= <<<HTML
                        <form method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="gap-2 d-md-flex justify-content-center" id="pet-of-day-btn">
                                <button name='{$btnname}' type="submit" class="btn btn-primary">$btntxt</button>
                            </div>
                        </form>
                        HTML;
    }
} else {
    $layout = "<p class='text-center'>Something went wrong. Record with id = $id is not found.</p>";
}
if (isset($_POST["make-POD"])) {

    $result = $crud->makePetOfDay($id);

    if ($result) {
        header("Location: $_SERVER[REQUEST_URI]");
        exit;
    }
} else if (isset($_POST["remove-POD"])) {
    $result = $crud->removePetOfDay($id);

    if ($result) {
        header("Location: $_SERVER[REQUEST_URI]");
        exit;
    }
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
        <div class="row ">
            <?= $petDetails ?>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-center">
            <?= $layout ?>
        </div>
    </div>
</body>

</html>