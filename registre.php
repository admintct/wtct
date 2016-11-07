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
        htmlestils('',1,0,0,0,1); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps, 0 Captcha
        ?>
    </head>
    <body>
        <?php 
            $titol = (($langles)?'Register':'Registro');
            $misatge = (($langles)?'Sign in to access our entire contents.':'Reg&iacute;strese para poder acceder a nuestros contenidos completos.');
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle($titol,$misatge,$titol,$misatge,'login'); 
        ?>
        <!-- LOGIN TEMPLATE -->
        <?php
            $accede = (($langles)?'Register':'Registrarse');
            $registrate = (($langles)?'Sign Up Here':'Reg&iacute;strese aqui');
            $obligatori = (($langles)?'Required fields':'Campos obligatorios');
            $descuser = (($langles)?'New User':'Nuevo Usuario');
            
        ?>
        <div class="container">
            <div class="container" style="margin:20px 0px 20px 0px">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-centered">
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
                                    </div>
                                    <form role="form" action="faregistre.php" method="POST" data-fv-framework="bootstrap"
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
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 formulari">
                                                    <div class="form-group">
                                                        <div class="row">
                                                        <div class="col-sm-6">
                                                    <?php
                                                        // User
                                                        $_SESSION['r_login'] = (isset($_SESSION['r_login']))?$_SESSION['r_login']:'';
                                                        if ($langles){entradeta("","obliga_loginname","New User","New User","",'glyphicon-user','T',true,' minlength="6" maxlength="15" ',$_SESSION['r_login']);}
                                                                else{entradeta("","obliga_loginname","Nuevo usuario","Nuevo usuario","",'glyphicon-user','T',true,' minlength="6" maxlength="15" ',$_SESSION['r_login']);}
                                                        // Password
                                                        $_SESSION['r_pass1'] = (isset($_SESSION['r_pass1']))?$_SESSION['r_pass1']:'';
                                                        entradeta("","password","Password","Password","",'glyphicon-lock','P',true,' id="password" ',$_SESSION['r_pass1']);
                                                        // Repetir Passwrd
                                                        $_SESSION['r_pass2'] = (isset($_SESSION['r_pass2']))?$_SESSION['r_pass2']:'';
                                                        if ($langles){entradeta("","password_again","Repeat Password","Repeat Password","",'glyphicon-lock','P',true,' id="password_again" ',$_SESSION['r_pass2']);}
                                                                else{entradeta("","password_again","Repita el password","Repita el Password","",'glyphicon-lock','P',true,' id="password_again" ',$_SESSION['r_pass2']);}
                                                        // email
                                                        $_SESSION['r_email'] = (isset($_SESSION['r_email']))?$_SESSION['r_email']:'';
                                                        entradeta("","email","email","email","",'glyphicon-envelope','T',true,' email="true" ',$_SESSION['r_email']);
                                                        // Nombre
                                                        $_SESSION['r_name'] = (isset($_SESSION['r_name']))?$_SESSION['r_name']:'';
                                                        if ($langles){entradeta("","yourname","Your Name","Your Name","",'glyphicon-user','T',false,'',$_SESSION['r_name']);}
                                                                else{entradeta("","yourname","Su Nombre","Su nombre","",'glyphicon-user','T',false,'',$_SESSION['r_name']);}
                                                    ?>
                                                        </div>
                                                        <div class="col-sm-6">
                                                    <?php
                                                        // Empresa
                                                        $_SESSION['r_empre'] = (isset($_SESSION['r_empre']))?$_SESSION['r_empre']:'';
                                                        if ($langles){entradeta("","companyname","Company Name","Company Name","",'glyphicon-briefcase','T',false,'',$_SESSION['r_empre']);}
                                                                else{entradeta("","companyname","Nombre de la Empresa","Nombre de la Empresa","",'glyphicon-briefcase','T',false,'',$_SESSION['r_empre']);}
                                                        // Teléfono
                                                        $_SESSION['r_tel'] = (isset($_SESSION['r_tel']))?$_SESSION['r_tel']:'';
                                                        if ($langles){entradeta("","telefon","Phone","Phone","",'glyphicon-phone','T',false,'',$_SESSION['r_tel']);}
                                                                else{entradeta("","telefon","Tel&eacute;fono","Tel&eacute;fono","",'glyphicon-phone','T',false,'',$_SESSION['r_tel']);}
                                                        // Adreça
                                                        $_SESSION['r_adreca'] = (isset($_SESSION['r_adreca']))?$_SESSION['r_adreca']:'';
                                                        if ($langles){entradeta("","adreca","Address","Address","",'glyphicon-home','M',false,'',$_SESSION['r_adreca'],3);}
                                                                else{entradeta("","adreca","Direcci&oacute;n","Direcci&oacute;n","",'glyphicon-home','M',false,'',$_SESSION['r_adreca'],3);}
                                                        // Notes
                                                        $_SESSION['r_notes'] = (isset($_SESSION['r_notes']))?$_SESSION['r_notes']:'';
                                                        if ($langles){entradeta("","lesnotes","Notes","Notes","",'glyphicon-list','M',false,'',$_SESSION['r_notes'],4);}
                                                                else{entradeta("","lesnotes","Notas","Notas","",'glyphicon-list','M',false,'',$_SESSION['r_notes'],4);}
                                                    ?>
                                                        </div>
                                                        </div>
                                                        <div class="form-group" style="margin:0px 0px 15px 0px">
                                                            <div class="g-recaptcha" data-sitekey="6Ldstg4TAAAAAH7Nlgu7We6STcriyQQpq5kxPV6q"></div>
                                                        </div>
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