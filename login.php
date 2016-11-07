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
        htmlestils('',1,0,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Login","Por favor, identif&iacute;quese para acceder a los contenidos privados de la web","Login","Please login to access private contents of the web","login"); 
        ?>
        <!-- LOGIN TEMPLATE -->
        <?php
            $titol = (($langles)?'Sign in to continue':'Identif&iacute;quese para continuar');
            $descuser = (($langles)?'Username':'Usuario');
            $accede = (($langles)?'Sign in':'Identificarse');
            $nocuenta = (($langles)?'Don\'t have an account':'No tiene una cuenta');
            $registrate = (($langles)?'Sign Up Here':'Reg&iacute;strese aqui');
            $olvido = (($langles)?'Forgot your password':'Olvid&oacute; su password');
            
        ?>
        <div class="container">
            <div class="container" style="margin:40px 0px 40px 0px">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4  col-centered">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>
                                    <?php 
                                        echo($titol);
                                        if (isset($_SESSION['dimelo'])){
                                            echo '<p style="margin:10px 0px 10px 0px;color:red;">';
                                            if ($_SESSION['dimelo'] === 'NO'){
                                                echo (($langles)?'Wrong username or password.</p><p>Please try again.':'Usuario o password incorrectos.</p><p>Por favor int&eacute;ntelo de nuevo.');
                                            }
                                            else{
                                                echo (($langles)?'Valid username and password must be specified':'Debe indicar un usuario y password.');
                                            }
                                            echo '</p>';
                                            unset($_SESSION['dimelo']);
                                        }
                                    ?>
                                    </strong>
                                </div>
                                <div class="panel-body entersubmit">
                                    <form role="form" action="entra.php" method="POST">
                                        <fieldset>
                                            <div class="row">
                                                <div class="center-block">
                                                    <img class="profile-img"
                                                        src="assets/img/user_avatar.png" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-user"></i>
                                                            </span> 
                                                            <input class="form-control" placeholder="<?php echo($descuser); ?>" name="loginname" type="text" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-lock"></i>
                                                            </span>
                                                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                                        </div>
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
                                <div class="panel-footer ">
                                    <a href="nopass.php" onClick=""><i><?php echo($olvido); ?> ?</i></a>
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