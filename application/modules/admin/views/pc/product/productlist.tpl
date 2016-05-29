
<h3><a href="{url:admin/product/productAdd}" class="actionBtn add">添加商品</a>商品列表</h3>
<div class="filter">
    <form action="{url:admin/product/productList}" method="post">
        <select name="cat_id">
            <option value="0">未分类</option>
            {foreach:items=$cateList}

                <option value="{$item['cat_id']}" {if:$item['cat_id']==$search['cat_id']}selected=true{/if}>{$item['cate_name']} </option>

            {/foreach}


        </select>
        <input name="keyword" type="text" class="inpMain" value="{$search['keyword']}" size="20" />
        <input name="submit" class="btnGray" type="submit" value="筛选" />
    </form>

</div>

<form name="action" method="post" action="product.php?rec=action">
    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
        <tr>
           <!-- <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
           --> <th width="40" align="center">编号</th>
            <th align="left">商品名称</th>
            <th width="150" align="center">商品分类</th>
            <th width="80" align="center">添加日期</th>
            <th width="80" align="center">操作</th>
        </tr>
        {foreach:items=$productList }
        <tr>
           <!-- <td align="center"><input type="checkbox" name="checkbox[]" value="{$item['id']}" /></td>
           --> <td align="center">{$item['id']}</td>
            <td><a href="{url:admin/product/productAdd?id=$item['id']}">{$item['name']}</a></td>
            <td align="center">{$item['cat_text']}</td>
            <td align="center">{$item['add_time']}</td>
            <td align="center">
                <a href="{url:admin/product/productAdd?id=$item['id']}">编辑</a> |
                <a ajax_status=-1 ajax_url="{url:admin/product/productDel?id=$item['id']} href="javascript:void(0)">删除</a>

            </td>
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
</form>
{$bar}




