
const ctx = document.getElementById('progressChart').getContext('2d');
const progressChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Project Yang Sedang Berjalan', 'Project Selesai', 'Surat Yang Belum Ditanda Tangan', 'Surat Yang Sudah Ditanda Tangan'],
        datasets: [{
            data: [4, 3, 1, 2],
            backgroundColor: ['#3b82f6', '#10b981', '#ef4444', '#f97316'],
            borderWidth: 2,
            borderColor: '#ffffff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Sidebar Toggle Functionality
let sidebarOpen = true;

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const overlay = document.getElementById('sidebarOverlay');
    const hamburgerIcon = document.querySelector('#hamburgerBtn i');
    
    if (window.innerWidth > 768) {
        // Desktop behavior
        sidebarOpen = !sidebarOpen;
        
        if (!sidebarOpen) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('sidebar-collapsed');
            hamburgerIcon.className = 'bi bi-layout-sidebar';
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('sidebar-collapsed');
            hamburgerIcon.className = 'bi bi-list';
        }
    } else {
        // Mobile behavior
        const isOpen = sidebar.classList.contains('show');
        
        if (!isOpen) {
            sidebar.classList.add('show');
            overlay.classList.add('show');
            hamburgerIcon.className = 'bi bi-x';
        } else {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            hamburgerIcon.className = 'bi bi-list';
        }
    }
}

// Close sidebar when clicking overlay (mobile)
document.getElementById('sidebarOverlay').addEventListener('click', function() {
    if (window.innerWidth <= 768) {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const hamburgerIcon = document.querySelector('#hamburgerBtn i');
        
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        hamburgerIcon.className = 'bi bi-list';
    }
});

// Handle window resize
window.addEventListener('resize', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const overlay = document.getElementById('sidebarOverlay');
    const hamburgerIcon = document.querySelector('#hamburgerBtn i');
    
    if (window.innerWidth > 768) {
        // Reset to desktop mode
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        
        if (sidebarOpen) {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('sidebar-collapsed');
            hamburgerIcon.className = 'bi bi-list';
        } else {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('sidebar-collapsed');
            hamburgerIcon.className = 'bi bi-layout-sidebar';
        }
    } else {
        // Reset to mobile mode
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('sidebar-collapsed');
        hamburgerIcon.className = 'bi bi-list';
        sidebarOpen = true;
    }
});

// Tab switching functionality
function switchTab(tabType) {
    const inventoryTab = document.getElementById('inventoryTab');
    const movementTab = document.getElementById('movementTab');
    const inventoryWrapper = document.getElementById('inventoryTableWrapper');
    const movementWrapper = document.getElementById('movementTableWrapper');
    const tableTitle = document.getElementById('tableTitle');
    const tableSubtitle = document.getElementById('tableSubtitle');
    
    if (tabType === 'inventory') {
        // Switch to inventory table
        inventoryTab.classList.add('active');
        movementTab.classList.remove('active');
        inventoryWrapper.classList.remove('hidden');
        movementWrapper.classList.remove('active');
        
        // Update titles
        tableTitle.textContent = 'Inventori Bahan Baku';
        tableSubtitle.textContent = 'Daftar lengkap bahan baku dan status stok terkini';
    } else {
        // Switch to movement table
        movementTab.classList.add('active');
        inventoryTab.classList.remove('active');
        inventoryWrapper.classList.add('hidden');
        movementWrapper.classList.add('active');
        
        // Update titles
        tableTitle.textContent = 'Inventori Bahan Baku';
        tableSubtitle.textContent = 'Daftar lengkap bahan baku dan status stok terkini';
    }
}
function toggleDropdown(button) {
    // Close all other dropdowns first
    document.querySelectorAll('.action-dropdown').forEach(dropdown => {
        if (dropdown !== button.nextElementSibling) {
            dropdown.classList.remove('show');
        }
    });
    
    // Toggle current dropdown
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('show');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.action-cell')) {
        document.querySelectorAll('.action-dropdown').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }
});

// Handle dropdown item clicks
document.addEventListener('click', function(event) {
    if (event.target.closest('.dropdown-item')) {
        event.preventDefault();
        const action = event.target.closest('.dropdown-item');
        const actionType = action.classList.contains('edit') ? 'edit' : 
                         action.classList.contains('detail') ? 'detail' : 'delete';
        
        // Close dropdown
        action.closest('.action-dropdown').classList.remove('show');
        
        // You can add your action logic here
        console.log(`${actionType} action clicked`);
        
        if (actionType === 'delete') {
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                // Handle delete action
                console.log('Item deleted');
            }
        }
    }
});




