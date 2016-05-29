<script language="javascript" type="text/javascript" src="{root:admin/views/pc/js/My97DatePicker/WdatePicker.js}"></script>

<h3><a href="{url:admin/member/memberList}" class="actionBtn">返回列表</a>编辑会员</h3>

<div class="idTabs">

    <div class="items">
        <div id="nav_add">
            <form action="{url:admin/member/memberAdd}" method="post" auto_submit redirect_url="{url:admin/member/memberList}">
                <input type="hidden" name="id" value="{$member['id']}" />
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
                    <tr>
                        <td width="80" height="35" align="right">会员号码</td>
                        <td>
                           <span> <input type="text"  name="no" datatype="s2-30" nullmsg="请填写会员号" errormsg="会员号错误" value="{$member['no']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">姓名</td>
                        <td>
                           <span> <input type="text"  name="name" datatype="s2-30" nullmsg="请填写" errormsg="会员姓名错误" value="{$member['name']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">身份证</td>
                        <td>
                           <span> <input type="text"  name="identify_no" datatype="s2-30" nullmsg="请填写" errormsg="会员身份证错误" value="{$member['identify_no']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>

                    <tr>
                        <td width="80" height="35" align="right">创建人</td>
                        <td>
                           <span> <input type="text"  name="create_person" datatype="s2-30" nullmsg="请填写" errormsg="创建人错误" value="{$member['create_person']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">创建时间</td>
                        <td>
                           <span>
                               <input name="create_time" value="{$member['create_time']}" datatype="date" nullmsg="" errormsg="请选择日期" class="Wdate addw" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" type="text">
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
