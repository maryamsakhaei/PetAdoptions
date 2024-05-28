<?php
session_start();

require_once "../utils/crudAdoption.php";
require_once "../utils/crudUser.php";
require_once "../utils/crudPet.php";
require_once "../utils/crudStories.php";
require_once "../components/usertable.php";
require_once "../utils/formUtils.php";
require_once "../components/breadcrumb.php";

$id = $_SESSION["User"];

$pageTitle = "My adoptions";

preventAgency();
preventAdmin();

$crud = new CRUD_ADOPTION();

$applications = $crud->selectAdoptions("fk_adoptee_id = $id");
$applic = viewAdoptions($applications);

addBreadcrumb('Home', '../user/dashboard.php');
addBreadcrumb('User', '../user/profile.php?id=' . $_SESSION["User"]);
addBreadcrumb('Adoptions');

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

        <div class="col">
            
                <div class="card mb-4">
                    <div class="card-header">
                        My adoption applications
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Pet Name</th>
                                        <th scope="col">Species</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Submission Date</th>
                                        <th scope="col">Donation</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?= $applic ?>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            
        </div>

</body>

</html>