
    <!--========================================================
                              CONTENT
    =========================================================-->
    <section id="content"><!-- <div class="ic">More Website Templates @ TemplateMonster.com - September08, 2014!</div> -->
        <div class="bg_1 wrap_16 wrap_10">
            <div class="container">
                <div class="row">
                    <div class="grid_12">

                        <div id="owl_2">
                            <div class="item">
                                <div class="row">
                                    <div class="preffix_1 grid_10">
                                        <ul class="list_3">
                                            {if:!empty($product['images'])}
                                            {foreach:items=$product['images']}
                                            <li><a href="#"><img src="{$item['thumb']}" alt="Image 9"/></a><p></p></li>
                                            {/foreach}
                                            {/if}
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row wrap_0">
                <div class="grid_11">
                    <div class="wrap_0">

                        <h1 class="wrap_3 padd_25">{$product['name']}</h1>
                        <p class="text_3 padd_25">{$product['description']}<span class="text_6 color_3">RMB&nbsp;{$product['price']}</span></p>
                    </div>
                    <div class=""></div>
                </div>
                <div class="grid_11">
                    <div class="wrap_0">
                        <style type="text/css">
                            .lanrenzhijia{ width:100%; height:auto; margin:15px auto; background:#fff; border:1px solid #eee;}
                            .lanrenzhijia .tab{ overflow:hidden;}
                            .lanrenzhijia .tab a{ display:block; padding:10px 20px; float:left; text-decoration:none; color:#333; background:#ccc; width:18%;}
                            .lanrenzhijia .tab a:hover{ background:#E64E3F; color:#fff; text-decoration:none;}
                            .lanrenzhijia .tab a.on{ background:#E64E3F; color:#fff; text-decoration:none;}
                            .lanrenzhijia .content{ overflow:hidden; padding:10px;}
                            .lanrenzhijia .content li{ display:none;}
                        </style>
                        <div class="lanrenzhijia">
                            <div class="tab">
                                <a href="javascript:;" class="on">产品介绍</a>
                            </div>
                            <div class="content">
                                {$product['content']}
                            </div>
                        </div>
                        <script>
                        $(function(){
                            $(".lanrenzhijia .tab a").mouseover(function(){
                                $(this).addClass('on').siblings().removeClass('on');
                                var index = $(this).index();
                                number = index;
                                $('.lanrenzhijia .content li').hide();
                                $('.lanrenzhijia .content li:eq('+index+')').show();
                            });
                            
                            var auto = 1;  //等于1则自动切换，其他任意数字则不自动切换
                            if(auto ==1){
                                var number = 0;
                                var maxNumber = $('.lanrenzhijia .tab a').length;
                                function autotab(){
                                    number++;
                                    number == maxNumber? number = 0 : number;
                                    $('.lanrenzhijia .tab a:eq('+number+')').addClass('on').siblings().removeClass('on');
                                    $('.lanrenzhijia .content ul li:eq('+number+')').show().siblings().hide();
                                }
                              }
                        });
                        </script>
                    </div>
                </div>
                <!-- <div class="grid_4">
                    <div class="wrap_16">
                        <h2 class="header_2 indent_3">
                            更多精彩
                        </h2>
                        <ul class="list_2 text_2 color_5">
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                            <li><a href="#">这是其他的信息</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
