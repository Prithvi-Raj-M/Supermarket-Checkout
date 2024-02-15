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
    if ($row = $result->fetch_assoc()) {
        // Output product information

        $productDisplay="<h1>Products</h1>";
        $productHTML = "<div class='product'>";
        $productHTML .= "<p>" . $row["product_name"] . "</p>";
        $productHTML .= "<p>Price: " . $row["price"] . "</p>";
        // Add more product information as needed
        $productHTML .= "</div>";
        $productDisplay .= $productHTML;
        echo "var outputDiv = document.getElementByClass('container');";
        echo "outputDiv.appendChild($productDisplay);";
        $productHTML="";
        
    }
}
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Event listener for barcode scanning
    document.getElementById('barcodeInput').addEventListener('input', function() {
        var scannedBarcode = this.value.trim();
        if (scannedBarcode !== '') {
            // AJAX request
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    var outputDiv = document.querySelector('.container');
                    outputDiv.innerHTML += this.responseText;
                }
            };
            xhr.open("GET", "your_php_script.php?data=" + scannedBarcode, true);
            xhr.send();

            this.value = ''; // Clear input after scanning
        }
    });
});
}
</script>
