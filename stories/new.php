<?php
session_start();
require_once "../utils/file_upload.php";
require_once "../utils/formUtils.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudStories.php";
require_once "../components/usertable.php";
require_once "../utils/crudPet.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Pet story";

$petId = $_GET["id"];

$userId = $_SESSION["User"];

$crud = new CRUD_STORY();

if (isset($_POST["create"])) {

    $date = date("Y-m-d H:i:s");
    $description = cleanInputs($_POST['desc']);
    $title = cleanInputs($_POST['title']);
    $image = fileUpload($_FILES["image"], 'story');
    $values = [$petId, $image[0], $title, $date, $description, $userId];

    $story = $crud->createStory($values);

    if (!empty($story)) {
        header("refresh: 2; url = ../stories/viewstories.php");
    }
}

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Stories', '../stories/viewStories.php');
addBreadcrumb('New');
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
        <h1 class="text-center">Add your story</h1>
        <form method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="optional-fields">
                <div class="mb-3">
                    <label for="desc" class="form-label">Title </label>
                    <input type="text" class="form-control" id="title" name="title" rows="4" cols="50" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description </label>
                    <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder=""></textarea>
                </div>
                <div class="mb-3"></div>
                <div class="mb-3"></div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image </label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
            <div class="container">
                <div class="d-grid gap-2 d-md-flex justify-content-start">
                    <button name='create' type="submit" class="btn btn-primary">Create</button>
                    <a href="../user/profile.php?id=<?= $id ?>" class="btn btn-warning">Back</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>