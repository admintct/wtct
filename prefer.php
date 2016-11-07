<?php
    $GLOBALS['privada'] = 1;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    // Cal saltar ?
    $horari = retvar('horari');
    $horaria = retvar('horaria');
    $conec = conexioi();
    if ($conec){
        if (isset($_REQUEST['guarda'])){
            $quevol = 'UPDATE preferweb SET horari="'.retvar('horari').'", horaria="'.retvar('horaria').'" WHERE codi="1"';
            $fconstmp = mysqli_query($conec,$quevol );
            if ($fconstmp){
                saltaa('index.php');
            }
        }
        else{
            $quevol = 'SELECT * FROM preferweb WHERE codi="1"';
            $fconstmp = mysqli_query($conec,$quevol );
            if ($preferweb = mysqli_fetch_array($fconstmp)) {
                $horari = $preferweb['horari'];
                $horaria = $preferweb['horaria'];
            }
        }
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
        htmlestils('',1,0,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps, Captcha, grid
        include_once 'lagrid_datatable.php';
        lagrid_datatable("selempre","selempre.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Preferencias ".miratct(),'TCT SL',"Preferences ".miratct(),'TCT SL',"selempre"); 
        ?>
        <div class="container">
            <div class="row text-left" style="padding: 20px 0px 20px 20px;">
                    <form role="form" action="prefer.php" method="post" novalidate="novalidate">
                        <div class="prefer">
                            <p>Horario y Festivos</p>
                            <textarea name="horari"  rows="4" cols="80" class="contact-message" id="contact-message"><?php echo $horari; ?></textarea>
                        </div>
                        <div class="prefer">
                            <p>Horario y Festivos (inglés)</p>
                            <textarea name="horaria"  rows="4" cols="80" class="contact-message" id="contact-message"><?php echo $horaria; ?></textarea>
                        </div>
                        <button type="submit" class="btn" name="guarda" value="guarda">Guardar</button>
                    </form>
            </div>
        </div>
        <!--define the table using the proper table tags, leaving the tbody tag empty -->
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
    </body>
</html>