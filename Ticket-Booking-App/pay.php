<?php
include 'connect.php';
include 'head2.php';

session_start();
if ($_SESSION['log'] == '') {
    header("location:sindex.php");
}

// Check if the Emergency Pay button has already been used
if (!isset($_SESSION['emergency_used'])) {
    $_SESSION['emergency_used'] = false; // Initialize the "used" state
}

// Generate a one-time token for emergency pay if not already generated
if (!isset($_SESSION['emergency_pay_token']) && !$_SESSION['emergency_used']) {
    $_SESSION['emergency_pay_token'] = bin2hex(random_bytes(16)); // Generate a random unique token
}
?>

<html>
<head>
  <style>
    .formm {
       font-family: Montserrat, sans-serif;
       font-size: 18px !important;
    }
  </style>
<link rel='stylesheet' href='index.css'>
<link rel="shortcut icon" href="logofig.jpg" />
<title> Registration Page </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body style="background-color: F5F1F0;">

<div class="formm">
<h2 align="center"><b>Enter Payment Details :</b></h2>

<form method='post' action='payaction.php'>
<table align="center">
<tr>
  <td><h3>Card No.:</h3></td>
  <td colspan='2'><input type="number" name="cno" placeholder="1111-2222-3333-4444" maxlength='50' required></td>
</tr>
<tr>
  <td><h3>Name on Card:</h3></td>
  <td colspan='2'><input type="text" name="name" placeholder="Enter Your Name" maxlength='50' required></td>
</tr>
<tr>
  <td><h3>Expiry Date:</h3></td>
  <td><input type="number" name="Em" placeholder="MM" maxlength='2' required></td>
  <td><input type="number" name="Ey" placeholder="YY" maxlength='2' required></td>
</tr>
<tr>
  <td><h3>CVV No:</h3></td>
  <td colspan='2'><input type="password" name="Cvv" maxlength='3' required></td>
</tr>
<tr>
  <td><h3>PIN No:</h3></td>
  <td colspan='2'><input type="password" name="Pin" maxlength='4' required></td>
</tr>
<tr>
  <td colspan='3'><center><button style="background-color:black; border-color:black" type='submit' name='register_submit'>Complete Payment</button></center></td>
</tr>
</table>
</form>

<!-- Emergency Pay Button -->
<center>
    <?php if ($_SESSION['emergency_used']): ?>
        <!-- Show message if Emergency Pay was already used -->
        <p style="color: red; font-size: 18px; font-weight: bold;">YOU HAVE ALREADY USED YOUR EMERGENCY LOAN</p>
    <?php else: ?>
        <!-- Show Emergency Pay button if it has not been used -->
        <form method="post" action="">
            <input type="hidden" name="emergency_pay_token" value="<?php echo $_SESSION['emergency_pay_token']; ?>">
            <button style="background-color:red; color:white; padding:10px 20px; border:none; font-size:18px;" type="submit" name="emergency_submit">
                Emergency Pay
            </button>
        </form>
    <?php endif; ?>
</center>

<br><br>
</div>

<?php include 'footer.php'; ?>
</body>
</html>

<?php
// Handle the Emergency Pay button submission
if (isset($_POST['emergency_submit'])) {
  // Validate the token and process Emergency Pay
  if (isset($_POST['emergency_pay_token']) && $_POST['emergency_pay_token'] === $_SESSION['emergency_pay_token']) {
      // Emergency Pay logic goes here
      echo "<script>
          alert('Emergency Payment Successful!');
          window.location.href = 'payaction.php'; // Redirect to bookdone.php
      </script>";

      // Mark Emergency Pay as used
      $_SESSION['emergency_used'] = true;
      unset($_SESSION['emergency_pay_token']); // Invalidate the token after use
  } else {
      // Invalid token (should not happen unless tampered with)
      echo "<script>
          alert('Invalid Emergency Payment Request.');
          
      </script>";
  }
}

?>
