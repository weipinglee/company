
    <!--========================================================
                              CONTENT
    =========================================================-->
    <section id="content"><!-- <div class="ic">More Website Templates @ TemplateMonster.com - September08, 2014!</div> -->
        <div class="container">
            <div class="row wrap_11">
                <div class="grid_8 wrap_15">
                    <div class="wrap_10">
                        <h2 class="header_2 indent_2">{$article['title']}</h2>
                        <p class="line wrap_0 padd_15 put-left" style="width:100%;font-size:14px;">发布时间：{$article['add_time']} </p>
                        <div class="box_6">
                            <div>
                                <div class="caption">
                                    <a href=""><img src="{$article['images'][0]['thumb']}" alt="Image 1"/>
                                    <p class="text_2 color_1">
                                        {$article['title']}
                                    </p></a>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="text_2 color_2"><a href="#">{$article['title']}</a></h3>
                                <p class="text_5">
                                    {$article['content']}
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="grid_4_4">
                    {if:!empty($list)}
                    <div class="wrap_10">
                        <h2 class="header_2 indent_3">
                            更多精彩
                        </h2>
                        <div class="grid_1_1 put-left" style="margin:0;">
                            <img src="{$list[0]['img'][0]['thumb']}">
                        </div>
                        <span class="grid_2 put-right"><a href="{url:/index/article}?id={$list[0]['id']}">{$list[0]['title']}</a></span>
                            <div class="clearfix"></div>                        
                        <ul class="list_2 text_2 color_5 grid_4_4">
                            {foreach:items=$list}
                                {if:$key!=0}
                            <li><a href="{url:/index/article}?id={$item['id']}">{$item['title']}</a></li>
                                {/if}
                            {/foreach}
                        </ul>
                    </div>
                    {/if}
                </div>
            </div>
        </div>
