
<h3><a href="{url:admin/manager/managerAdd}" class="actionBtn" >添加管理员</a>管理员列表</h3>

<div class="navList">

    <table width="100%" border="0" cellpadding="10" cellspacing="0" class="tableBasic">
        <tr>
            <th width="113" align="center">编号</th>
            <th align="center">管理员名称</th>
            <th align="center">电子邮箱</th>
            <th align="center">添加时间</th>
            <th align="center">最后登录时间</th>
            <th width="120" align="center">操作</th>
        </tr>
        {foreach:items=$list }
            <tr>
                <td align="center"> {$item['id']}</td>
                <td>{$item['user_name']}</td>
                <td align="center">{$item['email']}</td>
                <td align="center">{$item['add_time']}</td>
                <td align="center">{$item['last_login']}</td>

                <td align="center">
                    <a href="{url:admin/manager/managerAdd?id=$item['id']}">编辑</a> |
                    <a ajax_status=-1 ajax_url="{url:admin/manager/managerDel?id=$item['id']}" href="javascript:void(0)">删除</a>
                </td>
            </tr>
        {/foreach}
    </table>
</div>

{$bar}
