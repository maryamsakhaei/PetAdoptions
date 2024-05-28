<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";
require_once "../utils/petform.php";

$pageTitle = "Add new pet";

preventUser();

if (isset($_SESSION['Agency'])) {
    $userID = $_SESSION["Agency"];
    addBreadcrumb('Dashboard', '../agency/dashboard.php');
    addBreadcrumb('Pets', '../agency/repository.php');
    addBreadcrumb('New');
} else if (isset($_SESSION['Adm'])) {
    $userID = $_SESSION["Adm"];
    addBreadcrumb('Dashboard', '../admin/dashboard.php');
    addBreadcrumb('Pets', '../pet/listings.php');
    addBreadcrumb('New');
}

$crud = new CRUD_PET();

$name = (isset($_POST['name'])) ? cleanInputs($_POST['name']) : '';
$minSpace = (isset($_POST['minSpace'])) ? cleanInputs($_POST['minSpace']) : '';
$species = (isset($_POST['species'])) ? $_POST['species'] : '';
$experience = isset($_POST["experience"]) ? 'checked' : '';
$status = isset($_POST["status"]) ? 'checked' : '';
$vaccine = isset($_POST["vaccine"]) ? 'checked' : '';

$location = (isset($_POST['location'])) ? cleanInputs($_POST['location']) : Null;
$breed = (isset($_POST['breed'])) ? cleanInputs($_POST['breed']) : Null;
$age = (isset($_POST['age'])) ? $_POST['age'] : Null;
$size = (isset($_POST['size'])) ? $_POST['size'] : Null;
$description = (isset($_POST['desc'])) ? $_POST['desc'] : Null;
$behavior = (isset($_POST['behavior'])) ? $_POST['behavior'] : Null;

$form = renderForm($name, $species, $minSpace, $experience, $status, $vaccine, $breed, $age, $size, $location, $description, $behavior, "Create");

$exp = isset($_POST["experience"]) ? 1 : 0;
$available = isset($_POST["status"]) ? 1 : 0;
$vaccinated = isset($_POST["vaccine"]) ? 1 : 0;

if (isset($_POST["create"])) {

    $image = fileUpload($_FILES["image"], 'pet');

    $values = [$name, $image[0], $location, $species, $breed, $age, $size, $available, $description, $vaccinated, $exp, $minSpace, $behavior, $userID];

    $crud->createPet($values);
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
                    <h2>New pet</h2>
                </div>
                <?= $form ?>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="../js/formhelper.js"></script>
</body>

</html>