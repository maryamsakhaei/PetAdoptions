<?php

function renderForm($firstname, $lastname, $address, $phone, $exp, $birthdate, $space, $email, $btnName)
{
    $e1 = ($exp === 'Dog') ? 'selected' : '';
    $e2 = ($exp === 'Cat') ? 'selected' : '';

    $emailPass =  ($btnName === 'Update account') ? 'hidden' : '';

    $form = <<<HTML
    <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First name <span class='required'>*</span></label>
                            <input type="text" class="form-control" id="fname" name="firstname" placeholder="First name" value="{$firstname}">
                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="form-label">Last name <span class='required'>*</span></label>
                            <input type="text" class="form-control" id="lname" name="lastname" placeholder="Last name" value="{$lastname}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address <span class='required'>*</span></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{$address}">
                        </div>
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Phone Number </label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{$phone}">
                        </div>
                        <div class="col-md-2">
                            <label for="date" class="form-label">Date of birth <span class='required'>*</span></label>
                            <input type="date" class="form-control" id="date" name="birthdate" value="{$birthdate}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="space" class="form-label">Apartment size in m&sup2</label>
                            <input type="number" class="form-control" placeholder="Space" value="{$space}">
                        </div>
                        <div class="col-md-6">
                            <label for="experienced" class="form-label">Do you have experience with the Pets? <span class='required'>*</span></label>
                            <select class="form-select" name="experienced" id="experienced">
                                <option name="experienced" value="Yes" $e1>Yes</option>
                                <option name="experienced" value="No" $e2>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="picture" class="form-label">Profile picture </label>
                        <input type="file" class="form-control" id="picture" name="picture">
                    </div>
                    <div class="row" $emailPass id = "emailPass">
                        <div class="col-md-8">
                            <label for="email" class="form-label">Email address <span class='required'>*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="{$email}">
                            <span class="text-danger" id="emailError"></span>
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label">Password <span class='required'>*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <br>
                    <p>(<span class='required'>*</span>) Required fields</p>
                    <span id="error" class="text-danger" display='block;'></span>
                    <div class="gap-2 d-md-flex justify-content-center">
                        <button id ="createAcc" name="sign-up" type="submit" class="btn btn-primary">$btnName</button>
                    </div>
                </div>
    HTML;
    return $form;
}
