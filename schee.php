<div class="container">
    <div class="container" style="margin:40px 0px 40px 0px">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-centered">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <strong><h4>EXPORT SCHEDULE</h4>
                        </strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="formexport" action="sche-expo.php" method="POST" data-fv-framework="bootstrap"
                            data-fv-icon-valid="glyphicon glyphicon-ok"
                            data-fv-icon-invalid="glyphicon glyphicon-remove"
                            data-fv-icon-validating="glyphicon glyphicon-refresh">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12 col-md-10  col-md-offset-1 formulari">
                                        <div class="form-group entersubmit">
                                            <?php
                                                $desde = retvar('desde');
                                                $hasta = retvar('hasta');
                                                if (empty($desde)){$desde = date('Y-m-d');}
                                                if (empty($hasta)){
                                                   $hasta = date('Y-m-d');
                                                   $tmp = strtotime("+3 month", strtotime($hasta));
                                                   $hasta = date('Y-m-d',$tmp);
                                                }
                                                $meshtml = '<input  onclick="brow(\'pais_export\',\'#puntse_pais\',\'#puntse_punt\');" class="btn btn-xs btn-default btn-block" value="'.(($langles)?'SEARCH COUNTRY':'BUSCAR PAIS').'">';
                                                entradeta("B|","puntse_pais",($langles)?'Country':'País',($langles)?'Country':'País',"puntse_pais",'glyphicon-flag','T',false,'','','','','',$meshtml);
                                                $meshtml = '<input  onclick="brow(\'punt_export\',\'#puntse_punt\',\'#puntse_pais\');" class="btn btn-xs btn-default btn-block" value="'.(($langles)?'SEARCH PORT':'BUSCAR PUERTO').'">';
                                                entradeta("B|","puntse_punt",($langles)?'Port':'Puerto',($langles)?'Port':'Puerto',"puntse_punt",'glyphicon-globe','T',true,'','','','','',$meshtml);
//                                                entradeta("","desde",'',($langles)?'From':'Desde',"desde",'glyphicon-calendar','D',false,'',$desde,'','');//,7);
//                                                entradeta("","hasta",'',($langles)?'To':'Hasta',"hasta",'glyphicon-calendar','D',false,'',$hasta,'','');//,7);
                                                echo '<div style="padding-top:15px;">';
                                                echo '<input type="submit" class="btn btn-lg btn-primary btn-block" value="'.(($langles)?'SEARCH':'BUSCAR').'">';
                                                echo '</div>';
                                                echo '<div class="text-center wow fadeInLeft" style="padding-top:15px;"><h5><a href="allexport.php"><span style="font-size: 25px;;padding-right:10px;" class="glyphicon glyphicon-globe"></span> '.(($langles)?'See ALL':'Ver TODO el schedule').'</a></h5></div>';
                                                echo '<div style="float:right;">';
                                                    include 'skypechat.php';
                                                echo '</div>';
                                            ?>
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

