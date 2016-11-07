<?php
    include_once 'sempre.php';
    include 'htmldoctipe.php';
?>
<html lang="<?php echo(($langles)?'en':'es');?>">
    <head>
        <?php
        // Meta
        include_once 'htmlmeta.php';
        htmlmeta('login');
        // CSS
        include_once 'htmlestils.php';
        htmlestils('',1,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            $titol = (($langles)?'Password recovery : email sent':'Reuperaci&oacute;n de password : email enviado');
            $misatge = (($langles)?'We\'ve sent you an email so you can recover your password. Please check it .':'Hemos enviado un email para que pueda recuperar su password. Por favor verifíquelo.');
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle($titol,$misatge,$titol,$misatge,'login'); 
        ?>
        <!-- LOGIN TEMPLATE -->
        <?php
            $accede = (($langles)?'Return':'Volver');
            $nocuenta = (($langles)?'Don\'t have an account':'No tiene una cuenta');
            $registrate = (($langles)?'Sign Up Here':'Reg&iacute;strese aqui');
            
        ?>
        <div class="container">
            <div class="container" style="margin:40px 0px 60px 0px">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>
                                    <?php 
                                        echo($titol);
                                        echo '<p style="margin:10px 0px 10px 0px;color:'.$GLOBALS['red'].';"><a href="#">';
                                        echo $misatge;
                                        echo '</a></p>';
                                    ?>
                                    </strong>
                                </div>
                                <div class="panel-body">
                                    <form role="form" action="index.php" method="POST">
                                        <fieldset>
                                            <div class="row">
                                                <div class="center-block">
                                                    <img class="profile-img"
                                                        src="assets/img/sendmail-128.png" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo($accede); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
       		</div>
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow');
        ?>
    </body>
</html>