<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            padding: 2px;
            text-align: center;
            background: #ce1023;
            color: white;
            font-size: 15px;
        }


        .topnav {
            position: relative;
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #ce1023;
            color: white;
        }

        .topnav-centered a {
            float: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .topnav-right {
            float: right;
        }

        .topnav input[type=text] {
            float: right;
            padding: 14px 16px;
            border: 2px;
            font-size: 17px;
        }

        .registerbtn {
            background-color: #ce1023;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 15%;
            opacity: 0.9;
        }

        .deletebtn {
            background-color: #ce1023;
            color: white;
            padding: 1px 3px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 15%;
            opacity: 0.9;
        }

        form.search button {
            float: right;
            width: 20%;
            padding:10px;
            background: #ce1023;
            color: white;
            font-size: 17px;
            border: 1px solid grey;
            border-left: none;
            cursor: pointer;
        }

        form.search button:hover {
            background: #ddd;
        }

        form.search::after {
            content: "";
            clear: both;
            display: table;
        }


        /* Responsive navigation menu (for mobile devices) */
        @media screen and (max-width: 600px) {
            .topnav a, .topnav-right {
                float: none;
                display: block;
            }

            .topnav-centered a {
                position: relative;
                top: 0;
                left: 0;
                transform: none;
            }
        }
    </style>
</head>
</body>

<div class="header">
    <h1>Clothing Designer DB</h1>
</div>

<!-- Top navigation -->
<div class="topnav">

    <!-- Left-aligned links (default) -->
    <a href="index.php">Home</a>
    <a href="store.php">Stores</a>
    <a href="customer.php">Customers</a>
    <a href="product.php">Products</a>
    <a href="top.php">Tops</a>
    <a href="bottom.php">Bottoms</a>
    <a href="shoe.php">Shoes</a>
    <a href="transactions.php">Transactions</a>
    <a href="cart.php"  class="active">Cart</a>

</div>



</div>


<title>Cart</title>
<div style="padding-left:16px">
    <h1>Cart</h1>
</div>


<?php
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] = 1)
{
class TableRows extends RecursiveIteratorIterator
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current()
    {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current() . "</td>";
    }

    function beginChildren()
    {
        echo "<tr>";
    }

    function endChildren()
    {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothingdatabase";


$totalPrice = 0;
$totalPrice2 = 0;
$tax = 0;

try {
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<div style='padding-left:16px; padding-bottom: 16px; padding-right: 16px'>
                        <table style='border: solid 1px black;'>
                </div>";
    $stmt = $conn->prepare("SELECT c1.customerID, c1.transactionID, c1.productID, p1.brandName, p1.name, p1.color, p1.price FROM ((cart c1 INNER JOIN product p1 ON c1.productID = p1.productID) INNER JOIN customer cus1 ON c1.customerID = cus1.customerID) WHERE cus1.customerID = " . $_SESSION["customerID"] . " AND cus1.password = '" . $_SESSION["password"] . "'");
    echo "<tr><th>CustomerID</th><th>TransactionID</th><th>ProductID</th><th>Brand Name</th><th>Name</th><th>Color</th><th>Price</th></tr>";

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /*foreach (new TableRows(new RecursiveArrayIterator($result)) as $k => $v) {
        echo $v;
    }*/

    foreach($result as $row) {
      echo "<tr class='info'>
                <td>" . $row['customerID'] . "</td>
                <td>" . $row['transactionID'] . "</td>
                <td>" . $row['productID'] . "</td>
                <td>" . $row['brandName'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['color'] . "</td>
                <td>" . $row['price'] . "</td>
                <td><a class='deletebtn'  href='deleteItemCart.php?id=".$row['productID']."'>Delete</a></td>
                                </td>
                                   </tr>";
        $totalPrice = $totalPrice + $row['price'];
    }

    $stmt1 = $conn->prepare("SELECT calculateTax(" . $totalPrice . ")");
    $stmt1->execute();
    $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    foreach($result1 as $row1)
    {
        $tax = $row1;
    }
    $tax = number_format($tax, 2);

    $stmt2 = $conn->prepare("SELECT calculateTotal(" . $totalPrice . ")");
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    foreach($result2 as $row2)
    {
        $totalPrice2 = $row2;
    }
    $totalPrice2 = number_format($totalPrice2, 2);

    $conn = null;
    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
    echo '<br></br>';
    echo "Price before tax: $$totalPrice";
    echo "<br>";
    echo "Tax: $$tax";
    echo "<br>";
    echo "Shipping & Handling: $6.99";
    echo "<br>";
    echo "Total Price: $$totalPrice2";
    echo '<br></br>';
    echo '<a href="finalizePurchase.php?id='.$totalPrice.'" class="registerbtn">Finalize Purchase</a>';   

}
?>

</body>
</html>