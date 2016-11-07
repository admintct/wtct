<?php
    $ambcodusr = 1;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    // Cal saltar ?
    /*if (isset($_REQUEST['totes'])){
        $_SESSION['usr_codcli'] = 0;
        $_SESSION['usr_nomcli'] = "TODAS LAS EMPRESAS";
        actimpexp(); // mirem les partides d'import i export
        saltaa('index.php');
    }
    elseif (isset($_REQUEST['siscon_param'])){
        $_SESSION['usr_codcli'] = $_REQUEST['siscon_param'];
        $_SESSION['usr_nomcli'] = $_REQUEST['siscon_paramb'];
        actimpexp(); // mirem les partides d'import i export
        saltaa('index.php');
    }*/
    
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
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct(false);
            // -- Page Title -->
            $laptda = retvar('laptda');
            $xxref = '<a href="ptda_export.php?siscon_param='.$laptda.'">';
            pagetitle("BL",'Modificación / '.$xxref.'Volver</a>',"BL",'MODIFY / '.$xxref.'Return</a>',"edit",'','',false); 
            include 'bbdd_lcl.php';
            include 'calc_bl.php'; 
        ?>
        <div class="container">
            <div class="class="col-xs-12 col-centered"" style="padding: 20px 0px 20px 20px;">
                <form action="modbl.php" method="post" class="mivalida">
                <table width="900px" border="1px">
                    <tr style="font-size:0.6em">
                        <td width="20%" style="border-left: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;">&nbsp;</td>
                        <td width="5%" style="border-left: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;">&nbsp;</td>
                        <td width="5%" style="border-left: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;">&nbsp;</td>
                        <td width="5%" style="border-left: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;">&nbsp;</td>
                        <td width="5%" style="border-left: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;">&nbsp;</td>
                        <td width="5%" style="border-left: 1px solid #fff;border-right: 1px solid #fff;border-top: 1px solid #fff;">&nbsp;</td>
                        <td width="5%" style="border: 1px solid #fff;">&nbsp;</td>
                        <td width="15%" style="border: 1px solid #fff;">&nbsp;</td>
                        <td width="15%" style="border: 1px solid #fff;">&nbsp;</td>
                        <td width="5%" style="border: 1px solid #fff;">&nbsp;</td>
                        <td width="15%" style="border: 1px solid #fff;"><?php echo 'Ref. '.$ptda['codi']; ?></td>
                    </tr>
                    <tr height="130px" align="left" valign="top"  style="border-left: 1px solid #fff;border-right: 1px solid #fff;">
                        <td colspan="6">
                            <div padding="3px;" class="bltitol">Shipper</div>
                            <div class="bl_ship"><textarea placeholder="Shipper" name="shipper" rows="4" required><?php echo utf8_encode(trim($elshipper)); ?></textarea></div>
                            <?php echo html_input_hidden('xshipper',utf8_encode(trim($elshipper))); ?>
                        </td>
                        <td colspan="7" rowspan="5" style="border-left: 1px solid #fff;border-right: 1px solid #fff;">
                            <div padding="10px"><img src="assets/img/logolineatct.jpg" width="480px"></div>
                            <div style="color:#adadad;font-size:6em;text-align: center;padding-top:40px;">
                                <b>DRAFT BL</b>
                            </div>
                            <input name="ptda" type="hidden" value="<?php echo $ptda['codi']; ?>">
                        </td>
                    </tr>
                    <tr height="130px" align="left" valign="top" style="border-left: 1px solid #fff;">
                        <td colspan="6">
                            <div padding="3px;" class="bltitol">Consignee (if "To Order" so indicate)</div>
                            <div class="bl_ship"><textarea placeholder="Consignee" name="consignee" rows="4" required><?php echo utf8_encode(trim($elconsig)); ?></textarea></div>
                            <?php echo html_input_hidden('xconsignee',utf8_encode(trim($elconsig))); ?>
                        </td>
                    </tr>
                    <tr height="110px" align="left" valign="top" style="border-left: 1px solid #fff;">
                        <td colspan="6">
                            <div padding="3px;" class="bltitol">Notify party (No claim shall attach for failure to notify)</div>
                            <div class="bl_ship"><textarea style="height:88px;" placeholder="Notify party" name="notify" rows="3" required><?php echo utf8_encode(trim($elnotify)); ?></textarea></div>
                            <?php echo html_input_hidden('xelnotify',utf8_encode(trim($elnotify))); ?>
                        </td>
                    </tr>
                    <tr height="40px" align="left" valign="top">
                        <td colspan="2" style="border-left: 1px solid #fff;border-top: 1px solid #ffffff;"></td>
                        <td colspan="4" style="border-top: 1px solid #000;">
                            <div class="bltitol">place of receipt / precarriage by</div>
                            <div class="bl_ship"><input name="por" type="text" value="<?php echo $ptda['blplaceofrecip']; ?>"></div>
                            <?php echo html_input_hidden('xpor',$ptda['blplaceofrecip']); ?>
                        </td>
                    </tr>
                    <tr height="40px" align="left" valign="top">
                        <td colspan="2" style="border-left: 1px solid #fff;">
                            <div class="bltitol">ocean vessel</div>
                            <div class="bl_ship"><input style="width:200px;" name="oceanvessel" type="text" value="<?php echo $oceanvessel; ?>"></div>
                            <?php echo html_input_hidden('xoceanvessel',$oceanvessel); ?>
                        </td>
                        <td colspan="4" style="border-right: 1px solid #fff;">
                            <div class="bltitol">port of loading</div>
                            <div class="bl_ship"><input style="width:200px;" name="pol" type="text" value="<?php echo $ptda['bl_pol']; ?>" required></div>
                            <?php echo html_input_hidden('xpol',$ptda['bl_pol']); ?>
                        </td>
                    </tr>
                    <tr height="40px" align="left" valign="top">
                        <td colspan="2" style="border-left: 1px solid #fff;">
                            <div class="bltitol">port of discharge</div>
                            <div class="bl_ship"><input style="width:200px;" name="pod" type="text" value="<?php echo $ptda['blpod']; ?> required"></div>
                            <?php echo html_input_hidden('xpod',$ptda['blpod']); ?>
                        </td>
                        <td colspan="5">
                            <div class="bltitol">Place of delivery</div>
                            <div class="bl_ship"><input style="width:200px;" name="delivery" type="text" value="<?php echo $ptda['blfpod']; ?>" required></div>
                            <?php echo html_input_hidden('xdelivery',$ptda['blfpod']); ?>
                        </td>
                        <td>
                            <div class="bltitol">Freight payable at</div>
                            <div class="bl_ship"><input style="width:120px;" name="payable" type="text" value="<?php echo $payable; ?>" required></div>
                            <?php echo html_input_hidden('xpayable',$payable); ?>
                        </td>
                        <td>
                            <div class="bltitol">Numb, of origin. B/L's</div>
                            <div class="bl_ship"><input style="width:120px;" name="numbls" type="text" value="<?php echo $ncopies; ?>"></div>
                            <?php echo html_input_hidden('xnumbls',$ncopies); ?>
                        </td>
                        <td colspan="2" style="border-right: 1px solid #fff;">
                            <div class="bltitol">B/L No.</div>
                            <div class="bl_ship"><input style="width:140px;" name="blno" type="text" value="<?php echo $numbl; ?>" disabled></div>
                        </td>
                    </tr>
                    <tr height="20px" align="left" valign="top">
                        <td colspan="3" style="border-left: 1px solid #fff;">
                            <div class="bltitol">Marks and numbers</div>
                        </td>
                        <td colspan="2">
                            <div class="bltitol">No. of Pkgs or Shipping Units</div>
                        </td>
                        <td colspan="5">
                            <div class="bltitol">Description of Goods and Packages</div>
                        </td>
                        <td style="border-right: 1px solid #fff;">
                            <div class="bltitol">gross weight of cargo in kilos</div>
                        </td>
                    </tr>
                    <tr height="280px" align="left" valign="top">
                        <td colspan="3" rowspan="3" style="border-left: 1px solid #fff;">
                            <div class="bl_marks"><textarea style="width:250px;" placeholder="Marks & numbers" name="marks" required rows="4"><?php echo (($zzz)?$ptda['mmarcas']:$ptda['fmmarcas']); ?></textarea></div>
                            <?php echo html_input_hidden('xmarks',(($zzz)?$ptda['mmarcas']:$ptda['fmmarcas'])); ?>
                        </td>
                        <td colspan="2" rowspan="3">
                            <div class="bl_marks"><textarea style="width:86px;" placeholder="Pkgs." name="units" required rows="4"><?php echo $paquets; ?></textarea></div>
                            <?php echo html_input_hidden('xunits',$paquets); ?>
                        </td>
                        <td colspan="5" rowspan="3">
                            <div class="bl_marks"><textarea style="width:380px;" placeholder="Goods & Packages" name="goods" required rows="4"><?php echo $mimerc; ?></textarea></div>
                            <?php echo html_input_hidden('xgoods',$mimerc); ?>
                        </td>
                        <td style="border-right: 1px solid #fff;">
                            <div class="bl_marks"><textarea style="width:110px;height:270px;" placeholder="KGs" name="kgs" required rows="4"><?php echo $gross; ?></textarea></div>
                            <?php echo html_input_hidden('xkgs',$gross); ?>
                        </td>
                    </tr>
                    <tr height="20px" align="left" valign="top">
                        <td style="border-right: 1px solid #fff;">
                            <div class="bltitol">VOLUME</div>
                        </td>
                    </tr>
                    <tr height="30px" align="left" valign="top">
                        <td style="border-right: 1px solid #fff;">
                            <div style="margin-top: 5px;" class="bl_ship"><input style="width:140px;" name="volume" required type="text" value="<?php echo number_format($ptdab['bl_cbm'],3,',','.').' CBM'; ?>"></div>
                            <?php echo html_input_hidden('xvolume',number_format($ptdab['bl_cbm'],3,',','.').' CBM'); ?>
                        </td>
                    </tr>
                    <tr height="40px" align="left" valign="top">
                        <td colspan="7" style="border-left: 1px solid #fff;">
                            <div class="bltitol">Loaded into container (s)</div>
                        </td>
                        <td colspan="4" style="border-right: 1px solid #fff;">
                            <div class="bltitol">Excess value declaratin refer to clause 6 (4) (B) + (C) on reverse side</div>
                        </td>
                    </tr>
                    <tr height="45px" align="left" valign="top">
                        <td style="border-left: 1px solid #fff;">
                            <div class="bltitol">W/M</div>
                            <div class="bl_ship"><input style="width:140px;" name="wm" type="text" value="<?php echo $elwm;?>"></div>
                            <?php echo html_input_hidden('xwm',$elwm); ?>
                        </td>
                        <td colspan="3">
                            <div class="bltitol">rate</div>
                            <div class="bl_ship"><input style="width:130px;" name="rate" type="text" value="<?php echo $elrate;?>"></div>
                            <?php echo html_input_hidden('xrate',$elrate); ?>
                        </td>
                        <td colspan="3">
                            <div class="bltitol">total freight</div>
                            <div class="bl_ship"><input style="width:130px;" name="tfreight" type="text" value="<?php echo $totalfreight;?>"></div>
                            <?php echo html_input_hidden('xtfreight',$totalfreight); ?>
                        </td>
                        <td colspan="4" style="border-right: 1px solid #fff;">
                            &nbsp;
                        </td>
                    </tr>
                    <tr height="40px" align="left" valign="top">
                        <td colspan="7" style="border-left: 1px solid #fff;">
                            <div class="bltitol" >"The contract evidence by or contained in this Bill of Landing is governed by the law of Spain, and any claim of dispute arising hereuder or in connection herewith shall be determined by the Courts in Spain and no other Courts".
                            </div>
                        </td>
                        <td style="border: 1px solid #fff;">&nbsp</td>
                        <td colspan="3" rowspan="2" style="border: 1px solid #fff;">
                            <div class="bltitol" style="padding-top:60px;">
                                <p>Place and date os issue</p>
                                </br>
                                </br>
                                </br>
                                <p>Signed as Carrier</p>
                            </div>
                        </td>
                    </tr>
                    <tr height="100px">
                        <td colspan="8" style="border: 1px solid #fff;">&nbsp;</td>
                    </tr>
                </table>
                    <div class="row" style="padding: 0px 0px 30px 0px;">
                        <div class="col-xs-5 col-right">
                            <div style="padding:10px 0px 15px 0px;" align="left" valign="top">
                                <div><label for="contact-message"><?php echo ($langles)?'Notes :':'Notas :' ?></label></div>
                                <div><textarea style="width:400px;height:60px;" name="message" placeholder="<?php echo ($langles)?'Notes ...':'Notas...' ?>" class="contact-message" id="contact-message"></textarea></div>
                            </div>
                            <button type="submit" id="modificabl" name="modificabl" class="btn btn-primary btn-group btn-group-justified" value="067573"><i class="fa fa-envelope" style="padding-right:20px;"></i> Solicitar Modificaciones</button>
                        </div>
                    </div>
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