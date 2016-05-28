
<h3><a href="{url:admin/system/showList}" class="actionBtn">返回列表</a>编辑幻灯</h3>

<div class="idTabs">

    <div class="items">
        <div id="nav_add">
            <form action="{url:admin/system/showAdd}" method="post" auto_submit>
                <input type="hidden" name="id" value="{$show['id']}" />
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
                    <tr>
                        <td width="80" height="35" align="right">幻灯名称</td>
                        <td>
                            <input type="text"  name="show_name" value="{$show['show_name']}" size="40" class="inpMain" />

                        </td>
                    </tr>

                    <tr>
                        <td height="35" align="right">链接</td>
                        <td>
                            <input type="text"  name="show_link" value="{$show['show_link']}" size="40" class="inpMain" />

                        </td>
                    </tr>
                    <tr>
                        <td height="35" align="right">图片</td>
                        <td id="parent">
                            <input type="file" name="file1" id="file1"  onchange="javascript:uploadImg(this);" />
                            <div  class="up_img">
                                    <img name="file1" height="100" src="{$show['thumb']}"/>

                                <input type="hidden" id="imgfile1" name="show_img" value="{$show['show_img']}"  />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="35" align="right">排序</td>
                        <td>
                            <input type="text" name="sort" value="{$show['sort']}" size="5" class="inpMain" />
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
