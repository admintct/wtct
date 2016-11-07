<?php
    include_once 'sempre.php';
    if (isset($_REQUEST['id']) && $_REQUEST['id']){
        $laptda = $_REQUEST['id'];
        include 'bbdd_lcl.php';

        require_once('fpdf.php');
        require_once('fpdi.php');

        $pdf = new FPDI();

        $pagecount = $pdf->setSourceFile($GLOBALS['$bl']);
        $tplidx = $pdf->importPage(1, '/MediaBox');

        $pdf->addPage();
        $pdf->useTemplate($tplidx, 0, 0, 0);
        //
        $pdf->SetFont('Arial','',8);
        $pdf->SetTextColor(0, 0, 0);
        include 'calc_bl.php';
        // IMPRESIO ******************************
        
        $pdf->SetXY(3, 8);
        $pdf->MultiCell(78, 3.5, trim($elshipper), 0, 'L');
        $pdf->SetXY(15, 29);$pdf->Write(0,$laref);
        $pdf->SetXY(3, 36); $pdf->MultiCell(78, 3.5, $elconsig, 0, 'L');
        $pdf->SetXY(3, 65); $pdf->MultiCell(78, 3.5, $elnotify, 0, 'L');
        $pdf->SetXY(3, 95); $pdf->Write(0,$oceanvessel);
        $pdf->SetXY(50, 87); $pdf->Write(0,$ptda['blplaceofrecip']);
        $pdf->SetXY(50, 95); $pdf->Write(0,$ptda['bl_pol']);
        $pdf->SetXY(3, 102); $pdf->Write(0,$ptda['blpod']);
        $pdf->SetXY(50, 102); $pdf->Write(0,$ptda['blfpod']);
        $pdf->SetXY(105, 102); $pdf->Write(0,$payable);
        $pdf->SetXY(133, 102); $pdf->Write(0,$ncopies);
        $pdf->SetXY(162, 102); $pdf->Write(0,$numbl);

                $pdf->SetXY(105, 60);$pdf->Write(0,$ctmp);

        $pdf->SetXY(3, 111); $pdf->MultiCell(55, 3.5,(($zzz)?$ptda['mmarcas']:$ptda['fmmarcas']) , 0, 'L');
        $pdf->SetXY(58, 111); $pdf->MultiCell(19, 3.5,$paquets, 0, 'L');
        $pdf->SetXY(78, 111); $pdf->MultiCell(90, 3.5,$mimerc, 0, 'L');
        $pdf->SetXY(175, 111); $pdf->MultiCell(30, 3.5,$gross, 0, 'L');
        if ($ptdab['lbl_cbm'] || true){
            $pdf->Line(168,174,197,174);
            $pdf->SetXY(168, 177); $pdf->Write(0,'VOLUME');
            $pdf->Line(168,180,197,180);
            $pdf->SetXY(174, 184); $pdf->Write(0,number_format($ptdab['bl_cbm'],3,',','.').' CBM');
        }
        $pdf->SetXY(15, 195); $pdf->Write(0,str_replace("-", "",str_replace(".", "",$cntr)));
        $pdf->SetXY(45, 195); $pdf->Write(0,$seal);
        if (! ($ptda['fcl'] || $ptda['noblwm'])){
            $pdf->SetXY(10, 210); $pdf->Write(0,number_format($ptda['bl_cbm'],3,',','.'));
        }
        if ($ptda['bl_ldetalle']){
            $pdf->SetXY(45, 210); $pdf->Write(0,number_format($ptda['bl_detalle'],0,',','.').' '.$ptda['divisa']);
        }
        if ($ptda['bl_ltotal']){
            $pdf->SetXY(68, 211); $pdf->Write(0,$totalf);
        }
        $pdf->SetXY(109, 204); $pdf->Write(0,(($ptdab['bl_agents'])?$ptdab['bl_agents']:'SHIPPING AGENTS AT PORT OF DESTINATION :'));
        $pdf->SetXY(109, 214); $pdf->MultiCell(100, 3.5,$pintagent, 0, 'L');
        $pdf->SetXY(134, 253); $pdf->Write(0,$placeanddate);
        
        $pdf->SetXY(3, 224); $pdf->MultiCell(100, 3.5,$clausules, 0, 'L');
        
        
        
        
        $pdf->Output('BL-'.$laptda.'.pdf', 'I');            
    }
?>