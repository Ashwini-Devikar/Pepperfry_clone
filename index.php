<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pepperfry Clone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container position-relative">
      
          <!-- Left: Search bar -->
    <div class="pf-search-container">
  <div class="pf-search-bar" id="pfSearchBar">
    <input type="text" id="searchInput" placeholder="Search" autocomplete="off" />
    <i class="bi bi-search"></i>
  </div>

  <div class="pf-search-dropdown" id="pfDropdown">
    <div id="defaultSearchContent">
      <p class="title">Popular Searches</p>
      <div class="pf-tags">
        <span onclick="applySearch('4 Door Wardrobes')" style="cursor:pointer;">↗ 4 Door Wardrobes</span>
        <span onclick="applySearch('Book Shelves')" style="cursor:pointer;">↗ Book Shelves</span>
        <span onclick="applySearch('Centre Tables')" style="cursor:pointer;">↗ Centre Tables</span>
        <span onclick="applySearch('Sofa Cum Beds')" style="cursor:pointer;">↗ Sofa Cum Beds</span>
        <span onclick="applySearch('TV Units')" style="cursor:pointer;">↗ TV Units</span>
        <span onclick="applySearch('Bed')" style="cursor:pointer;">↗ Bed</span>
        <span onclick="applySearch('Bed Side Table')" style="cursor:pointer;">↗ Bed Side Table</span>
      </div>
    </div>
    <div id="searchResults" class="list-group list-group-flush" style="display: none;"></div>
  </div>
</div>

      <!-- Center: Logo / Title -->
    <a class="pf-logo" href="#">
  <img src="logo.svg" alt="Pepperfry">
</a>

 <!-- Right: Icons and Links -->
<div class="d-flex align-items-center gap-4 right-navbar">

  <!-- Sign Up (WRAPPED) -->
<?php if (isset($_SESSION['user_id'])) { ?>

  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle fs-4 me-2"></i>
        <span><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'User'); ?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
    </ul>
  </div>

<?php } else { ?>

<div class="signup-wrapper position-relative d-flex align-items-center">
  <div class="text-end me-3">
    <div class="signup-text">Sign Up Now</div>
    <div class="offer-text">Get Upto Rs. 1,500 off</div>
  </div>
  <i class="bi bi-person signup-icon"></i>

  <div class="signup-dropdown">
    <div class="top-bar"></div>
    <h6>Welcome</h6>
    <p>Register now and Get Exclusive Benefits!</p>
    <button class="btn signup-btn" data-bs-toggle="modal" data-bs-target="#loginModal">
      LOGIN / SIGNUP
    </button>
  </div>
</div>
<?php } ?>

  <!-- Find a Store -->
  <div class="d-flex align-items-center store-wrapper">
    <div class="text-end me-3">
      <div class="signup-text">Find a</div>
      <div class="store-text">Store</div>
    </div>
    <i class="bi bi-shop nav-icon"></i>
  </div>

  <!-- Wishlist -->
  <a href="wishlist.php" class="text-decoration-none text-dark">
    <i class="bi bi-heart nav-icon"></i>
  </a>

  <!-- Cart -->
<div class="nav-item position-relative d-inline-block">
  <a href="cart.php" class="text-decoration-none">
    <i class="bi bi-cart nav-icon" style="font-size: 1.5rem; cursor: pointer;"></i>
    <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem; display: none;">
      0
    </span>
  </a>
</div>

</div>
  </nav>

<div class="pf-category-bar">
  <ul class="pf-category-list">

    <!-- FURNITURE -->
    <li class="pf-item">
      <a href="#">Furniture</a>
      <div class="pf-mega">
        <div class="pf-mega-wrap">

          <div class="pf-mega-cols">
            <div class="pf-col grey">
            <div class="pf-col">
              <h6>Sofas</h6>
              <a href="#">3 Seater Sofas</a>
              <a href="#">2 Seater Sofas</a>
              <a href="#">1 Seater Sofas</a><br>

              <h6>Sectional Sofas</h6>
              <a href="#"> LHS Sectionals</a>
              <a href="#"> RHS Sectionals</a>
              <a href="#"> Corner Sofas</a><br>

              <h6>Sofa Cum Beds </h6><br>
              <h6>Chaise Loungers</h6><br>
              <h6>Bean Bags</h6><br>
            </div>
            </div>

          <div class="pf-col white">
            <div class="pf-col">
              <h6>Recliners</h6>
              <a href="#">1 Seater Recliners</a>
              <a href="#">2 Seater Recliners</a>
              <a href="#">3 Seater Recliners</a>
              <a href="#">Recliners Sets</a><br>

  
              <h6>Sofa Chairs</h6>
              <a href="#">Wing Chairs</a>
              <a href="#">Lounge Chairs</a>
              <a href="#">Slipper Chairs</a>
              <a href="#">Barrel Chairs</a><br>
    
              <h6>Settees & Benches</h6>
              <a href="#">Settees</a>
              <a href="#">Benches</a>
              <a href="#"> Recamiers </a><br>

              <h6>Ottomans</h6>
            </div>
          </div>

          <div class="pf-col grey">
            <div class="pf-col">
              <h6>Chairs</h6>
              <a href="#">Arm Chairs</a>
              <a href="#">Rocking Chairs</a>
              <a href="#">Folding Chairs</a>
              <a href="#">Iconic Chairs</a>
              <a href="#">Chairs</a><br>
              
              <h6>Gaming Chairs</h6><br>

              <h6>Stools & Pouffes</h6>
              <a href="#">Foot Stools</a>
              <a href="#">Seating Stools</a>
              <a href="#">Pouffes</a><br>

              <h6>Shoe Racks</h6>
              <a href="#">Shoe Cabinets</a>
              <a href="#">Open Shoe Racks</a>
              <a href="#">Shoe Rack & Seat</a>
              <a href="#">Tilt Out Shoe Racks</a>
            </div>
          </div>

          <div class="pf-col white">
           <div class="pf-col">
              <h6>Centre Tables</h6>
              <a href="#">Coffee Tables</a>
              <a href="#">Coffee Table Sets</a>
              <a href="#">Nesting Tabless</a><br>

              <h6>Side Tables</h6>
              <a href="#">End Tables</a>
              <a href="#">C shaped Tables</a>
              <a href="#">Console Tables</a>
              <a href="#">Nest of Tables</a><br>

              <h6>Cabinet & Sideboards</h6>

              <h6>TV & Media Units</h6><br>
              <h6>Cabinets & Sideboards</h6><br>
              <h6>Book Shelves</h6><br>
              <h6>Book Cases</h6><br>
            </div>
          </div>

        <!-- DINING -->
          <div class="pf-col grey">
        <div class="pf-col">
          <h6>Dining Sets</h6>
          <a href="#">2 Seater</a>
          <a href="#">4 Seater</a>
          <a href="#">6 Seater</a>
          <a href="#">8 Seater</a><br>

          <h6>Dining Chairs</h6><br>
          <h6>Dining Tables</h6><br>
          <h6>Crockery Units</h6><br>
          <h6>Bar Furniture</h6>
          <a href="#">Bar Cabinets</a>
          <a href="#">Bar Trolley</a>
          <a href="#">Bar Stools</a>
          <a href="#">Bar Table Sets</a>
          <a href="#">Bar Chairs</a>
          <a href="#">Bar Seating</a>
        </div>
          </div>

        <!-- BEDS -->
          <div class="pf-col white">
        <div class="pf-col">
          <h6>Beds</h6>
          <a href="#">Queen Size Beds</a>
          <a href="#">King Size Beds</a>
          <a href="#">Single Beds</a>
          <a href="#">Poster Beds</a>
          <a href="#">Folding Beds</a><br>

          <h6>Bedside Tables</h6><br>
          <h6>Trunks</h6><br>
          <h6>Chest of Drawers</h6><br>

          <h6>Dressing Tables</h6>
          <a href="#">Dressers</a>
          <a href="#">Dressing Cabinets</a>
          <a href="#">Dressing Units</a>
        </div>
          </div>

        <!-- DRESSING & WARDROBES -->
          <div class="pf-col grey">
        <div class="pf-col">
          <h6>Wardrobes</h6>
          <a href="#">1 Door Wardrobes</a>
          <a href="#">2 Door Wardrobes</a>
          <a href="#">3 Door Wardrobes</a>
          <a href="#">4 Door Wardrobes</a>
          <a href="#">4+ Door Wardrobes</a>
          <a href="#">Sliding Door</a><br>

          <h6>Kids & Teens</h6>
          <a href="#">Cribs</a>
          <a href="#">Kids Beds</a>
          <a href="#">Bunk Beds</a>
          <a href="#">Study</a>
          <a href="#">Wardrobes</a>
          <a href="#">Book Shelves</a>
          <a href="#">Storage</a>
          <a href="#">Seating</a><br>
        </div>
          </div>

        <!-- STUDY -->
          <div class="pf-col white">
        <div class="pf-col">
          <h6>Study Tables</h6>
          <a href="#">Writing Tables</a>
          <a href="#">Computer Tables</a>
          <a href="#">Hutch Desks</a>
          <a href="#">Foldable Tables</a>
          <a href="#">Wall Mounted Tables</a><br>

          <h6>Office Furniture</h6>
          <a href="#">Office Chairs</a>
          <a href="#">Office Tables</a>
          <a href="#">Office Cabinets</a><br>

          <h6>Furniture Care</h6>
          <a href="#">Solid Wood Care Kits</a>
          <a href="#">Fabric Care Kits</a>
        </div>
          </div>

        </div>
      </div>
    </li>

    <!-- SOFAS & SEATING -->
    <li class="pf-item">
      <a href="#">Sofas & Seating</a>
      <div class="pf-mega">
         <div class="pf-mega-inner">
               <div class="pf-mega-wrap">
          <div class="pf-mega-cols">

    <!-- COLUMN 1 -->
    <div class="pf-col grey">
      <h6>Sofas</h6>
      <a href="#">3 Seater Sofas</a>
      <a href="#">2 Seater Sofas</a>
      <a href="#">1 Seater Sofas</a><br>

      <h6>Sofa Sets</h6><br>

      <h6>Sectional Sofas</h6>
      <a href="#">LHS Sectionals</a>
      <a href="#">RHS Sectionals</a>
      <a href="#">Corner Sofas</a><br>

      <h6>Sofa Cum Beds</h6>
      <a href="#">Pull Out Type</a>
      <a href="#">Convertible Type</a>
    </div>

    <!-- COLUMN 2 -->
    <div class="pf-col white">
      <h6>Recliners</h6>
      <a href="#">1 Seater Recliners</a>
      <a href="#">2 Seater Recliners</a>
      <a href="#">3 Seater Recliners</a><br>

      <h6>Recliner Sets</h6><br>

      <h6>Chaise Loungers</h6><br>

      <h6>Sofa Chairs</h6>
      <a href="#">Wing Chairs</a>
      <a href="#">Lounge Chairs</a>
      <a href="#">Slipper Chairs</a>
      <a href="#">Barrel Chairs</a>
    </div>

    <!-- COLUMN 3 -->
    <div class="pf-col grey">
      <h6>Bean Bags</h6><br>

      <h6>Accent Chairs</h6>
      <a href="#">Arm Chairs</a>
      <a href="#">Rocking Chairs</a>
      <a href="#">Folding Chairs</a>
      <a href="#">Iconic Chairs</a>
      <a href="#">Cafe Chairs</a><br>

      <h6>Office Chairs</h6>
      <a href="#">Ergonomic Chairs</a>
      <a href="#">Executive Chairs</a>
      <a href="#">Training Chairs</a>
      <a href="#">Guest Chairs</a>
      <a href="#">Cantilever Chairs</a>
    </div>

    <!-- COLUMN 4 -->
    <div class="pf-col white">
      <h6>Gaming Chairs</h6><br>

      <h6>Dining Chairs</h6><br>

      <h6>Bar Seating</h6>
      <a href="#">Bar Stools & Chairs</a>
      <a href="#">Bar Table Sets</a><br>

      <h6>Settees & Benches</h6>
      <a href="#">Settees</a>
      <a href="#">Benches</a>
      <a href="#">Recamiers</a>
    </div>

    <!-- COLUMN 5 -->
    <div class="pf-col grey">
      <h6>Ottomans</h6><br>

      <h6>Stools & Pouffes</h6>
      <a href="#">Foot Stools</a>
      <a href="#">Seating Stools</a>
      <a href="#">Pouffes</a><br>

      <h6>Outdoor Seating</h6>
      <a href="#">Loungers</a>
      <a href="#">Chairs</a>
      <a href="#">Swings</a>
      <a href="#">Plastic Chairs</a>
      <a href="#">Table & Chair Sets</a>
    </div>

    <!-- COLUMN 6 -->
    <div class="pf-col white">
      <h6>Furniture Care</h6>
      <a href="#">Fabric Care Kits</a>
      <a href="#">Solid Wood Care Kits</a><br>

      <h6>Top Collections</h6>
      <a href="#">Alba</a>
      <a href="#">Andres</a>
      <a href="#">Brescia</a>
      <a href="#">Clarkson</a>
      <a href="#">Fidel</a>
      <a href="#">Hugo</a>
      <a href="#">Indus</a>
      <a href="#">Ines</a>
      <a href="#">Miranda</a>
      <a href="#">Mireya</a>
      <a href="#">Mystic</a>
      <a href="#">Nirvana</a>
      <a href="#">Norton</a>
      <a href="#">Tochi</a>
      <a href="#">Wakizashi</a>
    </div>

  </div>
</div>
          <div class="pf-mega-images">
            <img src="images/sofas.webp">
          </div>
         </div>
    </li>

    <!-- MATTRESSES -->
    <li class="pf-item">
      <a href="#">Mattresses</a>
      <div class="pf-mega">
        <div class="pf-mega-wrap">
          <div class="pf-mega-cols">
             <!-- LEFT : COLUMNS -->

      <!-- COLUMN 1 -->
      <div class="pf-col grey">
        <h6>King Size Mattresses</h6>
        <a href="#">Foam</a>
        <a href="#">Spring</a>
        <a href="#">Latex</a>
        <a href="#">Coir</a><br>

        <h6>Queen Size Mattresses</h6>
        <a href="#">Foam</a>
        <a href="#">Spring</a>
        <a href="#">Latex</a>
        <a href="#">Coir</a>
      </div>

       <!-- COLUMN 2 -->
      <div class="pf-col white">
        <h6>Single Size Mattresses</h6>
        <a href="#">Foam</a>
        <a href="#">Spring</a>
        <a href="#">Latex</a>
        <a href="#">Coir</a><br>

        <h6>Foldable Mattresses</h6>
        <a href="#">King Size</a>
        <a href="#">Queen Size</a>
        <a href="#">Single</a><br>

        <h6>Crib Mattresses</h6>
      </div>

           <!-- COLUMN 3 -->
      <div class="pf-col grey">
        <h6>Mattress Protectors</h6>
        <a href="#">King Size</a>
        <a href="#">Queen Size</a>
        <a href="#">Single</a><br>

        <h6>Mattress Toppers</h6><br>

        <h6>Pillows</h6>
        <a href="#">Sleeping Pillows</a>
        <a href="#">Body Pillows</a>
        <a href="#">Pregnancy Pillows</a>
        <a href="#">Bed Wedges</a><br>
      </div>

         <!-- COLUMN 4 -->
      <div class="pf-col white">
        <h6>Mattresses By Feature</h6>
        <a href="#">Orthopaedic</a>
        <a href="#">Cooling Technology</a>
        <a href="#">Flippable</a>
        <a href="#">Low Motion Transfer</a><br>

        <h6>Top Brands</h6>
        <a href="#">Clouddio from Pepperfry</a>
        <a href="#">Centuary Mattresses</a>
        <a href="#">Coirfit</a>
        <a href="#">Durfi</a>
        <a href="#">DuroFlex</a>
        <a href="#">Kurl-On</a>
        <a href="#">Nilkamal Sleep</a>
        <a href="#">Sleepwell</a>
        <a href="#">Sleepycat</a>
        <a href="#">Sleepyhead</a>
        <a href="#">Springfit</a>
        <a href="#">Springtek</a>
        <a href="#">The Sleep Company</a>
        <a href="#">Usha Shriram</a>
        <a href="#">Wakeup India</a>
      </div>

          <div class="pf-mega-images">
            <img src="images/pillow.webp">
          </div>

          <div class="pf-mega-images">
            <img src="images/mattress.webp">
          </div>

        </div>
      </div>
    </li>

    <!-- HOME DECOR -->
    <li class="pf-item">
      <a href="#">Home Decor</a>
      <div class="pf-mega">
        <div class="pf-mega-wrap">

          <div class="pf-mega-cols">
            <div class="pf-col grey">
          <h6>Vases</h6>
          <a href="#">Table Vases</a>
          <a href="#">Floor Vases</a><br>

          <h6>Showpieces & Collectibles</h6>
          <a href="#">Figurines</a>
          <a href="#">Collectibles</a>
          <a href="#">Showpieces</a><br>

          <h6>Table Decor</h6>
          <a href="#">Decorative Boxes</a>
          <a href="#">Desk Organizers</a>
          <a href="#">Magazine Racks</a>
          <a href="#">Pen Stands</a>
          <a href="#">Bookends</a>
          <a href="#">Accessory Holders</a>
        </div>

        <div class="pf-col white">
          <h6>Wall Decor</h6>
          <a href="#">Wall Shelves</a>
          <a href="#">Wall Art</a>
          <a href="#">Metal Wall Art</a>
          <a href="#">Wooden Wall Art</a>
          <a href="#">Wall Plates & Tiles</a>
          <a href="#">Wall Masks</a>
          <a href="#">World Map & Quotes</a><br>

          <h6>Mirrors</h6>
          <a href="#">Wall Mirrors</a>
          <a href="#">Decorative Mirrors</a>
          <a href="#">Floor Mirrors</a>
          <a href="#">Full Length Mirrors</a>
          <a href="#">LED Mirrors</a><br>

          <h6>Clocks</h6>
          <a href="#">Wall Clocks</a>
          <a href="#">Platform Clocks</a>
          <a href="#">Pendulum Clocks</a>
          <a href="#">Cuckoo Clocks</a>
          <a href="#">Table Clocks</a>
        </div>

        <div class="pf-col grey">
          <h6>Spiritual</h6>
          <a href="#">Mandirs</a>
          <a href="#">Pooja Shelves</a>
          <a href="#">Religious Idols</a>
          <a href="#">Religious Frames</a>
          <a href="#">Chowkies</a>
          <a href="#">Vastu and Feng Shui</a><br>

          <h6>Prayer Essentials</h6>
          <a href="#">Bells & Pooja Utensils</a>
          <a href="#">Haldi Kumkum Box</a>
          <a href="#">Diyas & Incense Holders</a>
          <a href="#">Incense & Camphor</a><br>

          <h6>Festive Decor</h6>
          <a href="#">Christmas Decorations</a>
          <a href="#">Urli & Torans</a>
          <a href="#">Rangolis</a>
          <a href="#">Decorative Diyas</a>
        </div>

        <div class="pf-col white">
          <h6>Home Utility</h6>
          <a href="#">Vacuum Cleaners</a>
          <a href="#">Drawer Organizers</a>
          <a href="#">Bath Accessories</a>
          <a href="#">Laptop Tables</a>
          <a href="#">Rain Essentials</a><br>

          <h6>Gardening</h6>
          <a href="#">Natural Plants & Seeds</a>
          <a href="#">Gardening Tools</a>
          <a href="#">Planter Stands</a>
          <a href="#">Pots (Desk, Wall, Floor)</a>
          <a href="#">Hanging & Railing Planters</a><br>

          <h6>Fragrance & Candles</h6>
          <a href="#">Scented & Decorative Candles</a>
          <a href="#">Tea Lights & Holders</a>
          <a href="#">Diffusers & Aroma Oils</a>
          <a href="#">Sprays</a>
        </div>

        <div class="pf-col grey">
          <h6>Prayer Essentials</h6>
          <a href="#">Bells</a>
          <a href="#">Pooja Utensils & Wares</a>
          <a href="#">Haldi Kumkum Box</a>
          <a href="#">Diyas</a>
          <a href="#">Incense Holders</a>
          <a href="#">Incense Sticks, Cones & Camphor</a><br>

          <h6>Festive Decor</h6>
          <a href="#">Christmas Decorations</a>
          <a href="#">Tea Light and Candle Holders</a>
          <a href="#">Urli</a>
          <a href="#">Torans</a>
          <a href="#">Rangolis</a>
          <a href="#">Decorative Diyas</a>
        </div>

        <div class="pf-col white">
          <h6>Gardening</h6>
          <a href="#">Natural Plants</a>
          <a href="#">Seeds</a>
          <a href="#">Gardening Tools</a>
          <a href="#">Planter Stands</a>
          <a href="#">Plant Care</a><br>

          <h6>Pots and Planters</h6>
          <a href="#">Desk Pots</a>
          <a href="#">Wall Planters</a>
          <a href="#">Floor Planters</a>
          <a href="#">Hanging Planters</a>
          <a href="#">Railing Planters</a><br>

          <h6>Outdoor Decor</h6>
          <a href="#">Fountains</a>
          <a href="#">Garden Figurines</a>
          <a href="#">Artificial Grass</a>
        </div>

        <div class="pf-col grey">
          <h6>Wall Decor</h6>
          <a href="#">Metal Wall Art</a>
          <a href="#">Wooden Wall Art</a>
          <a href="#">Wall Plates & Tiles</a>
          <a href="#">Wall Masks</a>
          <a href="#">World Map</a>
          <a href="#">Quotes</a><br>

          <h6>Wall Art & Paintings</h6>
          <a href="#">Art Prints</a>
          <a href="#">Art Panels</a>
          <a href="#">Hand Paintings</a>
          <a href="#">Ethnic Art</a><br>

          <h6>Wallpapers & Decals</h6>
          <a href="#">Wall Stickers</a>
          <a href="#">Wallpaper for Wall</a>
        </div>

        <div class="pf-col white">
          <h6>Wall Storage & Accents</h6>
          <a href="#">Wall Shelves</a>
          <a href="#">Wall Cabinets</a>
          <a href="#">Set Top Box Holders</a>
          <a href="#">Key Holders</a>
          <a href="#">Jharokhas</a>
          <a href="#">Screens & Dividers</a><br>

          <h6>Mirrors</h6>
          <a href="#">Wall Mirrors</a>
          <a href="#">Decorative Mirrors</a>
          <a href="#">Floor Mirrors</a>
          <a href="#">Full Length Mirrors</a>
          <a href="#">LED Mirrors</a>
          <a href="#">Mirror Sets</a><br>

          <h6>Gifting</h6>
          <a href="#">Festive Gifts</a>
        </div>
        </div>
      </div>
    </li>
    <li class="pf-item"><a href="#">Furnishings</a>
      <div class="pf-mega">
    <div class="pf-mega-wrap">
      <div class="pf-mega-cols">

        <div class="pf-col grey">
          <h6>Bed Sheets</h6>
          <a href="#">Queen Bed Sheets</a>
          <a href="#">King Bed Sheets</a>
          <a href="#">Fitted Bed Sheets</a>
          <a href="#">Single Bed Sheets</a><br>

          <h6>Blankets & Quilts</h6>
          <a href="#">Quilts & Dohars</a>
          <a href="#">Blankets & Polar Blankets</a>
          <a href="#">Duvet Covers & Inserts</a><br>

          <h6>Bedding Essentials</h6>
          <a href="#">Pillow Covers</a>
          <a href="#">Bedding Sets</a>
          <a href="#">Diwan Sets</a>
          <a href="#">Bed Covers & Runners</a>
        </div>

        <div class="pf-col white">
          <h6>Bath Linen</h6>
          <a href="#">Bath Towels</a>
          <a href="#">Hand & Face Towels</a>
          <a href="#">Beach Towels & Sets</a>
          <a href="#">Bath Robes & Hair Wraps</a><br>

          <h6>Curtains & Accessories</h6>
          <a href="#">Door & Window Curtains</a>
          <a href="#">Blinds & Shower Curtains</a>
          <a href="#">Curtain Rods & Tracks</a>
          <a href="#">Tie Backs</a><br>

          <h6>Utility & Gifts</h6>
          <a href="#">Laundry Baskets</a>
          <a href="#">Mosquito Nets</a>
          <a href="#">Furnishing Gift Sets</a>
        </div>

        <div class="pf-col grey">
          <h6>Carpets By Size</h6>
          <a href="#">3 ft x 5 ft</a>
          <a href="#">4 ft x 6 ft</a>
          <a href="#">5 ft x 7 ft</a>
          <a href="#">6 ft x 9 ft</a>
          <a href="#">8 ft x 10 ft / 9 ft x 12 ft</a><br>

          <h6>Carpets By Type</h6>
          <a href="#">Abstract & Round Carpets</a>
          <a href="#">Machine Made</a>
          <a href="#">Hand Woven & Tufted</a>
          <a href="#">Shaggy & Flat Weave</a><br>

          <h6>Dhurries & Runners</h6>
          <a href="#">Cotton & Woolen Dhurries</a>
          <a href="#">Jute & Polyester Dhurries</a>
          <a href="#">Floor Runners</a>
        </div>

        <div class="pf-col white">
          <h6>Cushions & Covers</h6>
          <a href="#">Cushion Covers & Inserts</a>
          <a href="#">Floor & Shaped Cushions</a>
          <a href="#">Sofa Covers & Throws</a>
          <a href="#">Chair Covers & Pads</a><br>

          <h6>Kids & Pets</h6>
          <a href="#">Kids Bedding & Curtains</a>
          <a href="#">Kids Carpets & Baby Mats</a>
          <a href="#">Pet Blankets & Mats</a><br>

          <h6>Top Brands</h6>
          <a href="#">Jaipur Rugs</a>
          <a href="#">Maspar</a>
          <a href="#">Saral Home</a>
          <a href="#">Obsessions</a>
          <a href="#">Obeetee</a>
        </div>

        <div class="pf-col grey">
          <h6>Carpets</h6>
          <a href="#">3 ft x 5 ft</a>
          <a href="#">5 ft x 7 ft</a>
          <a href="#">4 ft x 6 ft</a>
          <a href="#">6 ft x 9 ft</a>
          <a href="#">8 ft x 10 ft</a>
          <a href="#">9 ft x 12 ft</a>
          <a href="#">Round Carpets</a>
          <a href="#">Abstract Carpets</a><br>

          <h6>Runners & Weaves</h6>
          <a href="#">Runners</a>
          <a href="#">Machine Made</a>
          <a href="#">Hand Woven</a>
          <a href="#">Hand Tufted</a>
          <a href="#">Shaggy</a>
          <a href="#">Flat Weave</a>
        </div>

        <div class="pf-col white">
          <h6>Dhurries</h6>
          <a href="#">Cotton Dhurries</a>
          <a href="#">Woolen Dhurries</a>
          <a href="#">Jute Dhurries</a>
          <a href="#">Polyester Dhurries</a>
          <a href="#">Blended Dhurries</a><br>

          <h6>Mats</h6>
          <a href="#">Door Mats</a>
          <a href="#">Bath Mats</a>
          <a href="#">Picnic Mats</a>
          <a href="#">Yoga Mats</a><br>

          <h6>Pet Furnishings</h6>
          <a href="#">Pet Blankets</a>
          <a href="#">Pet Mats</a>
        </div>

        <div class="pf-mega-images">
          <img src="images/bedsheets.webp">
        </div>
      </div>
    </div>
  </div>
    
    </li>
    <li class="pf-item"><a href="#">Lamps & Lighting</a>
    <div class="pf-mega">
    <div class="pf-mega-wrap">
      <div class="pf-mega-cols">

        <div class="pf-col grey">
          <h6>Floor & Table Lamps</h6>
          <a href="#">Floor Lamps</a>
          <a href="#">Shelf Floor Lamps</a>
          <a href="#">Table Lamps</a>
          <a href="#">Night Lamps</a>
          <a href="#">Work and Study Lamps</a>
          <a href="#">Lamp Shades</a>
          <a href="#">Kids Lamps</a><br>

          <h6>Smart Lights</h6>
          <a href="#">Smart Ceiling Lights</a>
          <a href="#">Smart Chandeliers</a>
          <a href="#">Smart Lamps</a>
          <a href="#">Smart Bulbs</a>
        </div>

        <div class="pf-col white">
          <h6>Ceiling Lights</h6>
          <a href="#">Hanging Lights</a>
          <a href="#">Chandeliers</a>
          <a href="#">Ceiling Flush Mounts</a>
          <a href="#">Panel Lights</a><br>

          <h6>Wall Lights</h6>
          <a href="#">Wall Lamps</a>
          <a href="#">Wall Flush Mounts</a>
          <a href="#">Picture Lights</a><br>

          <h6>Functional Lighting</h6>
          <a href="#">Spot and Track Lights</a>
          <a href="#">Tube Lights & Battens</a>
          <a href="#">Emergency Lights</a>
        </div>

        <div class="pf-col grey">
          <h6>Outdoor Lights</h6>
          <a href="#">Outdoor Hanging Lights</a>
          <a href="#">Outdoor Wall Lights</a>
          <a href="#">Gate Lights</a>
          <a href="#">Garden Lights</a><br>

          <h6>Decorative Lights</h6>
          <a href="#">String Lights</a>
          <a href="#">Festive Lights</a>
          <a href="#">Neon Lights</a><br>

          <h6>Bulbs</h6>
          <a href="#">Filament Bulbs</a>
          <a href="#">LED Bulbs</a>
        </div>

        <div class="pf-col white">
          <h6>Top Brands</h6>
          <a href="#">Orange Tree</a>
          <a href="#">Homesake</a>
          <a href="#">Kapoor Lampshades</a>
          <a href="#">Eliante by Jainsons Lites</a>
          <a href="#">LeArc Designer Lighting</a>
          <a href="#">HabereIndia</a>
          <a href="#">Stello</a>
          <a href="#">Laspia by Lafit</a>
          <a href="#">Home4U</a>
        </div>

        <div class="pf-mega-images">
          <img src="images/lamps.webp">
        </div>
      </div>
    </div>
  </div>
    </li>
    <li class="pf-item"><a href="#">Kitchen & Dining</a>
    <div class="pf-mega">
    <div class="pf-mega-wrap">
      <div class="pf-mega-cols">

        <div class="pf-col grey">
          <h6>Dinnerware</h6>
          <a href="#">Dinnerware Sets</a>
          <a href="#">Bowls</a>
          <a href="#">Dinner Plates</a>
          <a href="#">Side Plates</a><br>

          <h6>Serveware</h6>
          <a href="#">Serving Bowls</a>
          <a href="#">Casseroles</a>
          <a href="#">Butter Dishes</a>
          <a href="#">Serving Trays & Sets</a>
          <a href="#">Appetizer Platters</a>
          <a href="#">Cheese Boards</a>
          <a href="#">Cake Stands & Cloche</a>
          <a href="#">Jugs</a><br>

          <h6>Bakeware</h6>
          <a href="#">Baking Dishes</a>
          <a href="#">Baking Tools</a>
        </div>

        <div class="pf-col white">
          <h6>Cookware</h6>
          <a href="#">Pots and Pans</a>
          <a href="#">Kadhai & Woks</a><br>

          <h6>Cooking Tools</h6>
          <a href="#">Spatulas, Ladles and Tongs</a>
          <a href="#">Knives and Choppers</a>
          <a href="#">Chopping Boards</a>
          <a href="#">Rolling Pins and Boards</a>
          <a href="#">Strainers and Whisks</a>
          <a href="#">Cooking Preparation Tools</a><br>

          <h6>Knives & Cutlery</h6>
          <a href="#">Cutlery Sets</a>
          <a href="#">Knife Sets</a>
          <a href="#">Serving Cutlery</a>
          <a href="#">Cutlery Holders</a>
        </div>

        <div class="pf-col grey">
          <h6>Drinkware</h6>
          <a href="#">Everyday Glasses</a>
          <a href="#">Whiskey & Wine Glasses</a>
          <a href="#">Champagne & Cocktail Glasses</a>
          <a href="#">Shot Glasses & Beer Mugs</a>
          <a href="#">Bottles, Flasks & Sippers</a><br>

          <h6>Barware</h6>
          <a href="#">Barware Sets & Tools</a>
          <a href="#">Ash Trays</a>
          <a href="#">Wine Holders & Coolers</a>
          <a href="#">Carafes and Decanters</a>
          <a href="#">Dispensers & Ice Buckets</a><br>

          <h6>Teaware & Coffee</h6>
          <a href="#">Tea Cups and Saucer Sets</a>
          <a href="#">Tea Pots</a>
          <a href="#">Coffee Mugs & Tumblers</a>
        </div>

        <div class="pf-col white">
          <h6>Kitchen Storage & Organizers</h6>
          <a href="#">Jars and Containers</a>
          <a href="#">Kitchen Racks & Cabinets</a>
          <a href="#">Microwave Stands</a>
          <a href="#">Dish Drainers</a>
          <a href="#">Spice Boxes & Oil Dispensers</a>
          <a href="#">Egg Trays & Lunch Boxes</a><br>

          <h6>Table Essentials & Linen</h6>
          <a href="#">Coasters & Trivets</a>
          <a href="#">Tissue Holders & Baskets</a>
          <a href="#">Kitchen & Table Linen Sets</a>
          <a href="#">Aprons & Oven Gloves</a><br>

          <h6>Top Brands</h6>
          <a href="#">Luminarc</a>
          <a href="#">Trovea's</a>
          <a href="#">The Home Co.</a>
        </div>

        <div class="pf-mega-images">
          <img src="images/kitchen.webp">
        </div>

      </div>
    </div>
  </div>
    </li>
    <li class="pf-item"><a href="#">Luxury</a>
    <div class="pf-mega">
    <div class="pf-mega-wrap">
      <div class="pf-mega-cols">

        <div class="pf-col grey">
          <h6>Living Room</h6>
          <a href="#">Sofas</a>
          <a href="#">Recliners</a>
          <a href="#">Chairs</a>
          <a href="#">Coffee Tables</a>
          <a href="#">Side Tables</a>
          <a href="#">Console Table</a>
          <a href="#">TV and Media Units</a>
        </div>

        <div class="pf-col white">
          <h6>Bedroom</h6>
          <a href="#">Beds</a>
          <a href="#">Bedside Tables</a>
          <a href="#">Wardrobes</a>
          <a href="#">Benches</a>
          <a href="#">Chest of Drawers</a>
        </div>

        <div class="pf-col grey">
          <h6>Dining Room</h6>
          <a href="#">Dining Sets</a>
          <a href="#">Dining Tables</a>
          <a href="#">Dining Chairs</a>
          <a href="#">Sideboards</a>
          <a href="#">Bar Cabinets</a>
        </div>

        <div class="pf-col white">
          <h6>Home Office</h6>
          <a href="#">Study Tables</a>
          <a href="#">Office Chairs</a>
          <a href="#">Book Cases</a>
        </div>

        <div class="pf-mega-images">
          <img src="images/marble.webp">
        </div>

        <div class="pf-mega-images">
          <img src="images/leather sofa.webp">
        </div>

      </div>
    </div>
  </div>

<li class="pf-item pf-modular">
  <a href="#">Modular</a>

  <div class="pf-mega pf-mega-modular">
    <div class="pf-mega-wrap">
      <div class="pf-mega-inner">
         <img src="images/modular1.webp" alt="Modular Kitchen" class="w-100">
      </div>
    </div>
  </div>
</li>
</div>


  <!-- Hero Section -->
<section class="container pf-hero my-4">
  <div class="row g-3">
    
    <div class="col-lg-8 col-md-12">
      <div class="pf-hero-left h-100">
        <a href="#">
          <img src="images/ad.webp" class="img-fluid w-100 h-100 object-fit-cover shadow-sm" alt="Main Banner">
        </a>
      </div>
    </div>
<div class="col-lg-4 col-md-12">
  <div class="pf-hero-right h-100">
    <div id="heroSlider" class="carousel slide h-100 overflow-hidden" data-bs-ride="carousel" data-bs-interval="2000">
      
      <div class="carousel-indicators pf-dots">
        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="4" aria-label="Slide 5"></button>
      </div>

      <div class="carousel-inner h-100">
        <div class="carousel-item active h-100">
          <img src="images/first.webp" class="d-block w-100 h-100 object-fit-cover" alt="Slide 1">
        </div>
        <div class="carousel-item h-100">
          <img src="images/second.webp" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
        </div>
        <div class="carousel-item h-100">
          <img src="images/third.jpg" class="d-block w-100 h-100 object-fit-cover" alt="Slide 3">
        </div>
        <div class="carousel-item h-100">
          <img src="images/fourth.webp" class="d-block w-100 h-100 object-fit-cover" alt="Slide 4">
        </div>
        <div class="carousel-item h-100">
          <img src="images/fifth.webp" class="d-block w-100 h-100 object-fit-cover" alt="Slide 5">
        </div>
      </div>
    </div>
  </div>
</div>

  </div>
</section>


<div class="container pf-layout-container my-4">
  <div class="row">
    <div class="col-12">
      <a href="#" class="d-block shadow-sm hover-lift transition rounded overflow-hidden">
        <img src="images/coupon.webp" 
             class="img-fluid w-100" 
             alt="Special Offer Coupon">
      </a>
    </div>
  </div>
</div>

<div class="container pf-layout-container my-4">
  <div class="row g-3">
    
    <div class="col-md-4">
      <div class="hover-zoom shadow-sm overflow-hidden">
        <img src="images/buy1.webp" class="img-fluid w-100" alt="Buy 1 Get 1">
      </div>
    </div>

    <div class="col-md-4">
      <div class="hover-zoom shadow-sm overflow-hidden">
        <img src="images/spin.webp" class="img-fluid w-100" alt="Spin and Win">
      </div>
    </div>

    <div class="col-md-4">
      <div class="hover-zoom shadow-sm overflow-hidden">
        <img src="images/spacewood.webp" class="img-fluid w-100" alt="Spacewood Furniture">
      </div>
    </div>

  </div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12 text-center">
      <h4 class="fw-bold mb-0" style="color: #84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
        Visit Our Store
      </h4>
    </div>
  </div>
</div>

<div class="container-fluid p-0 overflow-hidden">
  <div class="row g-0">
    <div class="col-12">
      <a href="#" class="d-block w-100">
        <img src="images/pf.webp" class="w-100 d-block" alt="Visit Our Store Offer">
      </a>
    </div>
  </div>
</div>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12 text-center">
      <h4 class="fw-bold mb-0" style="color:#84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
        Shop All Things Home
      </h4>
    </div>
  </div>
</div>

<div class="container mb-5">
  <div class="nav d-flex flex-wrap justify-content-center gap-3 mb-5" role="tablist">
    <button class="pf-pill active" data-bs-toggle="pill" data-bs-target="#living" type="button" role="tab">Living Room</button>
    <button class="pf-pill" data-bs-toggle="pill" data-bs-target="#bedroom" type="button" role="tab">Bed Room</button>
    <button class="pf-pill" data-bs-toggle="pill" data-bs-target="#dining" type="button" role="tab">Dining Room</button>
    <button class="pf-pill" data-bs-toggle="pill" data-bs-target="#study" type="button" role="tab">Study Room</button>
    <button class="pf-pill" data-bs-toggle="pill" data-bs-target="#solid" type="button" role="tab">Solid Wood</button>
    <button class="pf-pill" data-bs-toggle="pill" data-bs-target="#engineered" type="button" role="tab">Engineered Wood</button>
    <button class="pf-pill" data-bs-toggle="pill" data-bs-target="#luxury" type="button" role="tab">Luxury Furniture</button>
  </div>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="living" role="tabpanel">
<div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 pf-mobile-scroll">
        
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomsofa.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomcentretables.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomsofachairs.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomcabinets.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomwallarts.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomhanginglights.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingmandir.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingchair.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingrecliners.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingtv.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingcarpets.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingcurtains.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomsofa.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomcentretables.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomsofachairs.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomcabinets.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomwallarts.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/livingroomhanginglights.webp" class="img-fluid"></div></div>

      </div>
        </div>

    <div class="tab-pane fade" id="bedroom" role="tabpanel">
  <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 pf-mobile-scroll">
        
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom6.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom8.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom9.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom10.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom11.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom12.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/bedroom6.webp" class="img-fluid"></div></div>

      </div>
        </div>

   <div class="tab-pane fade" id="dining" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 pf-mobile-scroll">
        
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D6.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D8.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D9.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D10.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D11.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D12.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/D6.webp" class="img-fluid"></div></div>

      </div>
    </div>

    <div class="tab-pane fade" id="study" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 pf-mobile-scroll">
        
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s6.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s8.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s9.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s10.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s11.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/s12.webp" class="img-fluid"></div></div>

      </div>
    </div>
    
 <div class="tab-pane fade" id="solid" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 pf-mobile-scroll">
        
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw6.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw8.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw9.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw10.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw11.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/sw12.webp" class="img-fluid"></div></div>

      </div>
    </div>

 <div class="tab-pane fade" id="engineered" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 pf-mobile-scroll">
        
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e6.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e8.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e9.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e10.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e11.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/e12.webp" class="img-fluid"></div></div>

      </div>
    </div>

     <div class="tab-pane fade" id="luxury" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4 pf-mobile-scroll">
        
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l4.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l6.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l8.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l9.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l10.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l11.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/l12.webp" class="img-fluid"></div></div>

      </div>
    </div>
    </div>
    </div>
</div>

<div class="container mb-5 text-center">
  <div class="row">
    <div class="col-12">
      <h4 class="fw-bold mb-4" style="color: #84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
        Brand Bazaar
      </h4>
    </div>

    <ul class="nav nav-tabs brand-bazaar-tabs mb-5 border-bottom-0" id="brandTab" role="tablist">
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100 active" data-bs-toggle="tab" data-bs-target="#furniture-pane" type="button" role="tab">
                <img src="images/iconfur.svg" class="brand-icon mb-1">
                <span class="d-block">Furniture</span>
            </button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#mattresses-pane" type="button" role="tab">
                <img src="images/iconmat.svg" class="brand-icon mb-1">
                <span class="d-block">Mattresses</span>
            </button>
        </li>
        <li class="nav-item flex-fill" role="presentation">
            <button class="nav-link w-100" data-bs-toggle="tab" data-bs-target="#decor-pane" type="button" role="tab">
                <img src="images/iconhomedecor.svg" class="brand-icon mb-1">
                <span class="d-block">Home Decor</span>
            </button>
        </li>
    </ul>

        <div class="tab-content" id="brandBazaarContent">
      <div class="tab-pane fade show active" id="furniture-pane" role="tabpanel">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 pf-mobile-scroll">
          <div class="col"><div class="pf-arch-card"><img src="images/F1.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/F2.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/F3.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/F4.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/F5.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/F6.webp" class="img-fluid"></div></div>
        </div>
      </div>

      <div class="tab-pane fade" id="mattresses-pane" role="tabpanel">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 pf-mobile-scroll">
          <div class="col"><div class="pf-arch-card"><img src="images/M1.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/M2.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/M3.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/M4.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/M5.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/M6.webp" class="img-fluid"></div></div>
        </div>
      </div>

      <div class="tab-pane fade" id="decor-pane" role="tabpanel">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 pf-mobile-scroll">
          <div class="col"><div class="pf-arch-card"><img src="images/H1.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/H2.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/H3.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/H4.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/H5.webp" class="img-fluid"></div></div>
          <div class="col"><div class="pf-arch-card"><img src="images/H6.webp" class="img-fluid"></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="container mb-5">
    <div class="tab-content" id="brandBazaarContent">
       </div>

    <div class="row mt-5">
        <div class="col-12">
            <img src="images/casacraft.webp" class="img-fluid w-100" alt="Promotional Banner">
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h4 class="fw-bold mb-0" style="color: #84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
                What The Fry Deals
            </h4>
        </div>
    </div>
    
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 pf-mobile-scroll">
        <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/frydeal1.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                    <div class="wishlist-container" onclick="handleWishlist(this, 'White Ceramic Fancy Table Vases', 149, 'images/frydeal1.webp')">
                        <i class="bi bi-heart-fill"></i> 
                    </div>
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">White Ceramic Fancy Table Vases</p>
                    <div class="d-flex align-items-center gap-1">
                        <span class="fw-bold" style="font-size: 0.8rem;">₹149</span>
                        <span class="text-muted text-decoration-line-through" style="font-size: 0.7rem;">₹449</span>
                        <span class="text-success fw-bold" style="font-size: 0.7rem;">67%</span>
                    </div>
                   <button class="btn btn-outline-orange btn-sm w-100 rounded-pill mt-auto fw-bold" 
                    onclick="addToCart('White Ceramic Fancy Table Vases', 149, 'images/frydeal1.webp')"
                    style="font-size: 0.7rem; border-width: 1.5px;">
                ADD TO CART
            </button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/frydeal2.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                    <div class="wishlist-container" onclick="handleWishlist(this, 'White Fur Solid 16x16 inches Cushi...', 119, 'images/frydeal2.webp')">
                        <i class="bi bi-heart-fill"></i> </div>
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">White Fur Solid 16x16 inches Cushi...</p>
                    <div class="d-flex align-items-center gap-1">
                        <span class="fw-bold" style="font-size: 0.8rem;">₹119</span>
                        <span class="text-muted text-decoration-line-through" style="font-size: 0.7rem;">₹599</span>
                        <span class="text-success fw-bold" style="font-size: 0.7rem;">80%</span>
                    </div>
                     <button class="btn btn-outline-orange btn-sm w-100 rounded-pill mt-auto fw-bold" 
                    onclick="addToCart('White Fur Solid 16x16 inches Cushi...', 119, 'images/frydeal2.webp')"
                    style="font-size: 0.7rem; border-width: 1.5px;">
                ADD TO CART
            </button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/frydeal3.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                    <div class="wishlist-container" onclick="handleWishlist(this, 'Kitchen Serving Platter Ceramic Small', 1, 'images/frydeal3.webp')">
                        <i class="bi bi-heart-fill"></i> </div>
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Kitchen Serving Platter Ceramic Small</p>
                    <div class="d-flex align-items-center gap-1">
                        <span class="fw-bold" style="font-size: 0.8rem;">₹1</span>
                        <span class="text-muted text-decoration-line-through" style="font-size: 0.7rem;">₹599</span>
                        <span class="text-success fw-bold" style="font-size: 0.7rem;">100%</span>
                    </div>
                     <button class="btn btn-outline-orange btn-sm w-100 rounded-pill mt-auto fw-bold" 
                    onclick="addToCart('Kitchen Serving Platter Ceramic Small', 1, 'images/frydeal3.webp')"
                    style="font-size: 0.7rem; border-width: 1.5px;">
                ADD TO CART
            </button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/frydeal4.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                    <div class="wishlist-container" onclick="handleWishlist(this, 'Antique Brass e27 Holder Wall Light w', 449, 'images/frydeal4.webp')">
                        <i class="bi bi-heart-fill"></i> </div>
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Antique Brass e27 Holder Wall Light w</p>
                    <div class="d-flex align-items-center gap-1">
                        <span class="fw-bold" style="font-size: 0.8rem;">₹449</span>
                        <span class="text-muted text-decoration-line-through" style="font-size: 0.7rem;">₹2000</span>
                        <span class="text-success fw-bold" style="font-size: 0.7rem;">78%</span>
                    </div>
                     <button class="btn btn-outline-orange btn-sm w-100 rounded-pill mt-auto fw-bold" 
                    onclick="addToCart('Antique Brass e27 Holder Wall Light w', 449, 'images/frydeal4.webp')"
                    style="font-size: 0.7rem; border-width: 1.5px;">
                ADD TO CART
            </button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/frydeal5.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                    <div class="wishlist-container" onclick="handleWishlist(this, 'Meena Metal Pot for Indoor Plants wit', 119, 'images/frydeal5.webp')">
                        <i class="bi bi-heart-fill"></i> </div>
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 0.75rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Meena Metal Pot for Indoor Plants with</p>
                    <div class="d-flex align-items-center gap-1">
                        <span class="fw-bold" style="font-size: 0.8rem;">₹119</span>
                        <span class="text-muted text-decoration-line-through" style="font-size: 0.7rem;">₹689</span>
                        <span class="text-success fw-bold" style="font-size: 0.7rem;">71%</span>
                    </div>
                   <button class="btn btn-outline-orange btn-sm w-100 rounded-pill mt-auto fw-bold" 
                    onclick="addToCart('Meena Metal Pot for Indoor Plants wit', 119, 'images/frydeal5.webp')"
                    style="font-size: 0.7rem; border-width: 1.5px;">
                ADD TO CART
            </button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="explore-deal-box h-100 d-flex flex-column justify-content-between p-3" style="background-color: #ffb422;">
                <div class="text-center mt-3">
                    <h2 class="fw-bold mb-0" style="font-size: 2.2rem; line-height: 1; color: #000;">W'F</h2>
                    <h2 class="fw-bold text-danger" style="font-size: 2.2rem; line-height: 1;">DEALS</h2>
                </div>
                <div>
                    <p class="fw-bold mb-0 text-dark" style="font-size: 0.85rem;">Explore More Deals</p>
                    <small class="text-dark">Shop Now <i class="bi bi-arrow-right"></i></small>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="wishlist-toast" class="wishlist-toast">Item added to wishlist</div>


<div class="container mb-5">
    <div class="tab-content" id="brandBazaarContent">
       </div>

    <div class="row mt-5">
        <div class="col-12">
            <img src="images/pfhome.webp" class="img-fluid w-100" alt="Promotional Banner">
        </div>
    </div>
</div>

<div class="container mb-5">
  <div class="nav d-flex flex-wrap justify-content-center gap-3 mb-5" role="tablist">
    <button class="pf-pill active" data-bs-toggle="tab" data-bs-target="#furniture" type="button" role="tab">Furniture</button>
    <button class="pf-pill" data-bs-toggle="tab" data-bs-target="#mattresses" type="button" role="tab">Mattresses</button>
    <button class="pf-pill" data-bs-toggle="tab" data-bs-target="#goods" type="button" role="tab">Home Goods</button>
  </div>

  <div class="tab-content">
    
    <div class="tab-pane fade show active" id="furniture" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pf-mobile-scroll">
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn4.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn6.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/fn8.webp" class="img-fluid"></div></div>
      </div>
    </div>

    <div class="tab-pane fade" id="mattresses" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pf-mobile-scroll">
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt4.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt6.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/mt8.webp" class="img-fluid"></div></div>
      </div>
    </div>

    <div class="tab-pane fade" id="goods" role="tabpanel">
      <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 pf-mobile-scroll">
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g1.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g2.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g3.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g4.webp" class="img-fluid"></div></div>

        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g5.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g6.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g7.webp" class="img-fluid"></div></div>
        <div class="col"><div class="pf-img-box rounded-4"><img src="images/g8.webp" class="img-fluid"></div></div>
      </div>
    </div>

  </div>
</div>

<div class="container my-5">
    <div class="row g-0 align-items-center border shadow-sm bg-white overflow-hidden">
        
        <div class="col-lg-4 border-end border-white border-4">
            <div class="h-100">
                <img src="images/vs.webp" class="img-fluid w-100 object-fit-cover d-block" alt="Store Offer" style="height: 300px;">
            </div>
        </div>

        <div class="col-lg-8 position-relative d-flex align-items-center bg-light">
            
            <button class="slider-arrow prev-arrow" onclick="slide('prev')">
                <i class="bi bi-chevron-left text-dark"></i>
            </button>

            <div class="slider-container" id="cardTrack">
                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/bengluru.jpeg" class="card-img rounded-0" alt="Bengaluru">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Bengaluru</h5>
                            <p class="small mb-0">8 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/agra.jpeg" class="card-img rounded-0" alt="Agra">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Agra</h5>
                            <p class="small mb-0">1 Store</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/shimla.jpeg" class="card-img rounded-0" alt="Shimla">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Shimla</h5>
                            <p class="small mb-0">1 Store</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/mumbai.jpeg" class="card-img rounded-0" alt="Mumbai">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Mumbai</h5>
                            <p class="small mb-0">6 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/delhi.jpeg" class="card-img rounded-0" alt="New Delhi">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">New Delhi</h5>
                            <p class="small mb-0">2 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/pune.jpeg" class="card-img rounded-0" alt="Pune">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Pune</h5>
                            <p class="small mb-0">5 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/hyderabad.jpeg" class="card-img rounded-0" alt="Hyderabad">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Hyderabad</h5>
                            <p class="small mb-0">5 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/chennai.jpeg" class="card-img rounded-0" alt="Chennai">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Chennai</h5>
                            <p class="small mb-0">6 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/kolkata.jpeg" class="card-img rounded-0" alt="Kolkata">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Kolkata</h5>
                            <p class="small mb-0">3 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/navi mumbai.jpeg" class="card-img rounded-0" alt="Navi Mumbai">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Navi Mumbai</h5>
                            <p class="small mb-0">2 Stores</p>
                        </div>
                    </div>
                </div>

                <div class="city-card-wrapper border-end border-white border-2">
                    <div class="card city-card border-0 text-white rounded-0">
                        <img src="images/explore.jpeg" class="card-img rounded-0" alt="explore">
                        <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                            <h5 class="fw-bold mb-0">Explore More</h5>
                            <p class="small mb-0">Stores Near You</p>
                        </div>
                    </div>
                </div>

            <button class="slider-arrow next-arrow" onclick="slide('next')">
                <i class="bi bi-chevron-right text-dark"></i>
            </button>
        </div>
    </div>
</div>
</div>
<div class="container-fluid p-0 overflow-hidden">
  <div class="row g-0">
    <div class="col-12">
      <a href="#" class="d-block w-100">
        <img src="images/mintwud.webp" class="w-100 d-block" alt="Visit Our Store Offer">
      </a>
    </div>
  </div>
</div>

<div class="pf-main-content">

  <div class="container my-4">
    <div class="row g-3">
      <div class="col-md-6">
        <div class="hover-zoom shadow-sm overflow-hidden">
          <img src="images/A1.webp" class="img-fluid w-100" alt="Buy 1 Get 1">
        </div>
      </div>
      <div class="col-md-6">
        <div class="hover-zoom shadow-sm overflow-hidden">
          <img src="images/A2.webp" class="img-fluid w-100" alt="Spin and Win">
        </div>
      </div>
    </div>
  </div>

  <div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h4 class="fw-bold mb-0" style="color: #84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
                Fresh Finds At Pepperfry
            </h4>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 pf-mobile-scroll">
        <div class="col">
            <div class="pf-deal-card">
                    <img src="images/freshfind1.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 1rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Space Saving-Make Room For More</p>
                    <div class="d-flex align-items-center gap-1">
                        <span style="font-size: 0.8rem;">Starts At Rs.3,499-></span>
                    </div>
                </div>
            </div>
        </div>
          <div class="col">
            <div class="pf-deal-card">
                    <img src="images/freshfind2.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                    <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 1rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Ergonomic - Designed For Better Health</p>
                    <div class="d-flex align-items-center gap-1">
                        <span style="font-size: 0.8rem;">Starting at 3,358-> </span>
                    </div>
                </div>
            </div>
          </div>

            <div class="col">
            <div class="pf-deal-card">
                    <img src="images/freshfind3.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 1rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"> Drink Tables - For That Perfect Sip</p>
                    <div class="d-flex align-items-center gap-1">
                        <span style="font-size: 0.8rem;">Starting at 1,980-></span>
                    </div>
                </div>
            </div>
          </div>
           <div class="col">
            <div class="pf-deal-card">
                    <img src="images/freshfind4.webp" class="img-fluid w-100" style="aspect-ratio: 1/1; object-fit: cover;" alt="Product">
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 1rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Timeless Brass Collection </p>
                </div>
            </div>
          </div>
    </div>

     <div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h4 class="fw-bold mb-0" style="color: #84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
                Crafted In India
            </h4>
        </div>
    </div>
    <div class="container pf-layout-container my-4">
  <div class="row g-3">
    
    <div class="col-md">
      <div class="hover-zoom shadow-sm overflow-hidden">
        <img src="images/craft1.webp" class="img-fluid w-100" alt="craft1">
      </div>
    </div>

    <div class="col-md">
      <div class="hover-zoom shadow-sm overflow-hidden">
        <img src="images/craft2.webp" class="img-fluid w-100" alt="craft2">
      </div>
    </div>   
  </div>
  </div>

  <div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h4 class="fw-bold mb-0" style="color: #84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
                Need Help Buying?
            </h4>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3 pf-mobile-scroll">
        <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/need1.webp" class="img-fluid" alt="need">
                </div>
            </div>
        </div>
          <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/need2.webp" class="img-fluid" alt="need">
                </div>
            </div>
          </div>

            <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/need3.webp" class="img-fluid" alt="need">
                </div>
            </div>
          </div>
           <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/need4.webp" class="img-fluid" alt="need">
                </div>
            </div>
          </div>

          <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/need5.webp" class="img-fluid" alt="need">
                </div>
            </div>
          </div>

          <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/need6.webp" class="img-fluid" alt="need">
                </div>
            </div>
          </div>
    </div>

    <div class="container py-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h4 class="fw-bold mb-0" style="color: #84582d; font-family: Arial, Helvetica, sans-serif; font-size: 1.25rem;">
                Follow Home Interior Trends
            </h4>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 g-3 pf-mobile-scroll">
        <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/int1.webp" class="img-fluid w-100" alt="Product">
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 1rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"> Biophilic Furniture</p>
                    <div class="d-flex align-items-center gap-1">
                        <span style="font-size: 0.8rem;">30+ Options, Starting at 19,000-></span>
                    </div>
                </div>
            </div>
        </div>
          <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/int2.webp" class="img-fluid w-100" alt="Product">
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 1rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">The Fluted Collection</p>
                    <div class="d-flex align-items-center gap-1">
                        <span style="font-size: 0.8rem;">50+ Options, Starting at 3,499-> </span>
                    </div>
                </div>
            </div>
          </div>

            <div class="col">
            <div class="pf-deal-card">
                <div class="position-relative overflow-hidden">
                    <img src="images/int3.webp" class="img-fluid w-100" alt="Product">
                </div>
                <div class="pt-2">
                    <p class="product-title mb-1" style="font-size: 1rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"> Chic Sofa Chairs</p>
                    <div class="d-flex align-items-center gap-1">
                        <span style="font-size: 0.8rem;">250+ Sofa Options , Starting at 6,079 </span>
                    </div>
                </div>
            </div>
          </div>    
    </div>  

    <section class="container pf-hero my-4">
  <div class="row g-3">
    
    <div class="col-lg-8 col-md-12">
      <div class="pf-hero-left h-100">
        <a href="#">
          <img src="images/review.webp" class="img-fluid w-100 h-100 object-fit-cover shadow-sm" alt="review">
        </a>
      </div>
    </div>
<div class="col-lg-4 col-md-12">
 <div class="pf-hero-right mb-3">
   <a href="#">
      <img src="images/review3.webp" class="img-fluid w-100 object-fit-cover shadow-sm" alt="review">
   </a>
</div>
    
<div class="pf-hero-right">
   <a href="#">
      <img src="images/review3.webp" class="img-fluid w-100 object-fit-cover shadow-sm" alt="review">
   </a>
</div>
  </div>
</div>

<div class="container pf-layout-container my-4">
  <div class="row g-0">
    
    <div class="col-md">
      <div class="hover-zoom overflow-hidden">
        <img src="images/end1.webp" class="img-fluid w-100" alt="Buy 1 Get 1">
      </div>
    </div>

    <div class="col-md">
      <div class="hover-zoom overflow-hidden">
        <img src="images/end2.webp" class="img-fluid w-100" alt="Spin and Win">
      </div>
    </div>  
    
     <div class="col-md">
      <div class="hover-zoom overflow-hidden">
        <img src="images/end3.webp" class="img-fluid w-100" alt="Spin and Win">
      </div>
    </div>   
  </div>
  </div>
    </div>
  </div>
     </div>
  </div>
</div>

  <!-- Footer -->
  <footer class="pf-footer bg-light pt-5">
  <div class="container">

    <!-- TOP FOOTER LINKS -->
    <div class="row gy-4">

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-bold mb-3">Corporate</h6>
        <ul class="list-unstyled">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Corporate Governance</a></li>
          <li><a href="#">Pepperfry in the News</a></li>
          <li><a href="#">Careers</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-bold mb-3">Useful Links</h6>
        <ul class="list-unstyled">
          <li><a href="#">Explore Gift Cards</a></li>
          <li><a href="#">Buy in Bulk</a></li>
          <li><a href="#">Discover Our Brands</a></li>
          <li><a href="#">Our Blog</a></li>
          <li><a href="#">Find a Store</a></li>
          <li><a href="#">Track Your Order</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-bold mb-3">Partner With Us</h6>
        <ul class="list-unstyled">
          <li><a href="#">Sell on Pepperfry</a></li>
          <li><a href="#">Become a Franchisee</a></li>
          <li><a href="#">Channel Partner</a></li>
          <li><a href="#">Pep Home</a></li>
          <li><a href="#">Marketplace Policies</a></li>
          <li><a href="#">Merchant Login</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-bold mb-3">Need Help?</h6>
        <ul class="list-unstyled">
          <li><a href="#">FAQs</a></li>
          <li><a href="#">Policies</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>

      <div class="col-12 col-md-4 col-lg">
        <h6 class="fw-bold mb-3">Shop Built Safe Products</h6>
        <ul class="list-unstyled">
          <li><a href="#">Kids & Pet Friendly</a></li>
          <li><a href="#">Certified Non-Toxic</a></li>
          <li><a href="#">Vegetarian Glue</a></li>
          <li><a href="#">Scratch Resistant Finish</a></li>
        </ul>

        <h6 class="fw-bold mt-4 mb-2">Download our App</h6>
        <div class="d-flex gap-2">
          <img src="images/appstore.webp" style="height: 40px; width: auto;">
          <img src="images/googleplay.webp" style="height: 40px; width: auto;">
        </div>
      </div>

    </div>

    <!-- POPULAR SECTIONS -->
 <div class="row mt-5 gy-4">
  <div class="col-lg-4">
    <h6 class="fw-bold mb-3">Popular Categories</h6>
    <p class="small text-muted lh-lg">
      Sofas, Sectional Sofas, Sofa Sets, Queen Size Beds, King Size Beds, Coffee Tables, Dining Sets, Recliners, Sofa Cum Beds, Queen Size Mattresses, Cabinets & Sideboards, Book Shelves, TV & Media Units, Wardrobes, Foldable Mattresses, Pillows, Wall Shelves, Photo Frames, Bed Sheets, Table Linen, Study Tables, Office Furniture, Dining Tables, Carpets, Wall Decor
    </p>
  </div>

  <div class="col-lg-4">
    <h6 class="fw-bold mb-3">Popular Brands</h6>
    <p class="small text-muted lh-lg">
      Mintwud, Woodsworth, CasaCraft, Amberville, Mudramark, Bohemiana, Springtek, Spacewood, A Globia Creations, Febonic, Durian, Nilkamal, Sleepycat, Bluewud, Duroflex, Sleepyhead, Green Soul, Orange Tree, Clouddio
    </p>
  </div>

  <div class="col-lg-4">
    <h6 class="fw-bold mb-3">Popular Cities</h6>
    <p class="small text-muted lh-lg">
      Bengaluru, Mumbai, Navi Mumbai, Delhi, Hyderabad, Pune, Chennai, Gurgaon, Kolkata, Noida, Goa, Ghaziabad, Faridabad, Jaipur, Lucknow, Kochi, Visakhapatnam, Chandigarh, Vadodara, Nagpur, Thiruvananthapuram, Indore, Mysore, Bhopal, Surat, Patna, Ludhiana, Ahmedabad, Nashik, Aurangabad
    </p>
  </div>
</div>

    <hr class="my-4">

    <!-- BOTTOM FOOTER -->
    <div class="row align-items-center gy-3 pb-4">

      <div class="col-lg-6">
        <h6 class="fw-bold mb-2">We accept</h6>
        <div class="d-flex flex-wrap gap-1">
          <img src="images/WC1.webp" style="height: 50px; width: auto;">
          <img src="images/WC2.webp" style="height: 50px; width: auto;">
          <img src="images/WC3.webp" style="height: 50px; width: auto;">
          <img src="images/WC4.webp" style="height: 50px; width: auto;">
          <img src="images/WC5.webp" style="height: 50px; width: auto;">
          <img src="images/WC6.webp" style="height: 50px; width: auto;">
          <img src="images/WC7.webp" style="height: 50px; width: auto;">
        </div>
      </div>

     <div class="col-lg-6">
  <div class="ms-auto text-start" style="max-width: fit-content;">
    <h6 class="fw-bold mb-2">Like What You See? Follow us Here</h6>
    
    <div class="d-flex justify-content-start gap-3">
      <img src="images/instra.webp" style="height: 50px; width: auto;">
      <img src="images/fb.webp" style="height: 50px; width: auto;">
      <img src="images/pintrest.webp" style="height: 50px; width: auto;">
      <img src="images/linkden.webp" style="height: 50px; width: auto;">
      <img src="images/youtube.webp" style="height: 50px; width: auto;">
      <img src="images/twitter.webp" style="height: 50px; width: auto;">
    </div>
  </div>
</div>

<div class="container-fluid border-top py-4 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <div class="d-flex flex-wrap justify-content-center gap-3 gap-md-4 mb-3">
          <a href="#" class="text-secondary text-decoration-none small">Whitehat</a>
          <a href="#" class="text-secondary text-decoration-none small">Sitemap</a>
          <a href="#" class="text-secondary text-decoration-none small">Terms Of Use</a>
          <a href="#" class="text-secondary text-decoration-none small">Privacy Policy</a>
          <a href="#" class="text-secondary text-decoration-none small">Your Data and Security</a>
          <a href="#" class="text-secondary text-decoration-none small">Grievance Redressal</a>
        </div>
        
        <p class="text-secondary small mb-0">
          © Copyright Pepperfry Limited
        </p>
      </div>
    </div>
  </div>
</div>

    </div>
  </div>
</footer>

<?php if (!isset($_SESSION['user_id'])) { ?>
<!-- MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">

      <button type="button" class="btn-close ms-auto p-3" data-bs-dismiss="modal"></button>

      <div class="modal-body p-0">

        <div class="login-banner p-4 text-center" style="background:#FFF5F0;">
          <h2 style="color:#E24F1E;font-weight:bold;">
            Sign Up Now & Get Upto Rs. 1,500 Off
          </h2>
          <p>On Your First Purchase ❯</p>
          <div class="coupon-box">
            Use Coupon: <b style="color:#E24F1E;">HELLO1500</b>
          </div>
        </div>

        <div class="p-4 text-center">
          <h4 style="color:#8B572A;">Sign Up</h4>

          <form action="signup.php" method="POST">

            <input type="text" name="name"
              class="form-control form-control-lg mb-3"
              placeholder="Full Name" required>

            <input type="email" name="email"
              class="form-control form-control-lg mb-3"
              placeholder="Email" required>

            <div class="input-group mb-3">
              <input type="password" name="password" id="signupPass"
                class="form-control form-control-lg" placeholder="Password" required>
              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('signupPass', this)">
                <i class="bi bi-eye"></i>
              </button>
            </div>

            <button type="submit"
              class="btn btn-lg w-100 text-white"
              style="background:#FF6B35;">
              CONTINUE
            </button>

          </form>
          <p class="mt-3">
           Already a customer?
          <a href="#"
   onclick="switchToLogin(); return false;"
   style="color:#E24F1E; font-weight:600;">
   Login here
</a>
          </p>
          

          <p class="small mt-2 text-muted">
            By continuing, you agree to our
            <a href="#" class="text-orange">Terms & Conditions</a>
          </p>

          <div class="divider d-flex align-items-center my-3">
            <hr class="flex-grow-1">
            <span class="mx-2 small text-muted">Or Continue with</span>
            <hr class="flex-grow-1">
          </div>

          <a href="google_login.php"
             class="btn btn-outline-secondary w-100 mb-2 d-flex justify-content-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                 width="18" class="me-2"> Google
          </a>

          <a href="fb_login.php"
             class="btn btn-outline-secondary w-100 d-flex justify-content-center">
            <i class="bi bi-facebook text-primary me-2"></i> Facebook
          </a>

        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- LOGIN MODAL -->
<div class="modal fade" id="loginPopup" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">

      <button type="button" class="btn-close ms-auto p-3"
              data-bs-dismiss="modal"></button>

      <div class="modal-body p-4 text-center">

        <h4 style="color:#8B572A;">Login</h4>

        <form action="login.php" method="POST">

          <input type="email" name="email"
            class="form-control form-control-lg mb-3"
            placeholder="Email" required>

          <div class="input-group mb-3">
            <input type="password" name="password" id="loginPass"
              class="form-control form-control-lg" placeholder="Password" required>
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('loginPass', this)">
              <i class="bi bi-eye"></i>
            </button>
          </div>

          <button type="submit"
            class="btn btn-lg w-100 text-white"
            style="background:#FF6B35;">
            LOGIN
          </button>

        </form>

        <p class="mt-3">
          New user?
          <a href="#"
             onclick="switchToSignup(); return false;"
             style="color:#E24F1E; font-weight:600;">
             Sign up here
          </a>
        </p>

      </div>
    </div>
  </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js?v=<?php echo time(); ?>"></script> 
</body>
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
</html>
