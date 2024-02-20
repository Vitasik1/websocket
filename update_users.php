<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: index.php");
}
require("db/users.php");
require("db/chatrooms.php");

$objChatroom = new chatrooms;
$chatrooms = $objChatroom->getAllChatRooms();

$objUser = new users;
$users = $objUser->getAllUsers();
foreach ($users as $key => $user) {
    $color = 'color: red';
    if ($user['login_status'] == 1) {
        $color = 'color: green';
    }
    if (!isset($_SESSION['user'][$user['id']])) {
        echo "<tr><td>" . $user['name'] . "&nbsp;&nbsp;" . "</td>" ;
        echo "<td><span class='fas fa-globe' style='" . $color .  "' ></span>&nbsp;&nbsp;</td>";
        echo "<td>" . $user['last_login'] . "</td></tr>";
    }
}
