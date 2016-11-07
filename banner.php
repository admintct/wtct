<?php
// Per Agents
if ($_SESSION['usr_clientoagent'] > 1){
    $quevol = 'SELECT * FROM banner WHERE ((totscliag=3 AND codcli="") OR (totscliag=3 AND codcli="'.$_SESSION['usr_codcli'].'")) AND marcat=1 AND iniciofi='.$iniciofi;
    if ($conec){
        $fconstmp = mysqli_query($conec,$quevol );
        while($news = mysqli_fetch_array($fconstmp)) {
            echo '<div style="padding:10px 0px 10px 0px;">';
                echo '<div class="row amb_fons_blau wow fadeIn'.((rand(1,2)==1)?'Right':'Left').'" style="padding:10px 10px 10px 10px;">';
                    $quepinta = utf8_encode($news['rollo']);
                    $quepinta = str_replace('%usuario%',$_SESSION['usr_nomuser'],$quepinta);
                    $quepinta = str_replace('%cliente%',($_SESSION['usr_tct'])?'TCT':$_SESSION['usr_nomcli'],$quepinta);
                    echo $quepinta;
                echo '</div>';
            echo '</div>';
       }
    }
}
// Per clients 
if ($_SESSION['usr_clientoagent'] == 1 || $_SESSION['usr_clientoagent'] == 3 ){
    $quevol = 'SELECT * FROM banner WHERE ((totscliag=2 AND codcli="") OR (totscliag=2 AND codcli="'.$_SESSION['usr_codcli'].'")) AND marcat=1 AND iniciofi='.$iniciofi;
    if ($conec){
        $fconstmp = mysqli_query($conec,$quevol );
        while($news = mysqli_fetch_array($fconstmp)) {
            echo '<div style="padding:10px 0px 10px 0px;">';
                echo '<div class="row amb_fons_blau wow fadeIn'.((rand(1,2)==1)?'Right':'Left').'" style="padding:10px 10px 10px 10px;">';
                    $quepinta = utf8_encode($news['rollo']);
                    $quepinta = str_replace('%usuario%',$_SESSION['usr_nomuser'],$quepinta);
                    $quepinta = str_replace('%cliente%',($_SESSION['usr_tct'])?'TCT':$_SESSION['usr_nomcli'],$quepinta);
                    echo $quepinta;
                echo '</div>';
            echo '</div>';
       }
    }
}
/// Generals
$quevol = 'SELECT * FROM banner WHERE totscliag=1 AND marcat=1 AND iniciofi='.$iniciofi;
if ($conec){
    $fconstmp = mysqli_query($conec,$quevol );
    while($news = mysqli_fetch_array($fconstmp)) {
        echo '<div style="padding:10px 0px 10px 0px;">';
            echo '<div class="row amb_fons_blau wow fadeIn'.((rand(1,2)==1)?'Right':'Left').'" style="padding:10px 10px 10px 10px;">';
                $quepinta = utf8_encode($news['rollo']);
                $quepinta = str_replace('%usuario%',$_SESSION['usr_nomuser'],$quepinta);
                $quepinta = str_replace('%cliente%',($_SESSION['usr_tct'])?'TCT':$_SESSION['usr_nomcli'],$quepinta);
                echo $quepinta;
            echo '</div>';
        echo '</div>';
   }
}
?>