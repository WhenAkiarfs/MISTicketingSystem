<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Font Awesome CDN Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Confirm Update for Account Modal -->
<div class="modal" id="updateConfirmAccModal" tabindex="-1" aria-labelledby="updateConfirmAccModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fa-solid fa-circle-question md-icon"></i>
                <h1>Confirm Update</h1>
                <h3>Are you sure you want to update the information?</h3>
                <p class="p-warning mt-4">Once updated, the account information will be changed.</p>

                <div class="modal-footer">
                <div class="d-flex justify-content-around">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Confirm</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Update for Asset Modal -->
<div class="modal" id="updateConfirmAssetModal" tabindex="-1" aria-labelledby="updateConfirmAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <i class="fa-solid fa-circle-question md-icon"></i>
                <h1>Confirm Update</h1>
                <h3>Are you sure you want to update the information?</h3>
                <p class="p-warning mt-4">Once updated, the asset information will be changed.</p>

                <div class="modal-footer">
                <div class="d-flex justify-content-around">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Confirm</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete for Account Modal -->
<div class="modal fade" id="deleteConfirmAccModal" tabindex="-1" aria-labelledby="deleteConfirmAccLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<form action="deleteAccount.php" method="POST" class="modal-content md-cont p-3">
    <div class="modal-body text-center">
    <i class="fa-solid fa-trash md-icon"></i>
    <h2 class="modal-title">Confirm Deletion</h2>
    <p>Are you sure you want to delete this account?</p>
    <input type="hidden" name="deleteUserId" id="deleteUserId">
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary">Confirm</button>
    </div>
</form>
</div>
</div>

<!-- Confirm Delete for Asset Modal -->
<div class="modal fade" id="deleteConfirmAssetModal" tabindex="-1" aria-labelledby="deleteConfirmAssetModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<form action="deleteAsset.php" method="POST" class="modal-content md-cont p-3">
    <div class="modal-body text-center">
    <i class="fa-solid fa-trash md-icon"></i>
    <h2 class="modal-title">Confirm Deletion</h2>
    <p>Are you sure you want to delete this asset?</p>
    <input type="hidden" name="deleteAssetId" id="deleteAssetId">
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary">Confirm</button>
    </div>
</form>
</div>
</div>