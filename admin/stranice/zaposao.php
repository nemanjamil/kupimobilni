<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 05. 02. 2016.
 * Time: 14:35
 */

$db->where("PosaoId", $id);

$tag = $db->getOne("posao");
$PosaoId = $tag['PosaoId'];
$PosaoIme = $tag['PosaoIme'];
$PosaoEmail = $tag['PosaoEmail'];
$PosaoTelefon = $tag['PosaoTelefon'];
$PosaoAdresa = $tag['PosaoAdresa'];
$PosaoIskustvo = $tag['PosaoIskustvo'];
$PosaoPoruka = $tag['PosaoPoruka'];
$PosaoIp = $tag['PosaoIp'];


?>
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i>Prijava za posao</h4>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=editzaposao">

                    <input type="hidden" name="idkategorijeDodajArtikal" id="idkategorijeDodajArtikal">

                    <div>


                        <label class="centriraj"><h3>IP Adresa</h3></label>
                        <!--ime i prezime-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ip adresa prijave </label>

                            <div class="col-md-9">
                                <input type="text" name="ime" class="form-control text-input required" id="ime"
                                       value="<?php echo $PosaoIp ?>">
                            </div>
                        </div>

                        <label class="centriraj"><h3>Opsti podaci</h3></label>
                        <!--ime i prezime-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ime i prezime </label>

                            <div class="col-md-9">
                                <input type="text" name="ime" class="form-control text-input required" id="ime"
                                       value="<?php echo $PosaoIme ?>">
                            </div>
                        </div>
                        <!--email-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email </label>

                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control text-input required" id="email"
                                       value="<?php echo $PosaoEmail ?>">
                            </div>
                        </div>
                        <!--telefon-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kontakt telefon </label>

                            <div class="col-md-9">
                                <input type="text" name="telefon" class="form-control digits required" id="telefon"
                                       value="<?php echo $PosaoTelefon ?>">
                            </div>
                        </div>
                        <!--adresa-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Adresa </label>

                            <div class="col-md-9">
                                <input type="text" name="adresa" id="adresa" class="form-control required"
                                       value="<?php echo $PosaoAdresa ?>">
                            </div>
                        </div>

                    </div>



                    <div>

                        <label class="centriraj"><h3>Iskustvo</h3></label>
                        <!--Iskustvo-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Radno iskustvo u prodaji </label>

                            <div class="col-md-9">
                                <textarea name="iskustvo" id="iskustvo" class="form-control">
                                     <?php echo $PosaoIskustvo ?>
                                </textarea>

                            </div>
                        </div>

                        <!--Poruka-->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Vasa poruka </label>

                            <div class="col-md-9">
                                <textarea name="poruka" id="poruka" class="form-control"><?php echo $PosaoPoruka ?></textarea>

                            </div>
                        </div>

                    </div>

                    <!--Button unesi-->
                    <div class="form-actions">

                        <a href="/akcija.php?action=obrisiprijavu&id=<?php echo $PosaoId;?>" class="btn btn-danger pull-left"> Obrisi prijavu</a>

                        <a href="/admin/listazaposao" class="btn btn-info pull-right"> Lista prijava</a>
                        <!--<input type="submit" value="Izmeni prijavu" class="btn btn-primary pull-right">-->

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
