<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
          <a href="dashbord.php" class="d-flex align-items-center">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="category.php" class="active d-flex align-items-center">
          <i class="bi bi-grid-fill"></i>
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
          <a href="acc_category.php" class="d-flex align-items-center">
          <i class="bi bi-tags-fill"></i>
            <span>Accessories Catgeory</span>
          </a>
        </li>
        <li>
          <a href="accessories.php" class="d-flex align-items-center">
            <i class="fas fa-shopping-basket"></i>
            <span>Accessories</span>
          </a>
        </li>
        <li>
          <a href="service.php" class="d-flex align-items-center">
            <i class="fas fa-concierge-bell"></i>
            <span>Services</span>
          </a>
        </li>
        <li>
          <a href="offer.php" class="d-flex align-items-center">
          <i class="bi bi-bookmark-star-fill"></i>
            <span>Offers</span>
          </a>
        </li>
        <li>
          <a href="banner.php" class="d-flex align-items-center">
          <i class="fa-solid fa-image"></i>
            <span>Banner</span>
          </a>
        </li>
        <li>
          <a href="" class="d-flex align-items-center">
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
  const accCategoryLink = document.querySelector('.k-sidebar-menu li a[href="acc_category.php"]');
  const accessoriesLink = document.querySelector('.k-sidebar-menu li a[href="accessories.php"]');
  const serviceLink = document.querySelector('.k-sidebar-menu li a[href="service.php"]');
  const offerLink = document.querySelector('.k-sidebar-menu li a[href="offer.php"]');
  const bannerLink = document.querySelector('.k-sidebar-menu li a[href="banner.php"]');
  const dashbordLink = document.querySelector('.k-sidebar-menu li a[href="dashbord.php"]');

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
  } else if(currentPage === 'acc_category.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (accCategoryLink) {
      accCategoryLink.classList.add('active');
    }
  }
  else if(currentPage === 'accessories.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (accessoriesLink) {
      accessoriesLink.classList.add('active');
    }
  }
  else if(currentPage === 'service.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (serviceLink) {
      serviceLink.classList.add('active');
    }
  }
  else if(currentPage === 'offer.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (offerLink) {
      offerLink.classList.add('active');
    }
  }
  else if(currentPage === 'banner.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (bannerLink) {
      bannerLink.classList.add('active');
    }
  }
  else if(currentPage === 'dashboard.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (dashbordLink) {
      dashbordLink.classList.add('active');
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
  
  if (accCategoryLink) {
    accCategoryLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (accessoriesLink) {
    accessoriesLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (serviceLink) {
    serviceLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (offerLink) {
    offerLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (bannerLink) {
    bannerLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (dashbordLink) {
    dashbordLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
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