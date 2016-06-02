
<!--========================================================
                          CONTENT
=========================================================-->
<section id="content">
<div class="container">
    <div class="row wrap_11 wrap_12">
        <div style="margin:40px auto;width:100%;" >
            <form method="post" action="{url:/member/index}" name="search">
                <input type="text" name="name" size="40" class="padd_40" placeholder="请输入会员名称">
                <input  class="button" type="submit" value="搜索"/>

            </form>
            <div class="clearfix"></div>
        </div>
        <div class="grid_5">
             <h2 class="header_2 indent_2 put-left">会员信息</h2><span class="put-right"><a href=""></a></span>
            <div class="clearfix"></div>
            {if:!empty($data)}
             <ul class="search">
                <li>姓名：{$data['name']}</li>
                 <li>身份证：{$data['identify_no']}</li>
                 <li>会员号：{$data['no']}</li>
                 <li>创建时间：{$data['create_time']}</li>
                 <li>创建人：{$data['create_person']}</li>
             </ul>
            {/if}
            <div class="clearfix"></div>
        </div>


            <div class="clearfix"></div>
    </div>
</div>

