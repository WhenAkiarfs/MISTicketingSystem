function paginateTableWithLimitSelector(tableId, paginationId, perPageSelectId, totalItemCountId) {
    const table = document.querySelector(tableId);
    const pagination = document.querySelector(paginationId);
    const select = document.getElementById(perPageSelectId);
    const totalItemsDisplay = document.getElementById(totalItemCountId);
    const rows = table.querySelectorAll('tbody tr');

    let currentPage = 1;
    let rowsPerPage = parseInt(select.value);
    const totalItems = rows.length;

    function updateTotalDisplay() {
        totalItemsDisplay.innerHTML = `of <span class="fw-bold" style="color: #234a75; ">${totalItems}</span> items`;
    }

    function showPage(page) {
        currentPage = page;
        const totalPages = Math.ceil(totalItems / rowsPerPage);
        if (page > totalPages) currentPage = totalPages;

        rows.forEach((row, index) => {
            row.style.display = index >= (currentPage - 1) * rowsPerPage &&
                                index < currentPage * rowsPerPage ? '' : 'none';
        });

        renderPagination();
    }

    function renderPagination() {
        const totalPages = Math.ceil(totalItems / rowsPerPage);
        let html = '<ul class="pagination mb-0 d-flex gap-1">';
    
        const disabled = (cond) => cond ? 'disabled' : '';
        const active = (page) => page === currentPage ? 'active' : '';
    
        html += `
            <li class="page-item ${disabled(currentPage === 1)}">
                <a class="page-link" href="#" data-page="1"><i class="fas fa-angles-left"></i></a>
            </li>
            <li class="page-item ${disabled(currentPage === 1)}">
                <a class="page-link" href="#" data-page="${currentPage - 1}"><i class="fas fa-angle-left"></i></a>
            </li>
        `;
    
        // Only show current page button (active)
        html += `
            <li class="page-item active">
                <a class="page-link" href="#" data-page="${currentPage}">${currentPage}</a>
            </li>
        `;
    
        html += `
            <li class="page-item ${disabled(currentPage === totalPages)}">
                <a class="page-link" href="#" data-page="${currentPage + 1}"><i class="fas fa-angle-right"></i></a>
            </li>
            <li class="page-item ${disabled(currentPage === totalPages)}">
                <a class="page-link" href="#" data-page="${totalPages}"><i class="fas fa-angles-right"></i></a>
            </li>
        `;
    
        html += '</ul>';
        pagination.innerHTML = html;
    }    

    // Pagination button click
    pagination.addEventListener('click', (e) => {
        const link = e.target.closest('a.page-link');
        if (!link) return;
        e.preventDefault();
        const page = parseInt(link.dataset.page);
        if (!isNaN(page)) {
            showPage(page);
        }
    });

    // Change rows per page
    select.addEventListener('change', () => {
        rowsPerPage = parseInt(select.value);
        showPage(1);
    });

    // Initial render
    updateTotalDisplay();
    showPage(1);
}
