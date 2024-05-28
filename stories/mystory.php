<?php
session_start();

require_once "../utils/formUtils.php";
require_once "../utils/crudStories.php";

$pageTitle = "View My Story";
$crud = new CRUD_STORY();
$stories = $crud->selectStories("");
foreach ($stories as $story) {
    $image = "../images/stories/{$story['image']}";
    $desc = $story["desc"];
    $title = $story["title"];
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
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?php echo $image; ?>" alt="avatar" class="rounded-circle img-fluid" id="profile-picture">
                            <h5 class="my-3"></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <p class="text-muted mb-0">
                            <h3><?php echo $title; ?></h3>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-muted mb-0"><?php echo $desc; ?></p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <a href="../user/profile.php?id=7" class="btn btn-primary">Go Back</a></p>
        </div>
    </section>
</body>

</html>