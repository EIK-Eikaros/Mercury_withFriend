<?php
session_start();
if (
    $_SESSION['mem_id'] == null ||
    $_SESSION["mem_role"] != "customer"
) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="data.css">
</head>

<body>
    <form name="checkoutForm" method="POST" action="confirm_payment.php?price=<?= $_GET['price'] ?>">
        <script type="text/javascript" src="https://cdn.omise.co/omise.js" data-key="pkey_test_5ls6esdutigbhc82itf" data-image="Pic/The_Mercury.png" data-frame-label="The Mercury" data-button-label="ใช้บริการ" data-submit-label="Submit" data-location="no" data-amount="<?= $_GET['price'] * 100 ?>" data-currency="thb">
        </script>
        <!--the script will render <input type="hidden" name="omiseToken"> for you automatically-->
    </form>
    <script>
        const mybutton = document.getElementsByClassName("omise-checkout-button")
        mybutton[0].style = "display: none"
        mybutton[0].click();
    </script>
</body>

</html>
<?php
include "connect.php";
$stmt = $pdo->prepare("INSERT INTO access(price_access,branch_no,mem_id,usetime) VALUES(?,?,?,?)");
$data_time = $_GET['date'] . " " . $_GET['time'] . ":00";
$stmt->bindParam(1, $_GET['price']);
$stmt->bindParam(2, $_GET['branch_no']);
$stmt->bindParam(3, $_SESSION['mem_id']);
$stmt->bindParam(4, $data_time);
$stmt->execute();
?>