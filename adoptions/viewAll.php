<?php

function calculateAge($birthdate)
{
    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $ageInterval = $currentDate->diff($birthDate);
    return $ageInterval->y;
}

function viewAdoptions($result)
{
    $crudUser = new CRUD_USER();
    $crudPet = new CRUD_PET();
    $list = "";

    if (!empty($result)) {

        foreach ($result as $row) {

            if ($row["fk_adoptee_id"] != Null) {
                $getUser = $crudUser->selectUsers("id = {$row["fk_adoptee_id"]}");
                $adoptee = $getUser[0]["firstName"] . ' ' . $getUser[0]["lastName"];
            } else {
                $adoptee = '';
            }

            $petId = $row["petId"];
            $getPet = $crudPet->selectPets("id = $petId");
            $pet = $getPet[0];
            $userExperience = $row["userExperience"];
            $petExperience = $row["petExperience"];
            $petName = $row["pname"];
            $petSpace = $row["petSpace"];
            $userSpace = $row["userSpace"];
            $petSpecies = $row["species"];
            $status = $row['adopStatus'];
            $adopId = $row["adoptId"];
            $birthDate = $row["birthDate"];
            $userAge = calculateAge($birthDate);

            $btnattr = "hidden";

            $NoRequirements  = 0;


            if ($userAge > 18) {
                $NoRequirements++;
            }
            if ($userExperience == $petExperience || $userExperience == 1) {
                $NoRequirements++;
            }
            if ($userSpace >= $petSpace) {
                $NoRequirements++;
            }


            if ($status == 'Apply') {
                $application = 'Pending';
                $url = "../adoptions/edit.php?id={adoptId}";
                $btnattr = "";
            } elseif ($status == 'Approved') {
                $application = 'Approved';
            } elseif ($status == 'Declined') {
                $application = 'Rejected';
            } else {
                $application = 'Cancelled';
            }


            $list .= <<<HTML
                <tr>
                    <td> $adopId </td>
                    <td> $petId </td>
                    <td> {$petName} </td>
                    <td> {$petSpecies} </td>
                    <td> $application </td>
                    <td> {$adoptee} </td>
                    <td> {$row['submitionDate']} </td>
                    <td> € {$row['donation']} </td>
                HTML;

            if (isset($_SESSION['Agency'])) {
                $list .= <<<HTML
                            <td class="thReq" scope="col"> $NoRequirements </th>
                        HTML;
            }

            $list .= <<<HTML
                    <td>
                    <p class="d-inline-flex gap-1">
                HTML;

            if (isset($_SESSION['User'])) {
                $list .= "
                    <a href='../adoptions/view.php?id={$adopId}' class='btn btn-warning'>Details</a>";
            };

            if (isset($_SESSION['Agency']) || isset($_SESSION['Adm'])) {
                $list .= "    
                        <a href='../adoptions/viewAdoptions.php?id={$adopId}' class='btn btn-warning'>Details</a>";
            }

            if (isset($_SESSION['Agency']) && $status == "Apply") {
                $list .= "
                    <a href='../adoptions/edit.php?id={$adopId}&status=Approved&pid={$petId}' class='btn btn-success ' aria-disabled='true'>Approve</a>
                    <a href='../adoptions/edit.php?id={$adopId}&status=Declined&pid={$petId}' class='btn btn-primary ' aria-disabled='true'>Reject</a>";
            } elseif (isset($_SESSION['User'])) {
                $list .= "<a href='../adoptions/edit.php?id={$adopId}&status=Cancelled&pid={$petId}' class='btn btn-primary' $btnattr>Cancel</a>";
            }
            $list .= "</p>
            </td>
        </tr>";
        }
    } else {
        $list .= "<tr><td colspan='10'>No records found</td></tr>";
    }
    return $list;
}
