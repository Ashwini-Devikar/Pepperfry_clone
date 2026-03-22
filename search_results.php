<?php
session_start();
require 'db_connect.php';

$query = trim($_GET['query'] ?? '');
$selectedCategories = $_GET['category'] ?? [];
$selectedPrices = $_GET['price'] ?? [];
$sort = $_GET['sort'] ?? 'relevance';

if(empty($query)){
    echo "No search term entered.";
    exit;
}

// Build Dynamic Query
$sql = "SELECT * FROM products WHERE name LIKE ?";
$types = "s";
$params = ["%" . $query . "%"];

// Filter by Category
if (!empty($selectedCategories)) {
    $placeholders = implode(',', array_fill(0, count($selectedCategories), '?'));
    $sql .= " AND category IN ($placeholders)";
    $types .= str_repeat('s', count($selectedCategories));
    foreach ($selectedCategories as $cat) {
        $params[] = $cat;
    }
}

// Filter by Price
if (!empty($selectedPrices)) {
    $priceClauses = [];
    foreach ($selectedPrices as $range) {
        $parts = explode('-', $range);
        if (count($parts) == 2) {
            $priceClauses[] = "(price BETWEEN ? AND ?)";
            $types .= "ii";
            $params[] = (int)$parts[0];
            $params[] = (int)$parts[1];
        }
    }
    if (!empty($priceClauses)) {
        $sql .= " AND (" . implode(' OR ', $priceClauses) . ")";
    }
}

// Sort Logic
switch ($sort) {
    case 'price_asc':
        $sql .= " ORDER BY price ASC";
        break;
    case 'price_desc':
        $sql .= " ORDER BY price DESC";
        break;
    case 'newest':
        $sql .= " ORDER BY id DESC";
        break;
}

$sql .= " LIMIT 50";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<title>Search Results</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="style.css">
<style>
    .product-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .product-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
        background-color: #f8f9fa;
    }
    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .product-card:hover .product-img-wrapper img {
        transform: scale(1.05);
    }
    .wishlist-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.2s;
        color: #e0e0e0;
    }
    .wishlist-btn:hover {
        background: #fff;
        color: #ff7043;
        transform: scale(1.1);
    }
    .wishlist-btn.active {
        color: #ff7043;
    }
    /* Filter Styles */
    .filter-group-title {
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #84582d;
        margin-bottom: 15px;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 8px;
    }
    .form-check-input:checked {
        background-color: #ff7043;
        border-color: #ff7043;
    }
    .form-check-label {
        font-size: 0.95rem;
        color: #555;
        cursor: pointer;
    }
    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(255, 112, 67, 0.25);
        border-color: #ff7043;
    }
</style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container position-relative">
        <div class="pf-search-container me-auto">
            <div class="pf-search-bar" id="pfSearchBar">
                <input type="text" id="searchInput" placeholder="Search" autocomplete="off" value="<?php echo htmlspecialchars($query); ?>" />
                <i class="bi bi-search"></i>
            </div>
            <div class="pf-search-dropdown" id="pfDropdown">
                <div id="defaultSearchContent">
                </div>
                <div id="searchResults" class="list-group list-group-flush" style="display: none;"></div>
            </div>
        </div>
        <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="index.php">
            <img src="logo.svg" alt="Pepperfry" height="32">
        </a>
        <div class="d-flex align-items-center gap-4">
             <a href="index.php" class="text-decoration-none text-dark fw-bold d-none d-md-block">Home</a>
             <a href="wishlist.php" class="text-decoration-none text-dark"><i class="bi bi-heart fs-5"></i></a>
             <a href="cart.php" class="text-decoration-none text-dark position-relative">
                <i class="bi bi-cart fs-5"></i>
                <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; display: none;">0</span>
             </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Search Results for "<span class="text-orange"><?php echo htmlspecialchars($query); ?></span>"</h4>
        <div class="d-flex gap-2">
            <?php
            function getSortUrl($sortType) {
                global $query, $selectedCategories, $selectedPrices;
                $params = ['query' => $query, 'sort' => $sortType];
                if (!empty($selectedCategories)) $params['category'] = $selectedCategories;
                if (!empty($selectedPrices)) $params['price'] = $selectedPrices;
                return 'search_results.php?' . http_build_query($params);
            }
            $sortLabel = 'Relevance';
            if ($sort == 'price_asc') $sortLabel = 'Price: Low to High';
            if ($sort == 'price_desc') $sortLabel = 'Price: High to Low';
            if ($sort == 'newest') $sortLabel = 'Newest First';
            ?>
            <button class="btn btn-outline-secondary rounded-pill px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sortOffcanvas" aria-controls="sortOffcanvas">
                <i class="bi bi-sort-down"></i> Sort By: <?php echo $sortLabel; ?>
            </button>
            <button class="btn btn-outline-secondary rounded-pill px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas" aria-controls="filterOffcanvas">
                <i class="bi bi-sliders"></i> Filter
            </button>
        </div>
    </div>
    
    <div class="row g-4">

<?php
if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
?>
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm product-card rounded-3 overflow-hidden">
                <div class="product-img-wrapper">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <div class="wishlist-btn shadow-sm" data-id="<?php echo $row['id']; ?>" onclick="handleWishlist(this, '<?php echo addslashes($row['name']); ?>', <?php echo $row['price']; ?>, '<?php echo addslashes($row['image']); ?>', <?php echo $row['id']; ?>)">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <h6 class="card-title text-truncate mb-1" title="<?php echo htmlspecialchars($row['name']); ?>"><?php echo htmlspecialchars($row['name']); ?></h6>
                    <p class="text-muted small mb-2"><?php echo isset($row['category']) ? htmlspecialchars($row['category']) : 'Furniture'; ?></p>
                    <div class="mt-auto">
                        <p class="fw-bold fs-5 mb-2 text-dark">₹<?php echo number_format($row['price']); ?></p>
                        <button class="btn btn-outline-orange w-100 rounded-pill btn-sm fw-bold" 
                                onclick="addToCart('<?php echo addslashes($row['name']); ?>', <?php echo $row['price']; ?>, '<?php echo addslashes($row['image']); ?>', <?php echo $row['id']; ?>)">
                            ADD TO CART
                        </button>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo '
    <div class="col-12">
        <div class="text-center p-5 bg-white rounded-3 shadow-sm" style="margin: 0 auto; max-width: 600px;">
            <div class="mb-4">
                <i class="bi bi-search" style="font-size: 4rem; color: #ff7043;"></i>
            </div>
            <h4 class="fw-bold">No Results Found</h4>
            <p class="text-muted mb-4">We couldn\'t find any products matching your search for "<span class="fw-bold text-dark">' . htmlspecialchars($query) . '</span>".</p>
            <a href="index.php" class="btn btn-primary rounded-pill px-5 py-2" style="background-color: #ff7043; border-color: #ff7043;">Continue Shopping</a>
        </div>
    </div>';
}
?>

    </div>
</div>

<!-- Sort Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="sortOffcanvas" aria-labelledby="sortOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="sortOffcanvasLabel"><i class="bi bi-sort-down me-2"></i>Sort By</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column h-100">
    <div class="flex-grow-1">
        <div class="filter-group-title">Sort Options</div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sortRadio" id="sortRel" value="<?php echo getSortUrl('relevance'); ?>" <?php echo $sort == 'relevance' ? 'checked' : ''; ?>>
            <label class="form-check-label" for="sortRel">Relevance</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sortRadio" id="sortAsc" value="<?php echo getSortUrl('price_asc'); ?>" <?php echo $sort == 'price_asc' ? 'checked' : ''; ?>>
            <label class="form-check-label" for="sortAsc">Price: Low to High</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sortRadio" id="sortDesc" value="<?php echo getSortUrl('price_desc'); ?>" <?php echo $sort == 'price_desc' ? 'checked' : ''; ?>>
            <label class="form-check-label" for="sortDesc">Price: High to Low</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="sortRadio" id="sortNew" value="<?php echo getSortUrl('newest'); ?>" <?php echo $sort == 'newest' ? 'checked' : ''; ?>>
            <label class="form-check-label" for="sortNew">Newest First</label>
        </div>
    </div>
    <div class="d-grid gap-2 mt-auto pt-3 border-top">
        <button class="btn btn-primary fw-bold py-2" type="button" style="background-color: #ff7043; border: none;" onclick="const selected = document.querySelector('input[name=\'sortRadio\']:checked'); if(selected) window.location.href = selected.value;">APPLY SORT</button>
        <button class="btn btn-outline-secondary py-2" type="button" onclick="window.location.href='<?php echo getSortUrl('relevance'); ?>'">RESET</button>
    </div>
  </div>
</div>

<!-- Filter Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="filterOffcanvasLabel"><i class="bi bi-sliders me-2"></i>Filters</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form action="search_results.php" method="GET" id="filterForm" class="h-100 d-flex flex-column">
        <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">
        <input type="hidden" name="sort" value="<?php echo htmlspecialchars($sort); ?>">
        
        <div class="flex-grow-1 overflow-auto pe-2">
            <div class="mb-5">
                <div class="filter-group-title">Price Range</div>
                <?php 
                $prices = [
                    '0-5000' => 'Under ₹5,000',
                    '5000-10000' => '₹5,000 - ₹10,000',
                    '10000-20000' => '₹10,000 - ₹20,000',
                    '20000-999999' => 'Over ₹20,000'
                ];
                foreach($prices as $val => $label): 
                    $checked = in_array($val, $selectedPrices) ? 'checked' : '';
                ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="price[]" value="<?php echo $val; ?>" id="price_<?php echo $val; ?>" <?php echo $checked; ?>>
                    <label class="form-check-label" for="price_<?php echo $val; ?>"><?php echo $label; ?></label>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mb-4">
                <div class="filter-group-title">Category</div>
                <?php 
                $cats = ['Sofas', 'Chairs', 'Tables', 'Beds', 'Dining', 'Storage', 'Decor', 'Lighting'];
                foreach($cats as $cat): 
                    $checked = in_array($cat, $selectedCategories) ? 'checked' : '';
                ?>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $cat; ?>" id="cat_<?php echo $cat; ?>" <?php echo $checked; ?>>
                    <label class="form-check-label" for="cat_<?php echo $cat; ?>"><?php echo $cat; ?></label>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="d-grid gap-2 mt-auto pt-3 border-top">
            <button class="btn btn-primary fw-bold py-2" type="submit" style="background-color: #ff7043; border: none;">APPLY FILTERS</button>
            <button class="btn btn-outline-secondary py-2" type="button" onclick="window.location.href='search_results.php?query=<?php echo urlencode($query); ?>'">CLEAR ALL</button>
        </div>
    </form>
  </div>
</div>

<!-- Toast for Cart notifications -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
  <div id="cartToast" class="toast align-items-center text-white bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        <i class="bi bi-check-circle-fill text-success me-2"></i>
        Item added to your cart successfully!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
