document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.view-ticket-row');

    rows.forEach(row => {
        row.addEventListener('click', () => {
            const status = row.getAttribute('data-status')?.toLowerCase();
            const issueType = row.getAttribute('data-issue-type')?.toLowerCase();

            // --- Ticket Status Button ---
            const statusBtn = document.getElementById('view-ticket-status');
            const statusText = document.getElementById('view-ticket-status-text');
            statusBtn.className = 'btn btn-status'; // Reset classes

            let statusLabel = '';
            switch (status) {
                default: 'pending'
                    statusBtn.classList.add('btn-pending');
                    statusLabel = 'Pending';
                case 'ongoing':
                    statusBtn.classList.add('btn-ongoing');
                    statusLabel = 'Ongoing';
                    break;
                case 'completed':
                    statusBtn.classList.add('btn-completed');
                    statusLabel = 'Completed';
                    break;
                case 'cancelled':
                    statusBtn.classList.add('btn-cancelled');
                    statusLabel = 'Cancelled';
                    break;
            }
            statusText.textContent = statusLabel;

            // -- Transfer Status Button ---
            const transferStatusBtn = document.getElementById('view-ticket-transfer-status');
            const transferStatusText = document.getElementById('view-ticket-transfer-status-text');
            transferStatusBtn.className = 'btn btn-transfer-status'; // Reset classes

            let transferStatusLabel = '';
            transferStatusBtn.classList.add();
            switch (status) {
                default: 'pending'
                    transferStatusBtn.classList.add('btn-pending');
                    transferStatusLabel = 'Pending';
                case 'approved':
                    transferStatusBtn.classList.add('btn-approved');
                    transferStatusLabel = 'Approved';
                    break;
                case 'rejected':
                    transferStatusBtn.classList.add('btn-rejected');
                    transferStatusLabel = 'Rejected';
                    break;
                case 'completed':
                    transferStatusBtn.classList.add('btn-completed');
                    transferStatusLabel = 'Completed';
                    break;
            }
            transferStatusText.textContent = transferStatusLabel;

            // --- Issue Type Button ---
            const typeBtn = document.getElementById('view-ticket-type');
            const typeText = document.getElementById('view-ticket-type-text');
            typeBtn.className = 'btn btn-type'; // Reset classes

            let typeLabel = '';
            switch (issueType) {
                case 'software':
                    typeBtn.classList.add('btn-software');
                    typeLabel = 'Software';
                    break;
                case 'hardware':
                    typeBtn.classList.add('btn-hardware');
                    typeLabel = 'Hardware';
                    break;
                default:
                    typeBtn.classList.add('btn-secondary');
                    typeLabel = 'Unknown';
            }
            typeText.textContent = typeLabel;
        });
    });
});
