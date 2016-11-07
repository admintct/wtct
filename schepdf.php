<?php
    include_once 'sempre.php';
    function rettirae($id='',$actport){
        $conecb= conexioi();
        $mitira = '';
        if ($conecb){
            $quevolb = 'SELECT DISTINCT descrip FROM scheweb WHERE ie="E" AND descbase="'.$actport.'" AND descrip!="'.$actport.'" ORDER BY descrip';
            $fconstmpb = mysqli_query($conecb,$quevolb);
            while ($mesports = mysqli_fetch_array($fconstmpb)) {
                $mitira .= (($mitira)?', ':'') . $mesports[0];
            }
           // $conecb->close();
        }
        return $mitira;
    }
    function rettirai($id='',$actport){
        $conec = conexioi();
        if ($conec){
            $mitira = '';
            $quevolb = 'SELECT DISTINCT descrip FROM scheweb WHERE ie="I" AND descbase="'.$actport.'" AND descrip!="'.$actport.'" ORDER BY descrip';
            $fconstmpb = mysqli_query($conec,$quevolb);
            while ($mesports = mysqli_fetch_array($fconstmpb)) {
                $mitira .= (($mitira)?', ':'') . $mesports[0];
            }
        }
        return $mitira;
    }
    if (isset($_REQUEST['ie']) && $_REQUEST['ie']){
        $lasource = 'assets/img/NoImage150.gif';
        $_SESSION['ellogo'] = 'assets/img/LOGO SOLO 150x52.png';
        include_once 'quinlogo.php';
        
        $ie = retvar('ie');
        $GLOBALS['ie'] = $ie;
        $id = retvar('id');
        $GLOBALS['id'] = $id;
        $com = retvar('com');
        require_once('fpdf.php');

        class PDF extends FPDF
        {
            function Header()
            {
                global $title;
                global $ie;
                // Arial bold 15
                $this->Image($_SESSION['ellogo'],10,8,40);
                $this->SetFont('Arial','B',15);
                // Calculamos ancho y posición del título.
                $w = $this->GetStringWidth($title)+6;
                // Título
                $this->SetXY((210-$w)/2+10, 29);
                $this->SetTextColor(0, 0, 0); //Letra color blanco
                $this->Write(0,$title);
                ////
                $this->SetXY(25, 40);
                $this->SetLeftMargin(35);
                $this->SetFont('Arial','B',9);
                $this->SetFillColor(16,63,117);//Fondo verde de celda
                $this->SetTextColor(255, 255, 255); //Letra color blanco

                if($GLOBALS['ie']=='i'){
                    // IMPORT CAPCALERA
                    $etdbase = '';
                    $isobase = '';
                    if ($GLOBALS['id'] != 'ALL'){
                        $conec = conexioi();
                        if ($conec){
                            $quevol = 'SELECT * FROM scheweb WHERE descrip="'.$GLOBALS['id'].'" AND ie="I" ORDER BY etseta LIMIT 1';
                            $fconstmp = mysqli_query($conec,$quevol );
                            if($scheweb = mysqli_fetch_array($fconstmp)) {
                                $isobase = $scheweb['isobase'];
                                if($scheweb['etdbase']){
                                    $etdbase = $scheweb['descbase'];
                                    $isobase = '';
                                }
                            }
                        }
                    }
                    $this->Cell(35,7, "ORIGIN",0, 0 , 'L', true);
                    $this->Cell(40,7, "VESSEL",0, 0 , 'L', true);
                    $this->Cell(16,7, "VOY No.",0, 0 , 'C', true);
                    $this->Cell(17,7, "CUT OFF",0, 0 , 'C', true);
                    $this->Cell(17,7, "ETD",0, 0 , 'C', true);
                    $this->Cell(17,7, "ETA",0, 0 , 'C', true);
                    $this->Cell(8,7, "TT",0, 0 , 'C', true);
                    if ($isobase){
                        $this->Cell(8,7, "VIA",0, 0 , 'C', true);
                    }
                    $this->Ln();
                    if ($etdbase){
                        $this->Cell(35,7, "",0, 0 , 'L', true);
                        $this->Cell(40,7, "",0, 0 , 'L', true);
                        $this->Cell(16,7, "",0, 0 , 'C', true);
                        $this->Cell(17,7, "",0, 0 , 'C', true);
                        $this->Cell(17,7, $etdbase,0, 0 , 'C', true);
                        $this->Cell(17,7, "",0, 0 , 'C', true);
                        $this->Cell(8,7, "",0, 0 , 'C', true);
                        $this->Ln();
                    }
                }
                else{
                    // EXPORT CAPCALERA 
                    $this->Cell(35,7, "DESTINATION",0, 0 , 'L', true);
                    $this->Cell(40,7, "VESSEL",0, 0 , 'L', true);
                    $this->Cell(16,7, "VOY No.",0, 0 , 'C', true);
                    $this->Cell(17,7, "CUT OFF",0, 0 , 'C', true);
                    $this->Cell(17,7, "ETD",0, 0 , 'C', true);
                    $this->Cell(17,7, "ETA",0, 0 , 'C', true);
                    $this->Cell(8,7, "TT",0, 0 , 'C', true);
                    if ($GLOBALS['id']!='ALL'){
                        $this->Cell(8,7, "VIA",0, 0 , 'C', true);
                    }
                    $this->Ln();
                }
            }

            function Footer()
            {
                // Posición a 1,5 cm del final
                $this->SetY(-15);
                // Arial itálica 8
                $this->SetFont('Arial','I',8);
                // Color del texto en gris
                $this->SetTextColor(128);
                // Número de página
                $this->Cell(0,10,(($GLOBALS['$langles'])?'Page':utf8_decode('Página')).' '.$this->PageNo(),0,0,'C');
            }

            function fesexport($ie,$id,$com)
            {
                $this->SetFont('Arial','',8);
                $this->SetFillColor(255,255,255);//Fondo verde de celda
                $this->SetTextColor(0, 0, 0); //Letra color blanco
                $conec = conexioi();
                if ($conec){
                    $pinici = new DateTime();
                    $pinici->sub(new DateInterval('P2D'));
                    $dinici = $pinici->format('Y-m-d');
                    $n = 0;
                    $nvan = 0;
                    if ($id == "ALL"){
                        $quevol = 'SELECT * FROM scheweb WHERE ie="E" and (codpunt=codbase or codbase="") and (etseta >= "'.$dinici.'") ORDER BY descrip, etseta';
                    }
                    else{
                        $quevol = 'SELECT * FROM scheweb WHERE ie="E" and (descrip="'.$id.'") and (etseta >= "'.$dinici.'") ORDER BY descrip, etseta';
                    }
                    $fconstmp = mysqli_query($conec,$quevol );
                    $actport = '';
                    $pintaport = '';
                    while ($scheweb = mysqli_fetch_array($fconstmp)) {
                        $n++;
                        //echo $scheweb['nombarco'].'<br>';
                        $c = (($n%2) == 0)?'':'2';
                        $potfer = true;
                        if ($actport != $scheweb['descrip']){
                            if ($id == "ALL" || true){
                                $mitira = rettirae($id,$actport);
                                if ($mitira){
                                    $this->SetFillColor(255,255,255);
                                    $this->SetTextColor(16, 63, 117);
                                    $this->SetFont('Arial','I',7.5);
                                    $this->Ln(3);
                                    $k = strlen($mitira);
                                    $xxl = 1;
                                    if ($k > 100){
                                        $xxl = 2;
                                    }
                                    elseif ($k > 250){
                                        $xxl = 3;
                                    }
                                    elseif ($k > 500){
                                        $xxl = 4;
                                    }
                                    $this->MultiCell(155,1 + ($xxl), $mitira,0,1, 'L', false);
                                    $this->Ln();
                                    $this->SetFont('Arial','',8);
                                    $this->SetTextColor(0, 0, 0); //Letra color blanco
                                    $this->Ln(6);
                                }
                            }
                            $nvan = 0;
                            $n= 1;
                            // include 'allexport_det.php';
                            // Mirem si cal mostrar el detall 
                            if ($actport){
                                $this->Ln();

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
                        $quepinta = ($avui >= $clos)?'X':DTOC($scheweb['closing']);
                        $potfer = ($avui <= $clos);
                        $nvan++;
                        $c = (($n%2) == 0)?$this->SetFillColor(255,255,255):$this->SetFillColor(232,232,232);
                        if ($nvan!=1){
                            $this->SetFillColor(255,255,255);
                        }
                        $this->SetFont('Arial','B',8);
                        $this->Cell(35,5,(($nvan==1)?$scheweb['descrip']:''),0, 0 , 'L', true);
                        $this->SetFont('Arial','',8);
                        $c = (($n%2) == 0)?$this->SetFillColor(255,255,255):$this->SetFillColor(232,232,232);
                        $this->Cell(40,5, $scheweb['nombarco'],0, 0 , 'L', true);
                        $this->Cell(16,5, (($scheweb['viaje'])?$scheweb['viaje']:'-'),0, 0 , 'C', true);
                        $this->Cell(17,5, $quepinta,0, 0 , 'C', true);
                        $this->Cell(17,5, DTOC($scheweb['etseta']),0, 0 , 'C', true);
                        $xxd = trim(DTOC($scheweb['etseta2']));
                        $this->Cell(17,5, (($xxd)?$xxd:'-'),0, 0 , 'C', true);
                        $this->Cell(8,5, $scheweb['tt'],0, 0 , 'C', true);
                        if($id != 'ALL'){
                            $this->Cell(8,5, substr($scheweb['isobase'],2),0, 0 , 'C', true);
                        }
                        $this->Ln();

                    }
                    // Mirem si cal mostrar un altre detall
                    $mitira = rettirae($id,$actport);
                    if ($mitira){
                        $this->SetFillColor(255,255,255);
                        $this->SetTextColor(16, 63, 117);
                        $this->SetFont('Arial','I',7.5);
                        $this->Ln(3);
                        $k = strlen($mitira);
                        $xxl = 1;
                        if ($k > 100){
                            $xxl = 2;
                        }
                        elseif ($k > 250){
                            $xxl = 3;
                        }
                        elseif ($k > 500){
                            $xxl = 4;
                        }
                        $this->MultiCell(155,1 + ($xxl), $mitira,0,1, 'L', false);
                        $this->Ln();
                        $this->SetFont('Arial','',8);
                        $this->SetTextColor(0, 0, 0); //Letra color blanco
                        $this->Ln(6);
                    }
                }
                
            }
            function fesimport($ie,$id,$com)
            {
                $this->SetFont('Arial','',8);
                $this->SetFillColor(255,255,255);//Fondo verde de celda
                $this->SetTextColor(0, 0, 0); //Letra color blanco
                $nlin = 42;
                $isobase = '';
                $conec = conexioi();
                if ($conec){
                    $nvan = 0;
                    $n = 0;
                    if ($id == "ALL"){
                        $quevol = 'SELECT * FROM scheweb WHERE ie="I" and (codpunt=codbase or codbase="") ORDER BY descrip, etseta';
                    }
                    else{
                        $quevol = 'SELECT * FROM scheweb WHERE descrip="'.$id.'" AND ie="I" ORDER BY etseta';
                    }
                    $fconstmp = mysqli_query($conec,$quevol );
                    $actport = '';
                    $pintaport = '';
                    while ($scheweb = mysqli_fetch_array($fconstmp)) {
                        if ($id != "ALL"){
                            $isobase = $scheweb['isobase'];
                            if($scheweb['etdbase']){
                                $isobase = '';
                            }
                        }
                        //echo $scheweb['nombarco'].'<br>';
                        $n++;
                        $nlin += 5;
                        $potfer = true;
                        if ($actport != $scheweb['descrip']){
                            $nvan = 0;
                            $n= 1;
                            if ($actport){
                                if ($id == "ALL"){
                                    $mitira = rettirai($id,$actport);
                                    if ($mitira){
                                        $this->SetFillColor(255,255,255);
                                        $this->SetTextColor(16, 63, 117);
                                        $this->SetFont('Arial','I',7.5);
                                        $this->Ln(3);
                                        $this->MultiCell(155,1 + (int) strlen($mitira)/120, $mitira,0,1, 'L', false);
                                        $this->Ln();
                                        $this->SetFont('Arial','',8);
                                        $this->SetTextColor(0, 0, 0); //Letra color blanco
                                        $this->Ln();
                                    }
                                    else{
                                        $this->Ln();
                                    }
                                }
                            }
                            $actport = $scheweb['descrip'];
                            $pintaport = $scheweb['descrip']; 
                        }
                        else{
                            $pintaport = ''; 
                        }
                        // booking
                        $c = (($n%2) == 0)?$this->SetFillColor(255,255,255):$this->SetFillColor(232,232,232);
                        $avui = date_create(date('Y-m-d'));
                        $clos = date_create($scheweb['closing']);
                        $potfer = ($avui < $clos);
                        $quepinta = ($potfer)?DTOC($scheweb['closing']):' X ';
                        if ($potfer || true){
                            $nvan++;
//                            $this->SetXY(25, $nlin);
                            if ($nvan!=1){
                                $this->SetFillColor(255,255,255);
                            }
                            $this->SetFont('Arial','B',8);
                            $this->Cell(35,5, ($nvan==1)?$scheweb['descrip']:'',0, 0 , 'L', true);
                            $this->SetFont('Arial','',8);
                            $c = (($n%2) == 0)?$this->SetFillColor(255,255,255):$this->SetFillColor(232,232,232);
                            $this->Cell(40,5, $scheweb['nombarco'],0, 0 , 'L', true);
                            $this->Cell(16,5, (($scheweb['viaje'])?$scheweb['viaje']:'-'),0, 0 , 'C', true);
                            $this->Cell(17,5, $quepinta,0, 0 , 'C', true);
                            $this->Cell(17,5, DTOC($scheweb['etseta']),0, 0 , 'C', true);
                            $xxd = trim(DTOC($scheweb['etseta2']));
                            $this->Cell(17,5, (($xxd)?$xxd:'-'),0, 0 , 'C', true);
                            $this->Cell(8,5, $scheweb['tt'],0, 0 , 'C', true);
                            if ($isobase){
                                $this->Cell(8,5, substr($scheweb['isobase'],2),0, 0 , 'C', true);
                            }
                            $this->Ln();
                        }
                    }
                    if ($id == "ALL"){
                        $mitira = rettirai($id,$actport);
                        if ($mitira){
                            $this->SetFillColor(255,255,255);
                            $this->SetTextColor(16, 63, 117);
                            $this->SetFont('Arial','I',7.5);
                            $this->Ln(3);
                            $this->MultiCell(155,1 + (int) strlen($mitira)/120, $mitira,0,1, 'L', false);
                            $this->Ln();
                            $this->SetFont('Arial','',8);
                            $this->SetTextColor(0, 0, 0); //Letra color blanco
                            $this->Ln();
                        }
                    }
                }
            }

            function PrintChapter($ie,$id,$com)
            {
                $this->AddPage();
                if ($ie == "i"){
                    $this->fesimport($ie,$id,$com);
                }
                else{
                    $this->fesexport($ie,$id,$com);
                }
            }
        }
        $pdf = new PDF();
        $pdf->ie = $ie;
        $title = (($ie=='i')?'IM':'EX')."PORT SCHEDULE";
        $pdf->PrintChapter($ie,$id,$com);
        $pdf->Output();        
    }
