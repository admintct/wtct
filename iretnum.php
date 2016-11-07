<?php
function iretnum($num=0){
    $ftorna = '';
    $numbers10 = array('ten','twenty','thirty','fourty','fifty','sixty','seventy','eighty','ninety');
    $numbers01 = array('one','two','three','four','fife','six','seven','eight','nine','ten',
        'eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen');

    if($num == 0) {
        $ftorna .= "zero";
    }

    $thousands = floor($num/1000);
    if($thousands != 0) {
        $ftorna .=  $numbers01[$thousands-1] . " thousand ";
        $num -= $thousands*1000;
    }
    $hundreds = floor($num/100);
    if($hundreds != 0) {
        $ftorna .=  $numbers01[$hundreds-1] . " hundred ";
        $num -= $hundreds*100;
    }
    if($num < 20) {
        if($num != 0) {
            $ftorna .=  $numbers01[$num-1];
        }
    } else {
        $tens = floor($num/10);
        echo $numbers10[$tens-1] . " ";
        $num -= $tens*10;

        if($num != 0) {
            $ftorna .=  $numbers01[$num-1];
        }
    }
    return $ftorna;
}
?>