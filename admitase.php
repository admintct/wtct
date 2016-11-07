<?php
    include_once 'sempre.php';
    if (isset($_REQUEST['admitase']) && $_REQUEST['admitase']){
        if ($GLOBALS['$admitase']){
            $laptda = $_REQUEST['admitase'];
            include 'bbdd_lcl.php';

            require_once('fpdf.php');
            require_once('fpdi.php');
  
            $pdf = new FPDI();

            $pagecount = $pdf->setSourceFile($GLOBALS['$admitase']);
            $tplidx = $pdf->importPage(1, '/MediaBox');

            $pdf->addPage();
            $pdf->useTemplate($tplidx, 0, 0, 0);
            //
            $pdf->SetFont('Arial','',10);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(35, 40.5);$pdf->Write(0, date('d/m/y'));
            
            if ($codcli){
                $pdf->SetXY(120, 38.5);
                $pdf->MultiCell(78, 4, trim($ptda['client']).$crlf.
                        trim($clients['domcli']).' '.trim($clients['domclib']).$crlf.
                        trim($clients['cpcli']).' - '.trim($clients['pobcli']), 0, 'L');
            } 
            
            $pdf->SetXY(105,88);$pdf->Write(0,$ptdab['refadmitase']);

            $pdf->SetXY(37, 107.5);$pdf->Write(0, $ptda['descpunt']);
            $pdf->SetXY(138, 107.5);$pdf->Write(0, $laptda);
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(25, 122);$pdf->Write(0, trim($ptda['bultos']));
            $pdf->SetXY(35, 122);$pdf->Write(0, trim($ptda['tipobult']));
            $pdf->SetXY(58, 120.5);
            $pdf->MultiCell(30, 3, trim($ptda['marcas']), 0, 'L');
            $pdf->SetXY(92, 120.5);
            $pdf->MultiCell(70, 3, trim($ptda['mercancia']), 0, 'L');
            $pdf->SetXY(170, 122);$pdf->Write(0, number_format($ptda['bultos'],2 )." Kgs");

            if ($codmagat){
                $pdf->SetFont('Arial','',9);
                $pdf->SetXY(60, 243);
                $pdf->MultiCell(85, 4, trim($depot['descrip']).$crlf.
                        trim($depot['domdepot']).$crlf.
                        trim($depot['cpdepot']).' - '.trim($depot['pobdepot']).$crlf.$crlf.
                        (($depot['horario'])?'Horario : '.$depot['horario'].$crlf:'').
                        (($depot['teldepot1'])?'Tel. : '.$depot['teldepot1']:'')
                        , 0, 'L');
            }

            $pdf->Output('ADMITES-'.$laptda.'.pdf', 'D');            
            
            
            
        }
    }
?>