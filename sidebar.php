<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
/* Submenu hidden by default */
.submenu {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s ease, opacity 0.4s ease;
  opacity: 0;
  padding-left: 20px;
}

/* When active */
.submenu.show {
  max-height: 200px; /* Adjust based on expected submenu size */
  opacity: 1;
}

.submenu-link {
  display: block;
  padding: 5px 0;
  color: white;
  text-decoration: none;
}

.dropdown-arrow {
  transition: transform 0.3s ease;
}

/* Rotate arrow when submenu is open */
.nav-item.open .dropdown-arrow {
  transform: rotate(180deg);
}

.nav-link:focus,
.nav-link:active,
.submenu-link:focus,
.submenu-link:active {
  outline: none;
  box-shadow: none;
  background-color: transparent;
  color: inherit;
}

.nav-link,
.submenu-link {
  color: white; /* or your sidebar text color */
  text-decoration: none;
}

.nav-link:hover,
.submenu-link:hover {
  color: #f0f0f0; /* light hover effect */
}

</style>


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
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
                <i class="fas fa-paw"></i>
                <span class="ps-2">Pets</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="    margin-left: 37px;">
              <li><a href="category.php" class="submenu-link">Category</a></li>
              <li><a href="subcategory.php" class="submenu-link">Subcategory</a></li>
              <li><a href="pets.php" class="submenu-link">Pets</a></li>
            </ul>
          </li>


        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fas fa-shopping-basket"></i>    
                <span class="ps-2">Accessories</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="acc_category.php" class="submenu-link">Accessories Catgeory</a></li>
              <li><a href="accessories.php" class="submenu-link">Accessories</a></li>
              <!-- <li><a href="pets.php" class="submenu-link">Pets</a></li> -->
            </ul>
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
          <a href="Inquiry.php" class="d-flex align-items-center">
          <i class="bi bi-patch-question-fill"></i>
            <span>Inquiry</span>
          </a>
        </li>
       
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fa-solid fa-cat fa-flip-horizontal"></i>
                <span class="ps-2">Pet Adoption / Return</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="addoption.php" class="submenu-link">Pet Adoption</a></li>
              <li><a href="pet_return.php" class="submenu-link">Pet Return</a></li>
              <!-- <li><a href="pets.php" class="submenu-link">Pets</a></li> -->
            </ul>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fa-solid fa-cart-shopping"></i>
                <span class="ps-2">Accessories Sale</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="ass_pur.php" class="submenu-link">Accessories Sale</a></li>
              <li><a href="ass_retu.php" class="submenu-link">Accessories Return</a></li>
              <!-- <li><a href="pets.php" class="submenu-link">Pets</a></li> -->
            </ul>
          </li>
        <!-- <li>
          <a href="addoption.php" class="d-flex align-items-center">
            <i class="fas fa-history"></i>
            <span>Adoption</span>
          </a>
        </li>
        <li>
          <a href="pet_return.php" class="d-flex align-items-center">
           <i class="fa-solid fa-cat fa-flip-horizontal"></i>
            <span>Pet Return</span>
          </a>
        </li> -->
        <li>
          <a href="service_m.php" class="d-flex align-items-center">
          <i class="fa-solid fa-house-chimney-medical"></i>

            <span>Services Maintain</span>
          </a>
        </li>
        <li>
          <a href="user_view.php" class="d-flex align-items-center">
          <i class="fa-solid fa-users"></i>
            <span>Users</span>
          </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
              <div>
              <i class="fa-solid fa-circle-info"></i>
                <span class="ps-2">Others</span>
              </div>
              <i class="fas fa-chevron-down dropdown-arrow"></i>
            </a>

            <ul class="submenu" style="margin-left: 10px;">
              <li><a href="aboutus.php" class="submenu-link">About Us</a></li>
              <li><a href="terms.php" class="submenu-link">Terms & Condtiton</a></li>
              <li><a href="privacy.php" class="submenu-link">Privacy Policy</a></li>
              <li><a href="faq.php" class="submenu-link">FAQ Message</a></li>
            </ul>
          </li>
        <!-- <li>
          <a href="aboutus.php" class="d-flex align-items-center">
           <i class="fa-solid fa-circle-info"></i>
            <span>About Us</span>
          </a>
        </li>
        <li>
          <a href="terms.php" class="d-flex align-items-center">
          <i class="fa-solid fa-file-circle-check"></i>
            <span>Terms & Condtiton</span>
          </a>
        </li>
        <li>
          <a href="privacy.php" class="d-flex align-items-center">
          <i class='fas fa-shield-alt'></i>
 
            <span>Privacy Policy</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="#" class="d-flex align-items-center">
            <i class="fas fa-history"></i>
            <span>Adoption History</span>
          </a>
        </li> -->
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
    const InquiryLink = document.querySelector('.k-sidebar-menu li a[href="Inquiry.php"]');
    const userLink = document.querySelector('.k-sidebar-menu li a[href="user_view.php"]');
    const addoptionLink = document.querySelector('.k-sidebar-menu li a[href="addoption.php"]');
    const returnLink = document.querySelector('.k-sidebar-menu li a[href="pet_return.php"]');
    const aboutLink = document.querySelector('.k-sidebar-menu li a[href="aboutus.php"]');
    const termsLink = document.querySelector('.k-sidebar-menu li a[href="terms.php"]');
    const privacyLink = document.querySelector('.k-sidebar-menu li a[href="privacy.php"]');




  
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
  else if(currentPage === 'Inquiry.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (InquiryLink) {
      InquiryLink.classList.add('active');
    }
  }else if(currentPage === 'user_view.php'){
    document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Add active class to pets link
    if (userLink) {
      userLink.classList.add('active');
    }
  
    }else if(currentPage === 'addoption.php'){
        document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
          link.classList.remove('active');
        });
        
        // Add active class to pets link
        if (addoptionLink) {
          addoptionLink.classList.add('active');
        }
      
      
    }else if(currentPage === 'pet_return.php'){
        document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
          link.classList.remove('active');
        });
        
        // Add active class to pets link
        if (returnLink) {
          returnLink.classList.add('active');
        }
      }else if(currentPage === 'aboutus.php'){
        document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
          link.classList.remove('active');
        });
        
        // Add active class to pets link
        if (aboutLink) {
          aboutLink.classList.add('active');
        }
      }else if(currentPage === 'terms.php'){
        document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
          link.classList.remove('active');
        });
        
        // Add active class to pets link
        if (termsLink) {
          termsLink.classList.add('active');
        }
      }else if(currentPage === 'privacy.php'){
        document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
          link.classList.remove('active');
        });
        
        // Add active class to pets link
        if (privacyLink) {
          privacyLink.classList.add('active');
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
  if (InquiryLink) {
    InquiryLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (userLink) {
    userLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (addoptionLink) {
    addoptionLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (returnLink) {
    returnLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (aboutLink) {
    aboutLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (termsLink) {
    termsLink.addEventListener('click', function(e) {
      // Remove active class from all links
      document.querySelectorAll('.k-sidebar-menu li a').forEach(function(link) {
        link.classList.remove('active');
      });
      
      // Add active class to only the accessories category link
      this.classList.add('active');
    });
  }
  if (privacyLink) {
    privacyLink.addEventListener('click', function(e) {
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
   <script>
function toggleDropdown(el) {
  const parent = el.closest(".nav-item");
  const submenu = parent.querySelector(".submenu");
  const isOpen = submenu.classList.contains("show");

  // Close all other submenus if needed (optional)
  document.querySelectorAll('.submenu').forEach(s => {
    s.classList.remove("show");
    s.closest('.nav-item')?.classList.remove("open");
  });

  // Toggle current
  if (!isOpen) {
    submenu.classList.add("show");
    parent.classList.add("open");
  }
}
</script>

