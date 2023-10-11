<?php
print '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
include('menu.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
    if ($db)
     
    {
    if (isset($_GET['filter']))
    {$add=' WHERE t1.id in ('.$_GET['filter'].') ';
       if (isset($_GET['er'])){$add=$add.' and t1.desc_priority=12';echo '<p><b>Предложения для включения в программу "Эффективный регион"</b></p>'; } else {echo '<p> <a href="?er&filter='.$_GET['filter'].'">Предложения для включения в программу "Эффективный регион"</a></p>';}
    }
    else
    { if ($_COOKIE['org_id']==0)
    {
       $add=' WHERE (parrent_process_id=0 or parrent_process_id is null or parrent_process_id=t1.id);';
    }
    else
    {
       $add=' WHERE t3.org_id='.$_COOKIE['org_id'].' and (parrent_process_id=0 or parrent_process_id is null or parrent_process_id=t1.id)';
       
       if (isset($_GET['er'])){$add=$add.' and t1.desc_priority=12';echo '<p><b>Предложения для включения в программу "Эффективный регион"</b></p>'; } else {echo '<p> <a href="?er">Предложения для включения в программу "Эффективный регион"</a></p>';}
       $add=$add.';';
    }
    }
    $req='SELECT t1.name, t2.unit_name, t1.id FROM processes as t1 JOIN org_structure as t2 ON t1.owner_id = t2.id JOIN authority as t3 ON t1.authority_id=t3.id'.$add;
    $resp = mssql_query($req);
    $i=0;
    echo "<br><table class='table'><thead><tr><td></td><td>Наименование процесса</td><td>Владелец процесса</td><td></td></tr></thead>";
    while($row = mssql_fetch_array($resp)) {
      $i=$i+1;
      $proc = stripslashes(str_replace(array('\n','\r'),array('',''),$row[0]));
      $ou = $row[1];
      $req2="SELECT t1.id, t1.name, t2.unit_name FROM processes as t1 JOIN org_structure as t2 on t1.owner_id=t2.id WHERE not t1.parrent_process_id=t1.id and t1.parrent_process_id='".$row[2]."';";
      $resp2 = mssql_query($req2);
      echo "<tr><td";
      if (mssql_num_rows($resp2)>0)
      {
    	 $n = mssql_num_rows($resp2)+1;
         echo " rowspan=".$n;
      }
      echo ">".$i."</td><td style='text-align: left; vertical-align: middle;'>".$proc."</td><td>".$ou."</td><td><a href='add.php?pid=".$row[2]."'>Карточка процесса</a></td></tr>";
      while ($row2 = mssql_fetch_array($resp2))
      {
           echo "<tr><td style='text-align: left; vertical-align: middle;'><i>".$row2[1]."</i></td><td><i>".$row2[2]."</i></td><td><a href='add.php?pid=".$row2[0]."'>Карточка процесса</a></td></tr>";    
      }                        
    
      }
    echo "</table>";
    }
    else
    {
	echo mssql_get_last_message($db);
    }
    
?>
            