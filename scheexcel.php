<head></head>
<body>
<?php
    include_once 'sempre.php';
    include_once 'excelaux.php';
    include './assets/Classes/PHPExcel/IOFactory.php';
    require_once './assets/Classes/PHPExcel.php';
    
    function flush_buffers(){
        ob_end_flush();
        flush();
        ob_start();
        ob_flush();
    } 

    function genexcel($ie){
        $ncols = 4;
        $excelgenerat = "download/schedule-".(($ie=='i')?'im':'ex')."port.xlsx";
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("tct.es")
                                                     ->setLastModifiedBy("TCT SL")
                                                     ->setTitle("TCT - Office 2007 XLSX Document")
                                                     ->setSubject("TCT - Office 2007 XLSX Document")
                                                     ->setDescription("TCT Schedule.")
                                                     ->setKeywords("office 2007 openxml php")
                                                     ->setCategory("schedule TCT SL");
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(5);
        $sheet->getStyle("C")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("D")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("F")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("G")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("H")->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Logo
        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $objDrawing->setPath('./assets/img/logo.png');
        $objDrawing->setHeight(42);
        $objDrawing->setCoordinates('A1');
        $objDrawing->setOffsetX(5);
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
        $numlin = 3;
        $sheet->getStyle("D".$numlin)->getFont()->setBold(true)
                                    ->setName('Verdana')
                                    ->setSize(14)
                                    ->getColor()->setRGB('103F75');
        $sheet->setCellValue('D'.$numlin,(($ie=='i')?'IM':'EX')."PORT SCHEDULE");  
        // CAPCALERA ///
        $sheet->getStyle('A5:H5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('A5:H5')->getFill()->getStartColor()->setARGB('0103f75');
        $sheet->getStyle('A5:H5')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
        $sheet->getStyle('A5:H5')->getFont()->setBold(true);
        $numlin = 5;
        $sheet
                    ->setCellValue('A'.$numlin, 'ORIGIN') // EAN
                    ->setCellValue('B'.$numlin, 'VESSEL')
                    ->setCellValue('C'.$numlin, 'VOY No.')
                    ->setCellValue('D'.$numlin, 'CUT OFF')
                    ->setCellValue('E'.$numlin, 'ETD')
                    ->setCellValue('F'.$numlin, 'ETA')
                    ->setCellValue('G'.$numlin, 'TT')
                    ->setCellValue('H'.$numlin, 'VIA');  
        $numlin++;

        $conec = conexioi();
        if ($conec){
            $n = 0;
//            $quevol = 'SELECT * FROM scheweb WHERE ie="I" and (codpunt=codbase or codbase="") ORDER BY descrip, etseta';
            $quevol = 'SELECT * FROM scheweb WHERE ie="'.(($ie=='i')?'I':'E').'" ORDER BY descrip, etseta';
            $fconstmp = mysqli_query($conec,$quevol );
            $actport = '';
            $pintaport = '';
            while ($scheweb = mysqli_fetch_array($fconstmp)) {
                $n++;
                $c = (($n%2) == 0)?'':'2';
                $potfer = true;
                if ($actport != $scheweb['descrip']){
                    //include 'allimport_det.php';
                    if ($actport){

                    }
                    $actport = $scheweb['descrip'];
                    $pintaport = $scheweb['descrip']; 
                }
                else{
                    $pintaport = ''; 
                }
                // booking
                $avui = date_create(date('Y-m-d'));
                $clos = date_create($scheweb['closing']);
                $potfer = ($avui < $clos);
                $quepinta = ($potfer)?DTOC($scheweb['closing']):' - ';
                $xxd = trim(DTOC($scheweb['etseta2']));
                $sheet
                            ->setCellValue('A'.$numlin, $scheweb['descrip']) 
                            ->setCellValue('B'.$numlin, $scheweb['nombarco'])
                            ->setCellValue('C'.$numlin, (($scheweb['viaje'])?$scheweb['viaje']:'-'))
                            ->setCellValue('D'.$numlin, $quepinta)
                            ->setCellValue('E'.$numlin, DTOC($scheweb['etseta']))
                            ->setCellValue('F'.$numlin, DTOC($scheweb['etseta2']))
                            ->setCellValue('G'.$numlin, $scheweb['tt'])
                            ->setCellValue('H'.$numlin, substr($scheweb['isobase'],2));  
                $numlin++;
            }
        }
        // include 'allimport_det.php';
        $objPHPExcel->getActiveSheet()->setTitle('Schedule TCT');
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->setPreCalculateFormulas(false);
        $objWriter->save($excelgenerat);
    }
    echo "GENERANDO SCHEDULE DE IMPORT...</br>";
    flush_buffers();
    genexcel('i');
    echo "SCHEDULES de IMPORT GENERADO. GENERANDO EXPORT...</br>";
    flush_buffers();
    genexcel('e');
    echo "SCHEDULES de EXPORT.";
    flush_buffers();
?>    
</body>
<script type="text/javascript">
//  alert("Un mensaje de prueba");
  window.close();
</script>