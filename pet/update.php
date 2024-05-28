<?php
require_once "../utils/crudPet.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";
require_once "../utils/petform.php";




$pageTitle = "Update details";

session_start();
preventUser();

if (isset($_SESSION["Adm"])) {
    $userID = $_SESSION["Adm"];
} else {
    $userID = $_SESSION["Agency"];
}

if(isset($_SESSION["Adm"])){
    addBreadcrumb('Dashboard', '../admin/dashboard.php');
    addBreadcrumb('Pets', '../pet/listings.php');
    addBreadcrumb('Update');
}elseif(isset($_SESSION["Agency"])){
    addBreadcrumb('Dashboard', '../agency/dashboard.php');
    addBreadcrumb('Pets', '../agency/repository.php'); 
    addBreadcrumb('Update');
} 

$id = $_GET["id"];

$crud = new CRUD_PET();

$result = $crud->selectPets("id = $id");

if (!empty($result)) {

    $pet = $result[0];
    $name = $pet["name"];
    $minSpace = $pet["minSpace"];
    $species = $pet["species"];

    $experience = ($pet["experienceNeeded"] == 1) ? 'checked' : '';
    $available = ($pet["available"] == 1) ? 'checked' : '';
    $vaccine = ($pet["vaccinated"] == 1) ? 'checked' : '';

    $location = $pet["location"];
    $breed = $pet["breed"];
    $age = $pet["age"];
    $size = $pet["size"];
    $description = $pet["description"];
    $behavior = $pet["behavior"];

    $form = renderForm($name, $species, $minSpace, $experience, $available, $vaccine, $breed, $age, $size, $location, $description, $behavior, "Update");

    if (isset($_POST["create"])) {

        $name = cleanInputs($_POST['name']);
        $minSpace = cleanInputs($_POST['minSpace']);
        $species = $_POST['species'];

        $experience = isset($_POST["experience"]) ? 1 : 0;
        $status = isset($_POST["status"]) ? 1 : 0;
        $vaccinated = isset($_POST["vaccine"]) ? 1 : 0;

        $location = $_POST['location'];
        $breed = $_POST['breed'];
        $age = $_POST['age'];
        $size = $_POST['size'];
        $description = $_POST['desc'];
        $behavior = $_POST['behavior'];

        $image = fileUpload($_FILES["image"], 'pet');

        if ($_FILES["image"]["error"] == 0) {
            removeOldPetImage($pet["image"]);
            $update = $crud->updatePet($id, $name, $location, $species, $breed, $age, $size, $description, $status, $vaccinated, $experience, $minSpace, $behavior, $image[0]);
        } else {
            $update = $crud->updatePet($id, $name, $location, $species, $breed, $age, $size, $description, $status, $vaccinated, $experience, $minSpace, $behavior, Null);
        }
        if ($update) {
            header("refresh: 2; url = ../pet/details.php?id=" . $pet["id"]);
        }
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
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h2>Update pet</h2>
                </div>
                <?= $form ?>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="../js/formhelper.js"></script>
</body>

</html>