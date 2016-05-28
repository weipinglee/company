
<script type="text/javascript" src="{root:admin/views/pc/js/admin/nav.js}"></script>

    <form action="{url:admin/system/navedit?id=$nav_info['id']}" method="post" auto_submit redirect_url="{url:admin/system/navList}">
     <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
      <tr>
       <th colspan="2">&nbsp;</th>
      </tr>
       {if: $nav_info['module']!=''}
      <tr>
       <td width="80" height="35" align="right">系统内容</td>
       <td>
        <select name="nav_menu" onchange="change('nav_name', this)">
         <option value="">请您选择链接项目</option>
          <option></option>
        </select>
       </td>
      </tr>
       {/if}
      <tr>
       <td width="80" height="35" align="right">导航名称</td>
       <td>
        <input type="text" id="nav_name" name="nav_name" value="{$nav_info['nav_name']}" size="40" class="inpMain" />
       </td>
      </tr>
      <tr>
      <td height="35" align="right">位置</td>
      <td>
       {foreach:items=$navType}
       <label for="type_{$key}">
       <input type="radio" name="type" id="type_{$key}" value="{$item}" {if:$item==$nav_info['type']} checked="true"{/if} onChange="getNav(this)">{$navText[$key]}</label>
       {/foreach}
      </td>
     </tr>
     <tr>
       <td height="35" align="right">链接地址</td>
       <td>
         {if: $nav_info['module'] == ''}
        <input type="text" name="guide" value="{$nav_info['link']}" size="60" class="inpMain" />
         {else:}
        <input type="text" name="guide_no" value="{$nav_info['link']}" size="60" readOnly="true" class="inpMain" />
        <b class="cue">系统连接，不可编辑</b>
         {/if}
       </td>
      </tr>
      <tr>
       <td height="35" align="right">上级导航</td>
       <td id="parent">
        <select name="parent_id">
         <option value="0">无</option>
         {foreach:items=$nav_info['nav_list']}
           <option value="{$item['id']}" {if:$item['id']==$nav_info['parent_id']}selected="true"{/if}>{$item['nav_name']}</option>
          {/foreach}
        </select>
       </td>
      </tr>
      <tr>
       <td height="35" align="right">排序</td>
       <td>
        <input type="text" name="sort" value="{$nav_info['sort']}" size="5" class="inpMain" />
       </td>
      </tr>
      <tr>
       <td></td>
       <td>
        <input type="hidden" name="id" value="{$nav_info['id']}" />
        <input name="submit" class="btn" type="submit" value="提交" />
       </td>
      </tr>
     </table>
    </form>
    <input type="hidden" name="ajaxUrl" value="{url:admin/system/ajaxGetNav}" />

