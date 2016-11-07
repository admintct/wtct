<?php
    include_once 'sempre.php';
    if (isset($_REQUEST['id']) && $_REQUEST['id']){
        $laptda = $_REQUEST['id'];
        if ($fcon = conexioi()){
            $loque = 'UPDATE lcl SET lcl.ok_bl_comer=1 WHERE codi="'.$laptda.'"';
            // $ftmp = mysqli_query($fcon,$loque);
            include_once 'web_2_dbf.php';
            //web_2_dbf();
            trackweb('H/BL OK','H/BL OK','',$laptda,'E');
            comanda('OKBL','PE',$laptda);
        }
    }
?>