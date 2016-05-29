<script language="javascript" type="text/javascript" src="{root:admin/views/pc/js/My97DatePicker/WdatePicker.js}"></script>

<h3><a href="{url:admin/manager/managerList}" class="actionBtn">返回列表</a>编辑管理员</h3>

<div class="idTabs">

    <div class="items">
        <div id="nav_add">
            <form action="{url:admin/manager/managerAdd}" method="post" auto_submit redirect_url="{url:admin/manager/managerList}">
                <input type="hidden" name="id" value="{$manager['id']}" />
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
                    <tr>
                        <td width="80" height="35" align="right">管理员名称</td>
                        <td>
                           <span> <input type="text"  name="user_name" datatype="/^[0-9a-zA-Z_]{2,20}$/" nullmsg="请填写名称" errormsg="名称错误" value="{$manager['user_name']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">邮箱</td>
                        <td>
                           <span> <input type="text"  name="email" datatype="e" nullmsg="请填写邮箱" errormsg="邮箱错误" value="{$manager['email']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    {if:$manager['id']==0}
                    <tr>
                        <td width="80" height="35" align="right">密码</td>
                        <td>
                           <span>
                               <input type="password"  name="password" datatype="/[\S]{6,20}/" nullmsg="请填写密码" errormsg="请填写6-20位字符" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">重复密码箱</td>
                        <td>
                           <span>
                               <input type="password"  name="repassword" datatype="*" recheck="password" nullmsg="请重复填写密码" errormsg="两次输入密码不一致"  size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>

                    {else:}
                        <tr>
                            <td width="80" height="35" align="right">密码</td>
                            <td>
                           <span>
                               <input type="password" ignore="ignore" name="password" datatype="/[\S]{6,20}/" nullmsg="请填写密码" errormsg="请填写6-20位字符" size="40" class="inpMain" />
                            </span>
                                <span>不填写则不更新密码</span>
                            </td>
                        </tr>
                        <tr>
                            <td width="80" height="35" align="right">重复密码箱</td>
                            <td>
                           <span>
                               <input type="password" ignore="ignore" name="repassword" datatype="*" recheck="password" nullmsg="请重复填写密码" errormsg="两次输入密码不一致"  size="40" class="inpMain" />
                            </span>
                                <span></span>
                            </td>
                        </tr>
                    {/if}
                    <tr>
                        <td width="80" height="35" align="right">权限分配</td>
                        <td>
                           <span>
                               {if:isset($manager['super']) && $manager['super']==1}
                                    所有权限
                               {else:}
                                {foreach:items=$access}
                              <label for="check{$key}" style="padding-right:6px;" >
                                  <input type="checkbox" id="check{$key}" {if:isset($manager['action_list']) && in_array($key,$manager['action_list'])}checked{/if} value="{$key}" name="access[]"    />{$item}
                              </label>
                               {/foreach}
                               {/if}
                            </span>

                            <span></span>
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
