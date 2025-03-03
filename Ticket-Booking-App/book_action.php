<?php
error_reporting(E_ERROR | E_PARSE);


include 'connect.php';
session_start();

if ($_SESSION['log'] == '') {
    header("location:sindex.php");
}
include 'header.php';

$source = $_POST['source'];
$dest = $_POST['dest'];
$class = $_POST['class'];
$type = $_POST['type'];
$no = $_POST['number'];

if ($source == $dest) {
    echo "<h1><center>Selected source and destination are the same. Please refill the details.</center></h1><br><br>";
    echo '<center>';
} else if ($connect) { // Assuming you want to check for a valid database connection
    echo "<h1><center><b><img src='https://img.icons8.com/cotton/80/000000/route.png'/> PROCEED TO CHECKOUT :</b></center></h1>";

    $sql_price = "SELECT * FROM `price` WHERE `source` LIKE '$source' AND `dest` LIKE '$dest' AND `type` LIKE '$type' AND `class` = '$class'";
    $result = $connect->query($sql_price);

    // Check if a result is returned
    if ($result && $result->num_rows > 0) {
        // You can process the result here, e.g., fetch data
        echo "<h1><center>Train details retrieved successfully.</center></h1>";
    } else {
        echo "<h1><center>No Train Found for the selected route. Please select another route.</center></h1><br><br>";
    }
    echo '<center>';
} else {
    echo "<h1><center>Database connection error. Please try again later.</center></h1><br><br>";
}


    

    while ($row = $result->fetch_assoc()) {
        $final = $row["Price"];
        $Route = $row["Route"];
        $final = $final * $no;
        
        echo "<br><br><br><h1><center>Total <b>" . $class . " Class , " . $type . "</b> Journey type fare from <b>" . $source . " to " . $dest . "</b> is: ৳ <b>" . $final . "</b> and route via <b>" . $source . " " . $Route . " " . $dest . "</b></center></h1><br><br>";
        echo '<center>
                <form action="pay.php">
                    <button type="submit" style="background-color: black; padding: 25px 70px; text-align:center;">
                        <span style="color:white;">
                            <h3>Checkout</h3>
                        </span>
                    </button>
                </form>
              </center>';
    }

    $_SESSION['final'] = $final;
    $_SESSION['source'] = $source;
    $_SESSION['dest'] = $dest;
    $_SESSION['Class'] = $class;
    $_SESSION['Type'] = $type;
    $_SESSION['NoOfpass'] = $no;
    $_SESSION['Route'] = $source . $Route . $dest;


?>

<br><br><br><br>
<center>
    <form action="book.php">
        <button type="submit" style="background-color: black; padding: 28px 80px; text-align:center;">
            <span style="color:white;">
                <h3>Go back</h3>
            </span>
        </button>
    </form>
</center>
<br><br>

<?php include 'footer.php'; ?>
