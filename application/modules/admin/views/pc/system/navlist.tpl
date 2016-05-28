

    <h3><a href="{url:admin/system/navAdd}" class="actionBtn">添加导航</a>自定义导航栏</h3>

    <div class="navList">
     <ul class="tab">
      <li><a href="{url:admin/system/navList}" {if:$type=='middle'} class="selected"{/if}>主导航</a></li>
      <li><a href="{url:admin/system/navList}?type=top" {if:$type=='top'} class="selected"{/if}>顶部导航</a></li>
      <li><a href="{url:admin/system/navList}?type=bottom" {if:$type=='bottom'} class="selected"{/if} >底部导航</a></li>
     </ul>
     <table width="100%" border="0" cellpadding="10" cellspacing="0" class="tableBasic">
      <tr>
       <th width="113" align="center">导航名称</th>
       <th align="left">链接地址</th>
       <th width="80" align="center">排序</th>
       <th width="120" align="center">操作</th>
      </tr>
       {foreach:items=$list }
      <tr>
       <td> {$item['nav_name']}</td>
       <td>{$item['link']}</td>
       <td align="center">{$item['sort']}</td>
       <td align="center">
        <a href="{url:admin/system/navEdit?id=$item['id']}">编辑</a> |
        <a href="{url:admin/system/navDel?id=$item['id']}">删除</a>
       </td>
      </tr>
     {/foreach}
     </table>
    </div>


