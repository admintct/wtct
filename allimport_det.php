<?php
if ($actport){
    $conecb= conexioi();
    $mitira = '';
    if ($conecb){
        $quevolb = 'SELECT DISTINCT descrip FROM scheweb WHERE ie="I" AND descbase="'.$actport.'" AND descrip!="'.$actport.'" ORDER BY descrip';
        $fconstmpb = mysqli_query($conecb,$quevolb);
        while ($mesports = mysqli_fetch_array($fconstmpb)) {
            $mitira .= (($mitira)?', ':'') . '<a href="sche-impo.php?puntsi_punt='.$mesports[0].'">'.$mesports[0].'</a>';
        }
       // $conecb->close();
    }
    if ($mitira){
        $mitira .= '.';
        echo '</div>';
            echo '<div class="row text-left">';
                echo '<div class="lagrid-desti-ports">';
                echo '<i>'.$mitira.'</i>';
                echo '</div>';
            echo '</div>';
        echo '<div class="row">';
    }
}
?>