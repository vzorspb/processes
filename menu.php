<?php
include("config.php");
?>
<script>
function set_cookie() {
    d = document.getElementById("org_id").value;
    document.cookie='org_id='+d;
    
<?php 
   echo 'window.location.href = "'.$_SERVER['REQUEST_URI'].'"'; 
   //index.php?start="+d
?>;
    }
</script>
<?php
//print_r($_SERVER);
   session_start();
   $islogin = false;
   if (isset($_POST['enter']))
   {
       $login = $_POST['login'];
       $password = $_POST['password'];
       $req = "SELECT password,session,org_id FROM org_structure WHERE login='$login';";
       $resp = mssql_query($req);
       $user_data =  mssql_fetch_array($resp);
       if (trim($user_data['password']) == $password)
       {
          $req = "UPDATE org_structure SET session = '".session_id()."' WHERE login ='".$login."';";
          $resp = mssql_query($req);
          setcookie('org_id',$user_data['org_id'],time()+86400);
          setcookie('login',$login,time()+86400);
          setcookie('login',$login,time()+86400,'/');
          header('Location: '.$_POST['url']);die();
       }
       else
       {
          header('Location: index.php?login_error');die();
       }
    }
    if (isset($_COOKIE['login']))
    {
       if (isset($_POST['quit']) or isset($_GET['quit']))
       {
           $req = "UPDATE org_structure SET session = '' WHERE login ='".$_COOKIE['login']."';";
           $resp = mssql_query($req);
           header ("Location: ".substr($_SERVER['REQUEST_URI'],0,-5));
           die();
       }
       $req = "SELECT id, session, note, login FROM org_structure WHERE login='".$_COOKIE['login']."';";
       $resp = mssql_query($req);
       $user_data = mssql_fetch_array($resp);
       $user_id = $user_data['id'];
       if (trim($user_data['session']) == session_id())
       {
            $username=$user_data['note'];
            $islogin = true;
            $login = $user_data['login'];
       }
       else
       {
//           header('Location: ../market2/login');die();
       }
   }
   else
   {
//       header('Location: ../market2/login');die();
   }
  
    
echo '<link rel="stylesheet" href="./css/table.css">';
echo '<link rel="stylesheet" href="./css/menu.css">';

if (isset($_COOKIE["org_id"])){$org_id=$_COOKIE["org_id"];}  else {$org_id=0; setcookie("org_id", 0);}

$req = "SELECT unit_name FROM org_structure WHERE id=".$org_id.";";
$resp = mssql_query($req);
$line = mssql_fetch_array($resp);
$org_name=$line[0];

echo "<table><tr><td><img width='64' src='./img/login-image_spb.png'></td><td><h2>Сводный реестр процессов<br>";
echo $org_name."</h2></td></tr></table><ui class='menu'>";
echo "<li><a class='link' href='index.php?start=0'> &#127968; </a></li>";
echo "<li><select id='org_id' name='org_id' onchange='set_cookie()'>";
echo "<option value='0'>Все организации</option>";

$req = "SELECT id,unit_name FROM org_structure WHERE type='ORG' ORDER BY sort_level, id;";
$resp = mssql_query($req);
while($line = mssql_fetch_array($resp))
{
    echo "<option value='".$line[0]."'";
    if ($line[0]==$org_id) {echo " selected";}
    echo ">".$line[1]."</option>";
}
          
echo "</select></li>";

echo "<li><a class='link' href='index.php?start=".$org_id."'>Штатная структура</a></li>";
echo "<li><a class='link' href='authority.php'>Полномочия/виды деятельности</a></li>";
echo "<li><a class='link' href='processes.php'>Процессы</a></li>";
if ($islogin or $islocal) {echo "<li><a class='link' href='add.php'>Добавить процесс</a></li>";}
//echo "<li><a href='help.php'>ЧаВо</a></li>";
if ($islogin or $islocal) {echo "<li><a class='link' href='it.php'>Использование IT систем</a></li>";}
if ($islogin)
{
   echo "<li><a class='link' href='save2xls.php'>Скачать Excel</a></li>";
   if (strpos($_SERVER['REQUEST_URI'],'?'))
   {
      echo "<li><a class='link' href='".$_SERVER['REQUEST_URI']."&quit'>&#10008; Выйти (".$username.")</a></li>";
   }
   else
   {
      echo "<li><a class='link' href='".$_SERVER['REQUEST_URI']."?quit'>&#10008; Выйти (".$username.")</a></li>";
   }
}
else
{echo "<li><a class='link' href='login.php?url=".$_SERVER['REQUEST_URI']."'>&#9094; Войти</a></li>";}
echo "</ui>";
if ($_COOKIE['org_id']>0) {echo '<p align="center" style="font-weight:bold; background-color:#FFFACD; border: solid 2px red; padding: 5px;">Включена фильтрация выводимой информации по названию организации. Данный режим используется для просмотра списка процессов и видов деятельности интересующей организации, а также добавления новых процессов по своей организации. Карточка процесса в данном режиме может отображаться некорректно.</p>';}

?>