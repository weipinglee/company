<!--========================================================
                             CONTENT
   =========================================================-->
<section id="content"><!-- <div class="ic">More Website Templates @ TemplateMonster.com - September08, 2014!</div> -->
    <div class="container">
        <div class="row wrap_11">
            <div class="grid_8">
                <div class="wrap_10">

                    <h2 class="header_2 indent_3">最新动态</h2>
                    {foreach:items=$data}
                        {if:$key<3}
                    <div class="box_6">
                        <div class="put-left">
                            <div class="caption">
                                <img src="{if:isset($item['img'][0])}{$item['img'][0]['file']}{/if}" />
                                    <p class="text_2 color_1">
                                        {$item['title']}
                                    </p>
                            </div>
                        </div>
                        <div class="caption">
                            <h3 class="text_2 color_2"><a href=""> {$item['title']}</a></h3>
                            <p class="text_5">
                                {$item['content']}
                            </p>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                        {/if}
                    {/foreach}

            </div>
            <div class="grid_4_4">
                <div class="wrap_10">
                    <h2 class="header_2 indent_3">
                        更多精彩
                    </h2>
                    <div class="grid_1_1 put-left" style="margin:0;"><img src="images/1463990612624.jpg"></div>
                    <span class="grid_2 put-right">这也是其他的信息</span>
                    <div class="clearfix"></div>
                    <ul class="list_2 text_2 color_5 grid_4_4">
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                        <li><a href="article.html">这是其他的信息</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>