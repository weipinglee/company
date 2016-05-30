<script type="text/javascript">
    function go()
    {
        window.history.go(-1);
    }
    setTimeout("go()",3000);
</script>

        <div class="mainBox" style="">
            <h3>操作提示</h3>
            <div id="douMsg">
                <h2>{if:$success==1}操作成功{else:}操作失败:{$info}{/if}</h2>
                <dl>
                    <dt>3秒后返回上一页</dt>

                </dl>
            </div>
        </div>

