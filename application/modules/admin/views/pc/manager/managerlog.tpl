
<h3>管理员日志</h3>


    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
        <tr>
            <!-- <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
            --> <th width="40" align="center">编号</th>
            <th width="40" align="left">操作时间</th>
            <th width="150" align="center">操作者</th>
            <th width="80" align="center">操作记录</th>
            <th width="80" align="center">ip地址</th>
        </tr>
        {foreach:items=$log }
        <tr>
            <!-- <td align="center"><input type="checkbox" name="checkbox[]" value="{$item['id']}" /></td>
            --> <td align="center">{$item['id']}</td>
            <td>{$item['create_time']}</td>
            <td align="center">{$item['admin']}</td>
            <td align="center">{$item['action']}</td>
            <td align="center">{$item['ip']}</td>
        </tr>
        {/foreach}
    </table>
    <!-- <div class="action">
         <select name="action" onchange="douAction()">
             <option value="0">请选择</option>
             <option value="del_all">删除</option>
         </select>

         <input name="submit" class="btn" type="submit" value="执行" />
     </div>-->

{$bar}
