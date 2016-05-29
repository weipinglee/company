
<h3><a href="{url:admin/article/cateList}" class="actionBtn">返回列表</a>编辑分类</h3>

<div class="idTabs">

    <div class="items">
        <div id="nav_add">
            <form action="{url:admin/article/cateAdd}" method="post" auto_submit redirect_url="{url:admin/article/cateList}">
                <input type="hidden" name="id" value="{$cate['cat_id']}" />
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
                    <tr>
                        <td width="80" height="35" align="right">分类名称</td>
                        <td>
                           <span> <input type="text"  name="cate_name" datatype="s2-30" nullmsg="请填写分类名" errormsg="分类名格式错误" value="{$cate['cate_name']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">上级分类</td>
                        <td>
                            <select name="parent_id">
                                <option value="0">无</option>
                                {foreach:items=$list}
                                    <option value="{$item['cat_id']}" {if:$cate['parent_id']==$item['cat_id']}selected="true"{/if}>{$item['cate_name']}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td height="35" align="right">描述</td>
                        <td>
                            <input type="text"  name="description" value="{$cate['description']}" size="40" class="inpMain" />

                        </td>
                    </tr>
                    <tr>
                        <td height="35" align="right">是否开启</td>
                        <td>
                            <label for="radio1">
                                <input id="radio1" type="radio" value="1" name="status" {if:!isset($cate['status']) || $cate['status']==1 }checked{/if}/>
                                是
                            </label>
                            <label for="radio2">
                                <input id="radio2" type="radio" value="0" name="status" {if:isset($cate['status']) && $cate['status']==0 }checked{/if}/>
                                否
                            </label>


                        </td>
                    </tr>
                    <tr>
                        <td height="35" align="right">排序</td>
                        <td>
                           <span><input type="text" name="sort" datatype="n" errormsg="请填写排序" value="{$cate['sort']}" size="5" class="inpMain" />
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
