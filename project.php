<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/10
 * Time: 22:07
 */
require_once 'includes/includes.php';
$sql="SELECT *FROM gjt_project ORDER BY pid DESC ";
$res=mysqli_query($link,$sql);
while($row=mysqli_fetch_assoc($res)){
    $rows[]=$row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GjtBlog</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/project.css">
    <link rel="author" href="humans.txt">
</head>
<body>
    <div class="container">
        <?php require_once 'includes/front_header.php' ?>
        <div class="project_box">
            <?php if(empty($rows)) { ?>
           <h1 style="color:red">暂无项目!</h1>
                <?php
            }else{
            foreach ($rows as $value) {
                ?>
                <div class="project">
                    <div class="project_details">
                        <a href="<?php echo $value['link'] ?>"><img src="<?php echo $value['pic'] ?>" alt=""></a>
                        <div class="project_content">
                            <h1><?php echo $value['proname'] ?></h1>
                            <p><?php echo $value['description'] ?></p>
                        </div>
                    </div>
                </div>

                <?php
            }
    }
    ?>
        </div>

        <?php require_once 'includes/front_footer.php' ?>
    </div>
<script src="js/min.js"></script>
</body>
</html>