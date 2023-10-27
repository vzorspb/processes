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



//Ширина столбцов
$sheet->getColumnDimension("A")->setWidth(4.29);
$sheet->getColumnDimension("B")->setWidth(25);
$sheet->getColumnDimension("C")->setWidth(15);
$sheet->getColumnDimension("D")->setWidth(40);
$sheet->getColumnDimension("G")->setWidth(50);
$sheet->getColumnDimension("H")->setWidth(50);
$sheet->getColumnDimension("I")->setWidth(11);
$sheet->getColumnDimension("J")->setWidth(12);
$sheet->getColumnDimension("K")->setWidth(25);
$sheet->getColumnDimension("L")->setWidth(50);
$sheet->getColumnDimension("M")->setWidth(25);
$sheet->getColumnDimension("N")->setWidth(17);
$sheet->getColumnDimension("O")->setWidth(17);
$sheet->getColumnDimension("R")->setWidth(15);
$sheet->getColumnDimension("S")->setWidth(15);
$sheet->getColumnDimension("T")->setWidth(40);
$sheet->getColumnDimension("Q")->setWidth(40);
$sheet->getColumnDimension("E")->setWidth(30);
$sheet->getColumnDimension("U")->setWidth(30);
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

//$sheet->getStyle('C3:F3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('C3:F3')->getFill()->getStartColor()->setRGB('FFA000');
//$sheet->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('G4')->getFill()->getStartColor()->setRGB('FFA000');
//$sheet->getStyle('K4:L4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('K4:L4')->getFill()->getStartColor()->setRGB('FFA000');
//$sheet->getStyle('Q4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('Q4')->getFill()->getStartColor()->setRGB('FFA000');
//$sheet->getStyle('T4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('T4')->getFill()->getStartColor()->setRGB('FFA000');
//$sheet->getStyle('AB3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//$sheet->getStyle('AB3')->getFill()->getStartColor()->setRGB('FFA000');


// Объединяем ячейки
//$sheet->mergeCells('A3:A5');
//$sheet->mergeCells('B3:B5');
//$sheet->mergeCells('C3:C5');
//$sheet->mergeCells('D3:D5');
//$sheet->mergeCells('E3:E5');
//$sheet->mergeCells('F3:F5');
//$sheet->mergeCells('G3:O3');
//$sheet->mergeCells('G4:G5');
//$sheet->mergeCells('H4:H5');
//$sheet->mergeCells('I4:I5');
//$sheet->mergeCells('J4:J5');
//$sheet->mergeCells('K4:K5');
//$sheet->mergeCells('L4:L5');
//$sheet->mergeCells('M4:O4');
//$sheet->mergeCells('Q3:T3');
//$sheet->mergeCells('V3:Z3');
//$sheet->mergeCells('Q4:Q5');
//$sheet->mergeCells('R4:R5');
//$sheet->mergeCells('S4:S5');
//$sheet->mergeCells('T4:T5');
//$sheet->mergeCells('V4:V5');
//$sheet->mergeCells('W4:W5');
//$sheet->mergeCells('X4:Y4');
//$sheet->mergeCells('Z4:Z5');
//$sheet->mergeCells('AB3:AB5');
//$sheet->mergeCells('AC3:AC5');
//$sheet->mergeCells('AD3:AD5');



if ($_COOKIE["org_id"]>0)
{$filter='WHERE t2.org_id='.$_COOKIE["org_id"];}
else
{$filter='';}

$req="SELECT t1.name, concat(t7.unit_name, '\n',t2.unit_name) as owner, t3.number, t1.npa, t3.text, t1.desc_priority, t10.descr as desc_level, t1.exec_level, t2.note, t1.id, t1.problems, t1.p_start, t1.p_finish,t1.vpp*t4.multiplexer/60.0, CONCAT(t5.unit_name,' ', t5.note) as name_from, CONCAT(t6.unit_name,' ' ,t6.note) as name_to, t1.creation_date, t8.name as it_level, t9.name as pgroup FROM processes as t1 LEFT JOIN org_structure as t2 ON t1.owner_id = t2.id LEFT JOIN authority as t3 ON t3.id=t1.authority_id LEFT JOIN measurement as t4 ON t4.id=t1.measurement_id LEFT JOIN org_structure as t5 ON t5.id = t1.reciever_id LEFT JOIN org_structure as t6 ON t6.id = t1.sender_id LEFT JOIN org_structure as t7 ON t7.id=t2.org_id LEFT JOIN it_level as t8 ON t8.id=t1.it_level LEFT JOIN processes as t9 ON t9.id=t1.parrent_process_id LEFT JOIN descr_level as t10 ON t10.id = t1.desc_level ".$filter." ORDER by t1.authority_id, t1.owner_id;";
//$req='SELECT t1.name, t2.unit_name, t3.number, t1.npa, t3.text, t1.desc_priority, t1.desc_level, t1.exec_level, t2.note, t1.id, t1.problems, t1.p_start, t1.p_finish,t1.vpp*t4.multiplexer/60.0 FROM processes as t1 LEFT JOIN org_structure as t2 ON t1.owner_id = t2.id LEFT JOIN authority as t3 ON t3.id=t1.authority_id LEFT JOIN measurement as t4 ON t4.id=t1.measurement_id ORDER by t1.authority_id, t1.owner_id';

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
$sheet->getStyle("AB6:AB".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("B6:B".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("D6:D".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("H6:H".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("F6:G".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("Q6:Q".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("O6:O".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("T6:T".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("W6:W".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("K6:K".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("L6:L".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("M6:M".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("R6:S".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("X6:X".$num_lines)->getAlignment()->setWrapText(true);
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
//   $sheet->setCellValueByColumnAndRow(1, $i+5, $row[2]);   
//   if ($row[5]>6) { $sheet->setCellValueByColumnAndRow(6, $i+5, $row[5]-6);}   
//   if ($row[6]>0) { $sheet->setCellValueByColumnAndRow(8, $i+5, $row[6]);}
//   if ($row[7]>0) { $sheet->setCellValueByColumnAndRow(9, $i+5, $row[7]);}
//   if ($row[2]=='          ' or $row[2]=='')
//   {
//      $sheet->setCellValueByColumnAndRow(4, $i+5, 'Обеспечивающие процессы');
//   }
//   else
//   {
//      $sheet->setCellValueByColumnAndRow(4, $i+5, 'Основные процессы');
//   }
//   $sheet->setCellValueByColumnAndRow(10, $i+5, $row[1]);   
//   $sheet->setCellValueByColumnAndRow(29, $i+5, stripslashes($row[10]));   

   $sheet->setCellValueByColumnAndRow(10, $i+5, stripslashes($row['desc_level']));   
   $sheet->setCellValueByColumnAndRow(11, $i+5, stripslashes($row['npa']));   
   $sheet->setCellValueByColumnAndRow(12, $i+5, stripslashes($row['owner']));   
   $sheet->setCellValueByColumnAndRow(14, $i+5, stripslashes($row['p_start']));      
   $sheet->setCellValueByColumnAndRow(17, $i+5, stripslashes($row['p_finish']));      
   $sheet->setCellValueByColumnAndRow(25, $i+5, stripslashes($row['problems']));      
   $sheet->setCellValueByColumnAndRow(15, $i+5, stripslashes($row['name_from']));
   $sheet->setCellValueByColumnAndRow(19, $i+5, stripslashes($row['name_to']));               
   $sheet->setCellValueByColumnAndRow(24, $i+5, stripslashes($row['creation_date']));                  
   $sheet->setCellValueByColumnAndRow(23, $i+5, stripslashes($row['it_level']));                  
   $sheet->setCellValueByColumnAndRow(6, $i+5, stripslashes($row['pgroup']));                     
//   $sheet->setCellValueByColumnAndRow(16, $i+5, stripslashes($row[11]));   
//  $sheet->setCellValueByColumnAndRow(19, $i+5, stripslashes($row[12]));
//   $sheet->setCellValueByColumnAndRow(18, $i+5, stripslashes($row[14]));
//   $sheet->setCellValueByColumnAndRow(17, $i+5, stripslashes($row[15]));         
//   if ($row[13]>0)
//   {
//      $sheet->setCellValueByColumnAndRow(22, $i+5, stripslashes($row[13]));      
//   }
//   $sheet->setCellValueByColumnAndRow(2, $i+5, $row[8]);   
//  $req2="SELECT count(t1.id) FROM process_workers as t1 JOIN org_structure as t2 ON t2.id=t1.worker_id WHERE t2.unit_name like 'Председатель Комитета%' and t1.process_id=".$row[9];
//   $resp2 = mssql_query($req2);
//  $row2= mssql_fetch_array($resp2);
//   if ($row2[0]>0)
//   {
//      $sheet->setCellValueByColumnAndRow(12, $i+5, 'Да');   
//   }
//   else
//   {
//      $sheet->setCellValueByColumnAndRow(12, $i+5, 'Нет');   
//   }
   
//   $req2="SELECT count(t1.id) FROM process_workers as t1 JOIN org_structure as t2 ON t2.id=t1.worker_id WHERE t2.unit_name like 'Заместитель председателя%' and t1.process_id=".$row[9];
//   $resp2 = mssql_query($req2);
//   $row2= mssql_fetch_array($resp2);
//   if ($row2[0]>0)
//   {
//      $sheet->setCellValueByColumnAndRow(13, $i+5, 'Да');   
//   }
//   else
//   {
//      $sheet->setCellValueByColumnAndRow(13, $i+5, 'Нет');   
//   }
   
//  $req2="SELECT count(t1.id) FROM process_workers as t1 JOIN org_structure as t2 ON t2.id=t1.worker_id WHERE not t2.unit_name like 'Председатель Комитета%' and not t2.unit_name like 'Заместитель председателя%'  and t1.process_id=".$row[9];
//   $resp2 = mssql_query($req2);
//   $row2= mssql_fetch_array($resp2);
//   if ($row2[0]>0)
//   {
//      $sheet->setCellValueByColumnAndRow(14, $i+5, 'Да');   
//   }
//   else
//   {
//      $sheet->setCellValueByColumnAndRow(14, $i+5, 'Нет');   
//   }
   
// Информационные системы   
   $list='';
   $req2="SELECT t2.s_name FROM process_it_system as t1 JOIN it_system as t2 ON t2.id=t1.it_system_id WHERE  t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   while ($row2= mssql_fetch_array($resp2))
   {
      $list = $list.$row2[0];
   } 

//   $sheet->setCellValueByColumnAndRow(22, $i+5, $list);   
//   if ($list=='')
//   {
//      $sheet->setCellValueByColumnAndRow(23, $i+5, '0');   
//   }
//   else
//   {
//      $sheet->setCellValueByColumnAndRow(23, $i+5, '1');   
//   }
//КПР
   $list='';
   $req2="SELECT t2.npp FROM process_kpr as t1 JOIN kpr as t2 ON t2.id=t1.kpr_id WHERE  t1.process_id=".$row[9];
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
header ( "Content-Disposition: attachment; filename=processes.xls" );
// Выводим содержимое файла
$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save('php://output');
?>