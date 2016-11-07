<?php
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    $op = retvar('op');
    $ptda = retvar('ptda');
    $quinvol = 'SOL_IMP'.$op;
    $xsubject = texteweb($quinvol,1);
    $xtexte = texteweb($quinvol,0);
    $eldetall = $_SESSION['dadesimport'];
    if ((empty($op) && empty($ptda)) || (empty($xsubject) || empty($xtexte))){
        saltaa('login.php');
    } 
?>
<html lang="<?php echo(($langles)?'en':'es');?>">
    <head>
        <?php
        // Meta
        include_once 'htmlmeta.php';
        htmlmeta('login');
        // CSS
        include_once 'htmlestils.php';
        htmlestils('',1,0,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("EMAIL","Ref. Import ".$ptda,"EMAIL","Ref. Import ".$ptda,"bookings"); 
            
        ?>
        <!-- NEWS -->
        <div class="container">
            <div class="container" style="margin:40px 0px 80px 0px">
                    <div class="row">
                        <div class="col-xm-12 col-sm-12 col-centered  wow fadeIn">
                                    <div class="col-sm-8 col-centered contact-form wow fadeInLeft animated text-left" style="visibility: visible; animation-name: fadeInLeft;">
                                        <form role="form" action="importemail.php" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                                            <p lingdex="1"><h4>
                                                <?php 
                                                    echo $xsubject; 
                                                    echo '<input type="hidden" name="eltitol" value="'.$xsubject.'">';
                                                    echo '<input type="hidden" name="eldetall" value="'.$eldetall.'">';
                                                    echo '<input type="hidden" name="ptda" value="'.$ptda.'">';
                                                ?> 
                                            </h4></p>
                                            <p>
                                                <?php echo $eldetall; ?>
                                            </p>
                                            <div class="form-group">
                                                <textarea name="message" placeholder="Su consulta..." class="contact-message" id="contact-message"><?php echo p_to_cr($xtexte); ?></textarea>
                                            </div>
                                            <?php
                                                echo html_input_hidden('nfitxers','0',true);
                                                echo '<div class="wow fadeInRight" style="padding:0px 0px 20px 0px;">';
                                                    echo '<table id="taulafitxers" style="width:80%" border="1" class="taulafitxer"><thead><tr>';
                                                    echo '<th>'.(($langles)?'FILES':'ARCHIVOS').'</th><th onclick="mesfitxer();" style="width:35px;text-align:center;"><h5><i style="color:cyan;" class="fa fa-plus"></i></h5></th>';
                                                    echo '</tr></thead>';
                                                    echo '<tr id="row_fitxer_">';
                                                    $elboto = '<input type="file" class="filestyle" data-classButton="btn btn-primary" data-input="false" data-classIcon="icon-plus" name="fitxer1">';
                                                    echo '<td>'.$elboto;
                                                    echo '<div style="padding:5px 0px 0px 0px;" class="text-right">';
                                                    echo (($langles)?'Type: ':'Tipo: ').fa_input_select('calif','califweb',' tipus="PI" AND selcliweb ','',null,'calif1');
                                                    echo '</div>';
                                                    echo '</dt>';
                                                    echo '<td onclick="borrafitxer();" style="text-align:center;"><h5><i style="color:orangered;" class="fa fa-remove"></i></h5></td>';

                                                    echo '</tr></table>';
                                                echo '</div>';
                                            ?>
                                            <div class="wow fadeInRight">
                                                <button type="submit" class="btn"><?php echo ($langles)?'Send':'Envía'; ?></button>
                                            </div>
                                        </form>
                                    </div>                                    
                        </div>
                    </div>
                </div>
            </div>
    	</div>
        <!-- NEWS -->
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow');
        ?>
        <script src="assets/js/emailptdai.js"></script>;
    </body>
</html>