<?php

function renderFormAgency($agency, $address, $phone, $email, $btnName)
{
   
    $emailPass =  ($btnName === 'Update account') ? 'hidden' : '';

    $form = <<<HTML
    <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="agency" class="form-label">Agency name<span class='required'>*</span></label>
                            <input type="text" class="form-control" id="agency" name="agency" placeholder="Agency" value="{$agency}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address <span class='required'>*</span></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{$address}">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number </label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{$phone}">
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
