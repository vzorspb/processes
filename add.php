<?php
print '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> ';
include("menu.php");
error_reporting(E_ALL);
$authority_add='';
$kpr='';

$situation='';
$service='';
ini_set('display_errors', '1');
if ($islocal or $islogin)
{
    echo '<form action="save.php" method="post">';
}
else
{
    echo '<form method="post">';
}

    
    if ($db)
    {
    if (isset($_GET['pid'])){
       echo '<input type="hidden" name="pid" value="'.$_GET['pid'].'">';
       $req='SELECT t1.name, t2.number,t2.text,t2.id,t1.npa,t1.exec_level,t1.desc_level, t1.desc_priority, t1.owner_id, t1.p_start, t1.p_finish, t1.problems, t1.measurement_id, t1.vpp, t1.sender_id, t1.reciever_id, t1.parrent_process_id, t1.it_level  FROM processes as t1 JOIN authority as t2 on t1.authority_id=t2.id where t1.id='.$_GET['pid'].';';
       $resp = mssql_query($req);
       $line = mssql_fetch_array($resp);
       $find = array('\"','\r\n','\n','\r','  ');
       $replace = array('"',"\n","\n","\n","\n");
       $p_name = str_replace($find,$replace,$line[0]);
       $authority =  $line[1].$line[2].'<br>';
       $authority_id=$line[3];
       if ($authority_id==0 or $authority_id==''){die();}
       $npa=str_replace($find,$replace,$line[4]);
       $exec_level=$line[5];
       $desc_level=$line[6];
       $desc_priority=$line[7];
       $owner_id=$line[8];
       $p_start=str_replace($find,$replace, $line[9]);
       $p_finish=str_replace($find,$replace,$line[10]);;
       $problems=str_replace($find,$replace,$line[11]);
       $measurement=$line[12];
       $vpp=$line[13];
       $level_3=$line['parrent_process_id'];
       $level_it=$line['it_level'];
       $sender_id = $line[14];
       $reciever_id = $line[15];
       $req1='SELECT t2.unit_name, t2.note, t3.unit_name FROM process_workers as t1 JOIN org_structure as t2 ON t1.worker_id=t2.id JOIN org_structure as t3 ON t2.org_id = t3.id  WHERE t1.process_id='.$_GET['pid'].' ORDER BY t2.org_id, t2.sort_level, t2.note';
       $resp1 = mssql_query($req1);
       $worker='';
       while($line = mssql_fetch_array($resp1)) 
       {
          if ($islogin or $islocal)
          {
             $worker=$worker.'<li>'.'<b>'.$line[2].':</b> '.$line[0].' '.$line[1]."</li>";
          }
          else
          {
             $worker=$worker.'<li>'.'<b>'.$line[2].':</b> '.$line[0]."</li>";
          }
       }
       
       $req1='SELECT t2.name FROM process_it_system as t1 JOIN it_system as t2 ON t1.it_system_id=t2.id WHERE t1.process_id='.$_GET['pid'];
       $resp1 = mssql_query($req1);
       $it_system='';
       while($line = mssql_fetch_array($resp1)) 
       {
          $it_system='<p>'.$it_system.$line[0].'</p>';
       }

       $req1='SELECT t2.id, t2.classifier_level FROM [process_classifier] as t1 JOIN classifier as t2 ON t2.id=t1.classifier_id WHERE t1.process_id='.$_GET['pid'];
       $resp1 = mssql_query($req1);
       $level_1=0;
       $level_2=0;
       
       while($line = mssql_fetch_array($resp1)) 
       {
          if ($line[1]==1){$level_1=$line[0];}
          if ($line[1]==2){$level_2=$line[0];}
       }
       
       
       $req1='SELECT t1.number, t1.text FROM authority as t1 JOIN authority_add as t2 ON t2.authority_id=t1.id WHERE t2.process_id='.$_GET['pid'];
       $resp1 = mssql_query($req1);
       $authority_add='';
       while($line = mssql_fetch_array($resp1)) 
       {
          $authority_add=$authority_add.'<p>'.$line[0].' '.$line[1].'</p>';
       }
       
       
       
       $req1='SELECT t1.name FROM situation as t1 JOIN process_situation as t2 ON t2.situation_id=t1.id WHERE t2.process_id='.$_GET['pid'];
       $resp1 = mssql_query($req1);
       $authority_add='';
       while($line = mssql_fetch_array($resp1)) 
       {
          $situation=$situation.'<p>'.$line[0].'</p>';
       }
       
       
       


       $req1='SELECT t1.type, t1.name FROM services as t1 JOIN process_service as t2 ON t2.service_id=t1.id WHERE t2.process_id='.$_GET['pid'];
       $resp1 = mssql_query($req1);
       $authority_add='';
       while($line = mssql_fetch_array($resp1)) 
       {
          $service=$service.'<p>'.$line[0].': '.$line[1].'</p>';
       }

       
       $req1='SELECT t1.npp, t1.name FROM kpr as t1 JOIN process_kpr as t2 ON t2.kpr_id=t1.id WHERE t2.process_id='.$_GET['pid'];
       $resp1 = mssql_query($req1);
       while($line = mssql_fetch_array($resp1)) 
       {
          $kpr=$kpr.'<p>'.$line[0].' '.$line[1].'</p>';
       }
       
       
    }
    else
    { 
       $p_name='';
       $npa='';
       $authority='';
       $authority_id=0;
       $exec_level=0;
       $desc_level=0;
       $desc_priority=0;
       $owner_id=0;
       $worker='';
       $it_system='';
       $p_start='';
       $p_finish='';       
       $problems='';
       $measurement=1;
       $vpp=1;
       $sender_id = 0;
       $reciever_id = 0;

    }
    if (isset($_GET['au_id']))
    {
	$req="SELECT number, text FROM authority WHERE id=".$_GET['au_id'];
	$resp = mssql_query($req);
        $line = mssql_fetch_array($resp);
        $authority=$authority.$line[0].$line[1].'<br>';
        $authority_id=$_GET['au_id'];
    }
    echo "<table class='addform'><thead><tr><td colspan=3><b>Карточка процесса";
    if (isset($_GET['pid'])){echo " № ".$_GET['pid'];}
    echo "</b></tr></thead>";
    echo '<tr><td colspan=2><abbr title="В графе «Жизненная ситуация» необходимо указать одну или несколько жизненных ситуаций, в которые входит функция, услуга или сервис. Эта информация может быть в дальнейшем использована для удобства работы по жизненным ситуациям. Если функция, услуга или сервис не может быть отнесена к жизненной ситуации, то поле может быть оставлено пустым. Для добавления новой жизненной ситуации в справочник необходимо направить заявку по электронной почте на адрес nevzorov@kb.gov.spb.ru.">Жизненная ситуация</abbr></td><td>'.$situation;
    
    echo '<select name="situation">';
    echo '<option value=0></option>';
    $req='SELECT id,name FROM situation ORDER BY id;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1];
      echo "<option ";
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';
    
//    echo '<input type="hidden" name="authority" value="'.$authority_id.'">';

    echo '<tr><td rowspan=2>Реализуемые полномочия</td><td>основное</td><td>'.$authority;
    echo '<select name="authority">';

    if ($_COOKIE["org_id"]>0)
    {$filter='WHERE org_id is null or org_id='.$_COOKIE["org_id"];}
    else
    {$filter='';}
    $req='SELECT id,number,SUBSTRING(text,0,140) FROM authority '.$filter .' ORDER BY [order];';
echo $req;
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1].$row[2];
      echo "<option ";
      if ($authority_id==$row[0]) echo "selected ";      
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';

    echo '<tr><td>дополнительные</td><td>'.$authority_add;
    
    echo '<select name="authority_add">';
    echo '<option value=0></option>';
#    $req='SELECT id,number,text FROM authority ORDER BY [order];';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1].$row[2];
      echo "<option ";
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td colspan=2>Название услуги, функции, сервиса</td><td>'.$service;
    
    echo '<select name="service">';
    echo '<option value=0></option>';
    $req='SELECT id,type,SUBSTRING(name,0,140) FROM services ORDER BY id;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1].": ".$row[2];
      echo "<option ";
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td rowspan=3>Классификация</td><td>Блок</td><td>';
    echo '<select name="level_1">';
    echo '<option value=0></option>';
    $req='SELECT id,npp,class FROM classifier WHERE classifier_level=1 ORDER BY id;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1].$row[2];
      echo "<option ";
      if ($row[0]==$level_1){echo " selected ";}
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td>Процессная категория(направление)</td><td>';
    echo '<select name="level_2">';
    echo '<option value=0></option>';
   if ($level_1>0){$wh=" and parrent_class_id='".$level_1."'";} else {$wh='';}
    $req='SELECT id,npp,class FROM classifier WHERE classifier_level=2'.$wh.' ORDER BY npp;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1].$row[2];
      echo "<option ";
      if ($row[0]==$level_2){echo " selected ";}      
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td>Группа процессов<input type="checkbox" name="is_group" disabled';
    if ($level_3==$_GET['pid']) {echo ' checked';}
    echo '></td><td>';
    echo '<select name="level_3"';
    if ($level_3==$_GET['pid'] and isset($_GET['pid'])) {echo disabled;}
    echo '>';
    echo '<option value=0></option>';
    if ($row[0]==$level_3){echo " selected ";}    
    $req='SELECT id,name FROM processes WHERE id=parrent_process_id;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1];
      echo "<option ";
      if ($row[0]==$level_3){echo " selected ";}    
      echo "value='".$row[0]."'> ".stripslashes($txt)."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td colspan=2>Наименование процесса/группы процессов</td><td><textarea required style="width:100%" name="process_name">'.$p_name.'</textarea></td></tr>';
    echo '<tr><td colspan=2>КПР</td><td>'.$kpr;
    
    echo '<select name="kpr">';
    echo '<option value=0></option>';
    $req='SELECT id,npp,SUBSTRING(name,0,140) FROM kpr ORDER BY [npp];';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[1].$row[2];
      echo "<option ";
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td rowspan=5>Общие сведения</td><td>Управляющее воздействие (документ, регламентирующий процесс)</td><td><textarea style="width:100%" name="npa">'.$npa.'</textarea></td></tr>';
    echo '<tr><td>Статус процесса (реинжиниринг)</td><td><select name="desc_level">';
#    echo "<option value='0'></option>";
    $req='SELECT * FROM descr_level ORDER BY id;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
#      $txt=$row[1].' - '.$row[2];
      $txt=$row[2];
      echo "<option ";
      if ($desc_level==$row[0]) echo "selected ";
      echo "value='".$row[0]."'> ".$txt."</option>";
    }
    echo '</select></td></tr>';

    echo '<tr><td>Приоритет описания</td><td><select name="desc_prority">';
    $req='SELECT * FROM desc_prority ORDER BY id;';
    $resp = mssql_query($req);
    echo "<option value='0'></option>";
    while($row = mssql_fetch_array($resp)) 
    {
      $txt=$row[1];#.'('.$row[2].')';
      echo "<option ";
      if ($desc_priority==$row[0]) echo "selected ";      
      echo "value='".$row[0]."'> ".$txt."</option>";
    }
    echo '</select></td></tr>';

    
//    echo '<tr><td>Текущий уровень исполнения</td><td><select name="exec_level">';
//    echo "<option value='0'></option>";
//    $req='SELECT * FROM exec_level ORDER BY id;';
//    $resp = mssql_query($req);
//    while($row = mssql_fetch_array($resp)) 
//    {
//      $txt=$row[1].' - '.$row[2];
//      echo "<option ";
//      if ($exec_level==$row[0]) echo "selected ";
//      echo "value='".$row[0]."'> ".$txt."</option>";
//    }    
//    echo '</select></td></tr>';

    if ($_COOKIE["org_id"]>0)
    {$filter=' t1.org_id='.$_COOKIE["org_id"].' and ';}
    else
    {$filter='';}
    echo '<tr><td>Владелец процесса</td><td><select name="owner_id">';
    $req='SELECT t1.id,t1.unit_name,t1.note, t2.unit_name FROM org_structure as t1 JOIN org_structure as t2 ON t1.org_id=t2.id WHERE '.$filter.' t1.type in ("OU", "CHEFF")  ORDER BY t1.org_id, t1.sort_level;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt=$row[3].': '.$row[1].' '.$row[2];
      echo "<option ";
      if ($owner_id==$row[0]) echo "selected ";      
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select></td></tr>';

    echo '<tr><td>Участники процесса (несколько участников добавляется последовательно выбрали -> сохранили -> выбрали следующего)</td><td><ol>'.$worker.'</ol><form><select name="process_worker">';
    echo "<option value='0'></option>";
    $req='SELECT t1.id,t1.unit_name,t1.note,t2.unit_name FROM org_structure as t1 JOIN org_structure as t2 ON t1.org_id = t2.id WHERE'.$filter.' not t1.note is null and not t1.type="ORG"  ORDER BY t1.org_id, t1.sort_level, t1.note;';
    echo $req;
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt=$row[3].': '.$row[1].' '.$row[2];
      echo "<option value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select></form>';
#    echo $req;
    echo '</td></tr>';
    
    echo '<tr><td colspan=2>Применяемые информационные системы</td><td>'.$it_system.'<select name="it_system">';
    echo "<option value='0'></option>";
    $req='SELECT id,s_name,name FROM it_system ORDER BY s_name;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt=$row[1].' '.$row[2];
      echo "<option value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select></td></tr>';
    
    echo '<tr><td colspan=2>Уровень автоматизации</td><td>';
    echo '<select name="level_it">';
    $req='SELECT id,name FROM it_level ORDER BY id;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt = $row[0].'. '.$row[1];
      echo "<option ";
      if ($row[0]==$level_it){echo " selected ";}
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select>';
    echo '</td></tr>';

    
    $req="SELECT id, measurement_name FROM measurement;";
    $resp = mssql_query($req);
#    echo '<tr><td colspan="2">Время протекания процесса (среднее время, которое затрачивается на выполнение всех действий в процессе)</td><td><input name="vpp" type="number" min="1" value="'.$vpp.'"step="1"/>';
#    echo '<select name="measurement">';
#    while($row = mssql_fetch_array($resp)) 
#    {
#      $txt=$row[1];
#      echo "<option ";
#      if ($measurement==$row[0]) echo "selected ";      
#      echo "value='".$row[0]."'> ".$txt."</option>";
#
#    }
#    echo '</select></td></tr>';
    echo '<tr><td rowspan="2">Границы процесса</td><td>Начало (документ, поручение, событие с которого начинается выполнение процесса)</td><td><textarea style="width:100%" name="p_start">'.$p_start.'</textarea><br>Поступает от внутреннего клиента: <select name="sender_id">';
    echo "<option value='0'></option>";
    
    if ($_COOKIE["org_id"]>0)
    {$filter=" WHERE not note='' and not note is null and org_id=".$_COOKIE["org_id"];}
    else
    {$filter='';}
    
    $req='SELECT id,unit_name,note FROM org_structure '.$filter.'ORDER BY sort_level, note;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt=$row[1].' '.$row[2];
      echo "<option ";
      if ($row[0]==$sender_id) {echo 'selected ';}
      echo "value='".$row[0]."'> ".$txt."</option>";
    }    
    echo '</select><br>Поступает от внешнего клиента:</td></tr>';
    echo '<tr><td>Завершение (документ, событие, которые являются результатом выполнения процесса)</td><td><textarea style="width:100%" name="p_finish">'.$p_finish.'</textarea><br>Передается внутреннему клиенту:<select name="reciever_id">';
    echo "<option value='0'></option>";
    $req='SELECT id,unit_name,note FROM org_structure '.$filter.'ORDER BY sort_level, note;';
    $resp = mssql_query($req);
    while($row = mssql_fetch_array($resp)) 
    {
      $txt=$row[1].' '.$row[2];
      echo "<option ";
      if ($row[0]==$reciever_id) {echo 'selected ';}
      echo "value='".$row[0]."'> ".$txt."</option>";

    }    
    echo '</select><br>Передается внешнему клиенту:</td></tr>';    
    echo '<tr><td rowspan="2">Связь с другими процессами</td>';      
    echo '<td>Данный процесс является составной частью другого процесса</td><td>';
    if (isset($_GET['pid']))
    {
        $req="SELECT t1.id, t1.name, t2.unit_name FROM processes as t1 JOIN org_structure as t2 on t1.owner_id=t2.id WHERE t1.id<>0 and t1.id in (SELECT parrent_process_id FROM processes WHERE not (id=parrent_process_id) and id='".$_GET['pid']."');";
        $resp = mssql_query($req);
        while ($row = mssql_fetch_array($resp))
        {
           echo '<a href="add.php?pid='.$row[0].'">'.stripslashes($row[1]).'/'.stripslashes($row[2]).'</a>';
        }
    }
    echo '</td></tr>';    
    echo '<tr><td>Данный процесс включает другие процессы</td><td><ol>';
    if (isset($_GET['pid']))
    {
        $req="SELECT t1.id, t1.name, t2.unit_name FROM processes as t1 JOIN org_structure as t2 on t1.owner_id=t2.id WHERE not (t1.id=t1.parrent_process_id) and  t1.parrent_process_id='".$_GET['pid']."';";
        $resp = mssql_query($req);
        while ($row = mssql_fetch_array($resp))
        {
           echo '<li><a href="add.php?pid='.$row[0].'">'.$row[1].'/'.$row[2].'</a></li>';
        }
    }
    
    echo '</ol></td></tr>';        
    echo '<tr><td colspan="2">Примечание</td><td><textarea style="width:100%" name="problems">'.$problems.'</textarea></td></tr>';
    echo "</table>";
    }
    else
    {
	echo mssql_get_last_message($db);
    }
    if ($islogin or $islocal)
    {
        echo '<input type="submit" value="Сохранить карточку процесса"></form>';
    }
?>
            