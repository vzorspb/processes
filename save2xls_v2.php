<?php
include ("config.php");

// Подключаем класс для работы с excel
require_once('PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
require_once('PHPExcel/Writer/Excel5.php');

// Создаем объект класса PHPExcel
$xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Реестр процессов');


//Выравнивание
$sheet->getStyle("A3:Z5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//Закрепить верхние строки
$sheet->freezePane('A6');


//Ширина столбцов
$sheet->getColumnDimension("A")->setWidth(4.29);
$sheet->getColumnDimension("B")->setWidth(25);
$sheet->getColumnDimension("C")->setWidth(15);
$sheet->getColumnDimension("D")->setWidth(25);
$sheet->getColumnDimension("G")->setWidth(25);
$sheet->getColumnDimension("H")->setWidth(50);
$sheet->getColumnDimension("I")->setWidth(11);
$sheet->getColumnDimension("J")->setWidth(14.57);
$sheet->getColumnDimension("K")->setWidth(25);
$sheet->getColumnDimension("L")->setWidth(50);
$sheet->getColumnDimension("M")->setWidth(25);
$sheet->getColumnDimension("N")->setWidth(17);
$sheet->getColumnDimension("O")->setWidth(30);
$sheet->getColumnDimension("R")->setWidth(30);
$sheet->getColumnDimension("S")->setWidth(15);
$sheet->getColumnDimension("T")->setWidth(40);
$sheet->getColumnDimension("Q")->setWidth(40);
$sheet->getColumnDimension("E")->setWidth(30);
$sheet->getColumnDimension("U")->setWidth(30);
$sheet->getColumnDimension("Y")->setWidth(11);
$sheet->getColumnDimension("X")->setWidth(17);
$sheet->getColumnDimension("V")->setWidth(20);
$sheet->getColumnDimension("P")->setWidth(30);
$sheet->getColumnDimension("Z")->setWidth(14);
$sheet->getColumnDimension("F")->setWidth(30);
$sheet->getColumnDimension("W")->setWidth(20);

// Переносы строк
$sheet->getStyle("A3:Z5")->getAlignment()->setWrapText(true);



// Вставляем текст в ячейки
$sheet->setCellValue("A1", 'Общий реестр процессов ИОГВ');
$sheet->setCellValue("A3", "№\nп/п");
$sheet->setCellValue("A4", "1");
$sheet->setCellValue("B3", "Жизненная ситуация");
$sheet->setCellValue("B4", "2");
$sheet->setCellValue("C3", "Пункт из ВНД");
$sheet->setCellValue("C4", "3");
$sheet->setCellValue("D3", "Название услуги, функции, сервиса");
$sheet->setCellValue("D4", "4");
$sheet->setCellValue("E3", "Блок");
$sheet->setCellValue("E4", "5");
$sheet->setCellValue("F3", "Процессная категория (направление)");
$sheet->setCellValue("F4", "6");
$sheet->setCellValue("G3", "Группа процессов");
$sheet->setCellValue("G4", "7");
$sheet->setCellValue("H3", "Наименование процесса");
$sheet->setCellValue("H4", "8");
$sheet->setCellValue("I3", "КПР ИОГВ");
$sheet->setCellValue("I4", "9");
$sheet->setCellValue("J3", "Статус процесса (реинжиниринг)");
$sheet->setCellValue("J4", "10");
$sheet->setCellValue("K3", "Приоритет описания");
$sheet->setCellValue("K4", "11");
$sheet->setCellValue("L3", "Управляющее воздействие");
$sheet->setCellValue("L4", "12");
$sheet->setCellValue("M3", "Владелец процесса");
$sheet->setCellValue("M4", "13");
$sheet->setCellValue("N3", "Исполнитель");
$sheet->setCellValue("N4", "14");
$sheet->setCellValue("O3", "Вход");
$sheet->setCellValue("O4", "15");
$sheet->setCellValue("P3", "Поступает (от кого)");
$sheet->setCellValue("P4", "16");
$sheet->setCellValue("Q3", "Способ поступления входа");
$sheet->setCellValue("Q4", "17");
$sheet->setCellValue("R3", "Выход");
$sheet->setCellValue("R4", "18");
$sheet->setCellValue("S3", "Ценность для клиента");
$sheet->setCellValue("S4", "19");
$sheet->setCellValue("T3", "Передается кому");
$sheet->setCellValue("T4", "20");
$sheet->setCellValue("U3", "Способ передачи выхода");
$sheet->setCellValue("U4", "21");
$sheet->setCellValue("V3", "Показатели эффективности процесса");
$sheet->setCellValue("V4", "22");
$sheet->setCellValue("W3", "Применяемые ИС");
$sheet->setCellValue("W4", "23");
$sheet->setCellValue("X3", "Уровень автоматизации");
$sheet->setCellValue("X4", "24");
$sheet->setCellValue("Y3", "Дата внесения записи");
$sheet->setCellValue("Y4", "25");
$sheet->setCellValue("Z3", "Примечание");
$sheet->setCellValue("Z4", "26");


if ($_COOKIE["org_id"]>0)
{$filter='WHERE t2.org_id='.$_COOKIE["org_id"];}
else
{$filter='';}

$req="SELECT t1.name, concat(t7.unit_name, '\n',t2.unit_name) as owner, t3.number, t1.npa, t3.text, t10.descr as desc_level, t1.exec_level, t2.note, t1.id, t1.problems, t1.p_start, t1.p_finish,t1.vpp*t4.multiplexer/60.0, CONCAT(t5.unit_name,' ', t5.note) as name_from, CONCAT(t6.unit_name,' ' ,t6.note) as name_to, t1.creation_date, t8.name as it_level, t9.name as pgroup, t11.level as desc_priority FROM processes as t1 LEFT JOIN org_structure as t2 ON t1.owner_id = t2.id LEFT JOIN authority as t3 ON t3.id=t1.authority_id LEFT JOIN measurement as t4 ON t4.id=t1.measurement_id LEFT JOIN org_structure as t5 ON t5.id = t1.reciever_id LEFT JOIN org_structure as t6 ON t6.id = t1.sender_id LEFT JOIN org_structure as t7 ON t7.id=t2.org_id LEFT JOIN it_level as t8 ON t8.id=t1.it_level LEFT JOIN processes as t9 ON t9.id=t1.parrent_process_id LEFT JOIN descr_level as t10 ON t10.id = t1.desc_level LEFT JOIN desc_prority as t11 ON t11.id=t1.desc_priority ".$filter." ORDER by t1.authority_id, t1.owner_id;";

//echo $req;die();
$resp = mssql_query($req);
$num_lines=mssql_num_rows($resp)+5;

//Границы
$border = array(
    'borders'=>array(
    'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_THIN,
    'color' => array('rgb' => '000000')
    ),
)
);
$sheet->getStyle("A3:Z".$num_lines)->applyFromArray($border);
//перенос строк
$sheet->getStyle("A6:Z".$num_lines)->getAlignment()->setWrapText(true);
//Выравнивание
$sheet->getStyle("A3:B".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("H3:J".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("M3:O".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("AC3:AC".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("A3:Z".$num_lines)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
// Фильтры
$sheet->setAutoFilter('B5:Z'.$num_lines);
// Шрифт Times New Roman
$sheet->getStyle('A1:Z'.$num_lines)->getFont()->setName('Times New Roman');


$i=0;
while($row = mssql_fetch_array($resp)) 
{
   $i++;
   $sheet->setCellValueByColumnAndRow(0, $i+5, $i );
//   $sheet->setCellValueByColumnAndRow(5, $i+5, stripslashes($row[0]));
   $sheet->setCellValueByColumnAndRow(2, $i+5, stripslashes($row['number']));
   $sheet->setCellValueByColumnAndRow(7, $i+5, stripslashes($row['name']));   
   if ($row[2]=='          ')
   {
   }
   else
   {
      $sheet->setCellValueByColumnAndRow(3, $i+5, stripslashes($row['text']));    
   }

   $sheet->setCellValueByColumnAndRow(10, $i+5, stripslashes($row['desc_priority']));   
   $sheet->setCellValueByColumnAndRow(11, $i+5, stripslashes($row['npa']));   
   $sheet->setCellValueByColumnAndRow(12, $i+5, stripslashes($row['owner']));   
   $sheet->setCellValueByColumnAndRow(14, $i+5, stripslashes($row['p_start']));      
   $sheet->setCellValueByColumnAndRow(17, $i+5, stripslashes($row['p_finish']));      
   $sheet->setCellValueByColumnAndRow(25, $i+5, stripslashes($row['problems']));      
   $sheet->setCellValueByColumnAndRow(15, $i+5, stripslashes($row['name_from']));
   $sheet->setCellValueByColumnAndRow(19, $i+5, stripslashes($row['name_to']));               
   $sheet->setCellValueByColumnAndRow(24, $i+5, stripslashes($row['creation_date']));                  
   $sheet->setCellValueByColumnAndRow(23, $i+5, stripslashes($row['it_level']));                  
   $sheet->setCellValueByColumnAndRow(9, $i+5, stripslashes($row['desc_level']));                     
   $sheet->setCellValueByColumnAndRow(6, $i+5, stripslashes($row['pgroup']));                     
   
// Информационные системы   
   $list='';
   $req2="SELECT t2.s_name FROM process_it_system as t1 JOIN it_system as t2 ON t2.id=t1.it_system_id WHERE  t1.process_id=".$row['id'];
//   echo $req2;die;
   $resp2 = mssql_query($req2);
   while ($row2= mssql_fetch_array($resp2))
   {
      $list = $list.$row2['s_name'];
   } 

   $sheet->setCellValueByColumnAndRow(22, $i+5, $list);   

//КПР
   $list='';
   $req2="SELECT t2.npp FROM process_kpr as t1 JOIN kpr as t2 ON t2.id=t1.kpr_id WHERE  t1.process_id=".$row['id'];
   $resp2 = mssql_query($req2);
   while ($row2= mssql_fetch_array($resp2))
   {
      $list = $list.$row2['npp'];
   } 

   $sheet->setCellValueByColumnAndRow(8, $i+5, $list);   

//Жизненная ситуация
   $list='';
   $req2="SELECT t2.name FROM process_situation as t1 JOIN situation as t2 ON t2.id=t1.situation_id WHERE  t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   while ($row2= mssql_fetch_array($resp2))
   {
      $list = $list.$row2['name'];
   } 

   $sheet->setCellValueByColumnAndRow(1, $i+5, $list);   

//Блок
   $list='';
   $req2="SELECT t2.class FROM process_classifier as t1 JOIN classifier as t2 ON t2.id=t1.classifier_id WHERE t2.classifier_level=1 and t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   while ($row2= mssql_fetch_array($resp2))
   {
      $list = $list.$row2['class'];
   } 

   $sheet->setCellValueByColumnAndRow(4, $i+5, $list);   

//Процессная категория
   $list='';
   $req2="SELECT t2.class FROM process_classifier as t1 JOIN classifier as t2 ON t2.id=t1.classifier_id WHERE t2.classifier_level=2 and t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   while ($row2= mssql_fetch_array($resp2))
   {
      $list = $list.$row2['class'];
   } 

   $sheet->setCellValueByColumnAndRow(5, $i+5, $list);   



}
// Выводим HTTP-заголовки
header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( "Content-type: application/vnd.ms-excel" );
header ( "Content-Disposition: attachment; filename=Реестр_процессов_v2.xls" );
// Выводим содержимое файла
$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save('php://output');
?>