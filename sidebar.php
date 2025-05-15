
<div class="k-sidebar" id="sidebar">
      <div class="k-logo">
        <div>
          <p class="p-0 m-0 text-start text-lg-center">LOGO</p>
        </div>
        <div>
          <button class="k-close-sidebar" id="closeSidebar">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <ul class="k-sidebar-menu">
        <li>
          <a href="#" class="d-flex align-items-center">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="category.php" class="active d-flex align-items-center">
            <img src="images/s2.svg" alt="" class="text-dark" />
            <span class="ps-2">Category</span>
          </a>
        </li>
        <li>
          <a href="subcategory.php" class="d-flex align-items-center">
            <i class="fas fa-layer-group"></i>
            <span>Subcategory</span>
          </a>
        </li>
        <li>
          <a href="pets.php" class="d-flex align-items-center">
            <i class="fas fa-paw"></i>
            <span>Pets</span>
          </a>
        </li>
        <li>
          <a href="#" class="d-flex align-items-center">
            <i class="fas fa-shopping-basket"></i>
            <span>Accessories</span>
          </a>
        </li>
        <li>
          <a href="#" class="d-flex align-items-center">
            <i class="fas fa-concierge-bell"></i>
            <span>Services</span>
          </a>
        </li>
        <li>
          <a href="#" class="d-flex align-items-center">
            <i class="fas fa-user"></i>
            <span>User</span>
          </a>
        </li>
        <li>
          <a href="#" class="d-flex align-items-center">
            <i class="fas fa-history"></i>
            <span>Adoption History</span>
          </a>
        </li>
      </ul>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
  // Get the subcategory and pets links specifically
  const subcategoryLink = document.querySelector('.k-sidebar-menu li a[href="subcategory.php"]');
  const petsLink = document.querySelector('.k-sidebar-menu li a[href="pets.php"]');
  
  // Check if we're on the subcategory or pets page
  const currentPage = window.location.pathname.split('/').pop();
  if (currentPage === 'subcategory.php') {
    // Remove active class from all links first (in case any have it)
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to subcategory link
    if (subcategoryLink) {
      subcategoryLink.classList.add('active');
    }
  } else if (currentPage === 'pets.php') {
    // Remove active class from all links first
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (petsLink) {
      petsLink.classList.add('active');
    }
  }
  
  // Add click event listener to subcategory link
  if (subcategoryLink) {
    subcategoryLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the subcategory link
      this.classList.add('active');
    });
  }

  // Add click event listener to pets link
  if (petsLink) {
    petsLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the pets link
      this.classList.add('active');
    });
  }
  
  // Handle close sidebar button if present
  const closeSidebarBtn = document.getElementById('closeSidebar');
  if (closeSidebarBtn) {
    closeSidebarBtn.addEventListener('click', function() {
      const sidebar = document.getElementById('sidebar');
      if (sidebar) {
        sidebar.classList.toggle('k-sidebar-closed');
      }
    });
  }
});
    </script>