<?php
/**
 * Created by PhpStorm.
 * User: 92 74
 * Date: 2017/2/1
 * Time: 20:38
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="龚金涛,gongjintao,9274,Gjt的个人博客">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="uyan_auth" content="36fd179721" />
    <title>GjtBlog</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="author" href="humans.txt">
</head>
<body>
    <div class="container">
        <?php require_once 'includes/front_header.php' ?>
        <video id="bgvd" autoplay loop >
            <source src="sources/lighthouse.webm" type="video/webm">
            <source src="sources/lighthouse.mp4" type="video/mp4">
        </video>
        <audio id="audio" src="sources/River Flows In You.mp3" controls hidden ></audio>
      
        <section id="index" class="index index-cover">
            <div class="content">
                <h1 class="title">Welcome To My Blog</h1>
                <p class="teasing">Hello World <img id="voice_control" src="images/quiet.png" alt=""></p>
            </div>
            <button id="learn_more" class="more">Learn More</button>
        </section>
        <section  class="intro">
            <div class="intro-content">
                <h1>WHO AM I</h1>
                <div class="now">
                    <p>性别：男 属性：程序猿</p><br>
                    <p>目前：WEB开发爱好者</p><br>
                    <p>段位：Hello World!</p>
                </div>
                <div class="goal">
                    <p>现在是大三狗一枚，从大二下开始接触web开发</p>
                    <p>到现在也就知道什么是前端开发以及html，css,js,php ...这些长什么样子，仅此</p>
                    <p>目标：以后不用写代码</p>
                    <p>路漫漫兮其修远兮。。。</p>
                    </pre>
                </div>
                <div class="future">
                    <p>其实我还是比较喜欢写字</p>
                    <p>因为写字的时候，除了写字什么也不用想，什么也不用管</p>
                    <p>嗯，我到是希望以后有这样的生活</p>
                </div>
            </div>
        </section>
        <section class="contact">
            <div class="contact-left">
                <form >
                    <legend>Contact Me</legend>
                    <hr/>
                    <table>
                        <tr>
                            <td>Your Name</td>
                            <td><input type="text" name="nickname" placeholder="请输入你的名字" maxlength="10"  required></td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td><input type="text" name="Email" placeholder="请输入你的邮箱地址" maxlength="25"  required></td>
                        </tr>
                        <tr>
                            <td style="display:block;line-height: 36px">Your Message</td>
                            <td><textarea name="message" placeholder="请写下你的留言"></textarea> </td>
                        </tr>
                    </table>
                    <div class="button">
                        <button class="button-left" type="submit">Send</button>
                        <button class="button-right"  type="reset">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="contact-left-mini">
                <form action="contact.php" method="post">
                    <legend>Contact Me</legend>
                    <hr/>
                    <input type="text" name="nickname" placeholder="请输入你的名字" maxlength="10"  required><br>
                    <input type="text" name="Email" placeholder="请输入你的邮箱地址" maxlength="25"  required><br>
                    <textarea name="message" placeholder="请写下你的留言"></textarea>
                    <div class="button">
                        <button class="button-left" type="submit">Send</button>
                        <button class="button-right"  type="reset">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="contact-right">
                <ul>
                    <li><a class="qq" href="#">QQ</a></li>
                    <li><a class="wechat" href="#">微信</a></li>
                    <li><a class="weibo" href="http://weibo.com/5463149746" target="_blank">微博</a></li>
                    <li><a class="github" href="https://github.com/9274gjt" target="_blank">Github</a></li>
                </ul>
            </div>
        </section>
        <?php require_once 'includes/front_footer.php' ?>
    </div>
    <script src="js/min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>