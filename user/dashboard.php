<?php
session_start();
require('../db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>ยินดีต้อนรับ/Welcome</title>
    <link rel="stylesheet" href="../font.css">
    <?php include('../header.php'); ?>
</head>

<body>

    <div class="container">
        <?php
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            header("Location: login.php");
        }
        ?>

        <h3>Welcome, <?php echo $_SESSION['user_name'] . $_SESSION['user_lastname']; ?></h3>

    </div>

    <div>
        <div class="container">
            <h2>User Dashboard</h2>
            <div id="profile">
                <p>Name: <?= htmlspecialchars($_SESSION['user_name']) ?></p>
                <p>Lastname: <?= htmlspecialchars($_SESSION['user_lastname']) ?></p>
                <p>Email: <?= htmlspecialchars($_SESSION['user_email']) ?></p>
                <p>Phone: <?php echo $_SESSION['user_phone'] ?></p>
                <button onclick="toggleEdit()">Edit Profile</button>
            </div>
            <div id="edit-profile" class="hidden">
                <form action="user_dashboard.php" method="POST">
                    <input type="hidden" name="update_profile" value="1">
                    Name: <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['user_name'])  ?>" required>
                    Lastname: <input type="text" name="lastname" value="<?= htmlspecialchars($_SESSION['user_lastname']) ?>" required>
                    Phone: <input type="text" name="phone" value="<?= htmlspecialchars($_SESSION['user_phone']) ?>" required>
                    <button type="submit" id="update">Update Profile</button>
                    <button type="button" id="cancel" onclick="toggleEdit()">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>