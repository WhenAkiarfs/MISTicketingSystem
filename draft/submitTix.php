<?php
require_once '../Includes/config.php';
session_start();

$loggedInEmployeeId = $_SESSION['UserId'] ?? null;
if (!$loggedInEmployeeId) exit('User not logged in');

if (!isset($_SESSION['previous_page']) && isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
}

$stmt = $conn->prepare("SELECT ue.EmployeeId, u.UserId, CONCAT(u.FirstName, ' ', u.LastName) AS FullName, u.Email, u.ContactNo, u.DistrictId, u.BranchId, d.DistrictName, b.BranchName FROM t_users u INNER JOIN t_useremp ue ON u.UserId = ue.UserId LEFT JOIN t_district d ON u.DistrictId = d.DistrictId LEFT JOIN t_branch b ON u.BranchId = b.BranchId WHERE u.UserId = ?");
$stmt->execute([$loggedInEmployeeId]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

$issues = $conn->query("SELECT * FROM t_issuedtype")->fetchAll(PDO::FETCH_ASSOC);
$subtypes = $conn->query("SELECT SubtypeId, SubtypeName, IssueId FROM t_issuedsubtype ORDER BY IssueId, SubtypeName")->fetchAll(PDO::FETCH_ASSOC);
$assets = $conn->query("SELECT * FROM t_asset")->fetchAll(PDO::FETCH_ASSOC);

$groupedSubtypes = [];
foreach ($subtypes as $sub) {
    $groupedSubtypes[$sub['IssueId']][] = $sub;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QCPL STS - Submit Support Ticket</title>
    <link rel="icon" type="image/x-icon" href="../asset/img/qcpl-sts-logo.png">
    <link rel="stylesheet" href="../asset/css/submitTix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        const issueTypeData = <?= json_encode($issues) ?>;
        const assetData = <?= json_encode($assets) ?>;
        const subIssueData = <?= json_encode(array_reduce($subtypes, function ($carry, $item) {
            $carry[$item['IssueId']][] = ['id' => $item['SubtypeId'], 'name' => $item['SubtypeName']];
            return $carry;
        }, [])) ?>;
    </script>
</head>
<body>
<?php if (!empty($_SESSION['ticket_success'])): ?>
    <div class="alert alert-success position-fixed top-0 start-50 translate-middle-x mt-5 shadow-lg" style="z-index: 1055;">
        <?= htmlspecialchars($_SESSION['ticket_success']) ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(() => {
                document.querySelector('.alert')?.remove();
            }, 3000);
            setTimeout(() => {
                window.location.href = <?= json_encode($_SESSION['previous_page'] ?? 'dashboard.php') ?>;
            }, 3200);
        });
    </script>
    <?php unset($_SESSION['ticket_success'], $_SESSION['previous_page']); ?>
<?php endif; ?>

<div class="container">
    <div class="header">
        <h1>Submit Support Ticket</h1>
        <p>Report issues and get technical support</p>
    </div>
    <div class="form-container">
        <form id="ticketForm" method="POST" action="../employee/create_ticket.php">
            <input type="hidden" name="EmployeeId" value="<?= $employee['EmployeeId'] ?>">
            <input type="hidden" name="BranchId" value="<?= $employee['BranchId'] ?>">
            <input type="hidden" name="DistrictId" value="<?= $employee['DistrictId'] ?>">

            <div class="issues-section">
                <div class="issues-header">
                    <h3>Report Issues</h3>
                    <div class="issues-controls">
                        <span id="issueCounter" class="issue-counter">1 Issue</span>
                        <button type="button" id="addIssueBtn" class="add-issue-btn">
                            <span>+</span> Add Issue
                        </button>
                    </div>
                </div>
                <div class="progress-indicator">
                    <div class="progress-bar" id="progressBar" style="width: 100%"></div>
                </div>
                <div class="mobile-nav">
                    <select id="mobileIssueSelect">
                        <option value="0">Issue #1</option>
                    </select>
                </div>
                <div class="issue-tabs" id="issueTabs">
                    <div class="issue-tab active" data-issue="0">
                        Issue #1
                        <button type="button" class="tab-close" style="display: none;"><i class="fa-solid fa-times"></i></button>
                    </div>
                </div>
                <div id="tabContents">
                    <div class="tab-content active" id="issue-0">
                        <div class="form-row-single">
                            <div class="form-group">
                                <label for="asset_0">Asset Selection</label>
                                <select name="issues[0][asset_id]" id="asset_0" class="form-control asset-select" required>
                                    <option value="">Select Asset</option>
                                    <?php foreach ($assets as $a): ?>
                                        <option value="<?= $a['AssetId'] ?>"><?= htmlspecialchars($a['AssetName']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="issue_type_0">Issue Type</label>
                                <select name="issues[0][issue_type_id]" id="issue_type_0" class="form-control issue-type-select" required>
                                    <option value="">Select Issue Type</option>
                                    <?php foreach ($issues as $issue): ?>
                                        <option value="<?= $issue['IssueId'] ?>"><?= htmlspecialchars($issue['IssueType']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_issue_0">Sub-Issue Type</label>
                                <select name="issues[0][sub_issue_id]" id="sub_issue_0" class="form-control sub-issue-select" required>
                                    <option value="">Select Sub-Issue</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row-single">
                            <div class="form-group">
                                <label for="description_0">Issue Description</label>
                                <textarea name="issues[0][description]" id="description_0" class="form-control" placeholder="Describe the issue..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="submit-btn">Submit Ticket</button>
        </form>
    </div>
</div>

<script src="../asset/js/submitTicket.js"></script>
</body>
</html>