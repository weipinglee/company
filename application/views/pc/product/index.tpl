<!--========================================================
                          CONTENT
=========================================================-->
<section id="content">
    <div class="container">
        <div class="row wrap_11 wrap_20">
            <div class="grid_12">
                <div class="text_7 color_2">
                  <!--  产品种类:
                    <ul id="filters">
                        <li><a href="#" data-filter="*">全部</a></li>
                        <li><a href="#" data-filter="c1">种类1</a></li>
                        <li><a href="#" data-filter="c2">种类2</a></li>
                        <li><a href="#" data-filter="c3">种类3</a></li>
                    </ul>-->
                </div>
            </div>
        </div>
    </div>
    <div class="bg_1 wrap_17">
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <div class="isotope row">
                        {foreach:items=$data}
                        <div class="element-item grid_4 c1">
                            <div class="box_7">
                                <div class="img-wrap">
                                    <a href="product.html"><img src="{$item['thumb']}" alt="Image 1"/></a>
                                </div>
                                <div class="caption">
                                    <h3 class="text_2 color_2"><a href="{url:/product/detail?id=$item['id']}">{$item['name']}</a></h3>
                                    <p class="text_5">
                                        {$item['description']}
                                    </p>
                                    <a class="btn_2" href="{url:/product/detail?id=$item['id']}">查看详情</a></div>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>
    </div>