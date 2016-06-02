
    <!--========================================================
                              CONTENT
    =========================================================-->
    <section id="content"><!-- <div class="ic">More Website Templates @ TemplateMonster.com - September08, 2014!</div> -->
        <div width="100%">
            <img src="" width="100%">
        </div>
        <div class="container">
            <div class="row wrap_2">
                {if:isset($data[0])}
                <div class="grid_12">                
                        <h2 class="header_2 indent_2 put-left">{$data[0]['cat_name']}</h2><span class="put-right"></span>
                        <div class="clearfix"></div>
                    <div class="grid_7 put-left" style="margin:0;">        
                        <div class="box_7">
                            <!-- 轮播 -->

                            <link href="{root:main/css/jquery.slideBox.css}" rel="stylesheet" type="text/css" />
                            <div id="demo1" class="slideBox">
                              <ul class="items grid_7">
                                  {foreach:items=$data[0]}
                                      {if:is_int($key)}
                                      <li><a href="{url:/index/article?id=$item['id']}" title="{$item['title']}"><img src="{if:isset($item['img'][0])}{$item['img'][0]['thumb']}{/if}"></a></li>
                                        {/if}
                                  {/foreach}
                              </ul>
                            </div>
                            <script src="{root:main/js/jquery.min.js}" type="text/javascript"></script>
                            <script src="{root:main/js/jquery.slideBox.min.js}" type="text/javascript"></script>
                            <script>
                            jQuery(function($){
                                $('#demo1').slideBox();
                                $('#demo2').slideBox({
                                    direction : 'top',//left,top#方向
                                    duration : 0.3,//滚动持续时间，单位：秒
                                    easing : 'linear',//swing,linear//滚动特效
                                    delay : 5,//滚动延迟时间，单位：秒
                                    startIndex : 1//初始焦点顺序
                                });
                                $('#demo3').slideBox({
                                    duration : 0.3,//滚动持续时间，单位：秒
                                    easing : 'linear',//swing,linear//滚动特效
                                    delay : 5,//滚动延迟时间，单位：秒
                                    hideClickBar : false,//不自动隐藏点选按键
                                    clickBarRadius : 10
                                });
                                $('#demo4').slideBox({
                                    hideBottomBar : true//隐藏底栏
                                });
                            });
                            </script>
                            <!-- 轮播 -->
                        </div>
                    </div>
                    <div class="grid_5 put-right">



                        <div class="caption line wrap_5">
                            <h3 class="text_6 color_2"><a href="{url:/index/article?id=$data[0][0]['id']}">{$data[0][0]['title']}</a></h3>
                            <p class="text_5 wrap_16">
                                {$data[0][0]['content']}

                            </p>
                        </div>

                        <ul style="list-style: url(images/dot.png);">
                            {foreach:items=$data[0]}
                                {if:$key!=0 && is_int($key)}
                                    <li><a href="{url:/index/article?id=$item['id']}">这是其他的信息</a></li>
                                {/if}
                            {/foreach}
                        </ul>

                    </div>
                        <div class="clearfix"></div>
                </div>
                {/if}
                {foreach:items=$data}
                    {if:$key!=0}
                <div class="grid_5_5">
                    <div class="wrap_10_5">
                            <h2 class="header_2 indent_2 put-left"><span class="color_3"></span>{$item['cat_name']}</h2><span class="put-right"><!--<a href=""> ></a>--></span>
                            <div class="clearfix"></div>
                        {if:isset($item[0])}
                            <div class="box_6">
                                <div class="grid_2" style="margin:0;"><img src="{$item[0]['img'][0]['thumb']}"></div>
                                <span class="grid_2"><a href="{url:/index/article?id=$item[0]['id']}">{$item[0]['title']}</a></span>
                            </div>
                            {/if}
                            <div class="clearfix"></div>      
                            <ul class="grid_4_4 wrap_16">
                                {foreach:items=$item key=$k item=$v}
                                {if:$k!=0}
                                <li><a href="{url:/index/article?id=$v['id']}">{$v['title']}</a></li>
                                 {/if}
                                {/foreach}
                            </ul>
                    </div>
                </div>
                    {/if}
                {/foreach}

                </div>

            </div>
        </div>
    </section>
