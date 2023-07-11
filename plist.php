<?php
print '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> ';
include('menu.php');
if (isset($_GET['au_id']))
{print "<a href='add.php?au_id=".$_GET['au_id']."'>Добавить процесс</a>";}
else
{print "<a href='add.php'>Добавить процесс</a>";}
error_reporting(E_ALL);
ini_set('display_errors', '1');
    if ($db)
     
    {
    if (isset($_GET['au_id']))
    {
       $req='SELECT number, text FROM authority WHERE id='.$_GET['au_id'];
       $resp = mssql_query($req);
       $res=mssql_fetch_array($resp);
       $text = $res[0].' '.$res[1];
       echo ("<h3>".$text."</h3>");
    }
    if (isset($_GET['ou_id']))
    {
       $add='AND owner_id='.$_GET['ou_id'].';';
    }
    else
    {$add=';';}
    $req='SELECT t1.name, t2.unit_name, t1.id  FROM processes as t1 JOIN org_structure as t2 ON t1.owner_id = t2.id LEFT JOIN authority_add AS t3 on t1.id=t3.process_id WHERE t1.authority_id='.$_GET['au_id'].' or t3.authority_id='.$_GET['au_id'].$add;
    $resp = mssql_query($req);
    $i=0;
    echo "<table class='table'><thead><tr><td></td><td>Наименование процесса</td><td>Владелец процесса</td><td></td></tr></thead>";
    while($row = mssql_fetch_array($resp)) {
      $i=$i+1;
      $proc = $row[0];
      $ou = $row[1];
      echo "<tr><td>".$i."</td><td style='text-align: left; vertical-align: middle;'>".str_replace('\"','"',$proc)."</td><td>".$ou."</td><td><a href='add.php?pid=".$row[2]."'>Карточка процесса</a></td></tr>";
      }
    echo "</table>";
    }
    else
    {
	echo mssql_get_last_message($db);
    }
?>
            