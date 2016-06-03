
    <!--========================================================
                              CONTENT
    =========================================================-->
    <section id="content"><div class="ic">More Website Templates @ TemplateMonster.com - September08, 2014!</div>

        <div class="bg_1 wrap_17 wrap_19">
            <div class="container">

                <div class="row">
                    {foreach:items=$data}
                    <div class="grid_6">
                        <div class="wrap_18">
                            <h2 class="header_2 indent_1 color_3">{$item['title']}</h2><span class="text_5">{$item['description']}</span>

                            {$item['content']}
                        </div>
                    </div>
                    {/foreach}

                </div>
            </div>
        </div>
