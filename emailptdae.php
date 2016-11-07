<?php
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    $ptda = retvar('siscon_param');
    $xsubject = texteweb('CERTIFICAT',1);
    $xtexte = texteweb('CERTIFICAT',0);
    $eldetall = $_SESSION['dadesexport'];
    $lesnotes = "";
    $quinsvol = "";
    if (isset($_REQUEST['cerdoc'])){$quinsvol .= '<li>'.(($langles)?'Ship\'s bag Certificate':'Certificado de envío de documentos').'</li>';}
    if (isset($_REQUEST['cerflag'])){$quinsvol .= '<li>'.(($langles)?'Flag':'Bandera').'</li>';}
    if (isset($_REQUEST['cerflet'])){$quinsvol .= '<li>'.(($langles)?'Freight':'Flete').'</li>';}
    if (isset($_REQUEST['cerblack'])){$quinsvol .= '<li>Black List</li>';}
    if (isset($_REQUEST['cerage'])){$quinsvol .= '<li>'.(($langles)?'Age':'Edad').'</li>';}
    if (isset($_REQUEST['cerruta'])){$quinsvol .= '<li>'.(($langles)?'Ruta':'Ruta').'</li>';}
    if (empty($quinsvol)){
        saltaa('ptda_export.php?siscon_param='.$ptda);
    }
    else{
        $eldetall .= '<p>'.$xtexte.'</p><p><b><ul>'.$quinsvol.'</ul></b></p></br><p>'.(($langles)?'NOTES :':'NOTAS :').'</p>';
    }
    if ((empty($xsubject) || empty($xtexte))){
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
            pagetitle("EMAIL","Ref. Export ".$ptda,"EMAIL","Ref. Export ".$ptda,"bookings"); 
            
        ?>
        <!-- NEWS -->
        <div class="container">
            <div class="container" style="margin:40px 0px 80px 0px">
                    <div class="row">
                        <div class="col-xm-12 col-sm-12 col-centered  wow fadeIn">
                                    <div class="col-sm-8 col-centered contact-form wow fadeInLeft animated text-left" style="visibility: visible; animation-name: fadeInLeft;">
                                        <form role="form" action="exportemail.php" method="post" novalidate="novalidate">
                                            <p lingdex="1"><h4>
                                                <?php 
                                                    echo $xsubject; 
                                                    echo '<input type="hidden" name="proces" value="CERTIFICAT">';
                                                    echo '<input type="hidden" name="eltitol" value="'.$xsubject.'">';
                                                    echo '<input type="hidden" name="eldetall" value="'.$eldetall.'">';
                                                    echo '<input type="hidden" name="ptda" value="'.$ptda.'">';
                                                ?> 
                                            </h4></p>
                                            <p>
                                                <?php echo $eldetall; ?>
                                            </p>
                                            <div class="form-group">
                                                <textarea name="message" placeholder="" class="contact-message" id="contact-message"><?php echo ''; ?></textarea>
                                            </div>
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
    </body>
</html>