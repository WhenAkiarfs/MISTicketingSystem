// Donut Chart: Branches with Most Tickets
const donutCtx = document.getElementById('branchMostTicketChart').getContext('2d');

fetch('getBranchTicketData.php')
  .then(response => response.json())
  .then(chartData => {
    new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: chartData.labels,
        datasets: [{
          data: chartData.data,
          backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#17a2b8'], // Add more if needed
          borderRadius: 5,
          hoverOffset: 8
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            padding: {
              top: 18,
              bottom: 5
            },
            labels: {
              font: {
                size: 12,
                family: "Inter"
              }
            }
          },
          title: {
            display: true,
            text: "Branches with Most Tickets",
            font: {
              size: 20,
              family: 'Inter',
              weight: 'bold'
            },
            padding: {
              top: 5,
              bottom: 12
            }
          }
        }
      }
    });
  })
  .catch(error => {
    console.error('Error loading donut chart data:', error);
  });

// Bar Chart 1: Top Issues in Main Branch
const mainBranchCtx = document.getElementById('mainBranchIssueChart').getContext('2d');
new Chart(mainBranchCtx, {
type: 'bar',
data: {
    labels: ['Printer', 'Software Bug', 'Network', 'Email'],
    datasets: [{
    label: 'Tickets',
    data: [10, 20, 5, 8],
    backgroundColor: '#007bff',
    borderRadius: 4
    }]
},
options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
    y: {
        beginAtZero: true,
        ticks: {
        stepSize: 5
        }
    }
    },
    plugins: {
    legend: {
        display: false
    },
    title: {
        display: true,
        text: "Top Issues in Main Branch",
        position: 'top',
        align: 'center',
        font: {
            size: 20,
            family: 'Inter',
            weight: 'bold'
        },
        padding: {
            top: 0,
            bottom: 12,
            left: 0,
            right: 0
            }
        }
    }
}
});

// Bar Chart 2: Top Issues in Other Branches
const otherBranchCtx = document.getElementById('otherBranchIssueChart').getContext('2d');
new Chart(otherBranchCtx, {
type: 'bar',
data: {
    labels: ['Hardware', 'Software', 'Connectivity'],
    datasets: [{
    label: 'Tickets',
    data: [6, 9, 4],
    backgroundColor: '#28a745',
    borderRadius: 4
    }]
},
options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
    y: {
        beginAtZero: true,
        ticks: {
        stepSize: 2
        }
    }
    },
    plugins: {
    legend: {
        display: false
    },
    title: {
        display: true,
        text: "Top Issues in Main Branch",
        text: "Top Issues in Sattelite Offices",
        position: 'top',
        align: 'center',
        font: {
            size: 20,
            family: 'Inter',
            weight: 'bold'
        },
        padding: {
            top: 0,
            bottom: 12,
            left: 0,
            right: 0
            }
        }
    }
}
});