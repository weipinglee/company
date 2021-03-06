<!DOCTYPE html>
<html lang="zh">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <link rel="icon" href="{root:main/images/favicon.ico}" type="image/x-icon">
    <link rel="stylesheet" href="{root:main/css/grid.css}">
    <link rel="stylesheet" href="{root:main/css/style.css}">
    <link rel="stylesheet" href="{root:main/css/camera.css}"/>
    <link rel="stylesheet" href="{root:main/css/owl.carousel.css}"/>
    <script src="{root:main/js/jquery.js}"></script>
    <script src="{root:main/js/jquery-migrate-1.2.1.js}"></script>
    <script src="{root:main/js/jquery.equalheights.js">}</script>
    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="{root:main/js/jquery.mobile.customized.min.js}"></script>
    <!--<![endif]-->
    <script src="{root:main/js/camera.js"}></script>
    <script src="{root:main/js/owl.carousel.js}"></script>
    <!-- 使浏览器支持H5用的JS
    <script src="http://html5media.googlecode.com/svn/trunk/src/html5media.min.js"></script> -->
</head>
<body>
<div class="page">
    <!--========================================================
                              HEADER
    =========================================================-->
    <header id="header">
        <div id="stuck_container">
            <div class="container">
                <div class="row">
                    <div class="grid_12">
                        <div class="brand put-left">
                            <h1>
                                <a href="index.html">
                                    <img src="{$logo}" />
                                </a>
                            </h1>
                        </div>
                        <nav class="nav put-right">
                            <ul class="sf-menu">
                            {foreach:items=$navlist}
                            <li {if:isset($cur)&& $cur==$item['nav_name']}class="current"{/if}><a href="{$item['guide']}">{$item['nav_name']}</a></li>
                            {/foreach}


                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

{content}


 <div class="footer">
<div class="container">
    <div class="row wrap_9 wrap_4 wrap_10">
    {foreach:items=$bottom}
        <div class="grid_2 put-left">
            <div class="header_1 color_1">
                <b>{$key}</b>
            </div>
            <div class="box_3">
                <ul class="list_2">
                {foreach:items=$item item=$title}
                    <li><a class="fa" href="{url:/index/article}?id={$title['id']}">{$title['title']}</a></li>
                {/foreach}
                </ul>
            </div>
        </div>
    {/foreach}



        <div class="grid_4 put-right">
            <div class="header_1 wrap_3 color_1">
                服务电话：{$tel}
               <!-- <img src="images/qrkd.png">-->
                <h4>官方微信</h4>
            </div>
            <div class="box_3">
                <ul class="list_1">
                    <li><a class="fa fa-twitter" href="#"></a></li>
                    <li><a class="fa fa-facebook" href="#"></a></li>
                    <li><a class="fa fa-google-plus" href="#"></a></li>
                    <li><a class="fa fa-pinterest" href="#"></a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
</section>
</div></div>
<!--========================================================
                          FOOTER
=========================================================-->
<footer id="footer" class="color_9">
    <div class="container">
        <div class="row">
            <div class="grid_12">
                <p class="info text_4 color_4">Copyright &copy; 2015.Company name All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<script src="{root:main/js/script.js}"></script>
</body>
</html>