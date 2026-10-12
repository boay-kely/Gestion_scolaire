// Lightweight JS for sidebar toggle and search functionality
document.addEventListener('DOMContentLoaded', function(){
  // ===== SIDEBAR TOGGLE =====
  var toggle = document.getElementById('toggle-sidebar');
  var sidebar = document.querySelector('.app-sidebar');
  var appRoot = document.querySelector('.app-root');
  
  // Load sidebar state from localStorage
  var sidebarState = localStorage.getItem('sidebarState') || 'expanded';
  
  if(sidebarState === 'collapsed' && sidebar) {
    sidebar.classList.add('collapsed');
    if(appRoot) appRoot.classList.add('sidebar-collapsed');
    sidebar.style.width = '72px';
  }
  
  if(toggle){
    toggle.addEventListener('click', function(){
      if(sidebar){
        var isCollapsed = sidebar.classList.toggle('collapsed');
        if(appRoot) appRoot.classList.toggle('sidebar-collapsed');
        
        if(isCollapsed){
          sidebar.style.width = '72px';
          localStorage.setItem('sidebarState', 'collapsed');
        } else {
          sidebar.style.width = '260px';
          localStorage.setItem('sidebarState', 'expanded');
        }
      }
    });
  }
  
  // ===== SEARCH FUNCTIONALITY =====
  var searchInput = document.querySelector('.search-input');
  if(searchInput) {
    searchInput.addEventListener('focus', function() {
      this.style.borderColor = '#667eea';
      this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
    });
    
    searchInput.addEventListener('blur', function() {
      this.style.borderColor = '#e5e7eb';
      this.style.boxShadow = 'none';
    });
    
    searchInput.addEventListener('input', function(e) {
      var query = this.value.trim().toLowerCase();
      
      if(query.length === 0) {
        // Clear search if empty
        return;
      }
      
      // Get current page context
      var currentUrl = window.location.pathname;
      var searchUrl = '';
      
      // Determine search endpoint based on current page
      if(currentUrl.includes('/students')) {
        searchUrl = '/students?search=' + encodeURIComponent(query);
      } else if(currentUrl.includes('/parents')) {
        searchUrl = '/parents?search=' + encodeURIComponent(query);
      } else if(currentUrl.includes('/classrooms')) {
        searchUrl = '/classrooms?search=' + encodeURIComponent(query);
      } else if(currentUrl.includes('/payments')) {
        searchUrl = '/payments?search=' + encodeURIComponent(query);
      } else if(currentUrl.includes('/dashboard')) {
        searchUrl = '/dashboard?search=' + encodeURIComponent(query);
      }
      
      // Store search for potential use
      if(searchUrl) {
        window.lastSearchUrl = searchUrl;
      }
    });
    
    // Handle search on Enter key
    searchInput.addEventListener('keypress', function(e) {
      if(e.key === 'Enter') {
        e.preventDefault();
        if(window.lastSearchUrl) {
          window.location.href = window.lastSearchUrl;
        }
      }
    });
  }
  
  // ===== TABLE ROW HOVER =====
  var tableRows = document.querySelectorAll('table tbody tr');
  tableRows.forEach(function(row) {
    row.addEventListener('mouseenter', function() {
      this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)';
    });
    
    row.addEventListener('mouseleave', function() {
      this.style.backgroundColor = '';
    });
  });
  
  // ===== PROFILE DROPDOWN MENU =====
  var profileMenuBtn = document.getElementById('profile-menu-btn');
  var profileDropdown = document.getElementById('profile-dropdown');
  
  if(profileMenuBtn && profileDropdown) {
    // Toggle dropdown on button click
    profileMenuBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      profileDropdown.classList.toggle('active');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
      if(!profileMenuBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
        profileDropdown.classList.remove('active');
      }
    });
    
    // Close dropdown when clicking a menu item
    var dropdownItems = profileDropdown.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(function(item) {
      item.addEventListener('click', function() {
        profileDropdown.classList.remove('active');
      });
    });
  }
  
  // ===== ALERT AUTO-CLOSE =====
  var alerts = document.querySelectorAll('.alert');
  alerts.forEach(function(alert) {
    setTimeout(function() {
      if(alert.style.display !== 'none') {
        alert.style.transition = 'opacity 0.3s ease';
        alert.style.opacity = '0';
        setTimeout(function() {
          alert.style.display = 'none';
        }, 300);
      }
    }, 5000);
  });
});

