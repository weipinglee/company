<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {if: $url}
    <meta http-equiv="refresh" content="3; URL={$url}" />
     {/if}
    <title></title>
    <meta name="Copyright" content="Douco Design." />
    <link href="{root:admin/views/pc/css/public.css}" rel="stylesheet" type="text/css">


    <script type="text/javascript">
        function go()
        {
            window.history.go(-1);
        }
        setTimeout("go()",3000);
    </script>

</head>
<body>

<div id="dcWrap">
    {include: include/header.tpl}
    <div id="dcLeft">{include file="menu.htm"}</div>
    <div id="dcMain">
        {include file="ur_here.htm"}
        <div class="mainBox" style="{$workspace.height}">
            <h3>{$ur_here}</h3>
            <div id="douMsg">
                <h2>{$text}</h2>
                <dl>
                    <dt>{$cue}</dt>
                    <!-- {if $check} -->
                    <p><form action="{$check}" method="post"><input name="confirm" class="btn" type="submit" value="{$lang.del_confirm}" /></form></p>
                    <!-- {/if} -->
                    <dd><a href="{if $url}{$url}{else}javascript:history.go(-1);{/if}">{$lang.dou_msg_back}</a></dd>
                </dl>
            </div>
        </div>
    </div>
    {include file="footer.htm"}
</div>

</body>
</html>