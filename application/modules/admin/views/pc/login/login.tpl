<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>后台管理中心</title>
<meta name="Copyright" content="Douco Design." />
<link href="{root:admin/views/pc/css/public.css}" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{root:admin/views/pc/js/jquery/jquery-1.7.2.min.js}"></script>
    <script type="text/javascript" src="{root:admin/views/pc/js/form/validform.js}" ></script>
    <script type="text/javascript" src="{root:admin/views/pc/js/form/formacc.js}" ></script>
    <script type="text/javascript" src="{root:admin/views/pc/js/layer/layer.js}"></script>
</head>
<body>

<div id="login">
  <div class="dologo"></div>

  <form action="{url:admin/login/doLogin}" method="post" auto_submit redirect_url="{url:admin/index/index}">
   <ul>
    <li class="inpLi"><b>用户名：</b><span><input type="text" name="user_name"   class="inpLogin"></span></li>

    <li class="inpLi"><b>密码：</b><input type="password" name="password" class="inpLogin"></li>

    <li class="captchaPic">
      <div class="inpLi" >
          <b>验证码：</b>
          <input type="text"  name="captcha" class="captcha">
      </div>
      <img id="vcode" src="{url:admin/login/getCaptcha}" alt="" width="75" border="1" onClick="changeCaptcha('{url:admin/login/getCaptcha}',this)" title="" />
    </li>

    <li class="sub"><input type="submit" name="submit" class="btn" value="登录"></li>

   </ul>
  </form>
</div>
<script type="text/javascript">
    //切换验证码
    function changeCaptcha(urlVal,imgObj)
    {
        var radom = Math.random();
        if( urlVal.indexOf("?") == -1 )
        {
            urlVal = urlVal+'/'+radom;
        }
        else
        {
            urlVal = urlVal + '&random/'+radom;
        }
        $(imgObj).attr('src',urlVal);
    }
</script>

</body>
</html>