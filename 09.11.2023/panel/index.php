<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('Location: ./login.php');
    die;
}

require_once '../include/db.php';
$messagesArr = getContactMessages();

$title = 'Panel administracyjny';
$activePage = 'home';
?>
<!doctype html>
<html lang="pl">
<?php
require_once '../include/head.php';
?>
<body>
<div class="container-fluid p-0">
    <?php
    require_once './include/nav.php';
    ?>
    <div class="container py-5">
        <h1>New contact messages</h1>
        <?php
        include_once "./include/messagesTable.php";
        include_once "./include/messagesGrid.php";
        ?>
    </div>
</div>
</body>
</html>
