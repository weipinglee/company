<!-- 配置文件 -->
<script type="text/javascript" src="{root:admin/views/pc/js/ueditor/ueditor.config.js}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{root:admin/views/pc/js/ueditor/ueditor.all.js}"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container',{
        autowidth : false
    });
</script>
<h3><a href="{url:admin/product/productList}" class="actionBtn">返回列表</a>编辑商品</h3>

<div class="idTabs">

    <div class="items">
        <div id="nav_add">
            <form action="{url:admin/product/productAdd}" method="post" auto_submit redirect_url="{url:admin/product/productList}">
                <input type="hidden" name="id" value="{$product['id']}" />
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
                    <tr>
                        <td width="80" height="35" align="right">商品名称</td>
                        <td>
                           <span> <input type="text"  name="name" datatype="s2-30" nullmsg="请填写商品名" errormsg="商品名格式错误" value="{$product['name']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">商品分类</td>
                        <td>
                           <span>
                               <select name="cat_id" datatype="/^[1-9][0-9]{0,}$/" errormsg="请选择分类"  nullmsg="请选择分类" >
                                   <option value="0">无</option>
                                   {foreach:items=$list}
                                       <option value="{$item['cat_id']}" {if:$product['cat_id']==$item['cat_id']}selected="true"{/if}>{$item['cate_name']}</option>
                                   {/foreach}
                               </select>
                           </span>
                            <span></span>
                        </td>
                    </tr>

                    <tr>
                        <td width="80" height="35" align="right">商品价格</td>
                        <td>
                           <span> <input type="text"  name="price" datatype="float" nullmsg="请填写商品价格" errormsg="商品价格错误" value="{$product['price']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">计量单位</td>
                        <td>
                           <span> <input type="text"  name="unit" datatype="s1-20" nullmsg="请填写商品单位" errormsg="商品单位错误" value="{$product['unit']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">简单描述</td>
                        <td>
                           <span> <input type="text"  name="description" datatype="*0-40"  errormsg="" value="{$product['description']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="200" height="35" align="right">详细描述</td>
                        <td>
                            <div style="width:1000px;">
                                <script id="container" name="content" type="text/plain">
                                    {$product['content']}
                                </script>
                            </div>
                            <!-- 加载编辑器的容器 -->


                        </td>
                    </tr>


                    <tr>
                        <td height="35" align="right">是否开启</td>
                        <td>
                            <label for="radio1">
                                <input id="radio1" type="radio" value="1" name="status" {if:!isset($product['status']) || $product['status']==1 }checked{/if}/>
                                是
                            </label>
                            <label for="radio2">
                                <input id="radio2" type="radio" value="0" name="status" {if:isset($product['status']) && $product['status']==0 }checked{/if}/>
                                否
                            </label>

                        </td>
                    </tr>
                    <tr>
                        <td height="35" align="right">排序</td>
                        <td>
                           <span><input type="text" name="sort" datatype="n" errormsg="请填写排序" value="{$product['sort']}" size="5" class="inpMain" />
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
