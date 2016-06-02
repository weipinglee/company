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
<h3><a href="{url:admin/article/articleList}" class="actionBtn">返回列表</a>编辑文章</h3>

<div class="idTabs">

    <div class="items">
        <div id="nav_add">
            <form action="{url:admin/article/articleAdd}" method="post" auto_submit redirect_url="{url:admin/article/articleList}">
                <input type="hidden" name="id" value="{$article['id']}" />
                <table width="100%" border="0" cellpadding="5" cellspacing="1" class="tableBasic">
                    <tr>
                        <td width="80" height="35" align="right">文章标题</td>
                        <td>
                           <span> <input type="text"  name="title" datatype="*2-30" nullmsg="请填写文章标题" errormsg="文章标题格式错误" value="{$article['title']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">文章分类</td>
                        <td>
                           <span>
                               <select name="cat_id" datatype="/^[1-9][0-9]{0,}$/" errormsg="请选择分类"  nullmsg="请选择分类" >
                                   <option value="0">无</option>
                                   {foreach:items=$list}
                                       <option value="{$item['cat_id']}" {if:$article['cat_id']==$item['cat_id']}selected="true"{/if}>{$item['cate_name']}</option>
                                   {/foreach}
                               </select>
                           </span>
                            <span></span>
                        </td>
                    </tr>


                    <tr>
                        <td width="80" height="35" align="right">简单描述</td>
                        <td>
                           <span> <input type="text"  name="description" datatype="*0-40"  errormsg="" value="{$article['description']}" size="40" class="inpMain" />
                            </span>
                            <span></span>
                        </td>
                    </tr>
                    <tr>
                        <td width="200" height="35" align="right">详细描述</td>
                        <td>
                            <div style="width:1000px;">
                                <script id="container" name="content" type="text/plain">
                                    {$article['content']}
                                </script>
                            </div>
                            <!-- 加载编辑器的容器 -->


                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">图片预览：</td>
                        <td colspan="2">
                            <span class="zhs_img" id='imgContainer'>
                                {if:isset($article['images']) &&!empty($article['images'])}
                                    {foreach:items=$article['images'] }
                                    <img src="{$item['thumb']}" />
                                    <input type="hidden" name="imgData[]" value="{$item['file']}" />
                                    {/foreach}
                                {/if}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td width="80" height="35" align="right">上传图片：</td>
                        <td>
                            <span>
                                <div>

                                    <input id="pickfiles"  type="button" value="选择文件">
                                    <input type="button"  id='uploadfiles' class="tj" value="上传">
                                    <span>双击图片删除</span>
                                </div>
                                <div id="filelist"></div>
                                <pre id="console"></pre>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td height="35" align="right">是否开启</td>
                        <td>
                            <label for="radio1">
                                <input id="radio1" type="radio" value="1" name="status" {if:!isset($article['status']) || $article['status']==1 }checked{/if}/>
                                是
                            </label>
                            <label for="radio2">
                                <input id="radio2" type="radio" value="0" name="status" {if:isset($article['status']) && $article['status']==0 }checked{/if}/>
                                否
                            </label>

                        </td>
                    </tr>
                    <tr>
                        <td height="35" align="right">排序</td>
                        <td>
                           <span><input type="text" name="sort" datatype="n" errormsg="请填写排序" value="{$article['sort']}" size="5" class="inpMain" />
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
{$plupload}