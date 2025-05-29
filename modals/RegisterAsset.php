<?php
include '../Includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $BranchId = $_POST['BranchId'];
    $AssetName = $_POST['AssetName'];
    $AssetTypeId = $_POST['AssetTypeId'];
    $SerialNumber = $_POST['SerialNumber'];
    $PropertyNumber = $_POST['PropertyNumber'];
    $PurchasedDate = $_POST['PurchasedDate'];
    $AssetStatus = $_POST['AssetStatus'];
    $Acquisition = $_POST['Acquisition'];
    $Description = $_POST['Description'];

    $sql = "INSERT INTO t_asset (
                BranchId, AssetName, AssetTypeId, SerialNumber,
                PropertyNumber, PurchasedDate, AssetStatus,
                Acquisition, Description
            ) VALUES (
                :BranchId, :AssetName, :AssetTypeId, :SerialNumber,
                :PropertyNumber, :PurchasedDate, :AssetStatus,
                :Acquisition, :Description
            )";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':BranchId', $BranchId);
    $stmt->bindParam(':AssetName', $AssetName);
    $stmt->bindParam(':AssetTypeId', $AssetTypeId);
    $stmt->bindParam(':SerialNumber', $SerialNumber);
    $stmt->bindParam(':PropertyNumber', $PropertyNumber);
    $stmt->bindParam(':PurchasedDate', $PurchasedDate);
    $stmt->bindParam(':AssetStatus', $AssetStatus);
    $stmt->bindParam(':Acquisition', $Acquisition);
    $stmt->bindParam(':Description', $Description);

    if ($stmt->execute()) {
        header("Location: ../admin/adminAssetMgmt.php?success=1");
        exit();
    } else {
        echo "Error: Unable to register asset.<br>";
        print_r($stmt->errorInfo());
    }
    
}
?>

<link rel="stylesheet" href="../asset/css/modals.css">

<!--Register Asset -->
<div class="modal fade" id="registerAssetModal" tabindex="-1" aria-labelledby="registerAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="../modals/RegisterAsset.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerAssetModalLabel">Register an Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="BranchId" class="form-label">Branch</label>
                            <select name="BranchId" id="BranchId" class="form-control rounded-pill" required>
                                <option value="" default></option>
                                <?php
                                    include '../Includes/config.php';
                                    $stmt = $conn->query("SELECT BranchId, BranchName FROM t_branch");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row['BranchId'] . '">' . $row['BranchName'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="AssetName" class="form-label">Asset Name</label>
                            <input type="text" name="AssetName" id="AssetName" class="form-control rounded-pill" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="AssetTypeId" class="form-label">Asset Type</label>
                            <select name="AssetTypeId" id="AssetTypeId" class="form-select rounded-pill" required>
                                <option value="" default></option>
                                <?php 
                                    $stmt = $conn->query("SELECT AssetTypeId, AssetTypeName FROM t_assettype");
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row['AssetTypeId'] . '">' . $row['AssetTypeName'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <label for="SerialNumber" class="form-label">Serial Number</label>
                            <input type="text" name="SerialNumber" id="SerialNumber" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-4">
                            <label for="PropertyNumber" class="form-label">Property Number</label>
                            <input type="text" name="PropertyNumber" id="PropertyNumber" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-4">
                            <label for="PurchasedDate" class="form-label">Purchased Date</label>
                            <input type="date" name="PurchasedDate" id="PurchasedDate" class="form-control rounded-pill" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea name="Description" id="Description" class="form-control" rows="3" placeholder="Describe the specifications (RAM, ROM, Processor, OS, etc...)"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Register Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>
