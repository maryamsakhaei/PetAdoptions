<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Bird pet care";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care', '../petcare/care.php');
addBreadcrumb('Bird');

?>

<!doctype html>
<html lang="en">

<head>
    <?php include '../components/head.php'; ?>
    <link rel="stylesheet" href="../css/main.css">
    <title><?= $pageTitle ?></title>
</head>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="container">
    <h1 class="text-center">Bird Care</h1>
        <div class="row">
            <div class="col">
                <ul>
                    <li>
                        Bird Care Fundamentals: Explore the essentials of providing a nurturing environment for pet birds, both large and small.
                    <li>
                        Diet and Feeding: Learn about suitable bird diets, including seeds, pellets, fruits, and vegetables, to ensure optimal health.
                        
                    <li>
                        Cage Setup and Enrichment: Find out how to create a comfortable cage with perches, toys, and mental stimulation.
                    </li>

                    <li>
                        Grooming and Hygiene: Get tips on maintaining your bird's feathers, beak, and nails, and providing bathing opportunities.
                    </li>
            
            </div>
            <div class="col">
                <img src="../images/pets/bird.jpg">
            </div>
            <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
                <a href="care.php" class="btn btn-warning">Back</a>
            </div>
        </div>
    </div>

</body>

</html>