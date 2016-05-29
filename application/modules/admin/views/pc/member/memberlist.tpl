
<h3><a href="{url:admin/member/memberAdd}" class="actionBtn" >添加会员</a>会员列表</h3>

<div class="navList">

    <table width="100%" border="0" cellpadding="10" cellspacing="0" class="tableBasic">
        <tr>
            <th width="113" align="center">会员ID</th>
            <th align="left">会员号</th>
            <th align="left">姓名</th>
            <th align="left">身份证号</th>
            <th align="left">创建人</th>
            <th align="left">创建日期</th>
            <th width="120" align="center">操作</th>
        </tr>
        {foreach:items=$list }
            <tr>
                <td> {$item['id']}</td>
                <td>{$item['no']}</td>
                <td align="center">{$item['name']}</td>
                <td align="center">{$item['identify_no']}</td>
                <td align="center">{$item['create_person']}</td>
                <td align="center">{$item['create_time']}</td>

                <td align="center">
                    <a href="{url:admin/member/memberAdd?id=$item['id']}">编辑</a> |
                    <a ajax_status=-1 ajax_url="{url:admin/member/memberDel?id=$item['id']}" href="javascript:void(0)">删除</a>
                </td>
            </tr>
        {/foreach}
    </table>
</div>

{$bar}
