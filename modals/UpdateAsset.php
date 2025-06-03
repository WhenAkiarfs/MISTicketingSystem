<?php
include '../Includes/config.php';

if (isset($_SESSION['success_message'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']); // Remove the message after displaying
}

// Asset table
$sql = "SELECT * FROM t_asset 
        JOIN t_branch ON t_asset.BranchId = t_branch.BranchId;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Update Asset
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateAssetId'])) {
    $id = $_POST['updateAssetId'];

$sql = "SELECT * FROM t_asset WHERE AssetId = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$assets = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $AssetId = $_POST['AssetId'];
    $BranchId = $_POST['BranchId'];
    $AssetName = $_POST['AssetName'];
    $AssetTypeId = $_POST['AssetTypeId'];
    $SerialNumber = $_POST['SerialNumber'];
    $PropertyNumber = $_POST['PropertyNumber'];
    $PurchasedDate = $_POST['PurchasedDate'];
    $AssetStatus = $_POST['AssetStatus'];
    $Acquisition = $_POST['Acquisition'];
    $Description = $_POST['Description'];

    $sql = "UPDATE t_asset SET 
                BranchId = :BranchId, 
                AssetName = :AssetName, 
                AssetTypeId = :AssetTypeId, 
                SerialNumber = :SerialNumber, 
                PropertyNumber = :PropertyNumber, 
                PurchasedDate = :PurchasedDate, 
                AssetStatus = :AssetStatus, 
                Acquisition = :Acquisition, 
                Description = :Description 
            WHERE AssetId = :AssetId";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'AssetId' => $AssetId,
        'BranchId' => $BranchId,
        'AssetName' => $AssetName,
        'AssetTypeId' => $AssetTypeId,
        'SerialNumber' => $SerialNumber,
        'PropertyNumber' => $PropertyNumber,
        'PurchasedDate' => $PurchasedDate,
        'AssetStatus' => $AssetStatus,
        'Acquisition' => $Acquisition,
        'Description' => $Description
    ]);

    $_SESSION['update_success'] = true;
    header("Location: ../admin/adminAssetMgmt.php ");
    exit();
}
?>

<link rel="stylesheet" href="../asset/css/modals.css">

<!-- Update Asset -->
<div class="modal fade" id="updateAssetModal" tabindex="-1" aria-labelledby="updateAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAssetModalLabel">Update Asset Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="AssetId" class="form-label">Asset ID</label>
                            <input type="text" name="AssetId" id="AssetId" class="form-control rounded-pill" read-only>
                        </div>
                        <div class="col-md-6">
                        <label for="BranchId" class="form-label">Branch</label>
                        <input type="text" name="BranchId" id="BranchId" class="form-control rounded-pill" read-only>
                        </input>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="assetName" class="form-label">Asset Name</label>
                            <input type="text" name="AssetName" id="assetName" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-6">
                            <label for="AssetTypeId" class="form-label">Asset Type</label>
                            <select name="AssetTypeId" id="AssetTypeId" class="form-control rounded-pill" required>
                                <option value="">------ Select Asset Type -----</option>
                                <?php 
                                    $stmt = $conn->query("SELECT AssetTypeId, AssetTypeName FROM t_assettype");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row['AssetTypeId'] . '">' . $row['AssetTypeName'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="SerialNumber" class="form-label">Serial Number</label>
                            <input type="text" name="SerialNumber" id="SerialNumber" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-4">
                            <label for="PropertyNumber" class="form-label">Property Number</label>
                            <input type="text" name="PropertyNumber" id="PropertyNumber" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-4">
                            <label for="Acquisition" class="form-label">Acquisition</label>
                            <select name="Acquisition" id="Acquisition" class="form-select rounded-pill" required>
                                <option value="" default></option>
                                <option value="Donation">Donation</option>
                                <option value="QCG">QCG</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="AssetStatus" class="form-label">Status</label>
                            <select name="AssetStatus" id="AssetStatus" class="form-select rounded-pill" required>
                                <option value="" default></option>
                                <option value="available">Available</option>
                                <option value="in use">In Use</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="disposed">Disposed</option>
                                <option value="transferred">Transferred</option>
                                <option value="transfer request">Transfer Request</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="PurchasedDate" class="form-label">Purchased Date</label>
                            <input type="date" name="PurchasedDate" id="PurchasedDate" class="form-control rounded-pill" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea name="Description" id="Description" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
