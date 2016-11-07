<?php
    include_once 'sempre.php';
    if ((! isset($_SESSION['relogin_pass'])) || (empty($_SESSION['relogin_pass']))){
        $_SESSION['dimelo'] = "";
        saltaa('login.php');
    }
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
        htmlestils('',1,0,0,0,1); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps, 0 Captcha
        ?>
    </head>
    <body>
        <?php 
            $titol = (($langles)?'Password recovery':'Recuperaci&oacute;n de Password');
            $misatge = (($langles)?'Enter your new password.':'Entre su nuevo password.');
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle($titol,$misatge,$titol,$misatge,'login'); 
        ?>
        <!-- LOGIN TEMPLATE -->
        <?php
            $accede = (($langles)?'NEW password':'NUEVO Password');
            $registrate = (($langles)?'Sign Up Here':'Reg&iacute;strese aqui');
            $obligatori = (($langles)?'Required fields':'Campos obligatorios');
            $descuser = (($langles)?'User':'Usuario');
            
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
                                        echo '<p style="margin:10px 0px 10px 0px;color:'.$GLOBALS['red'].';"><a href="#">';
                                        echo $misatge;
                                        echo '</a></p>';
                                        if (isset($_SESSION['quediu']) && (! empty($_SESSION['quediu']))){
                                            echo '<h4><p style="margin:10px 0px 10px 0px;color:'.$GLOBALS['red'].';">';
                                            echo $_SESSION['quediu'];
                                            echo '</p></h4>';
                                        }
                                        unset($_SESSION['quediu']);
                                    ?>
                                    </strong>
                                </div>
                                <div class="panel-body">
                                    <form role="form" action="repassinputfinal.php" method="POST" data-fv-framework="bootstrap"
                                        data-fv-icon-valid="glyphicon glyphicon-ok"
                                        data-fv-icon-invalid="glyphicon glyphicon-remove"
                                        data-fv-icon-validating="glyphicon glyphicon-refresh">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 formulari">
                                                    <div class="form-group">
                                                    <?php
                                                        $con = conexioi();
                                                        $eluser = trim($_SESSION['relogin_pass']);
                                                        $loque = "SELECT * FROM wusuaris WHERE codi=".$eluser;
                                                        $ftorna = mysqli_query($con,$loque);
                                                        if ($fila = mysqli_fetch_array($ftorna)) {
                                                            // User
                                                            echo '<div class="form-group"><h3>'.(($langles)?'User : ':'Usuario : ').$fila['usuari'].'<br></h3></div>';
                                                            $_SESSION['usr_codi'] = $fila['codi'];
                                                            $_SESSION['usr_usuari'] = $fila['usuari'];
                                                            // Password
                                                            entradeta("","password","Password","Password","",'glyphicon-lock','P',true,' id="password" ');
                                                            // Repetir Passwrd
                                                            if ($langles){entradeta("","password_again","Repeat Password","Repeat Password","",'glyphicon-lock','P',true,' id="password_again" ');}
                                                                    else{entradeta("","password_again","Repita el password","Repita el Password","",'glyphicon-lock','P',true,' id="password_again" ');}
                                                        }
                                                    ?>
                                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo($accede); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                       </fieldset>
                                    </form>
                                </div>
                                <div class="panel-footer ">
                                    <a href="#" onClick="">* <?php echo($obligatori); ?>. </a><br>
                                </div>
                                <div class="panel-footer ">
                                    <?php echo(($langles)?'Back to':'Volver a'); ?> <a href="login.php" onClick=""> Login </a><br>
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