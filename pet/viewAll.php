<?php
require_once __DIR__ . "/../utils/crudUser.php";
function viewPets($result)
{
    $layout = "";
    if (!empty($result)) {
        foreach ($result as $row) {
            $id = $row['id'];
            $name = $row['name'];
            $image = "../images/pets/{$row['image']}";
            $breed = $row['breed'];
            $age = $row['age'];
            $size = $row['size'];
            $description = $row['description'];
            $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';
            $isAdopted = ($row['available'] == 0) ? true : false;

            $hiddenAttr = $isAdopted ? 'hidden' : '';

            $layout .= <<<HTML
                        
                        <div class="pet-card">
                            <a href="../pet/details.php?id=$id">
                                <img src="{$image}" id="details-img" class='img-fluid shadow' alt="Pet image">
                            </a>
                            <div class="card-body">
                                <figure class="text-center">
                                    <blockquote class="blockquote"><h5>{$name}</h5></blockquote>
                                    <figcaption class="blockquote-footer">{$description}</figcaption>
                                </figure>
                                <p class='card-text'>Breed: $breed</p>
                                <p class="card-text">Age: $age years</p>
                                <p class="card-text">Size: $size</p>
                                <p class="card-text">Vaccinated: $vaccinated</p>
                                <div class="gap-2 d-md-flex justify-content-center">
                                    <a href="../pet/details.php?id=$id" class="btn btn-warning">Details</a><br>
                                    <a href="../adoptions/new.php?id=$id" class="btn btn-primary" $hiddenAttr>Take me home</a>
                HTML;
        if (isset($_SESSION["Adm"]) || isset($_SESSION["Agency"])) {
            $layout .= <<<HTML
                                    <a href="../pet/update.php?id={$id}" class="btn btn-primary">Update</a>
                    HTML;
        }
        $layout .= "            </div>
                            </div>
                        </div>";
        }
    } else {
        $layout = "No results";
    }
    return $layout;
}

function viewPetDetails($result)
{
    $layout = "";
    if (!empty($result)) {
        foreach ($result as $row) {

            $name = $row['name'];
            $image = "../images/pets/{$row['image']}";
            $breed = $row['breed'];
            $age = $row['age'];
            $size = $row['size'];
            $description = $row['description'];
            $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';
            $status = ($row['available'] == 1) ? 'Available for adoption' : 'Adopted';

            $agencyId = $row['fk_users_id'];

            $crud = new CRUD_USER();

            $getAgency = $crud->selectUsers("id = $agencyId");

            if (!empty($getAgency)) {

                $agency = $getAgency[0];
                $agencyName = $agency['agency'];
            } else {
                $agencyName = ' ';
            }

            $POD_Id = $row['id'];
            $layout .= <<<HTML

                                                
                        <div class="col-4">
                            <div class="card mb-4 pod">
                                <div class="card-body text-center">
                                    <a href="../pet/details.php?id={$POD_Id}">
                                        <img src="{$image}" id="details-img" class='img-fluid shadow' alt="Pet image">
                                    </a>
                                    <h5 class="my-3">$name</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card mb-4 pod">
                                <div class="card-header">
                                    Pet details
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Pet Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$name</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Description</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$description</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Breed</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$breed</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Age</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$age year</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Size</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$size</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Vaccinated</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$vaccinated</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Adoption status</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$status</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Agency</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">$agencyName</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                HTML;
        }
    } else {
        $layout = "No results";
    }
    return $layout;
}
