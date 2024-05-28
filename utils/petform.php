<?php

function renderForm($name, $species, $minSpace, $experience, $status, $vaccine, $breed, $age, $size, $location, $description, $behavior, $postBtn)
{
    $sp1 = ($species === 'Dog') ? 'selected' : '';
    $sp2 = ($species === 'Cat') ? 'selected' : '';
    $sp3 = ($species === 'Bird') ? 'selected' : '';
    $sp4 = ($species === 'Fish') ? 'selected' : '';

    $s0 = ($size === '') ? 'selected' : '';
    $s1 = ($size === 'Small') ? 'selected' : '';
    $s2 = ($size === 'Medium') ? 'selected' : '';
    $s3 = ($size === 'Large') ? 'selected' : '';

    $form = <<<HTML
            <div class="card-body">
                <div class="required-fields">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name <span class='required'>*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{$name}">
                        </div>
                        <div class="col-md-4">
                            <label for="species" class="form-label">Species <span class='required'>*</span></label>
                            <select class="form-control" id="species" name="species">
                            <option value="">Select</option>
                            <option value="Dog" $sp1>Dog</option>
                            <option value="Cat" $sp2>Cat</option>
                            <option value="Bird" $sp3>Bird</option>
                            <option value="Fish" $sp4>Fish</option>
                        </select>
                        </div>
                        <div class="col-md-2">
                            <label for="space" class="form-label">Space needed <span class='required'>*</span></label>
                            <input type="number" class="form-control" id="space" name="minSpace" placeholder="Space" min="0" value="{$minSpace}">
                        </div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="exp" name="experience" $experience>
                            <label class="form-label form-check-label" for="experience">Experience with pets needed? <span class='required'>*</span></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" $status>
                            <label class="form-label form-check-label" for="status">Is the pet available for adoption? <span class='required'>*</span></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="vaccine" name="vaccine" $vaccine>
                            <label class="form-label form-check-label" for="vaccine">Is the pet vaccinated? <span class='required'>*</span></label>
                        </div>
                    </div>
                    <p>(<span class='required'>*</span>) Required fields</p>
                    <span id="error" class="text-danger" display='block;'></span>
                </div>
                <div class="optional-fields" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="breed" class="form-label">Breed </label>
                            <input type="text" class="form-control" id="breed" name="breed" placeholder="Breed" value="{$breed}">
                        </div>
                        <div class="col-md-4">
                            <label for="size" class="form-label">Size</label>
                            <select class="form-control" id="size" name="size">
                                <option value="" $s0>Select</option>
                                <option value="Small" $s1>Small</option>
                                <option value="Medium" $s2>Medium</option>
                                <option value="Large" $s3>Large</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="age" class="form-label">Age </label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age" min="0" value="{$age}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="{$location}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="desc" class="form-label">Description </label>
                            <textarea class="form-control" id="desc" name="desc" rows="4" cols="50" placeholder="Give a pet description">$description</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="behavior" class="form-label">Behavior </label>
                            <textarea class="form-control" id="behavior" name="behavior" rows="4" cols="50" placeholder="Give a pet behavior">$behavior</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image </label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <br>
                <div class="gap-2 d-md-flex justify-content-center">
                    <a href="../admin/dashboard.php" class="btn btn-warning">Back to dashboard</a>
                    <button id="nextbtn" type="button" class="btn btn-primary">Next</button>
                    <button id="backbtn" type="button" class="btn btn-primary" hidden>Back</button>
                    <button id="createbtn" name="create" type="submit" class="btn btn-primary" hidden>$postBtn</button>
                </div>
            </div>
    HTML;
    return $form;
}
