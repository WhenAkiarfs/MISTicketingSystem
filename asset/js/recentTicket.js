function fetchRecentTickets() {
    fetch('adminTicketMgmt.php')
      .then(response => response.json())
      .then(data => {
        const recentTicketsContainer = document.getElementById('ticket-container');
        recentTicketsContainer.innerHTML = '';
  
        data.forEach(ticket => {
          const ticketItem = document.createElement('div');
          ticketItem.className = 'ticket-container';
          ticketItem.innerHTML = `
            <div class="ticket-id">${ticket.id}</div>
            <div class="ticket-status">${ticket.status}</div>
            <div class="ticket-branch">${ticket.branch}</div>
            <div class="ticket-issue">${ticket.issue}</div>
            <div class="ticket-date">${ticket.date}</div>
            <div class="ticket-time">${ticket.created_at}</div>
          `;
          recentTicketsContainer.appendChild(ticketItem);
        });
      })
      .catch(error => console.error('Error fetching recent tickets:', error));
  }
  
  // Fetch immediately when page loads
  fetchRecentTickets();
  
  // Auto-refresh every 10 seconds
  setInterval(fetchRecentTickets, 10000);  