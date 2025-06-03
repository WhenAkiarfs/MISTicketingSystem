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
        echo "Request to transfer asset submitted.";
    } else {
        echo "Error: Unable to request to transfer asset.";
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <form action="#" method="POST">
            <div class="modal-header">
            <h5 class="modal-title" id="transferAssetModalLabel">Transfer an Asset</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="#" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="assetName" class="form-label">Asset</label>
                        <select name="AssetName" id="assetName" class="form-select rounded-pill" required>
                            <option value="" default></option>
                            <?php
                            // Query only from t_asset
                            $stmt = $conn->query("SELECT AssetId, AssetName FROM t_asset");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['AssetId'] . '">' . $row['AssetName'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                    <label for="branchId" class="form-label">Dispatching Branch</label>
                    <select name="branch_ID" id="BranchiD" class="form-control rounded-pill">
                        <option value="" default></option>
                        <?php
                        // Query only from t_branch
                        $stmt = $conn->query("SELECT BranchId, BranchName FROM t_branch");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['BranchId'] . '">' . $row['BranchName'] . '</option>';
                        }
                        ?>
                    </select> 
                    </div>
                    <div class="col-md-6">
                    <label for="branchId" class="form-label">Receiving Branch</label>
                    <select name="branch_ID" id="BranchiD" class="form-select rounded-pill" required>
                        <option value="" default></option>
                        <?php
                            // Query only from t_branch
                            $stmt = $conn->query("SELECT BranchId, BranchName FROM t_branch");

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['BranchId'] . '">' . $row['BranchName'] . '</option>';
                            }
                            ?>
                    </select>
                    </div>
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