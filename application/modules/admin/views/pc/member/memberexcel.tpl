<script language="javascript" type="text/javascript" src="{root:admin/views/pc/js/My97DatePicker/WdatePicker.js}"></script>

<h3><a href="{url:admin/member/memberList}" class="actionBtn">返回列表</a>编辑会员</h3>

<div class="idTabs">

    <div class="items">
        <div id="nav_add">
            <form action="{url:admin/member/memberExcel}" method="post" enctype="multipart/form-data" >
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
                    <tr>
                        <td width="80" height="35" align="right">导入文件</td>
                        <td>
                           <input type="file"  name="no"    class="inpMain" />
                          </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td>
                            <input name="submit" class="btn" type="submit" value="导入" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
</div>
