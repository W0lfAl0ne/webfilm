<?php
require_once('database/database.php');
session_start();
ob_start();
$id = $_POST["filmId"];
$userName = $_POST["userName"];
$content = $_POST["content"];

$sql = "select user_id from users WHERE user_name =  '$userName' ";
$result = executeResult($sql);
$userId = $result[0]["user_id"];

$sql = "insert into comment (film_id, user_id, time, content) values (" . $id . "," . $userId . ",now(),'$content');";
execute($sql);

$sql = "select c.comment_id, c.content, c.time, u.user_name, u.full_name, u.gender
        from film f
        inner join comment c  on c.film_id = f.film_id and f.film_id = " . $id . "
        inner join users u on c.user_id = u.user_id;";
$result = executeResult($sql);
$film_comments = $result;

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    foreach ($film_comments as $film_comment) { ?>
        <div class="user">
            <?php $t = $film_comment['gender'] === 'male' ? 'assets/img/avatar-nam.jpg' : 'assets/img/avatar-nu.jpg' ?>
            <img src="<?php echo $t; ?>" alt="">
            <div class="info">
                <div class="name"><?php echo $film_comment['full_name'] ?></div>
                <div class="time"><?php echo $film_comment['time'] ?></div>
                <br>
                <p><?php echo $film_comment['content'] ?></p>
            </div>
            <br>
            <?php
            $emp = !empty($_SESSION["username"]);
            if ($emp && $_SESSION["username"] == $film_comment['user_name']) { ?>
                <button onclick="deleteComment(<?php echo $film_comment['comment_id'] ?>,<?php echo $id ?> )">Xóa</button>
            <?php } ?>
        </div>
        <br>
    <?php } ?>
</body>

</html>