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
            $titol = (($langles)?'Password recovery':'Recuperaci&oacute;n de password');
            $misatge = (($langles)?'Please enter your email address to get a new password.':'Por favor, introduzca su correo electrónico para conseguir un nuevo password.');
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle($titol,$misatge,$titol,$misatge,'login'); 
        ?>
        <!-- LOGIN TEMPLATE -->
        <?php
            $accede = (($langles)?'Sign in':'Solicitar nuevo password');
            $nocuenta = (($langles)?'Don\'t have an account':'No tiene una cuenta');
            $registrate = (($langles)?'Register here':'Regístrese');
            
        ?>
        <div class="container">
            <div class="container" style="margin:40px 0px 40px 0px">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>
                                    <?php 
                                        echo($titol);
                                        echo '<p style="margin:10px 0px 10px 0px;color:red;"><a href="#">';
                                        echo $misatge;
                                        echo '</a></p>';
                                        if (isset($_SESSION['dimelo']) && (! empty($_SESSION['dimelo']))){
                                            echo '<h4><p style="margin:10px 0px 10px 0px;color:'.$GLOBALS['red'].';">';
                                                echo $_SESSION['dimelo'];
                                            echo '</p></h4>';
                                        }
                                        unset($_SESSION['dimelo']);
                                    ?>
                                    </strong>
                                </div>
                                <div class="panel-body">
                                    <form role="form" action="repass.php" method="POST" data-fv-framework="bootstrap"
                                        data-fv-icon-valid="glyphicon glyphicon-ok"
                                        data-fv-icon-invalid="glyphicon glyphicon-remove"
                                        data-fv-icon-validating="glyphicon glyphicon-refresh">
                                        <fieldset>
                                            <div class="row">
                                                <div class="center-block">
                                                    <img class="profile-img"
                                                        src="assets/img/user_avatar -unknow.png" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                    <div class="form-group">
                                                    <?php
                                                        // email
                                                        entradeta("","email","email","email","",'glyphicon-envelope','T',true,' email="true" ');
                                                    ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo($accede); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="panel-footer ">
                                    <?php echo($nocuenta); ?> ?<a href="registre.php" onClick=""> <?php echo($registrate); ?> </a><br>
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