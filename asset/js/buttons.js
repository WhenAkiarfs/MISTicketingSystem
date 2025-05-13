document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.view-ticket-row');

    rows.forEach(row => {
        row.addEventListener('click', () => {
            const status = row.getAttribute('data-status')?.toLowerCase();
            const issueType = row.getAttribute('data-issue-type')?.toLowerCase();

            // --- Status Button ---
            const statusBtn = document.getElementById('view-ticket-status');
            const statusText = document.getElementById('view-ticket-status-text');
            statusBtn.className = 'btn btn-status'; // Reset classes

            let statusLabel = '';
            switch (status) {
                case 'pending':
                    statusBtn.classList.add('btn-pending');
                    statusLabel = 'Pending';
                    break;
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
                default:
                    statusBtn.classList.add('btn-secondary');
                    statusLabel = 'Unknown';
            }
            statusText.textContent = statusLabel;

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
