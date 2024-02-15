<?php

session_start();
$conn = new mysqli('localhost','root','','form');
$unique_id = $_SESSION['unique_id'];
if(empty($unique_id)){
    header("Location: login.php");
}
$qry = mysqli_query($conn,"SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if(mysqli_num_rows($qry)>0){
    $row = mysqli_fetch_assoc($qry);
    if($row){
        $_SESSION['verification_status'] = $row['verification_status'];
        if($row['verification_status'] !='Verified'){
            header("Location: verify.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home Page</title>
        <link rel="stylesheet" href="homestyle.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
                <div class="topbar">
                        <a href="#">
                                <i class='bx bx-user user_icon'></i>
                        </a>
                                
                        <p>CART</p>

                        <button class="threelines">
                                <img src="navbar/threelines.png">
                        </button>

                </div>
        <div class="container">
                <div class="product">
                        <p class="product_name">
                        <div id="result"></div>
                        </p>
                        
                        <div class="qty">
                                <button id="decrement" onclick="stepper(this)"> - </button>
                                <input type="number" min="0" max="100" step="1" value="1"  id="my-input" readonly>
                                <button id="increment" onclick="stepper(this)"> + </button>
                        </div>

                </div>
                <div class="product">
                </div>

                
        </div>
        <div class="Summary">
                <h2>SUMMARY</h2>

                <table class="table">
                        <tr>
                                <th>Sub-total :</th>
                                <td>Rs.1000</td>
                        </tr>
                       <tr>
                                <th>Discount :</th>
                                <td>-Rs.100</td>
                       </tr>
                       <tr style="border-top: 2px dashed grey;">
                                <th style="font-size: 30px;">TOTAL :</th>
                                <th style="font-size: 30px;">Rs.900</Rs></th>
                       </tr>
                </table>
        </div>

        <div class="Checkout">
                <button type="submit">
                        CHECKOUT
                </button>
        </div>






        <section class="bottom_bar">
                <div id="nav_menu">
                        <ul class="nav_list">

                               <li class="nav_item">
                                        <a href="#" class="nav_link">
                                                <i class='bx bx-home nav_icon'></i>
                                                <span class="nav_name">HOME</span>
                                        </a>
                               </li>
                               
                               <!-- Your existing HTML content -->
<li class="nav_item">
    <button class="nav_button" id="startScanner" onclick="togglebuttonstate()">
        <i class='bx bx-scan nav_icon'></i>
        <span class="nav_name">SCAN</span>
    </button>
</li>

<li class="nav_item">
    <button class="nav_button">
      <i class='bx bx-shopping-bag nav_icon'></i>
        <span class="nav_name">SCAN</span>
    </button>
</li>


                                <li class="nav_item">
                                        <a href="#" class="nav_link">
                                                <i class='bx bx-navigation nav_icon' ></i>
                                                <span class="nav_name">LOCATE</span>
                                        </a>
                               </li>
                        </ul>
                </div>
                
        </section>

        <script src="counter.js"></script>
        <script src="navbar.js"></script>
         <!-- QuaggaJS library via CDN -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

<script>
 document.getElementById('startScanner').addEventListener('click', function() {
      // Redirect to another page when the button is clicked
      window.location.href = 'barcode.php';
    });
</script>
</body>

</html>
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Default password is empty in XAMPP
$database = "form";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the barcode value from the AJAX request
$barcode = $_GET['data'];

// Prepare SQL statement to select the product with the given barcode
$sql = "SELECT * FROM product WHERE barcode = '$barcode'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Product with the given barcode found
    $productDisplay =" ";
    $productHTML=" ";
    if ($row = $result->fetch_assoc()) {
        // Output product information
        $productHTML .= "<div class=\"product\">";
        $productHTML .= "<p>" . $row["product_name"] . "</p>";
        $productHTML .= "<p>Price: " . $row["price"] . "</p>";
        // Add more product information as needed
        $productHTML .= "</div>";
    }
    $productDisplay .= $productHTML; 
    echo "<script>";
    echo "var outputDiv = document.querySelector('.container');";
    //echo "outputDiv.insertAdjacentHTML('beforeend', '$productDisplay');";
    //echo "</script>";
    //$productDisplay .= $productHTML;   
    //echo "var outputDiv = document.querySelector('.container');";
    echo "outputDiv.innerHTML += '$productDisplay';";

    echo "</script>";
        //$productDisplay .= $productHTML;
       // echo "var outputDiv = document.getElementsByClassName('container')[0];";
        //echo "var outputDiv = document.getElementByClassName('container');";
        //echo "outputDiv.appendChild($productDisplay);";
        // echo "outputDiv.innerHTML += '$productDisplay';";
        //$productHTML="";
}
?>