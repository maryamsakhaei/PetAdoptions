<?php
session_start();

require_once "../utils/formUtils.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudAdoption.php";
require_once "../utils/crudStories.php";
require_once "../components/usertable.php";
require_once "../utils/crudPet.php";
require_once "../components/breadcrumb.php";

$pageTitle = "View Stories";

$crud = new CRUD_STORY();

$stories = $crud->selectStories("");
$layout = "";
foreach ($stories as $story) {
    $image = "../images/stories/{$story['image']}";
    $desc = $story["desc"];
    $title = $story["title"];
    $layout .= <<<HTML
            <section>
                <div class="container py-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="$image" alt="Pet-Photo" class="img-fluid" id="profile-picture">
                                    <h5 class="my-3"></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <p class="text-muted mb-0"><h3> $title</h3></p>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="text-muted mb-0">$desc</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
   HTML;
}
if (isset($_SESSION["Adm"])) {
    addBreadcrumb('Dashboard', '../admin/dashboard.php');
} else if (isset($_SESSION["Agency"])) {
    addBreadcrumb('Dashboard', '../agency/dashboard.php');
} else if (isset($_SESSION["User"])) {
    addBreadcrumb('Home', '../home.php');
}

addBreadcrumb('Stories');

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

        <div id="layout" class="row">
            <?= $layout ?>
        </div>
    </div>
</body>

</html>