<script>
  var pageTitle = "Asset Management";
</script>

<?php
include '../Includes/config.php';

// Fetch the assets with branch name
$sql = "SELECT * FROM t_asset 
        JOIN t_branch 
        ON t_asset.BranchId = t_branch.BranchId;";

$stmt = $conn->prepare($sql);
$stmt->execute();
$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QCPL STS - Asset Management</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">

    <!-- External CSS Link/s -->
    <link rel ="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/div_mods.css">
    <link rel="stylesheet" href="../asset/css/navtabs.css">
    <link rel="stylesheet" href="../asset/css/tbl_charts.css">
    <link rel="stylesheet" href="../asset/css/tbl-controls.css">
    <link rel="stylesheet" href="../asset/css/buttons.css">    
    <link rel ="stylesheet" href="../asset/css/pagination.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- External JS Link/s -->
    <script src="../asset/js/sidebar.js"></script>
</head>

<body>
    <div class="layout-container d-flex">
        <!-- Sidebar and Header -->
        <?php include '../admin/inc/sidebar.php'; ?>

        <!-- Wrapper for Header + Main -->
        <div class="main-wrapper w-100" style="margin-left: 80px; margin-top: 30px;">
        <!-- Main Content -->
        <main class="px-4 py-5">
        <div class="col-12">
            <div class="container-fluid assetmgmt-nav">
            <div class="d-flex flex-wrap align-items-center justify-content-between mt-2">
            <!-- Left: Asset Management -->
            <!-- Tabs Section -->
            <div class="d-flex flex-wrap gap-2">
                <div class="div-mods inactive" onclick="window.location.href='empAssetMgmt.php'">
                    <span class="mods">All Assets</span>
                </div>
                <div class="div-mods active" onclick="window.location.href='empTransferRequestsList.php'">
                    <span class="mods">Transfer Requests</span>
                </div>
                <div class="div-mods action" data-bs-toggle="modal" data-bs-target="#transferAssetModal">
                    <span class="mods">Transfer an Asset</span>
                </div>
            </div>

            <!-- Right: Table Controls -->
            <div class="d-flex flex-wrap align-items-center gap-3" style="flex: 1 1 auto; justify-content: flex-end;">
            <!-- Search Bar -->
            <div class="input-group" style="max-width: 300px;">
            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-icon">
            <span class="input-group-text control-btn" id="search-icon">
                <i class="fa fa-search"></i>
            </span>
            </div>

            <!-- Date Button -->
            <button class="btn btn-outline-secondary control-btn" type="button">
                <i class="fa fa-calendar me-1"></i> Select Date
            </button>
            
            <!-- Filter Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                <i class="fa fa-filter me-1"></i>
                </button>
                <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                    <li><a class="dropdown-item py-2 px-3" href="#"><i class="fa-solid fa-copyright me-2"></i>Brand</a></li>
                    <li><a class="dropdown-item py-2 px-3" href="#"><i class="fa-solid fa-toolbox me-2"></i>Type of Issue</a></li>
                </ul>
            </div>
            
            <!-- Sort Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle control-btn" type="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-sort"></i>
                </button>
                <ul class="dropdown-menu shadow-sm p-2 rounded-3 border-0">
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-sort-alpha-up me-2"></i>Ascending</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-sort-alpha-down me-2"></i>Descending</a></li>
                </ul>
            </div>
            </div>
        </div>
        </div>

        <!-- Table for displaying assets -->
            <div class="row no-gutters mt-4">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 2.5%;">Asset ID</th>
                                    <th style="width: 3%;">Brand</th>
                                    <th style="width: 3%;">Serial Number</th>
                                    <th style="width: 3%;">Property Number</th>
                                    <th style="width: 3%;">Acquisition</th>
                                    <th style="width: 2%;">Purchased Date</th>
                                    <th style="width: 2%;">Status</th>
                                    <th style="width: 2%;">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($assets)): ?>
                                    <tr>
                                    <td colspan="8">No assets found.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($assets as $asset): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($asset['AssetId']); ?></td>
                                            <td><?php echo htmlspecialchars($asset['AssetName']); ?></td>
                                            <td><?php echo htmlspecialchars($asset['SerialNumber']); ?></td>
                                            <td><?php echo htmlspecialchars($asset['PropertyNumber']); ?></td>
                                            <td><?php echo htmlspecialchars($asset['Acquisition']); ?></td>
                                            <td><?php echo htmlspecialchars($asset['PurchasedDate']); ?></td>
                                            <td><?php echo htmlspecialchars($asset['AssetStatus']); ?></td>
                                            <td><?php echo htmlspecialchars($asset['Description']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        </div>
    </div>
    <?php include '../modals/TransferAsset.php'; ?>
</body>
</html>