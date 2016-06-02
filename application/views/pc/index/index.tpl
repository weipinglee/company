
    <!--========================================================
                              CONTENT
    =========================================================-->

    <section id="content">
        <div class="camera-wrapper">
            <div id="camera" class="camera-wrap">
                {foreach:items=$show}
                    {if:$key==0}
                   <a href="{$item['show_link']}" class="show"><img src="{$item['show_upload']}" /></a>
                    {else:}
                        <a href="{$item['show_link']}" class="hide"><img src="{$item['show_upload']}" /></a>

                    {/if}
                {/foreach}


            </div>
        </div>
        <script type="text/javascript">
            function startScroll(){
                setInterval(function(){
                    var nextImg = $('.show').next('.hide');
                    if(nextImg.length==0){
                        nextImg = $('#camera a').eq(0);
                    }
                    $('#camera .show').removeClass('show').addClass('hide');
                    nextImg.removeClass('hide').addClass('show');

                }, 3000);
            }
            startScroll();
        </script>
        <div class="container">
            <div class="row wrap_1 wrap_5">
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_1"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="#">企业概况</a></h3>

                    </div>
                </div>
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_2"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="#">会员查询</a></h3>

                    </div>
                </div>
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_3"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="#">健康养生</a></h3>

                    </div>
                </div>
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_4"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="#">产品展厅</a></h3>

                    </div>
                </div>
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_5"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="#">投诉建议</a></h3>

                    </div>
                </div>
            </div>
        </div>


        <div class="bg_1 wrap_2 wrap_4">
            <div class="container">
                <div class="row">
                    <div class=" grid_12 line">
                        <h2 class="header_1 wrap_0 color_3 put-left">
                            主题产品展示
                        </h2>
                        <a href="#" class="put-right" style="font-size:12px;">查看更多</a>
                    </div>
                </div>
                <div class="row">
                    {foreach:items=$product}
                    <div class="grid_4">
                        <div class="box_2 maxheight2 box_inner">
                            <div><img style="width:236px;height:172px;" src="{$item['file']}" alt="Image 1"/></div>
                            <div class="caption">
                                <h3 class="text_2">
                                    {$item['name']}
                                </h3>
                                <p class="text_3">
                                    {$item['description']}
                                </p>
                                <a href="{url:/product/detail?id=$item['id']}" class="btn_2 put-right">去看看</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                {/foreach}

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row wrap_1">
                <div class="grid_6">
                    <div>
                        <div class="box_2 ">
                            <div class="caption">
                                <h2 class="indent_1 color_3">企业简介</h2>
                                <p class="text_5">
                                    腾讯集团2012年开始使用国康私人医生保健、名医绿道、大病顾问、健康管家等健康管理服务，国康服务是腾讯18个福利项目中，最受欢迎的福利项目。
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="grid_6">
                    <div>
                        <div class="box_2 ">
                            <div class="caption">
                                <h2 class="indent_1 color_3">视频介绍</h2>
                                <p class="text_5">
                                    <video src="MP4.mp4" class="grid_5" controls autobuffer></video>
                                </p>
                                <a href="#" class="btn_2 put-right">查看更多</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <div class="grid_6">
                    <div>
                        <div class="box_2 ">
                            <div class="caption">
                                <h2 class="indent_1 color_3">行业动态</h2>
                                <p class="text_5">
                                <ul>
                                    <li class="text_5">第一条新闻动态</li>
                                    <li class="text_5">第一条新闻动态</li>
                                    <li class="text_5">第一条新闻动态</li>
                                </ul>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="grid_6">
                    <div>
                        <div class="box_2 ">
                            <div class="caption">
                                <h2 class="indent_1 color_3">联系投诉</h2>
                                <p class="text_5">
                                    联系电话：1234567
                                    邮箱：exaslkj@126.com
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg_1 wrap_7 wrap_6">
            <div class="container">
                <div class="row">
                    <div class="grid_12">
                        <h2 class="header_1 wrap_5 color_3">
                            焦点
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="grid_12">

                        <link rel="stylesheet" type="text/css" href="{root:main/css/tab.css}">
                        <div id="tab">
                            <h3 class="up" id="two1" onmouseover="setContentTab('two',1,4)">热点新闻</h3>
                            <div class="block" id="con_two_1">
                                <ul>
                                    <li><a class="tab_menu grid_2" href="article.html" style="margin:0;"><img src="images/index-3_img02.jpg"></a><a class="tab_title grid_9 text_3" href="article.html">收银妹代理棋牌游戏 成功晋级游戏女老板3</a>
                                        <div class="clearfix"></div>
                                        <p class="grid_9">收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3</p><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙：欢庆“十一”送祝福</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙携手移动端APP 开创棋牌游戏新模</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">看棋牌大亨如何颠覆快播江湖</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">棋牌行业：解密点点妙合作内幕 分成竟高达</a><span>2014-09-05</span></li>
                                </ul>
                            </div>
                            <h3 id="two2" onmouseover="setContentTab('two',2,4)">合作播报</h3>
                            <div id="con_two_2">
                                <ul>
                                    <li><a class="tab_menu grid_2" href="article.html" style="margin:0;"><img src="images/index-3_img03.jpg"></a><a class="tab_title grid_9 text_3" href="article.html">收银妹代理棋牌游戏 成功晋级游戏女老板3</a>
                                        <div class="clearfix"></div>
                                        <p class="grid_9">收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3</p><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙：欢庆“十一”送祝福</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙携手移动端APP 开创棋牌游戏新模</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">看棋牌大亨如何颠覆快播江湖</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">棋牌行业：解密点点妙合作内幕 分成竟高达</a><span>2014-09-05</span></li>
                                </ul>
                            </div>
                            <h3 id="two3" onmouseover="setContentTab('two',3,4)">行业咨询</h3>
                            <div id="con_two_3">
                                <ul>
                                    <li><a class="tab_menu grid_2" href="article.html" style="margin:0;"><img src="images/index-3_img04.jpg"></a><a class="tab_title grid_9 text_3" href="article.html">收银妹代理棋牌游戏 成功晋级游戏女老板3</a>
                                        <div class="clearfix"></div>
                                        <p class="grid_9">收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3</p><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙：欢庆“十一”送祝福</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙携手移动端APP 开创棋牌游戏新模</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">看棋牌大亨如何颠覆快播江湖</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">棋牌行业：解密点点妙合作内幕 分成竟高达</a><span>2014-09-05</span></li>
                                </ul>
                            </div>
                            <h3 id="two4" onmouseover="setContentTab('two',4,4)">运营攻略</h3>
                            <div id="con_two_4">
                                <ul>
                                    <li><a class="tab_menu grid_2" href="article.html" style="margin:0;"><img src="images/index-3_img05.jpg"></a><a class="tab_title grid_9 text_3" href="article.html">收银妹代理棋牌游戏 成功晋级游戏女老板3</a>
                                        <div class="clearfix"></div>
                                        <p class="grid_9">收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3收银妹代理棋牌游戏 成功晋级游戏女老板3</p><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙：欢庆“十一”送祝福</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">点点妙携手移动端APP 开创棋牌游戏新模</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">看棋牌大亨如何颠覆快播江湖</a><span>2014-09-05</span></li>
                                    <li><a class="tab_menu" href="article.html">[新闻热点]</a><a class="tab_title" href="article.html">棋牌行业：解密点点妙合作内幕 分成竟高达</a><span>2014-09-05</span></li>
                                </ul>
                            </div>
                        </div>

                        <script type="text/javascript">
                            function setContentTab(name, curr, n) {
                                for (i = 1; i <= n; i++) {
                                    var menu = document.getElementById(name + i);
                                    var cont = document.getElementById("con_" + name + "_" + i);
                                    menu.className = i == curr ? "up" : "";
                                    if (i == curr) {
                                        cont.style.display = "block";
                                    } else {
                                        cont.style.display = "none";
                                    }
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
</div>
