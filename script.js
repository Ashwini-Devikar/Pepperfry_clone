const searchContainer = document.querySelector('.pf-search-container');
  const searchInput = document.querySelector('.pf-search-bar input');

  // 1. OPEN DROPDOWN & EXPAND BAR
  if (searchContainer && searchInput) {
      searchInput.addEventListener('focus', () => {
        searchContainer.classList.add('active');
        updateRecentSearchesUI();
        // Trigger search immediately if there's text (e.g. on search results page)
        if (searchInput.value.trim().length > 0) {
            searchInput.dispatchEvent(new Event('input'));
        }
      });
  }

  // 2. PILL TOGGLE LOGIC (Your existing code)
  document.querySelectorAll('.pf-pill-group .pf-pill').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      // Only remove active from other pills
      document.querySelectorAll('.pf-pill-group .pf-pill')
        .forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // 3. CLOSE EVERYTHING when clicking outside
  document.addEventListener('click', (e) => {
    // If the click is NOT inside the search container, close it
    if (!searchContainer.contains(e.target)) {
      searchContainer.classList.remove('active');
    }
  });

function handleWishlist(element, productName, price, image, id = null) {
    const toast = document.getElementById('wishlist-toast');
    
    // Find product ID from global products array
    const product = (typeof products !== 'undefined') ? products.find(p => p.name === productName) : null;
    const productId = id ? id : (product ? product.id : Math.floor(Math.random() * 100000));

    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('name', productName);
    formData.append('price', price);
    formData.append('image', image);

    fetch('add_to_wishlist.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'added') {
            element.classList.add('active');
            toast.innerText = "Added " + productName + " to Wishlist";
            toast.style.backgroundColor = "#ff7043";
            toast.style.display = 'block';
        } else if (data.status === 'removed') {
            element.classList.remove('active');
            toast.innerText = "Removed from Wishlist";
            toast.style.backgroundColor = "#333";
            toast.style.display = 'block';
        } else if (data.status === 'error' && data.message === 'Please login first') {
            // Show login modal if not logged in
            var loginModal = new bootstrap.Modal(document.getElementById('loginPopup'));
            loginModal.show();
        }
        setTimeout(() => { toast.style.display = 'none'; }, 2000);
    })
    .catch(error => console.error('Error:', error));
}

function slide(direction) {
    const track = document.getElementById('cardTrack');
    // scrollWidth / total cards gives the width of exactly ONE card
    const cardWidth = track.querySelector('.city-card-wrapper').offsetWidth;

    if (direction === 'next') {
        track.scrollLeft += cardWidth;
    } else {
        track.scrollLeft -= cardWidth;
    }
}
function updateCartDisplay() {
    const cartListElement = document.getElementById('cart-items-list');
    const totalElement = document.getElementById('cart-total-price');
    const badge = document.getElementById('cart-badge');

    fetch('get_cart.php')
        .then(response => response.json())
        .then(data => {
            // Update Badge
            if (badge) {
                badge.innerText = data.count;
                badge.style.display = data.count > 0 ? 'block' : 'none';
            }

            // Update Cart List (if on cart page or dropdown)
            if (cartListElement && data.items) {
                cartListElement.innerHTML = data.items.map(item => `
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2">
                        <div class="small">${item.name || 'Item'} <span class="text-muted">x${item.quantity}</span></div>
                        <span class="badge bg-light text-dark rounded-pill border">₹${(item.price || 0) * item.quantity}</span>
                    </li>
                `).join('');
            }

            // Update Total
            if (totalElement) {
                totalElement.innerText = data.totalPrice;
            }
        })
        .catch(error => console.error('Error fetching cart:', error));
}

function addToCart(name, price, image, id = null) {
    // Find product ID from the global products array
    const product = (typeof products !== 'undefined') ? products.find(p => p.name === name) : null;
    const productId = id ? id : (product ? product.id : Math.floor(Math.random() * 100000)); // Fallback ID if not found
    const category = product ? product.category : 'General';

    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('image', image);
    formData.append('category', category);
    formData.append('quantity', 1);

    fetch('add_to_cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            updateCartDisplay(); // Refresh badge and totals
            
            // Show the prompt (Toast)
            const toastElement = document.getElementById('cartToast');
            if (toastElement) {
                const toast = new bootstrap.Toast(toastElement);
                toast.show();
            }
        } else {
            console.error("Failed to add to cart: " + (data.message || "Unknown error"));
        }
    })
    .catch(error => console.error('Error adding to cart:', error));
}

// Function to update badge (call this on window.onload too)
function updateCartBadge() {
    updateCartDisplay();
}

// Run on page load to show badge count
window.onload = function() {
    updateCartBadge();
    loadCategoryPage();
    checkLoginStatus();
    checkWishlistStatus();
};

// Search Functionality
// ================= SEARCH FUNCTIONALITY =================

const searchInputField = document.getElementById('searchInput');
const defaultContent = document.getElementById('defaultSearchContent');
const searchResults = document.getElementById('searchResults');

if (searchInputField) {

    // Live Dropdown Search
    searchInputField.addEventListener('input', function () {

        const query = this.value.trim();

        if (query.length > 0) {

            if (defaultContent) defaultContent.style.display = 'none';
            if (searchResults) searchResults.style.display = 'block';

            fetch('search_backend.php?query=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {

                    if (data.length > 0) {
                        searchResults.innerHTML = data.map(item => `
                            <div class="list-group-item small">
                                <div class="d-flex align-items-center">
                                    <img src="${item.image}" 
                                         style="width:40px;height:40px;object-fit:cover;margin-right:10px;border-radius:4px;">
                                    <div>
                                        <div class="fw-bold">${item.name}</div>
                                        <div>₹${item.price}</div>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                    } else {
                        searchResults.innerHTML =
                            '<div class="p-2 text-muted small">No results found</div>';
                    }

                })
                .catch(err => console.error('Search error:', err));

        } else {
            if (defaultContent) defaultContent.style.display = 'block';
            if (searchResults) searchResults.style.display = 'none';
        }
    });

    // Redirect to search results page on Enter
    searchInputField.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const query = this.value.trim();

            if (query.length > 0) {
                saveRecentSearch(query);
                window.location.href =
                    "search_results.php?query=" + encodeURIComponent(query);
            }
        }
    });

}


function checkLoginStatus() {
    fetch('get_user.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn) {
                // If PHP already rendered the logout link, don't overwrite it
                if (document.querySelector('a[href="logout.php"]')) {
                    return;
                }

                const signupWrapper = document.querySelector('.signup-wrapper');
                if (signupWrapper) {
                    signupWrapper.outerHTML = `
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle fs-4 me-2"></i>
                                <span>${data.username}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    `;
                }
            }
        })
        .catch(err => console.log("Session check failed", err));
}

function checkWishlistStatus() {
    fetch('get_wishlist_status.php')
    .then(response => response.json())
    .then(ids => {
        // Iterate over all wishlist containers to highlight active ones
        document.querySelectorAll('.wishlist-container, .wishlist-btn').forEach(el => {
            // Check data-id first (for search results)
            const dataId = el.getAttribute('data-id');
            if (dataId && ids.includes(parseInt(dataId))) {
                el.classList.add('active');
                return;
            }

            const onclick = el.getAttribute('onclick');
            if (onclick) {
                // Extract name from onclick attribute
                const match = onclick.match(/'([^']+)'/);
                if (match && match[1]) {
                    const name = match[1];
                    const product = (typeof products !== 'undefined') ? products.find(p => p.name === name) : null;
                    if (product && ids.includes(product.id)) {
                        el.classList.add('active');
                    }
                }
            }
        });
    });
}

function toggleLoginForms() {
    const signupContainer = document.getElementById('signup-form-container');
    const loginContainer = document.getElementById('login-form-container');
    const bannerTitle = document.getElementById('modal-banner-title');
    const bannerSubtitle = document.getElementById('modal-banner-subtitle');
    const couponBox = document.getElementById('modal-coupon-box');

    if (signupContainer.style.display === 'none') {
        signupContainer.style.display = 'block';
        loginContainer.style.display = 'none';
        if (bannerTitle) bannerTitle.innerText = "Sign Up Now & Get Upto Rs. 1,500 Off";
        if (bannerSubtitle) bannerSubtitle.style.display = 'block';
        if (couponBox) couponBox.style.display = 'block';
    } else {
        signupContainer.style.display = 'none';
        loginContainer.style.display = 'block';
        if (bannerTitle) bannerTitle.innerText = "Login to Your Account";
        if (bannerSubtitle) bannerSubtitle.style.display = 'none';
        if (couponBox) couponBox.style.display = 'none';
    }
}
function switchToLogin() {
    var signupModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('loginModal'));
    signupModal.hide();

    setTimeout(function() {
        var loginModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('loginPopup'));
        loginModal.show();
    }, 300);
}

function switchToSignup() {
    var loginModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('loginPopup'));
    loginModal.hide();

    setTimeout(function() {
        var signupModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('loginModal'));
        signupModal.show();
    }, 300);
}

// Recent Searches Feature
function saveRecentSearch(term) {
    if (!term) return;
    let searches = JSON.parse(localStorage.getItem('pf_recent_searches') || '[]');
    // Remove duplicate if exists to move to top
    searches = searches.filter(s => s.toLowerCase() !== term.toLowerCase());
    // Add to front
    searches.unshift(term);
    // Keep max 5
    if (searches.length > 5) searches.pop();
    localStorage.setItem('pf_recent_searches', JSON.stringify(searches));
    updateRecentSearchesUI();
}

function updateRecentSearchesUI() {
    const container = document.getElementById('defaultSearchContent');
    if (!container) return;
    
    let searches = JSON.parse(localStorage.getItem('pf_recent_searches') || '[]');
    let recentDiv = document.getElementById('pf-recent-searches');
    
    if (searches.length === 0) {
        if (recentDiv) recentDiv.remove();
        return;
    }
    
    const html = `
        <div id="pf-recent-searches" class="mb-3">
            <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 8px;">
                <p class="title mb-0" style="font-size: 12px; font-weight: bold; color: #ae8b06;">Recent Searches</p>
                <span onclick="clearRecentSearches()" style="font-size: 11px; color: #999; cursor: pointer;">Clear</span>
            </div>
            <div class="pf-tags">
                ${searches.map(s => `<span onclick="applySearch('${s.replace(/'/g, "\\'")}')" style="cursor:pointer;">🕒 ${s}</span>`).join('')}
            </div>
        </div>
    `;
    
    if (recentDiv) {
        recentDiv.outerHTML = html;
    } else {
        container.insertAdjacentHTML('afterbegin', html);
    }
}

window.clearRecentSearches = function() {
    localStorage.removeItem('pf_recent_searches');
    updateRecentSearchesUI();
};

window.applySearch = function(term) {
    const input = document.getElementById('searchInput');
    if (input) {
        input.value = term;
        saveRecentSearch(term);
        window.location.href = "search_results.php?query=" + encodeURIComponent(term);
    }
};

// Category Page Logic with Sorting
function loadCategoryPage() {
    const params = new URLSearchParams(window.location.search);
    const categoryName = params.get('name');
    const sortParam = params.get('sort') || 'relevance';
    const container = document.getElementById('product-list-container');
    const title = document.getElementById('category-heading');

    if (categoryName && container && typeof products !== 'undefined') {
        if(title) title.innerText = decodeURIComponent(categoryName);
        
        let filteredProducts = products.filter(p => 
            p.category.toLowerCase() === decodeURIComponent(categoryName).toLowerCase() ||
            p.name.toLowerCase().includes(decodeURIComponent(categoryName).toLowerCase())
        );

        // Sorting
        if (sortParam === 'price_asc') {
            filteredProducts.sort((a, b) => a.price - b.price);
        } else if (sortParam === 'price_desc') {
            filteredProducts.sort((a, b) => b.price - a.price);
        } else if (sortParam === 'newest') {
            filteredProducts.sort((a, b) => b.id - a.id);
        }

        // Render
        if (filteredProducts.length > 0) {
            container.innerHTML = filteredProducts.map(product => `
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm product-card rounded-3 overflow-hidden">
                        <div class="product-img-wrapper">
                            <img src="${product.image}" alt="${product.name}">
                            <div class="wishlist-btn shadow-sm" onclick="handleWishlist(this, '${product.name.replace(/'/g, "\\'")}', ${product.price}, '${product.image}')">
                                <i class="bi bi-heart"></i>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="card-title text-truncate mb-1" title="${product.name}">${product.name}</h6>
                            <p class="text-muted small mb-2">${product.description || product.category}</p>
                            <div class="mt-auto">
                                <p class="fw-bold fs-5 mb-2 text-dark">₹${product.price.toLocaleString('en-IN')}</p>
                                <button class="btn btn-outline-orange w-100 rounded-pill btn-sm fw-bold" 
                                        onclick="addToCart('${product.name.replace(/'/g, "\\'")}', ${product.price}, '${product.image}')">
                                    ADD TO CART
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<div class="col-12 text-center py-5"><h5 class="text-muted">No products found in this category.</h5></div>';
        }
        
        // Update Sort Label
        const sortLabel = document.getElementById('sortLabel');
        
        if(sortLabel) {
            if(sortParam === 'price_asc') sortLabel.innerText = 'Sort By: Price: Low to High';
            else if(sortParam === 'price_desc') sortLabel.innerText = 'Sort By: Price: High to Low';
            else if(sortParam === 'newest') sortLabel.innerText = 'Sort By: Newest First';
            else sortLabel.innerText = 'Sort By: Relevance';
            let text = 'Relevance';
            if(sortParam === 'price_asc') text = 'Price: Low to High';
            else if(sortParam === 'price_desc') text = 'Price: High to Low';
            else if(sortParam === 'newest') text = 'Newest First';
            
            sortLabel.innerHTML = `<i class="bi bi-sort-down me-2"></i>Sort By: ${text}`;
        }
        
        // Update Radio Buttons in Offcanvas
        const radio = document.querySelector(`input[name="sortRadio"][value="${sortParam}"]`);
        if (radio) {
            radio.checked = true;
        }
    }
}

window.applySortFrontend = function() {
    const selected = document.querySelector('input[name="sortRadio"]:checked');
    if(selected) sortCategory(selected.value);
};

window.sortCategory = function(sortType) {
    const params = new URLSearchParams(window.location.search);
    params.set('sort', sortType);
    // Update URL without reloading to keep state clean, then reload to apply sort
    const newUrl = window.location.pathname + '?' + params.toString();
    window.history.pushState({path: newUrl}, '', newUrl);
    loadCategoryPage(); // Re-render with new sort
};

window.togglePassword = function(inputId, element) {
    const input = document.getElementById(inputId);
    const icon = element.querySelector('i');

    if (!input || !icon) return;

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}