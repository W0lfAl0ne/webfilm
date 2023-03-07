<?php
require_once('database/database.php');
$s = $_GET['s'];

$search = addslashes($s);

$sql = "select * from film where film_name like '%$search%' or default_name like '%$search%'";
$result = executeResult($sql);
if (count($result) > 0) {
    $films = $result;

?>
    <!DOCTYPE html>
    <html lang="en">


    <body>
        <div class="list-group">
            <?php
            foreach ($films as $film) {
            ?>
                <a class="list-search" href="phim.php?id='<?php echo $film['film_id'] ?>'">
                    <img class="image" src="./uploads/images/<?php echo $film['image'] ?>" alt="<?php echo $film['film_name'] ?>">
                    <div class="list-search-title">
                        <b><?php echo $film['film_name'] ?></b>
                        <i><?php echo $film['default_name'] ?> (<?php echo $film['release_year'] ?>)</i>

                    </div>
                </a>

            <?php } ?>
        </div>
    </body>

    </html>
<?php } else { ?>
    <div class="list-search">
        <b style="color:#fff">Không Tìm Thấy Kết Quả Phù Hợp</b>
    </div>

<?php } ?>