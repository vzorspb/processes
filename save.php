<?php
function mssql_escape($data) {
    if(is_numeric($data))
        return $data;
    return addslashes($data);
}

 include("menu.php");
 if ($islocal or $islogin){}
 else
 {
    echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="refresh" content="4; url=index.php" />Нет прав для выполнения операции.<br>'.$_SERVER['REMOTE_ADDR'].'<br>'.$res[0];
    die();
 }
 
 $req ='SELECT t2.ip FROM org_structure as t1 JOIN org_structure as t2 ON t1.org_id = t2.id WHERE t1.id='.$_POST['owner_id'];
 $resp = mssql_query($req);
 $res= mssql_fetch_array($resp);
 $net= trim($res[0]);
 if (!$islogin and $_SERVER['REMOTE_ADDR']=='192.168.5.1'){die();}
 if ((strpos($_SERVER['REMOTE_ADDR'],$net)===false or $net=='')and $islocal)
 {
    echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="refresh" content="4; url=index.php" />Нет прав для выполнения операции.<br>'.$_SERVER['REMOTE_ADDR'].'<br>'.$res[0];
    die();
 }
 else
 {
 error_reporting(E_ALL);
 ini_set('display_errors', '1');
 if ($db)     
 {                     
    if (isset($_COOKIE['login']))
    {
       $req="INSERT INTO logs (ip,post,login) VALUES ('".$_SERVER['REMOTE_ADDR']."','".mssql_escape(implode(',',$_POST))."','".$_COOKIE['login']."');";
    }
    else 
    {
       $req="INSERT INTO logs (ip,post) VALUES ('".$_SERVER['REMOTE_ADDR']."','".mssql_escape(implode(',',$_POST))."');";
    }
//    echo ($req); die();
    $resp = mssql_query($req);
    
    print '<html><meta http-equiv="Content-Type" content="text/html; charset=cp1251"> ';
//   print_r ($_POST);die();
   if (isset($_POST['pid']))
   {
       $req="UPDATE processes SET reciever_id='".$_POST['reciever_id']."', sender_id='".$_POST['sender_id']."', authority_id='".$_POST['authority']."', measurement_id='".$_POST['measurement']."', vpp='".$_POST['vpp']."', p_finish='".mssql_escape($_POST['p_finish'])."' , p_start='".mssql_escape($_POST['p_start'])."' ,problems='".mssql_escape($_POST['problems'])."', name='".mssql_escape($_POST['process_name'])."' , npa='".mssql_escape($_POST['npa'])."' , desc_priority='".$_POST['desc_prority']."', desc_level='".$_POST['desc_level']."', exec_level='".$_POST['exec_level']."', owner_id='".$_POST['owner_id']."' WHERE id='".$_POST['pid']."';";
       $resp = mssql_query($req);
//echo($req);      
//       echo mssql_get_last_message($db); die();
       $res= mssql_fetch_array($resp);
//       echo($req);
//       echo($res);
       $req = "SELECT count(*) FROM process_workers WHERE process_id=".$_POST['pid']." and worker_id=".$_POST['process_worker'].";";
       $resp = mssql_query($req);
       $res= mssql_fetch_array($resp);
       if($res[0]==0 and $_POST['process_worker']!=0)
       {
    	  $req="INSERT INTO process_workers (process_id, worker_id) VALUES (".$_POST['pid'].", ".$_POST['process_worker'].");";
          $resp = mssql_query($req);
//    	  echo ($req);die();
       }
       
       if($_POST['authority_add']!=0)
       {
    	  $req="INSERT INTO authority_add (process_id, authority_id) VALUES (".$_POST['pid'].", ".$_POST['authority_add'].");";
          $resp = mssql_query($req);
       }

       if($_POST['kpr']!=0)
       {
    	  $req="INSERT INTO process_kpr (process_id, kpr_id) VALUES (".$_POST['pid'].", ".$_POST['kpr'].");";
          $resp = mssql_query($req);
       }

       if($_POST['service']!=0)
       {
    	  $req="INSERT INTO process_service (process_id, service_id) VALUES (".$_POST['pid'].", ".$_POST['service'].");";
          $resp = mssql_query($req);
       }

       if($_POST['situation']!=0)
       {
    	  $req="INSERT INTO process_situation (process_id, situation_id) VALUES (".$_POST['pid'].", ".$_POST['situation'].");";
          $resp = mssql_query($req);
       }

       if($_POST['level_1']!=0)
       {
    	  $req="DELETE FROM process_classifier WHERE process_id='".$_POST['pid']."';INSERT INTO process_classifier (process_id, classifier_id) VALUES (".$_POST['pid'].", ".$_POST['level_1'].");";
          $resp = mssql_query($req);
       }

       if($_POST['level_2']!=0)
       {
    	  $req="INSERT INTO process_classifier (process_id, classifier_id) VALUES (".$_POST['pid'].", ".$_POST['level_2'].");";
          $resp = mssql_query($req);
       }

       if($_POST['level_3']!=0)
       {
    	  $req="UPDATE processes SET parrent_process_id='".$_POST['pid']."';";
          $resp = mssql_query($req);
       }

       if($_POST['it_system']!=0)
       {
    	  $req="INSERT INTO process_it_system (process_id, it_system_id) VALUES (".$_POST['pid'].", ".$_POST['it_system'].");";
          $resp = mssql_query($req);
       }

       
       header('Location: add.php?pid='.$_POST['pid']);
   }
   else
   {
       $req="INSERT INTO processes (name, npa, desc_priority, desc_level, exec_level, owner_id, authority_id, p_start, p_finish, problems, vpp, measurement_id, reciever_id, sender_id, creation_date) VALUES ('".mssql_escape($_POST['process_name'])."', '".mssql_escape($_POST['npa'])."', '".$_POST['desc_prority']."', '".$_POST['desc_level']."', '".$_POST['exec_level']."', '".$_POST['owner_id']." ', '".$_POST['authority']."', '".mssql_escape($_POST['p_start'])."', '".mssql_escape($_POST['p_finish'])."', '".mssql_escape($_POST['problems'])."', '".$_POST['vpp']."', '".$_POST['measurement']."', '".$_POST['reciver_id']."', '".$_POST['sender_id']."',now());";
       $resp = mssql_query($req);
//echo($req);      
//       echo mssql_get_last_message($db); die();

       $req = "SELECT SCOPE_IDENTITY() AS ins_id";
       $resp = mssql_query($req);
       $res= mssql_fetch_array($resp);
       $redir=$res[0];
//       echo ('redir='.$redir);die();
       $req = "SELECT count(*) FROM process_workers WHERE process_id=".$redir." and worker_id=".$_POST['process_worker'].";";
       $resp = mssql_query($req);
       $res= mssql_fetch_array($resp);
       
       
       
       if($_POST['it_system']!=0)
       {
    	  $req="INSERT INTO process_it_system (process_id, it_system_id) VALUES (".$redir.", ".$_POST['it_system'].");";
          $resp = mssql_query($req);
       }

       if($res[0]==0 and $_POST['process_worker']!=0)
       {
    	  $req="INSERT INTO process_workers (process_id, worker_id) VALUES (".$redir.", ".$_POST['process_worker'].");";
          $resp = mssql_query($req);
       }


       header('Location: add.php?pid='.$redir);
   }
 }
 }

?>
