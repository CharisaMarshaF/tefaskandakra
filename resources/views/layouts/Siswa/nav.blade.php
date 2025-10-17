<!-- Top Navbar -->
<nav class="top-navbar d-flex justify-content-between align-items-center px-3 shadow-sm">
    <!-- Tombol Hamburger -->
    <button class="hamburger-btn ms-4" id="hamburgerBtn" onclick="toggleSidebar()">
      <i class="bi bi-list"></i>
    </button>
  
    <!-- Search -->
    <div class="search-container">
      <i class="bi bi-search search-icon"></i>
      <input type="text" placeholder="Search here...">
    </div>
  
    <!-- User Section -->
    <div class="dropdown">
      <div class="user-section d-flex align-items-center" 
           data-bs-toggle="dropdown" 
           aria-expanded="false" 
           style="cursor:pointer;">
        <i class="bi bi-bell notification-icon me-3"></i>
  
        <div class="user-profile d-flex align-items-center">
          <div class="user-avatar rounded-circle bg-secondary me-2" 
               style="width:32px;height:32px;"></div>
          <div class="user-info">
            <h6 class="mb-0">{{ optional(auth()->user())->username ?? 'Guest' }}</h6>
          </div>
          <i class="bi bi-chevron-down ms-2"></i>
        </div>
      </div>
  
      <ul class="dropdown-menu dropdown-menu-end shadow">
        <li><a href="#" class="dropdown-item">
          <i class="bi bi-person me-2"></i> Profile
        </a></li>
  
        <li><a href="#" class="dropdown-item">
          <i class="bi bi-gear me-2"></i> Settings
        </a></li>
  
        <li><hr class="dropdown-divider"></li>
  
        <li>
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item">Logout</button>
          </form>
      </li>
      
      </ul>
    </div>
  </nav>
