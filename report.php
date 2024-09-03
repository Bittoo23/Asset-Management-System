<!-- report.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Register Report</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>

    <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<style>
        
        .squares {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .square {
            width: 300px;
            height: 200px;
            background: #e3f2fd;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #333;
            text-decoration: none;
            transition: transform 0.3s ease, background 0.3s ease;
        }
        
        .square-left {
            background: #d1c4e9;
        }
        
        .square-right {
            background: #c8e6c9;
        }
        
        .square:hover {
            transform: scale(1.05);
        }
        
        .square-content h3 {
            margin: 0;
            font-size: 1.2em;
        }
        
        .square:hover {
            background: #bbdefb;
        }
        
        .square-left:hover {
            background: #b39ddb;
        }
        
        .square-right:hover {
            background: #a5d6a7;
        }
        
        footer {
            background-color: #002147;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        /* Basic styling */
        * {
          box-sizing: border-box;
          padding: 0;
          margin: 0;
        }
        body {
          font-family: sans-serif;
          font-size: 16px;
        }
        nav {
          background: #344df0;
          padding: 0 15px;
        }
        a {
          color: white;
          text-decoration: none;
        
        }
        .menu,
        .submenu {   
          list-style-type: none;
        }
        .logo {
          font-size: 20px;
          padding: 7.5px 10px 7.5px 0;
        }
        .item {
          padding: 10px;
        }
        .item.button {
          padding: 9px 5px;
        
        }
        .item:not(.button) a:hover,
        .item a:hover::after {
          color: #ccc;
        }
        /* Mobile menu */
        .menu {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          align-items: center;
        }
        .menu li a {
          display: block;
          padding: 15px 5px;
        }
        .menu li.subitem a {
          padding: 15px;
        }
        .toggle {
          order: 1;
          font-size: 20px;
        }
        .item.button {
          order: 2;
        }
        .item {
          order: 3;
          width: 100%;
          text-align: center;
          display: none;
        }
        .active .item {
          display: block;
        }
        .button.secondary { /* divider between buttons and menu links */
          border-bottom: 1px #444 solid;
        }
        /* Submenu up from mobile screens */
        .submenu {
          display: none;
        }
        .submenu-active .submenu {
         display: block;
        }
        .has-submenu i {
          font-size: 12px;
        }
        .has-submenu > a::after {
          font-family: "Font Awesome 5 Free";
          font-size: 12px;
          line-height: 16px;
          font-weight: 900; 
          content: "\f078";
          color: white;
          padding-left: 5px;
        }
        .subitem a {
          padding: 10px 15px;
          color: #ccc;
        }
        .submenu-active {
          background-color: #344df0;
          border-radius: 3px;
        }
        /* Tablet menu */
        @media all and (min-width: 700px) {
          .menu {
              justify-content: center;
          }
          .logo {
              flex: 1;
          }
          .item.button {
              width: auto;
              order: 1;
              display: block;
          }
          .toggle {
              flex: 1;
              text-align: right;
              order: 2;
          }
          /* Button up from tablet screen */
          .menu li.button a {
              padding: 10px 15px;
              margin: 5px 0;
          }
          .button a {
              background: #0080ff;
              border: 1px royalblue solid;
          }
          .button.secondary {
              border: 0;
          }
          .button.secondary a {
              background: transparent;
              border: 1px #0080ff solid;  
          }
          .button a:hover {
              text-decoration: none;
          }
          .button:not(.secondary) a:hover {
              background: royalblue;
              border-color: darkblue;
          }
        }
        /* Desktop menu */
        @media all and (min-width: 960px) {
          .menu {
              align-items: flex-start;     
              flex-wrap: nowrap;
              background: none;
          }
          .logo {
              order: 0;
          }
          .item {
              order: 1;
              position: relative;
              display: block; 
              width: auto;
          }
          .button {
              order: 2;
          }
          .submenu-active .submenu {
              display: block;
              position: absolute;
              left: 0;
              top: 68px;
              background: #344df0;
              z-index: 999;
          }
          .toggle {
              display: none;
          }
          .submenu-active {
              border-radius: 0;
          }
        }
        /* new */
        .custom-padding {
          padding: 0px;
        }
        
        .banner {
            width: 100%;
            background-color: #f0f0f0;
            color: #333;
            text-align: center;
            padding: 40px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .banner h1 {
            margin: 0;
            font-size: 1.5em;
        }
        
        
            </style>
        
</head>
<body>
    <div class="banner"><a href="http://localhost/_Project/Asset%20Register/land.php">
        <h1 style="display: inline-block; color: #333; ">CSIR - National Institute of Science Communication and Policy Research</h1>
    </a>    
    </div>
    <nav>
        <ul class="menu">
            <li class="logo"><a href="land.php">NKRC</a></li>
            <li class="item"><a href="land.php">Home</a></li>
            <li class="item has-submenu">
                <a tabindex="0">Data Entry</a>
                <ul class="submenu">
                    <li class="subitem"><a href="minutes.php">Opening Balance</a></li>
                    <li class="subitem"><a href="asset.php">Entries</a></li>
                </ul>
            </li>
            <li class="item has-submenu">
                <a tabindex="0">Reports</a>
                <ul class="submenu">
                    <li class="subitem"><a href="report.php">Asset</a></li>
                </ul>
            </li>
            <li class="item button"><a href="logout.php">Log out</a></li>
        </ul>
    </nav>
    <style>
/* Style for the navigation bar */
nav {
  background: #344df0;
  padding: 0 15px;
}

/* Basic menu styling */
.menu {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
}

.menu > .item {
  position: relative;
}

/* Submenu styling */
.submenu {
  display: none;
  position: absolute;
  left: 0;
  top: 100%;
  background: #344df0;
  z-index: 999;
  list-style: none;
  padding: 0;
  margin: 0;
  min-width: 180px;
}

.submenu .subitem {
  padding: 10px 20px;
}

.submenu .subitem a {
  color: #fff;
  text-decoration: none;
}

.submenu .subitem a:hover {
  background: #1d2ec1;
}

/* Hover effect to show submenu */
.menu > .item:hover > .submenu {
  display: block;
}

/* Style when submenu is activated by click */
.menu .item.active > .submenu {
  display: block;
}

/* Submenu arrow icon */
.menu .item.has-submenu > a::after {
  content: '\f0d7';
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  padding-left: 5px;
}

/* Toggle button for mobile menu */
.toggle {
  display: none;
}

/* Media Queries */
@media (max-width: 960px) {
  .menu {
    flex-direction: column;
    align-items: flex-start;
  }

  .menu .item {
    width: 100%;
    display: none;
  }

  .menu .item.active {
    display: block;
  }

  .toggle {
    display: block;
  }
}
</style>

    <script src="scripts.js"></script>
    <script>
        // JavaScript code to toggle dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.has-submenu > a');
        
            menuItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    const submenu = this.parentElement;
                    submenu.classList.toggle('submenu-active');
                });
            });
        });

        $(document).ready(function() {
  // Handle click event on submenu items
  $('.menu .item.has-submenu > a').click(function(e) {
    e.preventDefault();
    var $submenu = $(this).next('.submenu');
    
    // Toggle active class
    if ($submenu.is(':visible')) {
      $(this).parent().removeClass('active');
    } else {
      $('.menu .item').removeClass('active');
      $(this).parent().addClass('active');
    }
  });

  // Close submenu when clicking outside
  $(document).click(function(e) {
    if (!$(e.target).closest('.menu').length) {
      $('.menu .item').removeClass('active');
    }
  });
});
    </script>
   
    <div class="container">
        <h2 class="main-heading">Asset Register Report</h2>
        <form id="reportform" action="layouttry.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" >
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" >
            </div>
            <div class="form-group">
                <!-- Financial Year dropdown -->
                <label for="year">Financial Year (FY):</label>
                <select id="year" name="year" >
                <option value="">None</option>
                    <?php
                    $currentYear = date("Y");
                    for ($year = $currentYear; $year >= 1980; $year--) {
                        echo "<option value=\"$year\">$year</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="institutionType">Type of Institution:</label>
                <select id="place" name="place" required>
                    <option value="CSIR">CSIR</option>
                    <option value="DST">DST</option>
                    <option value="MOES">MOES Lab</option>
                </select>
            </div>
            
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>    
        
</body>
</html>
