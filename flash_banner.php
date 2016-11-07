<?php
$n = 0;
$lallista_flash = '';
$quevol = "SELECT * FROM notiweb WHERE noticiaoflash=2 ORDER BY data DESC";
$conec = conexioi();
if ($conec){
    $fconstmp = mysqli_query($conec,$quevol );
    while ($news = mysqli_fetch_array($fconstmp)) {
        $n++;
        $lahref = '<a href="flash.php?ref='.$news['codi'].'">';
        $titol = (($GLOBALS['$langles'])?$news['descripa']:$news['descrip']);
        $titol = utf8_encode($titol);
        $lallista_flash .= '<b><li>'. $lahref . $titol.'</a></li></b>';
    }
    if ($n > 0){
        if ($n ==1){
            $lallista_flash .= '<li> </li>';
        }
        echo '<b><ul class="fade_news">' . $lallista_flash . '</ul></b>' ; 
    }
}

?>