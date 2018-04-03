<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/2
 * Time: 13:41
 */
?>
<header class="nav">
    <span class="nav-left">
    MyBlog
   </span>
    <div class="nav-right">
        <a href="#"><img class="admin-face" src="../images/admin.png" alt=""></a>
        <span class=" slogan">Hi  <?php echo $_SESSION['adminName'] ?>!</span>
        <a href="../cores/dologin.php?act=logout"><img class="loginout" src="../images/loginout.png" alt=""></a>
    </div>
</header>
<nav class="sidebar">
    <ul>
        <li><a href="../admin/index.php"><img src="../images/system.png" alt="">系统首页</a></li>
        <li ><a href="../admin/article_add.php"><img src="../images/publish.png" alt="">博文管理</a>
            <ul >
                <li><a href="../admin/article_add.php">写文章<img src="../images/submenu.png" alt=""></a></li>
                <li><a href="../admin/article_list.php">所有文章<img src="../images/submenu.png" alt=""></a></li>
            </ul>
        </li>
        <li><a href="../admin/tag.php"><img src="../images/tag.png" alt="">标签管理</a></li>
        <li><a href="../admin/project.php"><img src="../images/project.png" alt="">项目管理</a></li>
        <li><a href="../admin/admin.php"><img src="../images/user.png" alt="">用户管理</a></li>
        <li><a href="../admin/recycle.php"><img src="../images/recycle.png" alt="">回收站</a></li>
    </ul>
</nav>
<nav id="minisidebar">
    <span id="minimenu">菜单栏>></span>
    <ul>
        <li><a href="../admin/index.php">系统首页</a></li>
        <li><a href="../admin/article_add.php">写文章</a></li>
        <li><a href="../admin/article_list.php">博文管理</a></li>
        <li><a href="../admin/tag.php">标签管理</a></li>
        <li><a href="../admin/project.php">项目管理</a></li>
        <li><a href="../admin/admin.php">用户管理</a></li>
        <li><a href="../admin/recycle.php">回收站</a></li>
    </ul>
</nav>