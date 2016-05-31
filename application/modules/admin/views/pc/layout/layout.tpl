<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link href="{root:admin/views/pc/css/public.css}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{root:admin/views/pc/js/jquery/jquery.min.js}"></script>
    <script type="text/javascript" src="{root:admin/views/pc/js/global.js}"></script>

    <script type="text/javascript" src="{root:admin/views/pc/js/jquery/jquery.tab.js}"></script>
    <script type="text/javascript" src="{root:admin/views/pc/js/form/validform.js}"></script>
    <script type="text/javascript" src="{root:admin/views/pc/js/form/formacc.js}"></script>
    <script type="text/javascript" src="{root:admin/views/pc/js/layer/layer.js}"></script>

</head>
<body>
<div id="dcWrap">
    {include:include/header.tpl}
    <div id="dcLeft">
        <div id="menu">
            {foreach:items=$nav}
                {if:$key==1}
                    <ul class="top">
                        <li><a href="{$item[0]['link']}"><i class="{$item[0]['icon']}"></i><em>{$item[0]['name_zh']}</em></a></li>
                    </ul>
                {else:}
                    <ul>
                        {foreach:items=$item key=$k item=$nav}
                        <li {if:$cur==$nav['name']}class="cur"{/if}><a href="{$nav['link']}"><i class="{$nav['icon']}"></i><em>{$nav['name_zh']}</em></a></li>
                        {/foreach}
                    </ul>
                {/if}


            {/foreach}

        </div>

    </div>
    <div id="dcMain">
        <div id="urHere">
            管理中心<b>></b> <strong>{$here}</strong>
        </div>
        <div class="mainBox" style="">
            <input type="hidden" name="uploadUrl"  value="{url:admin/base/upload}" />
            {content}
        </div>
    </div>
    {include:include/footer.tpl}
</div>
</body>
</html>