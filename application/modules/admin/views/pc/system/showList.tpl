
<h3><a href="{url:admin/system/showAdd}" class="actionBtn">添加幻灯</a>首页幻灯</h3>

<div class="navList">

    <table width="100%" border="0" cellpadding="10" cellspacing="0" class="tableBasic">
        <tr>
            <th width="113" align="center">幻灯名称</th>
            <th align="left">图片</th>
            <th align="left">排序</th>
            <th width="120" align="center">操作</th>
        </tr>
        {foreach:items=$show }
            <tr>
                <td> {$item['show_name']}</td>
                <td><img height="80" src="{$item['show_img']}" /></td>
                <td align="center">{$item['sort']}</td>
                <td align="center">
                    <a href="{url:admin/system/showAdd?id=$item['id']}">编辑</a> |
                    <a ajax_status=-1 ajax_url="{url:admin/system/showDel?id=$item['id']}" href="javascript:void(0)">删除</a>
                </td>
            </tr>
        {/foreach}
    </table>
</div>
