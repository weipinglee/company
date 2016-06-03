
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
                        <h3 class="text_2 color_2 maxheight1"><a href="{url:/index/about}">企业概况</a></h3>

                    </div>
                </div>
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_2"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="{url:/member/index}">会员查询</a></h3>

                    </div>
                </div>
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_3"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="{url:/index/healthy}">健康养生</a></h3>

                    </div>
                </div>
                <div class="grid_3">
                    <div class="box_1">
                        <div class="icon_4"><i></i></div>
                        <h3 class="text_2 color_2 maxheight1"><a href="{url:/product/index}">产品展厅</a></h3>

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
                {foreach:items=$article}
                <div class="grid_6">
                    <div>
                        <div class="box_2 ">
                            <div class="caption">
                                <h2 class="indent_1 color_3">{$item['title']}</h2>
                                <p class="text_5">
                                   {$item['content']} </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                {/foreach}
            </div>
        </div>

</div>
