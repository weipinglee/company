
<h3><a href="{url:admin/article/cateAdd}" class="actionBtn" >添加分类</a>分类列表</h3>

<div class="navList">

    <table width="100%" border="0" cellpadding="10" cellspacing="0" class="tableBasic">
        <tr>
            <th width="113" align="center">分类名称</th>
            <th align="left">描述</th>
            <th align="left">排序</th>
            <th align="left">状态</th>
            <th width="120" align="center">操作</th>
        </tr>
        {foreach:items=$list }
            <tr>
                <td> {$item['cate_name']}</td>
                <td>{$item['description']}</td>
                <td align="center">{$item['sort']}</td>
                <td align="center">{if:$item['status']==1}开启{else:}关闭{/if}</td>
                <td align="center">
                    <a href="{url:admin/article/cateAdd?id=$item['cat_id']}">编辑</a> |
                    <a ajax_status=-1 ajax_url="{url:admin/article/cateDel?id=$item['cat_id']}" href="javascript:void(0)">删除</a>
                </td>
            </tr>
        {/foreach}
    </table>
</div>
