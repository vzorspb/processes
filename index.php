<?php
print '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> ';
if (isset($_GET['login_error'])){echo "<p style='color:red'>Имя пользователя или пароль введены неверно.</p>";}
error_reporting(E_ALL);
include('menu.php');
ini_set('display_errors', '1');

    if ($db)
     
    {

    if (isset($_GET['start']))
    {$start=$_GET['start'];} 
    else 
    {$start=0;}

    
    $next=$start;
    $st=3;
    echo '<ou style="display: flex; flex-direction: column-reverse;">';
    do {
         $req='SELECT unit_name, id, parrent_id, note FROM org_structure WHERE id='.$next;
         $resp = mssql_query($req);
         $row = mssql_fetch_array($resp);
         $next=$row[2];
         echo '<li style="display: inline;">';
         for ($i=0; $i<$st; $i++){
            echo('&#x2003;');
         }
         if ($next>0) {echo '&#x2A3D;';}
         if ($st==3)
         {
            if ($islogin or $islocal) 
            {
               echo ('<b>'.$row[0].' '.$row[3].'</b></li>');
            }
            else
            {
               echo ('<b>'.$row[0].'</b></li>');
            }
         }
         else
         {
            if ($islogin or $islocal)
            {
               echo '<a style="text-decoration: none;" href="index.php?start='.$row[1].'">'.$row[0].' '.$row[3].'</a></li>';
            }
            else
            {
               echo '<a style="text-decoration: none;" href="index.php?start='.$row[1].'">'.$row[0].'</a></li>';
            }
         }
         $st--;
        }
    while ($next>0);
    echo '</ou>';
    
    
    $req='SELECT unit_name, id, note FROM org_structure WHERE parrent_id='.$start.' ORDER by sort_level, id;';    
    $resp = mssql_query($req);
    echo "<table  class='table'><thead><tr><td rowspan='2' colspan='2'>Структурное подразделение/сотрудник</td><td colspan=3>Процессы</td><td rowspan='2'>Полномочия/<br>виды деятельности </td></tr>";
    echo "<tr><td>Руководитель</td><td>Владелец</td><td>Участник</td></tr></thead>";
    $st=0;
    while($row = mssql_fetch_array($resp)) 
    {
        $st++;
        $req1='SELECT count(id) FROM org_structure WHERE parrent_id='.$row[1].';';
        $resp1 = mssql_query($req1);
        $next = mssql_fetch_array($resp1);
        if ($islogin or $islocal)
        {
	   $ou = $row[0].' '.$row[2];
	}
	else
	{
	   $ou = $row[0];
	}
	
	
	//Владелец
	$req2='SELECT count(id) FROM processes WHERE owner_id='.$row[1].';';
        $resp2 = mssql_query($req2);
        $pc = mssql_fetch_array($resp2);
        $req2='SELECT id FROM processes WHERE owner_id='.$row[1].';';
        $resp2 = mssql_query($req2);
        $filter4='0';
        while($id = mssql_fetch_array($resp2))
        {
           $filter4=$filter4.','.$id[0];
        }

	// Участник
	$req3='SELECT count(id) FROM process_workers WHERE worker_id='.$row[1].';';
        $resp3 = mssql_query($req3);
        $wk = mssql_fetch_array($resp3);
        $req3='SELECT process_id FROM process_workers WHERE worker_id='.$row[1].';';
        $resp3 = mssql_query($req3);
        $filter3='0';
        while($id = mssql_fetch_array($resp3))
        {
           $filter3=$filter3.','.$id[0];
        }

        //список подчиненных 
        $req_tree='DECLARE @start INT; SET @start = '.$row[1].'; SELECT id FROM org_structure  WHERE parrent_id in(SELECT id FROM org_structure WHERE parrent_id in (SELECT id FROM org_structure WHERE parrent_id=@start)) or parrent_id in(SELECT id FROM org_structure WHERE parrent_id in (SELECT id FROM org_structure WHERE parrent_id=@start)) or parrent_id in (SELECT id FROM org_structure WHERE parrent_id=@start) or parrent_id=@start or id=@start';
	$resp_tree=mssql_query($req_tree);
	$child_id_list='0';
	while($id = mssql_fetch_array($resp_tree))
	{
	   $child_id_list=$child_id_list.','.$id[0];
	}
    

	//Руководитель
        $req4='SELECT count(id) FROM [processes] WHERE owner_id in('.$child_id_list.')';
        $resp4 = mssql_query($req4);
        $ch = mssql_fetch_array($resp4);
        $req4='SELECT id FROM [processes] WHERE owner_id in('.$child_id_list.')';
        $resp4 = mssql_query($req4);
        $filter2='0';
        while($id = mssql_fetch_array($resp4))
        {
           $filter2=$filter2.','.$id[0];
        }




        //Полномочия
        $req5='WITH t1 as (SELECT authority_id FROM [processes] WHERE owner_id in('.$child_id_list.') GROUP BY authority_id) SELECT count(*) from t1;';
        $resp5 = mssql_query($req5);
        $au = mssql_fetch_array($resp5);
        $req5='DECLARE @start INT; SET @start = '.$row[1].'; SELECT authority_id FROM [processes] WHERE owner_id in('.$child_id_list.') GROUP BY authority_id;';
        $resp5 = mssql_query($req5);
        $filter='0';
        while($id = mssql_fetch_array($resp5))
        {
           $filter=$filter.','.$id[0];
        }
                
        //Полномочия
        $req6='WITH t3 AS (SELECT authority_id FROM process_workers as t1 JOIN processes as t2 ON t1.process_id=t2.id  WHERE worker_id in ('.$child_id_list.') GROUP BY authority_id) SELECT count(authority_id) FROM t3;';
        $resp6 = mssql_query($req6);
        $au2 = mssql_fetch_array($resp6);

        $req6='SELECT authority_id FROM process_workers as t1 JOIN processes as t2 ON t1.process_id=t2.id  WHERE worker_id in ('.$child_id_list.') GROUP BY authority_id;';
        $resp6 = mssql_query($req6);
        $filter1='0';
        while($id = mssql_fetch_array($resp6))
        {
           $filter1=$filter1.','.$id[0];
        }

	
	
	if ($next[0]>0)
	{
 	   echo '<tr><td>'.$st.'</td><td style="text-align: left; vertical-align: middle;"><a href="?start='.$row[1].'">'.$ou.'</a></td><td><a href="processes.php?filter='.$filter2.'">'.$ch[0].'</a></td><td><a href="processes.php?filter='.$filter4.'">'.$pc[0].'</a></td><td><a href="processes.php?filter='.$filter3.'">'.$wk[0].'</a></td><td><a href="authority.php?filter='.$filter.'">'.$au[0].'</a></td></tr>';
 	}
 	else
 	{
 	   echo '<tr><td>'.$st.'</td><td style="text-align: left; vertical-align: middle;">'.$ou.'</td><td>-</td><td><a href="processes.php?filter='.$filter4.'">'.$pc[0].'</a></td><td><a href="processes.php?filter='.$filter3.'">'.$wk[0].'</a></td><td><a href="authority.php?filter='.$filter1.'">'.$au2[0].'</a></td></tr>';
 	}
    }
    echo "</table>";
    }
    else
    {
	echo mssql_get_last_message($db);
    }
?>
            