
    <h3></h3>
    <script type="text/javascript">

     $(function(){ $(".idTabs").idTabs(); });

    </script>
    <div class="idTabs">
      <ul class="tab">
        <li><a href="#main">常规设置</a></li>

        <li><a href="#mail">邮件设置</a></li>

      </ul>
      <div class="items">
       <form action="{url:admin/system/configUpdate}" method="post" auto_submit>
        <input type="hidden" name="tab" value="main" />
        <div id="main">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
         <tr>
           <th width="131">名称</th>
           <th>内容</th>
         </tr>
         {foreach:items=$config['main'] }
            <tr>
             <td align="right">{$item['name_zh']}</td>
             <td>
              {if:$item['type']=='radio'}
                <label for="{$item['name']}_0">
                 <input type="radio" name="{$item['name']}" id="{$item['name']}_0" value="0"{if: $item['value']==0} checked="true"{/if}>
                  否
                </label>
               <label for="{$item['name']}_1">
                <input type="radio" name="{$item['name']}" id="{$item['name']}_1" value="1"{if: $item['value']==1} checked="true"{/if}>
                是
               </label>

               {elseif:$item['type']=='select'}
               <select name="{$item['name']}">
                {foreach: items=$item['box'] key=$name item=$value}
                <option value="{$value}"{if:$item['value']==$value} selected{/if}>{$value}</option>
                {/foreach}
               </select>

               {elseif:$item['type']=='file'}
               	<input type="file" name="file{$key}" id="file{$key}"  onchange="javascript:uploadImg(this);" />
                  <div  class="up_img">
                    {if:$item['value']}
					  <img name="file{$key}" src="{$item['thumb']}"/>
					{/if}
                   <input type="hidden" id="imgfile{$key}" name="{$item['name']}" value="{$item['value']}"  />
				  </div>


              {elseif:$item['type']=='textarea'}
                  <textarea name="{$item['name']}" cols="83" rows="8" class="textArea" />{$item['value']}</textarea>
              {else:}
                  <input type="text" name="{$item['name']}" value="{$item['value']}" size="80" class="inpMain" />

              {/if}
             </td>
            </tr>
         {/foreach}

        </table>
         <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
          <tr>
           <td width="131"></td>
           <td>
            <input name="submit" class="btn" type="submit" value="提交" />
           </td>
          </tr>
         </table>
        </div>

        </form>

        <form action="{url:admin/system/configUpdate}" method="post" auto_submit >
         <input type="hidden" name="tab" value="mail" />
        <div id="mail">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
         <tr>
          <th width="131">名称</th>
          <th>内容</th>
         </tr>
         {foreach:items=$config['mail']}
          <tr>
           <td align="right">{$item['name_zh']}</td>
           <td>
            {if:$item['type']=='radio'}
              <label for="{$item['name']}_0">
               <input type="radio" name="{$item['name']}" id="{$item['name']}_0" value="0"{if: $item['value']==0} checked="true"{/if}>
                {if:$item['box']!=''}
                {set:$box=explode(',',$item['box']);}
                 {$box[0]}
               {else:}
                 否
               {/if}

              </label>
             <label for="{$item['name']}_1">
              <input type="radio" name="{$item['name']}" id="{$item['name']}_1" value="1"{if: $item['value']==1} checked="true"{/if}>
              {if:$item['box']!=''}
                {set:$box=explode(',',$item['box']);}
                 {$box[1]}
               {else:}
                 是
               {/if}
             </label>

             {elseif:$item['type']=='select'}
             <select name="{$item['name']}">
              {foreach: items=$item['box'] key=$name item=$value}
              <option value="{$value}"{if:$item['value']==$value} selected{/if}>{$value}</option>
              {/foreach}
             </select>

             {elseif:$item['type']=='file'}
                <input type="file" name="{$item['name']}" size="18" />
                {if:$item['value']}
                 <a href="" target="_blank"><img src="{$item['value']}"></a>

                {/if}
            {elseif:$item['type']=='textarea'}
                <textarea name="{$item['name']}" cols="83" rows="8" class="textArea" />{$item['value']}</textarea>
            {else:}
                <input type="text" name="{$item['name']}" value="{$item['value']}" size="80" class="inpMain" />

            {/if}
           </td>
          </tr>
         {/foreach}
        </table>
         <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
          <tr>
           <td width="131"></td>
           <td>
            <input name="submit" class="btn" type="submit" value="提交" />
           </td>
          </tr>
         </table>
        </div>


        </form>
      </div>
    </div>

