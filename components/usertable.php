<?php
function viewAdoptions($result)
{

    $crudPet = new CRUD_PET();
    $crudStory = new CRUD_STORY();
    $list = "";

    if (!empty($result)) {

        foreach ($result as $adoption) {

            $petId = $adoption["fk_pet_id"];
            $adoptId = $adoption["id"];
            $submission = $adoption['submitionDate'];
            $dateTime = new DateTime($submission);
            $submission = $dateTime->format("d/m/Y");
            $status = $adoption['adopStatus'];

            $getPet = $crudPet->selectPets("id = $petId");

            $petName = $getPet[0]["name"];
            $petSpecies = $getPet[0]["species"];

            $btnattr = "hidden";
            $btnattr2 = "hidden";

            $submitted = $adoption["submitionDate"];
            $today = date("Y-m-d");
            $diff = strtotime($today) - strtotime($submitted);
            $daysAgo = floor($diff / (60 * 60 * 24));
            $daytext = ($daysAgo == 1) ? 'day' : 'days';

            $story = $crudStory->selectStories("fk_pet_id = $petId");


            if ($status == 'Apply') {
                $application = 'Pending';
                $url = "../adoptions/edit.php?id={adoptId}";
                $btnattr = "";
            } elseif ($status == 'Approved') {
                $application = 'Approved';
                if (empty($story)) {
                    $btnattr2 = "";
                }
            } elseif ($status == 'Declined') {
                $application = 'Rejected';
            } else {
                $application = 'Cancelled';
            }


            $donation = ($adoption['donation']) ? "&euro; " . $adoption['donation'] : "-";

            $list .= <<<HTML
                            <tr>
                                <td> $petName </td>
                                <td> $petSpecies </td>
                                <td> $application </td>
                                <td> $submission <span class="cssFont_1"> ($daysAgo $daytext ago)</span> </td>
                                <td> $donation </td>
                                <td>
                                <p class="d-inline-flex align-items-center gap-1">
                                    <a href='../adoptions/view.php?id={$adoption["id"]}' class='btn btn-warning'>Details</a>
                                    <a href='../adoptions/edit.php?id={$adoptId}&status=Cancelled&pid={$petId}' class='btn btn-primary' $btnattr>Cancel</a>
                                    <a href='../stories/new.php?id={$petId}' class='btn btn-primary' $btnattr2>Add Story</a>
                            HTML;
            if (isset($_SESSION['Adm'])) {
                $list .= "<a href='edit.php?id={$petId}' class='btn btn-success disabled' aria-disabled='true'>Approve</a>
                                <a href='edit.php?id={$petId}' class='btn btn-primary disabled' aria-disabled='true'>Reject</a>";
            }
            $list .= "</p>
                    </td>
                    </tr>";
        }
    } else {
        $list .= "<tr><td colspan='9'>No records found</td></tr>";
    }
    return $list;
}
