<?php
    $ie = $_REQUEST['ie'];
    $filename = './download/schedule-'.(($ie == 'i')?'im':'ex').'port.xlsx';
    $outname = 'schedule-'.(($ie == 'i')?'im':'ex').'port.xlsx';
    header('Content-Description: File Transfer');
    header("Expires: -1");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header('Content-Type: application/xlsx');
            header('Content-Disposition: attachment; filename='.$outname.";\n\n");
    header('Content-Transfer-Encoding: binary');
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0");
    header("Pragma: no-cache");
    $len = filesize($filename);
    header("Content-Length: $len;\n");
    ob_clean();
    flush();
    readfile($filename);
?>