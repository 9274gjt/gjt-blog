<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/3
 * Time: 10:54
 */
require_once '../includes/includes.php';
$sql="SELECT *FROM gjt_tag ORDER BY tid DESC";
$res=mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($res)){
    $rows[] = $row;
};
$aid=$_REQUEST['aid'];
$sql1="SELECT *FROM gjt_article WHERE aid={$aid}";
$res1=mysqli_query($link,$sql1);
$row1=mysqli_fetch_assoc($res1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Untitled</title>
    <link rel="stylesheet" href="..\plugs\bootstrap\dist\css\bootstrap.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/article.css">
</head>
<body>
<div class="wrapper">
    <?php require_once "../includes/admin_public.php" ?>
    <div class="page-wrapper">
        <div class="page-inner">
            <form class="article_add"  method="post" id="form">
                <legend>修改文章</legend>
                <filedset>
                    <input type="hidden" name="aid" value="<?php echo $aid?>">
                    <input type="text" class="form-control title" name="title" value="<?php echo $row1['title']?>">
                    <table>
                        <tr>
                            <td class="td-title">文章作者</td>
                            <td>
                                <label for="original">原创</label>
                                <input type="radio" name="author" id="original" value="原创"<?php if($row1['author']=="原创"){?>checked<?php }?>>
                                <label for="reprint">转载</label>
                                <input type="radio" name="author" id="reprint" value="转载"<?php if($row1['author']=="转载"){?>checked<?php }?>>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-title">文章标签</td>
                            <td>
                                <select name="tag" title="tag">
                                    <?php
                                    foreach ($rows as $item) {
                                        ?>
                                        <option value="<?php echo $item['tid']?>"
                                        <?php if($item['tid']==$row1['tid']){?>
                                            selected="selected"
                                        <?php } ?>
                                        ><?php echo $item['tname']?></option>
                                        <?php
                                    }?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <textarea class="form-control article_intro" name="intro"><?php echo $row1['intro']?></textarea>
                    <br>
                    <textarea class="form-control article_content"  id="editor_id" name="content" ><?php echo $row1['content']?></textarea>
                    <div class="button">
                        <button class="btn btn-default btn-success "  onclick="update()">提交发表</button>
                        <button class="btn btn-default btn-danger "  onclick="upsave()">保存草稿</button>
                        <button class="btn btn-default btn-warning" type="reset">取消修改</button>
                    </div>
                </filedset>
            </form>
            <?php
            mysqli_free_result($res1);
            mysqli_free_result($res);
            mysqli_close($link);
            ?>
        </div>
    </div>
</div>
<script src="js/min.js"></script>
<script type="text/javascript" charset="UTF-8" src="../plugs/editor/kindeditor.js"></script>
<script type="text/javascript" charset="UTF-8" src="../plugs/editor/lang/zh_CN.js" ></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_id');
        var editor;
        K('select[name=newlineTag]').change(function(){
            if(editor){
                editor.remove();
                editor = null;
            }
            editor = K.create('textarea[name ="content"]',{
                newlineTag : "br"
            });
        });
        K('select[name=newlineTag]').change();
    });
    function upsave(){
        document.getElementById('form').action="../cores/doarticle.php?act=upsave";
    }
    function update(){
        document.getElementById("form").action="../cores/doarticle.php?act=update";
    }
</script>
</body>
</html>