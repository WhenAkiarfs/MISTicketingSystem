<!-- External CSS Link -->
<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Font Awesome CDN Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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