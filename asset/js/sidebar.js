// Sidebar toggle
document.getElementById('sidebarCollapse')?.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('body')?.classList.toggle('collapsed');
});

// Sidebar highlighter
document.addEventListener('DOMContentLoaded', function () {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const currentPage = window.location.pathname.split('/').pop().split('?')[0]; // e.g., empticketMgmt.php

    // Map file names to sidebar anchors (match base menu pages only)
    const pageMap = {
        dashboard: ['admindashboard.php', 'ITdashboard.php', 'licDashboard.php', 'home.php'],
        tickets: ['adminTicketMgmt.php', 'adminCompletedTickets.php', 'adminArchivedTickets.php',
                    'ITticketMgmt.php', 'licTicketMgmt.php', 'licCompletedTickets.php', 
                    'licArchivedTickets.php', 'empTicketMgmt.php', 'empCompletedTickets.php',
                    'empArchivedTickets.php'],
        assets: ['adminAssetMgmt.php', 'adminTransferRequestsList.php',
                    'ITassetMgmt.php', 'ITtransferRequestsList.php', 'licAssetMgmt.php',
                    'licTransferRequestsList.php', 'empAssetMgmt.php'],
        staff: ['adminStaffMgmt.php'],
        branches: ['adminBranchMgmt.php', 'adminEmployeeList.php', 'ITbranchMgmt.php', 'ITEmployeeList.php'],
        employees: ['licEmployeeMgmt.php'], // for LIC
        activity: ['activityLogs.php']
    };

    let matched = false;

    sidebarItems.forEach(item => {
        const link = item.querySelector('a');
        if (!link) return;

        const href = link.getAttribute('href')?.split('/').pop();
        for (const [key, files] of Object.entries(pageMap)) {
            if (files.includes(currentPage) && href && files.includes(href)) {
                item.classList.add('active');
                matched = true;
                break;
            }
        }
    });

    // Fallback to default (dashboard)
    if (!matched) {
        sidebarItems.forEach(item => {
            if (item.classList.contains('default')) {
                item.classList.add('active');
            }
        });
    }

    document.documentElement.classList.remove('js-sidebar-initializing');
});

// Set page title
document.addEventListener("DOMContentLoaded", function () {
    const titleElement = document.getElementById('page-title');
    if (typeof pageTitle !== 'undefined' && titleElement) {
        titleElement.textContent = pageTitle;
    }
});