<?php
    require_once('database/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete user</title>

    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/local.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/delete.css" />

    <script type="text/javascript" src="asset/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>   
</head>
<body>
    <div id="wrapper">
        <?php
            include("common.php");
        ?>
       <div class="container">
            <div class="row" id="search-user">
                <form method="post">
                    <div class="row">
                       <div class="col-md-1"></div>
                        <div class="col-md-7">
                            <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search film for name" name="qry">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-lg btn-primary" type="submit" name="button_search" style="padding: 8px">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row" id="list-user">
                <div class="col-md-1"></div>
                <div class="col-md-8">
                    <!-- get from database -->
                    <?php
                    if(!isset($_POST["button_search"])){
                            $sql = "SELECT * FROM film ORDER BY film_name";
                            $films = executeResult( $sql);
                                if (count($films) > 0) { ?>
                            <table class="table" style="margin: 10px 0px">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Tên khác</th>
                                    <th scope="col">Số tập</th>
                                    <th scope="col">Đạo diễn</th>
                                    <th scope="col">Diễn viên</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php foreach($films as $film) {  ?>
                            <tr>
                                <th> <?php echo $film["film_id"] ?> </th>
                                <th> <?php echo $film["film_name"] ?> </th>
                                <th> <?php echo $film["default_name"] ?> </th>
                                <th> <?php echo $film["episode_number"] ?> </th>
                                <th> <?php echo $film["directors"] ?> </th>
                                <th> <?php
                                    $sql ="select  actor.name from film_actor inner join actor on film_actor.film_id = ".$film['film_id']." and film_actor.actor_id = actor.actor_id";
                                    $temp = executeResult( $sql);
                                    foreach($temp as $actor) if($actor == $temp[0]) echo $actor['name'];
                                        else echo ', '.$actor['name'];
                                    ?> </th>
                                <td>
                                    <button type="button" class="btn btn-info" name="edit" onclick="edit(this)">Edit</button>
                                    <button type="button" class="btn btn-primary" name="episode" onclick="manageEpisode(this)">Episode</button>
                                    <button type="button" class="btn btn-danger" name="delete" onclick="del(this)">Delete</button>
                                </td>
                            </tr>
                            <?php 
                                }
                            }
                        }
                        if(isset($_POST["button_search"])){
                            $qry = isset($_POST["qry"]) ? $_POST["qry"] : '';
                            
                            $sql_name = "SELECT * FROM film WHERE film_name LIKE '%{$qry}%'";
                            $sql_name2 = "SELECT * FROM film WHERE default_name LIKE '%{$qry}%'";
                            

                            $sql = $sql_name . " UNION ". $sql_name2;
                            $result = executeResult( $sql);
                            if (count($result) > 0) { ?>
                                <!-- output data of each row -->
                                <table class="table" style="margin: 10px 0px">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Tên khác</th>
                                            <th scope="col">Số tập</th>
                                            <th scope="col">Đạo diễn</th>
                                            <th scope="col">Diễn viên</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach($result as $row) {  ?>
                                    <tr>
                                        <th> <?php echo $row["film_id"] ?> </th>
                                        <th> <?php echo $row["film_name"] ?> </th>
                                        <th> <?php echo $row["default_name"] ?> </th>
                                        <th> <?php echo $row["episode_number"] ?> </th>
                                        <th> <?php echo $row["directors"] ?> </th>
                                        <th> <?php
                                            $sql ="select  actor.name from film_actor inner join actor on film_actor.film_id = ".$row['film_id']." and film_actor.actor_id = actor.actor_id";
                                            $temp = executeResult( $sql);
                                            foreach($temp as $actor) if($actor == $temp[0]) echo $actor['name'];
                                                else echo ', '.$actor['name'];
                                            ?> </th>
                                        <td>
                                            <button type="button" class="btn btn-info" name="edit" onclick="edit(this)">Edit</button>
                                            <button type="button" class="btn btn-primary" name="episode" onclick="manageEpisode(this)">Episode</button>
                                            <button type="button" class="btn btn-danger" name="delete" onclick="del(this)">Delete</button>
                                        </td>
                                    </tr>
                                <?php 
                                }
                            } else {
                                echo "No user like ".$qry;
                            }
                        }
                        
                    ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
    <script>

        
        function edit(params) {
                var tr = params.parentElement.parentElement;
                var td0= tr.cells.item(0).innerHTML;
                td0 = td0.replace(' ','' ); //id của user có space ???
                location.href= "editFilm.php?id=" + td0;
        };
        function manageEpisode(params) {
                var tr = params.parentElement.parentElement;
                var td0= tr.cells.item(0).innerHTML;
                td0 = td0.replace(' ','' ); //id của user có space ???
                location.href= "manageEpisode.php?id=" + td0;
        };
        function del(params) {
            if(confirm("Bạn có chắc muốn xóa film này?")){
                var tr = params.parentElement.parentElement;
                var td0= tr.cells.item(0).innerHTML;
                td0 = td0.replace(' ','' ); //id của user có space ???
                location.href= "deleteFilm.php?id=" + td0;
            }
        };
    </script>
</body>
</html>
