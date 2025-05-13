<?php
include '../Includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $BranchId = $_POST['BranchId'];
    $AssetName = $_POST['AssetName'];
    $AssetTypeId = $_POST['AssetTypeId'];
    $SerialNumber = $_POST['SerialNumber'];
    $PurchasedDate = $_POST['PurchasedDate'];
    $AssetStatus = $_POST['AssetStatus'];
    $Description = $_POST['Description'];

    // Prepare the SQL query using PDO
    $sql = "INSERT INTO t_asset (BranchId, AssetName, AssetTypeId, SerialNumber, PurchasedDate, AssetStatus, Description)
            VALUES (:BranchId, :AssetName, :AssetTypeId, :SerialNumber, :PurchasedDate, :AssetStatus, :Description)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters to the SQL query
    $stmt->bindParam(':BranchId', $BranchId);
    $stmt->bindParam(':AssetName', $AssetName);
    $stmt->bindParam(':AssetTypeId', $AssetTypeId);
    $stmt->bindParam(':SerialNumber', $SerialNumber);
    $stmt->bindParam(':PurchasedDate', $PurchasedDate);
    $stmt->bindParam(':AssetStatus', $AssetStatus);
    $stmt->bindParam(':Description', $Description);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "New asset registered successfully!";
    } else {
        echo "Error: Unable to register asset.";
    }
}
?>

<!-- External CSS Link/s -->
<link rel="stylesheet" href="../asset/css/modals.css">
<link rel="stylesheet" href="../asset/css/buttons.css">

<!-- External JS Link/s -->
<script src="../asset/js/buttons.js"></script>


<!-- Transfer Asset Modal -->
    <div class="modal fade" id="transferAssetModal" tabindex="-1" aria-labelledby="transferAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <form action="#" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="transferAssetModalLabel">Request to Transfer an Asset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="branchId" class="form-label">Branch</label>
                    <select name="branch_ID" id="BranchiD" class="form-control rounded-pill" required>
                        <option value="">----- Select Branch -----</option>
                        <?php
                            // Query only from t_branch
                            $stmt = $conn->query("SELECT BranchId, BranchName FROM t_branch");

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['BranchId'] . '">' . $row['BranchName'] . '</option>';
                            }
                            ?>
                    </select> 
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="assetName" class="form-label">Asset Name</label>
                        <input type="text" name="AssetName" id="assetName" class="form-control rounded-pill" required>
                    </div>
                    <div class="col-md-6">
                        <label for="assetType" class="form-label">Asset Type ID</label>
                        <input type="text" name="AssetTypeId" id="assetTypeId" class="form-control rounded-pill" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                <div class="col-md-4">
                    <label for="serialNumber" class="form-label">Serial Number</label>
                    <input type="text" name="SerialNumber" id="serialNumber" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-4">
                    <label for="purchasedDate" class="form-label">Purchased Date</label>
                    <input type="date" name="PurchasedDate" id="purchasedDate" class="form-control rounded-pill" required>
                </div>
                <div class="col-md-4">
                    <label for="assetStatus" class="form-label">Status</label>
                    <select name="AssetStatus" id="assetStatus"  class="form-control rounded-pill" required>
                        <option value="" default>-- Select Status --</option>
                        <option value="available">Available</option>
                        <option value="in use">In Use</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="disposed">Disposed</option>
                        <option value="transferred">Transferred</option>
                    </select>
                </div>
                </div>

                <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="Description" id="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Transfer Asset</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        </div>
    </div>