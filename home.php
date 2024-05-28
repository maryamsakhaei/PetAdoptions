<?php
session_start();

require_once "components/breadcrumb.php";
require_once "utils/crudPet.php";

$pageTitle = "Homepage";

addBreadcrumb('Home');

$crud = new CRUD_PET();

$getPOD = $crud->selectPets("pet_day = 1");

if (!empty($getPOD)) {
    $POD = $getPOD[0];
    $image = "images/pets/{$POD['image']}";
    $petId = $POD['id'];
    $detailsP = "pet/details.php?id={$petId}";
}

$successStories = "stories/viewStories.php";

$lastStory = "images/layout/64e5d72164d55.jpg";

$petCareURL = "petcare/care.php";
$petCareImg = "images/layout/petcare.jpg";

$petTrainingURL = "petcare/care.php";
$petTrainingImg = "images/layout/pettraining.jpg";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="/css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
   <div class="container">
        <div class="row  row-cols-lg-2 row-col-md-1 row-col-sm-1 row-col-xs-1">
            <div > 
              <div class="card mb-4">
                        <div class="card-body text-center">
                            <a href="<?= $detailsP ?>">
                                <img src="<?= $image ?>" id="details-img" class="img-fluid shadow" alt="Pet image">
                            </a>
                            <h5 class="my-3">Pet of the day</h5>
                        </div>
               </div>
            </div>
            <div > 
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <a href="<?= $successStories ?>">
                                <img src="<?= $lastStory ?>" id="details-img" class='img-fluid shadow' alt="Pet image">
                            </a>
                            <h5 class="my-3">Adoption success stories</h5>
                        </div>
                    </div>

            </div>
            <div>
            <div class="card mb-4">
                        <div class="card-body text-center">
                            <a href="<?= $petCareURL ?>">
                                <img src="<?= $petCareImg ?>" id="details-img" class='img-fluid shadow' alt="Pet image">
                            </a>
                            <h5 class="my-3">Pet care tips</h5>
                        </div>
                    </div>
            </div>
            <div>
             <div class="card mb-4">
                        <div class="card-body text-center">
                            <a href="<?= $petTrainingURL ?>">
                                <img src="<?= $petTrainingImg ?>" id="details-img" class='img-fluid shadow' alt="Pet image">
                            </a>
                            <h5 class="my-3">Pet training tips</h5>
                        </div>
                    </div>
             </div>
             </div>
             
        </div>
        
</body>

</html>