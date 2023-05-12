<?php
print '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> ';
include('menu.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
    if ($db)
     
    {
    if ($_COOKIE["org_id"]>0)
    {$filter='WHERE t1.org_id='.$_COOKIE["org_id"].' and not t1.note is null';}
    else
    {$filter="WHERE not t1.note=''";}
    $req='WITH t0 AS ( SELECT t1.unit_name, t1.note, t4.s_name, CAST(t4.name as varchar(800)) as name, t1.id, t3.it_system_id FROM org_structure as t1 JOIN process_workers as t2 ON t2.worker_id=t1.id JOIN process_it_system as t3 on t3.process_id=t2.process_id JOIN it_system as t4 ON t4.id = t3.it_system_id '.$filter.')  SELECT note,s_name,name,id,it_system_id FROM t0 GROUP BY id,it_system_id,note,s_name,name ORDER BY note';
    $resp = mssql_query($req);
    $i=0;
    echo ('<h1>Перечень информационных систем, необходимых для исполнения должностных обязанностей</h1>');
    echo "<table class='table'><thead><tr><td>Ф.И.О.</td><td colspan=2>Информационная система</td></tr></thead>";
    while($row = mssql_fetch_array($resp)) 
    {
      $i=$i+1;
      $note = str_replace('\"','"',$row[0]);      
      $s_name = str_replace('\"','"',$row[1]);
      $name = str_replace('\"','"', $row[2]);
      $req2='SELECT t1.process_id FROM process_it_system as t1 JOIN processes AS t2 ON t1.process_id=t2.id JOIN process_workers AS t3 ON t3.process_id = t2.id WHERE t3.worker_id='.$row[3].' and t1.it_system_id='.$row[4].';';
      $resp2 = mssql_query($req2);
      $p_list='0';
      while($row2 = mssql_fetch_array($resp2))
      { 
         $p_list=$p_list.','.$row2[0];
      }
      echo ('<tr><td>'.$note.'</td><td>'.$s_name.'</td><td style="text-align: left; vertical-align: middle;"><a href="processes.php?filter='.$p_list.'">'.$name.'</a></td></tr>');
      
    
      }
    echo "</table>";
    }
    else
    {
	echo mssql_get_last_message($db);
    }
?>
            