<?php
    $amblog = 1;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    if (isset($_REQUEST['email']) && (! empty($_REQUEST['email']))){
        // Ho gravem i saltem als bookings
        $con = conexioi();
        if ($con){
            if (isset($_REQUEST['borrar'])){
                include_once 'nologo.php';
            }
            $elnom = trim(nohack($_REQUEST['yourname']));
            $_SESSION['usr_nomuser'] = $elnom;
            $elemail = trim(nohack($_REQUEST['email']));
            $_SESSION['usr_email'] = $elemail;
            $eltelefon = trim(nohack($_REQUEST['telefon']));
            $_SESSION['usr_telefon'] = $eltelefon;
            $laadreca = trim(nohack($_REQUEST['adreca']));
            $_SESSION['usr_adreca'] = $laadreca;
            $elrollo = trim(nohack($_REQUEST['lesnotes']));
            $_SESSION['usr_rollo'] = $elrollo;
            guardaquefan("PERFIL USUARIO","ACTUALIZADO",$elnom,"");
            $loque = "UPDATE wusuaris SET email='".$elemail."', nomuser='".$elnom."'".
                    ", telefon='".$eltelefon."', adreca='".$laadreca."', rollo='".$elrollo."'  WHERE codi=".$_SESSION['usr_codi'];
            $ftorna = mysqli_query($con,$loque);
            // Hi ha logo ?
            if (isset($_FILES['logofile']['tmp_name'])){
                if ($_FILES['logofile']['tmp_name']){
                    $imageFileType = pathinfo($_FILES['logofile']["name"],PATHINFO_EXTENSION);
                    $target_file = $GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.$imageFileType;
                    if ($_FILES['logofile']["size"] > 500000000) {
                        // Es massa gran ...
                        texok("Sorry, FILE TOO BIG !");
                    }
                    else{
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif"){
                            texok($_FILES['logofile']["tmp_name"]."Sorry, only JPG, PNG or GIF !");
                        }
                        else{
                            include_once 'nologo.php';
                            if (move_uploaded_file($_FILES['logofile']["tmp_name"], $target_file)) {

                            } else {
                                texok("Sorry, there was an error uploading your file.");
                            }                            
                        }
                    }
                }
            }
            // Fi del logo
            if ($ftorna){
                $_SESSION['missatge'] = ($langles)?'Record updated':'Datos actualizados';
                saltaa('index.php');
            }
            //$con->close();
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
        htmlestils('',1,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps, 0 Captcha
        ?>
    </head>
    <body>
        <?php 
            $lasource = 'assets/img/NoImage150.gif';
            $_SESSION['ellogo'] = '';
            include_once 'quinlogo.php';
                    
            $titol = (($langles)?'My profile':'Mi perfil');
            $misatge = (($langles)?'Edit my profile':'Modificar mi perfil');
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle($titol,$misatge,$titol,$misatge,'login'); 
        ?>
        <!-- LOGIN TEMPLATE -->
        <?php
            $accede = (($langles)?'Save':'Guardar');
            $obligatori = (($langles)?'Required fields':'Campos obligatorios');
            $descuser = (($langles)?'New User':'Nuevo Usuario');
            
        ?>
        <div class="container">
            <div class="container" style="margin:40px 0px 40px 0px">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-centered">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong>
                                    <?php 
                                        echo($titol).' : '.$_SESSION['usr_usuari'].' - '.$_SESSION['usr_nomuser'];
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
                                    <form role="form" action="moduser.php" method="POST" enctype="multipart/form-data" data-fv-framework="bootstrap"
                                        data-fv-icon-valid="glyphicon glyphicon-ok"
                                        data-fv-icon-invalid="glyphicon glyphicon-remove"
                                        data-fv-icon-validating="glyphicon glyphicon-refresh">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 formulari">
                                                    <div class="form-group">
                                                    <?php
                                                         // Nombre
                                                        if ($langles){entradeta("","yourname","Your Name","Your Name","",'glyphicon-user','T',false,'',$_SESSION['usr_nomuser']);}
                                                                else{entradeta("","yourname","Su Nombre","Su nombre","",'glyphicon-user','T',false,'',$_SESSION['usr_nomuser']);}
                                                       // email
                                                        entradeta("","email","email","email","",'glyphicon-envelope','T',true,' email="true" ',$_SESSION['usr_email']);
                                                        // Empresa
                                                        // Teléfono
                                                        if ($langles){entradeta("","telefon","Phone","Phone","",'glyphicon-phone','T',false,'',$_SESSION['usr_telefon']);}
                                                                else{entradeta("","telefon","Tel&eacute;fono","Tel&eacute;fono","",'glyphicon-phone','T',false,'',$_SESSION['usr_telefon']);}
                                                        // Adreça
                                                        if ($langles){entradeta("","adreca","Address","Address","",'glyphicon-home','M',false,'',$_SESSION['usr_adreca'],2);}
                                                                else{entradeta("","adreca","Direcci&oacute;n","Direcci&oacute;n","",'glyphicon-home','M',false,'',$_SESSION['usr_adreca'],2);}
                                                        // Notes
                                                        if ($langles){entradeta("","lesnotes","Notes","Notes","",'glyphicon-list','M',false,'',$_SESSION['usr_rollo'],4);}
                                                                else{entradeta("","lesnotes","Notas","Notas","",'glyphicon-list','M',false,'',$_SESSION['usr_rollo'],4);}
                                                       if ($_SESSION['usr_codcli']){
                                                    ?>

                                                        <div class="alert alert-info">
                                                            <input type="file" name="logofile" style="visibility:hidden;" id="logofile" />
                                                            <label><?php echo ($langles)?'Upload your':'Subir su'?> LOGO (jpg, png, gif)</label>
                                                            <div class="input-append">
                                                                <a class="btn btn-filelogo btn-primary" onclick="$('#logofile').click();"><?php echo ($langles)?'Select':'Seleccionar'; ?></a>
                                                                <input type="submit" class="btn btn-alert" name="borrar" value="<?php echo ($langles)?'DELETE':'BORRAR'; ?>">
                                                                <div style="padding:10px;"><img id="blah" src="<?php echo $lasource;?>" alt="LOGO" /></div>
                                                            </div>
                                                        </div>
                                                    <?php
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