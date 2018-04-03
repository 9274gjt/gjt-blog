<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/3
 * Time: 10:54
 */
require_once '../includes/includes.php';
verifyAdmin();
$sql="SELECT *FROM gjt_tag ORDER BY tid DESC";
$res=mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($res)){
    $rows[] = $row;
};
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
                <legend>撰写新文章</legend>
                <filedset>
                    <input type="text" class="form-control title" name="title" placeholder="在此输入标题">
                    <table>
                        <tr>
                            <td class="td-title">文章作者</td>
                            <td>
                                <label for="original">原创</label>
                                <input type="radio" name="author" id="original" value="原创" checked>
                                <label for="reprint">转载</label>
                                <input type="radio" name="author" id="reprint" value="转载">
                            </td>
                        </tr>
                        <tr>
                            <td class="td-title">文章标签</td>
                            <td>
                                <select name="tag" title="tag">
                                    <?php
                                    foreach ($rows as $item) {
                                        ?>
                                        <option value="<?php echo $item['tid']?>"><?php echo $item['tname']?></option>
                                        <?php
                                    }?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <textarea class="form-control article_intro" placeholder="请输入文章简介"  name="intro"></textarea>
                    <br>
                    <textarea class="form-control article_content"  id="editor_id" name="content" >请输入文章内容</textarea>
                    <div class="button">
                        <button class="btn btn-default btn-success "   onclick="add()">提交发表</button>
                        <button class="btn btn-default btn-danger "  onclick="save()">保存草稿</button>
                        <button class="btn btn-default btn-warning" type="reset">取消发表</button>
                    </div>
                </filedset>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" charset="UTF-8" src="js/min.js"></script>
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
    function add(){
        document.getElementById("form").action="../cores/doarticle.php?act=add";
    }
    function save(){
        document.getElementById('form').action="../cores/doarticle.php?act=save";
    }

</script>
</body>
</html>