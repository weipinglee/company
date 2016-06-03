<script type="text/javascript" src="{root:admin/views/pc/js/admin/nav.js}"></script>

<h3><a href="{url:admin/system/navList}" class="actionBtn">返回列表</a>自定义导航栏</h3>

    <script type="text/javascript">
     $(function(){ $(".idTabs").idTabs(); });
    </script>
    <div class="idTabs">

     <input type="hidden" name="ajaxUrl" value="{url:admin/system/ajaxGetNav}" />


        <div id="nav_defined">
         <form action="{url:admin/system/doNavAdd}" method="post" auto_submit>
          <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
           <tr>
            <td width="80" height="35" align="right">导航名称</td>
            <td>
             <input type="text" name="nav_name" value="" size="40" class="inpMain" />
            </td>
           </tr>
           <tr>
            <td height="35" align="right">位置</td>
            <td>
              <label for="type_3">
               <input type="radio" name="type" id="type_3" value="middle" checked="true" onChange="getNav(this)">
               主导航
              </label>
             <label for="type_4">
              <input type="radio" name="type" id="type_4" value="top" onChange="getNav(this) ">
              顶部导航
             </label>
             <label for="type_5">
              <input type="radio" name="type" id="type_5" value="bottom" onChange="getNav(this)">
              底部导航
             </label>
            </td>
           </tr>
           <tr>
            <td height="35" align="right">链接地址</td>
            <td>
             <input type="text" name="guide" value="" size="80" class="inpMain" />
            </td>
           </tr>
           <tr>
            <td height="35" align="right">上级导航</td>
            <td id="parent_external">
             <select name="parent_id">
              <option value="0">无</option>
              {foreach:items=$parent}

               <option value="{$item['id']}">{echo:str_repeat('--',$item['level'])}{$item['nav_name']}</option>
              {/foreach}

             </select>
            </td>
           </tr>
           <tr>
            <td height="35" align="right">排序</td>
            <td>
             <input type="text" name="sort" value="50" size="5" class="inpMain" />
            </td>
           </tr>
           <tr>
            <td></td>
            <td>
             <input name="submit" class="btn" type="submit" value="提交" />
            </td>
           </tr>
          </table>
         </form>
        </div>
      </div>
    </div>

