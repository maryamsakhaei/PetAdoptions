<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Pending
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pet ID</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Species</th>
                            <th scope="col">Status</th>
                            <th scope="col">Adopted by</th>
                            <th scope="col">Submission Date</th>
                            <th scope="col">Donation</th>
                            <?php if (isset($_SESSION['Agency'])) { ?>
                                <th scope="col">Nr Requirements</th>
                            <?php } ?>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $pending ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Approved
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <div class="table-responsive">

                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pet ID</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Species</th>
                            <th scope="col">Status</th>
                            <th scope="col">Adopted by</th>
                            <th scope="col">Submission Date</th>
                            <th scope="col">Donation</th>
                            <?php if (isset($_SESSION['Agency'])) { ?>
                                <th scope="col">Nr Requirements</th>
                            <?php } ?>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $accepted ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Rejected
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <div class="table-responsive">

                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pet ID</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Species</th>
                            <th scope="col">Status</th>
                            <th scope="col">Adopted by</th>
                            <th scope="col">Submission Date</th>
                            <th scope="col">Donation</th>
                            <?php if (isset($_SESSION['Agency'])) { ?>
                                <th scope="col">Nr Requirements</th>
                            <?php } ?>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $rejected ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Cancelled
            </button>
        </h2>    
        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <div class="table-responsive">

                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pet ID</th>
                            <th scope="col">Pet Name</th>
                            <th scope="col">Species</th>
                            <th scope="col">Status</th>
                            <th scope="col">Adopted by</th>
                            <th scope="col">Submission Date</th>
                            <th scope="col">Donation</th>
                            <?php if (isset($_SESSION['Agency'])) { ?>
                                <th scope="col">Nr Requirements</th>
                            <?php } ?>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $cancelled ?>
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
</div>