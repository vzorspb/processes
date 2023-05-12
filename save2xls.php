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
$sheet->getStyle("A3:AD5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



//Ширина столбцов
$sheet->getColumnDimension("A")->setWidth(4.29);
$sheet->getColumnDimension("B")->setWidth(12.3);
$sheet->getColumnDimension("C")->setWidth(27);
$sheet->getColumnDimension("G")->setWidth(50);
$sheet->getColumnDimension("H")->setWidth(11);
$sheet->getColumnDimension("I")->setWidth(11);
$sheet->getColumnDimension("J")->setWidth(12);
$sheet->getColumnDimension("L")->setWidth(15);
$sheet->getColumnDimension("M")->setWidth(15);
$sheet->getColumnDimension("N")->setWidth(17);
$sheet->getColumnDimension("O")->setWidth(17);
$sheet->getColumnDimension("R")->setWidth(15);
$sheet->getColumnDimension("S")->setWidth(15);
$sheet->getColumnDimension("D")->setWidth(40);
$sheet->getColumnDimension("Q")->setWidth(40);
$sheet->getColumnDimension("T")->setWidth(40);
$sheet->getColumnDimension("K")->setWidth(30);
$sheet->getColumnDimension("E")->setWidth(0);
$sheet->getColumnDimension("U")->setWidth(0);
$sheet->getColumnDimension("P")->setWidth(0);
$sheet->getColumnDimension("Z")->setWidth(14);
$sheet->getColumnDimension("AA")->setWidth(0);
$sheet->getColumnDimension("AB")->setWidth(15);
$sheet->getColumnDimension("F")->setWidth(30);

// Переносы строк
$sheet->getStyle("A3:AD5")->getAlignment()->setWrapText(true);



// Вставляем текст в ячейки
$sheet->setCellValue("A1", 'Общий реестр процессов ИОГВ');
$sheet->setCellValue("A3", "№\nп/п");
$sheet->setCellValue("A5", "");
$sheet->setCellValue("B3", "Пункт из Положения");
$sheet->setCellValue("C3", "Блок");
$sheet->setCellValue("D3", "Направление");
$sheet->setCellValue("E3", "Группа процессов");
$sheet->setCellValue("F3", "Наименование процесса");
$sheet->setCellValue("G4", "Управляющее воздействие");
$sheet->setCellValue("H4", "Приоритет описания");
$sheet->setCellValue("I4", "Текущий уровень описания");
$sheet->setCellValue("J4", "Текущий уровень исполнения");
$sheet->setCellValue("G3", "Общие сведения");
$sheet->setCellValue("K4", "Владелец");
$sheet->setCellValue("L4", "Исполнитель");
$sheet->setCellValue("M4", "Участники процесса");
$sheet->setCellValue("M5", "Председатель Комитета");
$sheet->setCellValue("N5", "Зам. председателя Комитета");
$sheet->setCellValue("O5", "Пр. должностные лица");
$sheet->setCellValue("Q3", "Объекты/ субъекты");
$sheet->setCellValue("V3", "Показатели");
$sheet->setCellValue("AB3", "Применяемые IT системы");
$sheet->setCellValue("AC3", "Автоматизация");
$sheet->setCellValue("AD3", "Примечание");
$sheet->setCellValue("Q4", "Вход");
$sheet->setCellValue("R4", "Поступает (от)");
$sheet->setCellValue("S4", "Передается (кому)");
$sheet->setCellValue("T4", "Выход (результат)");
$sheet->setCellValue("V4", "Показатели результативности");
$sheet->setCellValue("W4", "ВПП (час)");
$sheet->setCellValue("X4", "Трудозатраты, чел./час.");
$sheet->setCellValue("X5", "План");
$sheet->setCellValue("Y5", "Факт");
$sheet->setCellValue("Z4", "Стоимость выполнения, руб.");

$sheet->getStyle('C3:F3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C3:F3')->getFill()->getStartColor()->setRGB('FFA000');
$sheet->getStyle('G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('G4')->getFill()->getStartColor()->setRGB('FFA000');
$sheet->getStyle('K4:L4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('K4:L4')->getFill()->getStartColor()->setRGB('FFA000');
$sheet->getStyle('Q4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('Q4')->getFill()->getStartColor()->setRGB('FFA000');
$sheet->getStyle('T4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('T4')->getFill()->getStartColor()->setRGB('FFA000');
$sheet->getStyle('AB3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('AB3')->getFill()->getStartColor()->setRGB('FFA000');


// Объединяем ячейки
$sheet->mergeCells('A3:A5');
$sheet->mergeCells('B3:B5');
$sheet->mergeCells('C3:C5');
$sheet->mergeCells('D3:D5');
$sheet->mergeCells('E3:E5');
$sheet->mergeCells('F3:F5');
$sheet->mergeCells('G3:O3');
$sheet->mergeCells('G4:G5');
$sheet->mergeCells('H4:H5');
$sheet->mergeCells('I4:I5');
$sheet->mergeCells('J4:J5');
$sheet->mergeCells('K4:K5');
$sheet->mergeCells('L4:L5');
$sheet->mergeCells('M4:O4');
$sheet->mergeCells('Q3:T3');
$sheet->mergeCells('V3:Z3');
$sheet->mergeCells('Q4:Q5');
$sheet->mergeCells('R4:R5');
$sheet->mergeCells('S4:S5');
$sheet->mergeCells('T4:T5');
$sheet->mergeCells('V4:V5');
$sheet->mergeCells('W4:W5');
$sheet->mergeCells('X4:Y4');
$sheet->mergeCells('Z4:Z5');
$sheet->mergeCells('AB3:AB5');
$sheet->mergeCells('AC3:AC5');
$sheet->mergeCells('AD3:AD5');



if ($_COOKIE["org_id"]>0)
{$filter='WHERE t2.org_id='.$_COOKIE["org_id"];}
else
{$filter='';}

$req="SELECT t1.name, concat(t7.unit_name, '\n',t2.unit_name), t3.number, t1.npa, t3.text, t1.desc_priority, t1.desc_level, t1.exec_level, t2.note, t1.id, t1.problems, t1.p_start, t1.p_finish,t1.vpp*t4.multiplexer/60.0, CONCAT(t5.unit_name,' ', t5.note), CONCAT(t6.unit_name,' ' ,t6.note) FROM processes as t1 LEFT JOIN org_structure as t2 ON t1.owner_id = t2.id LEFT JOIN authority as t3 ON t3.id=t1.authority_id LEFT JOIN measurement as t4 ON t4.id=t1.measurement_id LEFT JOIN org_structure as t5 ON t5.id = t1.reciever_id LEFT JOIN org_structure as t6 ON t6.id = t1.sender_id LEFT JOIN org_structure as t7 ON t7.id=t2.org_id ".$filter." ORDER by t1.authority_id, t1.owner_id;";
//$req='SELECT t1.name, t2.unit_name, t3.number, t1.npa, t3.text, t1.desc_priority, t1.desc_level, t1.exec_level, t2.note, t1.id, t1.problems, t1.p_start, t1.p_finish,t1.vpp*t4.multiplexer/60.0 FROM processes as t1 LEFT JOIN org_structure as t2 ON t1.owner_id = t2.id LEFT JOIN authority as t3 ON t3.id=t1.authority_id LEFT JOIN measurement as t4 ON t4.id=t1.measurement_id ORDER by t1.authority_id, t1.owner_id';

#echo $req;die();
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
$sheet->getStyle("A3:AD".$num_lines)->applyFromArray($border);
//перенос строк
$sheet->getStyle("AB6:AB".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("D6:D".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("F6:G".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("Q6:Q".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("T6:T".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("K6:K".$num_lines)->getAlignment()->setWrapText(true);
$sheet->getStyle("R6:S".$num_lines)->getAlignment()->setWrapText(true);
//Выравнивание
$sheet->getStyle("A3:B".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("H3:J".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("M3:O".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("AC3:AC".$num_lines)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle("A3:AD".$num_lines)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
// Фильтры
$sheet->setAutoFilter('B5:AD'.$num_lines);
// Шрифт Times New Roman
$sheet->getStyle('A1:AD'.$num_lines)->getFont()->setName('Times New Roman');


$i=0;
while($row = mssql_fetch_array($resp)) 
{
   $i++;
   $sheet->setCellValueByColumnAndRow(0, $i+5, $i );
   $sheet->setCellValueByColumnAndRow(5, $i+5, stripslashes($row[0]));
   $sheet->setCellValueByColumnAndRow(6, $i+5, stripslashes($row[3]));
   if ($row[2]=='          ')
   {
   }
   else
   {
      $sheet->setCellValueByColumnAndRow(3, $i+5, stripslashes($row[4]));    
   }
   $sheet->setCellValueByColumnAndRow(1, $i+5, $row[2]);   
   if ($row[5]>6) { $sheet->setCellValueByColumnAndRow(7, $i+5, $row[5]-6);}   
   if ($row[6]>0) { $sheet->setCellValueByColumnAndRow(8, $i+5, $row[6]);}
   if ($row[7]>0) { $sheet->setCellValueByColumnAndRow(9, $i+5, $row[7]);}
   if ($row[2]=='          ' or $row[2]=='')
   {
      $sheet->setCellValueByColumnAndRow(2, $i+5, 'Обеспечивающие процессы');
   }
   else
   {
      $sheet->setCellValueByColumnAndRow(2, $i+5, 'Основные процессы');
   }
   $sheet->setCellValueByColumnAndRow(10, $i+5, $row[1]);   
   $sheet->setCellValueByColumnAndRow(29, $i+5, stripslashes($row[10]));   
   $sheet->setCellValueByColumnAndRow(16, $i+5, stripslashes($row[11]));   
   $sheet->setCellValueByColumnAndRow(19, $i+5, stripslashes($row[12]));
   $sheet->setCellValueByColumnAndRow(18, $i+5, stripslashes($row[14]));
   $sheet->setCellValueByColumnAndRow(17, $i+5, stripslashes($row[15]));         
   if ($row[13]>0)
   {
      $sheet->setCellValueByColumnAndRow(22, $i+5, stripslashes($row[13]));      
   }
   $sheet->setCellValueByColumnAndRow(11, $i+5, $row[8]);   
   $req2="SELECT count(t1.id) FROM process_workers as t1 JOIN org_structure as t2 ON t2.id=t1.worker_id WHERE t2.unit_name like 'Председатель Комитета%' and t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   $row2= mssql_fetch_array($resp2);
   if ($row2[0]>0)
   {
      $sheet->setCellValueByColumnAndRow(12, $i+5, 'Да');   
   }
   else
   {
      $sheet->setCellValueByColumnAndRow(12, $i+5, 'Нет');   
   }
   
   $req2="SELECT count(t1.id) FROM process_workers as t1 JOIN org_structure as t2 ON t2.id=t1.worker_id WHERE t2.unit_name like 'Заместитель председателя%' and t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   $row2= mssql_fetch_array($resp2);
   if ($row2[0]>0)
   {
      $sheet->setCellValueByColumnAndRow(13, $i+5, 'Да');   
   }
   else
   {
      $sheet->setCellValueByColumnAndRow(13, $i+5, 'Нет');   
   }
   
   $req2="SELECT count(t1.id) FROM process_workers as t1 JOIN org_structure as t2 ON t2.id=t1.worker_id WHERE not t2.unit_name like 'Председатель Комитета%' and not t2.unit_name like 'Заместитель председателя%'  and t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   $row2= mssql_fetch_array($resp2);
   if ($row2[0]>0)
   {
      $sheet->setCellValueByColumnAndRow(14, $i+5, 'Да');   
   }
   else
   {
      $sheet->setCellValueByColumnAndRow(14, $i+5, 'Нет');   
   }
   
// Информационные системы   
   $list='';
   $req2="SELECT t2.s_name FROM process_it_system as t1 JOIN it_system as t2 ON t2.id=t1.it_system_id WHERE  t1.process_id=".$row[9];
   $resp2 = mssql_query($req2);
   while ($row2= mssql_fetch_array($resp2))
   {
      $list = $list.$row2[0];
   } 

   $sheet->setCellValueByColumnAndRow(27, $i+5, $list);   
   if ($list=='')
   {
      $sheet->setCellValueByColumnAndRow(28, $i+5, '0');   
   }
   else
   {
      $sheet->setCellValueByColumnAndRow(28, $i+5, '1');   
   }

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