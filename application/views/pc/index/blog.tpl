
    <!--========================================================
                              CONTENT
    =========================================================-->
    <section id="content"><!-- <div class="ic">More Website Templates @ TemplateMonster.com - September08, 2014!</div> -->
        <div class="container">
            <div class="row wrap_11">
                <div class="grid_8">
                    <div class="wrap_10">
                        <h4 class="header_1 indent_3">当前位置:最新动态>文章中心>最新动态</h4>
                        <h2 class="header_2 indent_3">最新动态</h2>
                        {foreach:items=$data}
                        {if:$key<3}
                        <div class="box_6">
                            <div class="put-left">
                                <div class="caption">
                                    <a href="{url:/index/article}?id={$item['id']}"><img src="{if:isset($item['img'][0])}{$item['img'][0]['thumb']}{/if}" alt="Image 1"/>
                                    <p class="text_2 color_1">
                                        {$item['title']}
                                    </p></a>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="text_2 color_2"><a href=""> {$item['title']}</a></h3>
                                <p class="text_5">
                                    {$item['description']}
                                </p>
                                <a class="btn_2" href="{url:/index/article}?id={$item['id']}">read more</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        {/if}
                        {/foreach}

                    </div>
                </div>
                <div class="grid_4_4">
                    {if:count($data)>3}
                    <div class="wrap_10">
                        <h2 class="header_2 indent_3">
                            更多精彩
                        </h2>
                        <div class="grid_1_1 put-left" style="margin:0;"><img src="{if:isset($data[3]['img'][0])}{$data[3]['img'][0]['thumb']}{/if}"></div>
                        <span class="grid_2 put-right"><a href="{url:/index/article}?id={$data[3]['id']}">{$data[3]['title']}</a></span>
                            <div class="clearfix"></div>                        
                        <ul class="list_2 text_2 color_5 grid_4_4">
                            {foreach:items=$data}
                            {if:$key>3}
                            <li><a href="{url:/index/article}?id={$item['id']}">{$item['title']}</a></li>
                            {/if}
                            {/foreach}
                        </ul>
                    </div>
                    {/if}
                </div>
            </div>
        </div>
