<?php
session_start();
if (
    $_SESSION['mem_id'] == null ||
    $_SESSION["mem_role"] != "admin"
) {
    header("location: ../../index.php");
}
?>
<?php include "../connect.php" ?>
<?php
$stmt = $pdo->prepare("SELECT * FROM staff WHERE staffno = ?");
$stmt->bindParam(1, $_GET["staffno"]);
$stmt->execute();
$row = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขพนักงาน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet" />
    <link rel="icon" href="mer.jpg">
</head>

<body>
    <a href="allstaff.php" class="buttonback"><button>BACK</button></a>
    <div class="section">
        <form action="editconfirm.php" method="post">
            <img src="./img/<?= $row["staffno"] ?>.jpg" alt="Responsive image" width='150' class="rounded"><br><br>
            หมายเลขพนักงาน : <input type="text" name="staff" value="<?= $row["staffno"] ?>" disabled><br><br>
            <input type="hidden" value="<?= $row["staffno"] ?>" name="staffno" />
            ชื่อพนักงาน : <input type="text" name="staffname" value="<?= $row["staffname"] ?>" pattern="[A-Za-z0-9ก-์\s]{2,50}"><br><br>
            เวลาเข้างาน : <input type="time" name="worktime" value="<?= $row["worktime"] ?>"><br><br>
            ประเภท : <input type="text" name="type" value="<?= $row["type"] ?>" pattern="[A-Za-z0-9ก-์]{2,50}"><br><br>
            สาขาที่ทำงาน : <input type="text" name="branch_no" value="<?= $row["branch_no"] ?>" pattern="[A-Za-z0-9]{5,15}"><br><br>
            ราคา : <input type="text" name="price" value="<?= $row["price"] ?>" pattern="[0-9]{1,20}"><br><br>
            <button type="submit">แก้ไขข้อมูล</button>

        </form>
    </div>
</body>

</html>