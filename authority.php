<?php
print '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> ';
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('menu.php');

    if ($db)
     
    {
    if (isset($_GET['filter'])){$filter = "WHERE id in (".$_GET['filter'].") ";} 
    else 
    { if ($_COOKIE["org_id"]>0){$filter = "WHERE org_id is null or org_id=".$_COOKIE["org_id"];}else{$filter='';}}
    $req='SELECT number,text,id FROM authority '.$filter.'ORDER BY [order];';
    $resp = mssql_query($req);
    $i=0;
    
    echo "<table class='table'><thead><tr><td></td><td>Наименование полномочия/вида деятельности</td><td>Количество инвентаризированных процессов</td><td>По структурным подразделениям</td></tr></thead>";
    while($row = mssql_fetch_array($resp)) {
      $i=$i+1;
      $num=$row[0];
      $text=$row[0].' '.$row[1];
//      $req1='SELECT count(*) FROM processes WHERE authority_id="'.$row[2].'";';
      $req1='SELECT count(*) FROM processes as t1 LEFT JOIN authority_add AS t2 on t1.id=t2.process_id WHERE t1.authority_id="'.$row[2].'" or t2.authority_id="'.$row[2].'";';
      $resp1 = mssql_query($req1);
      $res= mssql_fetch_array($resp1);
      echo "<tr><td>".$i."</td><td style='text-align: left; vertical-align: middle;'>".$text."</td><td><a href='plist.php?au_id=".$row[2]."'>".$res[0]."</a></td><td>";
      $au_id=$row[2];
      if ($res[0]>0)
      {
         $req1='WITH t1 (owner_id, cc) AS (SELECT owner_id,count(owner_id) FROM processes as t1 LEFT JOIN authority_add AS t2 on t1.id=t2.process_id WHERE t1.authority_id='.$row[2].' or t2.authority_id='.$row[2].' GROUP by owner_id) SELECT unit_name,cc,id FROM t1 JOIN org_structure ON t1.owner_id=org_structure.id ;';
         $resp1 = mssql_query($req1);
         echo "<table class='table2'>";
         while($row1 = mssql_fetch_array($resp1)) 
         {
            $name=$row1[0];
            echo "<tr><td  style='text-align: left; vertical-align: middle;'>".$name."</td><td><a href='plist.php?au_id=".$au_id."&ou_id=".$row1[2]."'>".$row1[1]."</a></td></tr>";
         }
         echo "</table>";
      }     
      echo"</td></tr>";
      }
    echo "</table>";
    }
    else
    {
	echo mssql_get_last_message($db);
    }
?>
            