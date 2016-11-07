<?php
    include_once 'sempre.php';
    include 'htmldoctipe.php';

    $titol = "";
    $misatge = "";
    
    if(isset($_SESSION['missatge'])){
        if (isset($_SESSION['missatge_literal']) && $_SESSION['missatge_literal']){
            $titol = $_SESSION['missatge'];
            $misatge = $_SESSION['missatge_literal'];
        }
        else{
            $titol = texteweb($_SESSION['missatge'], 1);
            $misatge = texteweb($_SESSION['missatge'], 0);
            if (empty($misatge)){
                $titol = $_SESSION['missatge'];
                $misatge = $_SESSION['missatge'];
            }
        }
        $saltarema = 'index.php';
        if (isset($_SESSION['missatge_to_php']) && $_SESSION['missatge_to_php']){
            $saltarema = $_SESSION['missatge_to_php'];
        }
        $diuboto = (isset($_SESSION['missatge_boto'])?$_SESSION['missatge_boto']:"OK");
        $_SESSION['missatge'] = '';
    }
    else{
        saltaa('index.php');
    }
    $titolcuadro = (isset($_SESSION['missatge_notitol']))?($_SESSION['missatge_notitol']===0):$titol;
        
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
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            
            pagetitle($titol,"",$titol,"",""); 
        ?>
        <div class="container">
            <div class="container" style="margin:40px 0px 40px 0px">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <?php 
                                    if ($titolcuadro){
                                        echo '<div class="panel-heading"><h4>';
                                        echo($titol);
                                        echo '</h4></div>';
                                    }
                                ?>
                                <div class="panel-body">
                                    <form role="form" action="<?php echo($saltarema); ?>" method="POST">
                                        <fieldset>
                                            <div class="row">
                                                <div class="center-block">
                                                    <?php 
                                                        if (isset($_SESSION['missatge_dibuix']) && $_SESSION['missatge_dibuix']){
                                                            echo '<h1><i class="fa '.$_SESSION['missatge_dibuix'].'"></i></h1>';
                                                        }
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                    <div class="form-group">
                                                        <?php echo($misatge); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo($diuboto); ?>">
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
            // Trec la configuració del missatge ...
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow');
        ?>
    </body>
</html>