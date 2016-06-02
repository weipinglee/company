
<!--========================================================
                          CONTENT
=========================================================-->
{foreach:items=$about}
<section id="content">
<div class="container">
    <div class="row wrap_11 wrap_12">
        <div class="grid_7">
            <h2 class="header_2 indent_1 color_3">{$item['title']}</h2><span class="text_5"></span>
            <div class="box_4">
                <p class="text_5">
                   {$item['content']}
                </p>
            </div>
        </div>
        {if:!empty($item['img'])}
        <div class="grid_5">
            <div class="img-wrap">
                {foreach:items=$item['img'] key=$k item=$img}
                <img  class="img_1" src="{$img['thumb']}" alt="Image 1"/>
                {/foreach}
            </div>
            <div class="clearfix"></div>
        </div>
        {/if}
    </div>
</div>
    {/foreach}
