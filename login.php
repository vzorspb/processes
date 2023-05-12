<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="./css/login.css">
<div class="login-page">
<div class="form">
<form action="index.php" method="post" class="login-form">
<input type="hidden" name="enter"/>
<?php
  echo '<input type="hidden" name="url" value="'.$_GET['url'].'"/>';
?>
<input type="text" name="login" placeholder="имя пользователя"/>
<input type="password" name="password"  placeholder="пароль"/>
<button>Войти</button>
</form>
</div>
</div>