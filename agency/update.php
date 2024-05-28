<?php

require_once "../utils/crudUser.php";
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";
require_once "../utils/agencyForm.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Update details";

session_start();

$id = $_GET["id"];
$crud = new CRUD_USER();

$result = $crud->selectUsers("id = $id");

if (!empty($result)) {

    $user = $result[0];
    $agency = $user['agency'];
    $email = $user['email'];
    $address = $user['address'];
    $phone = $user['phone'];

    $form = renderFormAgency($agency, $address, $phone, $email, "Update account");

    if (isset($_POST["sign-up"])) {

        $agency = cleanInputs($_POST["agency"]);
        $address = cleanInputs($_POST["address"]);
        $phone = (isset($_POST["phone"])) ? cleanInputs($_POST["phone"]) : '';
        $picture = fileUpload($_FILES["picture"], 'agency');

        if ($_FILES["picture"]["error"] == 0) {
            removeOldUserImage($user["image"]);
            $update = $crud->updateAgency($id, $agency, $address, $phone, $email, $picture[0]);
        } else {
            $picture = null;
            $update = $crud->updateAgency($id, $agency, $address, $phone, $email, $picture);
        }
        if ($update) {
            if(isset($_SESSION["Agency"])){
                header("refresh: 2; url = ../user/profile.php?id=" . $id);
            } elseif (isset($_SESSION["Adm"])) {
            header("refresh: 2; url = ../admin/agencies.php");
            }
            
        }
    }
}
addBreadcrumb('Home', '../home.php');
addBreadcrumb('Profile', '../user/profile.php?id=' . $id);
addBreadcrumb('Edit');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <h1 class="text-center">Update Agency</h1>
            <?= $form ?>
        </form>
    </div>
    <script type="text/javascript" src="../js/userform.js"></script>
</body>

</html>