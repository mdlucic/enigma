<?php
include_once('../../resources/html/header.php');
include_once('../../config/database.php');
session_start();



$sql = 'SELECT id, username FROM user_profile WHERE username = :username';
$stmt = new DBConn;

$db = $stmt->connect()->prepare($sql);
$db->bindParam(':username', $user_profile_id);
$db->execute();
$row = $db->fetchAll(PDO::FETCH_ASSOC);
$username = $row[0]['username'];



if ($_SESSION['username'] == $row[0]['username']) {
?>
    <form method="post" action="" style="display:inline;">
        <input type="submit" name="posts" class="user_page_tray" style="font-size:16px;" value="Posts">
        <input type="submit" name="posts" class="user_page_tray" style="font-size:16px;" value="Friends">
    </form>

    <form method="post" action="" style="display:inline;">
        <button type="submit" name="request_list" class="user_page_tray" style="font-size:16px;">Friend Requests</button>
    </form>





    <?php
    if (isset($_POST['request_list'])) {
        $sql = "SELECT friend_one FROM friendship_requests WHERE friend_two = :friend_two";
        $stmt = new DBConn;
        $db = $stmt->connect()->prepare($sql);
        $db->bindParam(':friend_two', $_SESSION['username']);
        $db->execute();
        $request_row = $db->fetchAll(PDO::FETCH_ASSOC);

        foreach ($request_row as $friend_row) {
            $possible_friend = $friend_row['friend_one'];
    ?>
            <form method="post" action="../../src/model/friend_accept_validation.php" style="display:inline;">
                <p> <?php echo $possible_friend ?></p>
                <button type="submit" name="accept" class="user_page_tray" style="font-size:16px;" value="<?php echo $possible_friend; ?>">Accept</button>


            </form>
    <?php
        }
    }
    include_once("$docroot/resources/html/footer.php");
}


if (!$_SESSION['username'] || $_SESSION['username'] == "") {
    echo "<p>" . $username . "</p>";
}



if ($_SESSION['username'] != $row[0]['username']) {

    ?>

    <h3><?php echo $username; ?> </h3>
    <form method="post" action="" style="display:inline;">
        <input type="submit" name="posts" class="user_page_tray" style="font-size:16px;" value="Posts">
        <input type="submit" name="posts" class="user_page_tray" style="font-size:16px;" value="Friends">
    </form>

    <form method="post" action="../../src/model/friend_request_validation.php" style="display:inline;">
        <button type="submit" name="friend_request" class="user_page_tray" style="font-size:16px;" value="<?php echo $username; ?>">Add Friend</button>

    </form>

<?php

}
?>
</div>