<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Dark Admin</title>

    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="asset/css/local.css" />

    <script type="text/javascript" src="asset/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>   

    <style>
        div {
            padding-bottom:20px;
        }
        .form-control{
            color: black;
        }
        .notifyerror{
            color: red;
            font-size: 90%;
            font-style: italic;
            font-weight: normal;
            margin-bottom: 0px;
        }
    </style>
</head>
<body>
    <?php
    require_once('database/database.php');

    if(isset($_GET["id"])){
        $filmID = $_GET['id'];
    }
    $sql = "SELECT * FROM film WHERE film_id = $filmID";
    $result = executeResult($sql);
    
    if (count($result) == 0) { 
        echo "No required user";
    } else {
        $film = $result[0];

        $sql = "SELECT * FROM episodes WHERE film_id = ".$film['film_id']."";
        $episodes = executeResult($sql);

    ?>
        
    <div id="wrapper">
        <?php
            include("common.php");
        ?>
        <div id="edit-film">
            <div class="row text-center">
                <h2><?php echo $film["film_name"]; ?></h2>
            </div>
            <form method="post" id="form-insert-film" name="form-insert-film" class="form-horizontal" action="" role="form" >
                <div> 
                    <label for="episode_id" class="col-md-2">
                        Chọn tập
                    </label>
                    <div class="col-md-10">
                        <select id="episode_id" style="color: black; width:90%" name="episode_id" class="form-control" onclick="chosse(this.value,<?php echo count($episodes); ?>)">
                            <?php 
                                
                                if (count($episodes) > 0) {
                                    foreach($episodes as $episode) { ?>
                                    <option value="<?php echo $episode["episode_id"];?>">
                                        <?php echo $episode["episode_name"];?>
                                    </option>
                                <?php 
                                    }
                                }  
                                else {?>
                                    <option value="">None</option>
                                <?php }
                            ?>
                        </select>
                        <script>
                            function chosse(id,l) {
                                var data = <?php echo json_encode($episodes, JSON_HEX_TAG); ?>;
                                // document.getElementById("episode_name").value = l;
                                for(var i=0 ;i<l;i++)if(data[i]['episode_id']==id){
                                    document.getElementById("episode_name").value = data[i]['episode_name'];
                                    document.getElementById("video_link").value = data[i]['url'];
                                    break;
                                }
                                
                            }
                            </script>
                    </div>
                </div>

                <div>
                    <label for="episode_name" class="col-md-2">
                        Tên tập
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="episode_name" name="episode_name" value="<?php if(!empty($episodes)) echo $episodes[0]["episode_name"]; ?>">
                    </div>
                </div>

                <div>
                    <label for="link" class="col-md-2">
                        Link tập phim
                    </label>
                    <div class="col-md-9">
                            <input type="file" name="video_name" id="video_name" onchange="getlink()"/>
                            <input type="text" class="form-control" id="video_link" name="video" value="<?php if(!empty($episodes)) echo $episodes[0]['url'] ?>">
                            <p class="help-block">
                                Ví dụ: images/video/cuoc-chien-vo-cuc.jpg
                            </p>
                            <script>
                                function getlink() {
                                    var name =  document.getElementById("video_name").value;
                                    var n = name.lastIndexOf('\\'); 
                                    var result = name.substring(n + 1);
                                    document.getElementById("video_link").value = "images/video/" + result;
                                }
                            </script>
                        </div>
                        <div id="choss"></div>
                </div>
                 
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary" id="button_update" name="button_update">Lưu lại</button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger" name="delete" onclick="del()">Delete</button>
                    </div>
                    <div class="col-md-3">
                        <a type="button" href="addEpisode.php?id=<?php echo $filmID ?>" class="btn btn-primary" name="add" >Thêm Tập</a>
                    </div>
                    
                </div>
                <script>
                    function del() {
                        if(confirm("Bạn có chắc muốn xóa Tập này?")){
                            location.href= "deleteEpisode.php?id=" + document.getElementById("episode_id").value;
                        }
                    };
                </script>
            </form>
            
        </div>  
    </div>
   
   
    <?php
        require_once('database/database.php');
        if(isset($_POST["button_update"])){
            $episodeId = $_POST["episode_id"];
            $episodeName = $_POST["episode_name"];
            $url = $_POST["video"];
            
            $conn = new mysqli(HOST, USERNAME, PASSWORD,DATABASE);
            mysqli_set_charset($conn,'utf8');
            
                $sql = "UPDATE episodes SET 
                    episode_name='$episodeName',
                    url='$url'
                WHERE episode_id = $episodeId";

                $result = mysqli_query($conn,$sql); 

                if ($result){?>
                    <script>
                        alert("Edit film successfully!");
                        location.href= window.location.href; //reload page
                    </script>
                <?php 
                } else{ 
                ?>
                    <script>
                        alert("Edit film fail!"); -->
                    </script>
                <?php
                }
            
            mysqli_close($conn);
        }

        


    }
    ?>
    


</body>
</html>

        
    


