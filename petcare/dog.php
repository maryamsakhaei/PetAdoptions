<?php
session_start();

require_once "../utils/crudPet.php";
require_once "../pet/viewAll.php";
require_once "../components/breadcrumb.php";

$pageTitle = "Dog pet care";

addBreadcrumb('Home', '../home.php');
addBreadcrumb('Pets', '../pet/listings.php');
addBreadcrumb('Pet care', '../petcare/care.php');
addBreadcrumb('Dog');

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
           <h1 class="text-center">Dog Care</h1>
            <div class="row">
               <div class="col">
                    <ul>
                       <li> Introduction to Dog Care: Learn the basics of providing a loving and healthy environment for your canine companion.</li>
                       <li> Feeding and Nutrition: Understand the dietary needs of dogs, including portion control, suitable foods, and feeding schedules.</li>
                      <li> Exercise and Play: Discover the importance of physical activity for dogs, and get ideas for engaging exercises and games</li>
                     <li>Grooming and Hygiene: Find out how to keep your dog's coat, nails, and teeth clean and well-maintained.</li>
                      <li>Health and Veterinary Care: Get insights into preventive care, vaccinations, common health issues, and regular vet visits.</li>
                   </ul>
             </div>
             <div class="col">
                   <img src="../images/pets/dog.jpg">
                </div>
         </div>
         <div class="gap-2 d-md-flex justify-content-left" id="pet-of-day-btn">
            <a href="care.php" class="btn btn-warning">Back</a>
        </div>
    </div>
    
</body>

</html>