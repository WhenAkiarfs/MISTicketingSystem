<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Account Profile Modal -->
<div class="modal fade" id="updateAccModal" tabindex="-1" aria-labelledby="updateAccModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="profileModalLabel">Profile Update</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="Firstname" class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" name="last_name" id="Lastname" class="form-control rounded-pill" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="emailAddress" class="form-label">Email</label>
                        <input type="text" name="email" id="Emailaddress" class="form-control rounded-pill" required>
                    </div>
                <div class="col-md-6">
                    <label for="contactNumber" class="form-label">Contact Number</label>
                    <input type="text" name="contactno" id="Contactnumber" class="form-control rounded-pill" required>
                </div>
                </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>