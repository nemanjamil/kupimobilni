<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 26. 08. 2015.
 * Time: 00:22
 */

$db->where("idImail", $id);

$tag = $db->getOne("email");
$idImail = $tag['idImail'];
$FirstNameMail = $tag['FirstNameMail'];
$LastNameMail = $tag['LastNameMail'];
$EmailAddressMail = $tag['EmailAddressMail'];
$vrememailMail = $tag['vrememailMail'];
$poslatoMail = $tag['poslatoMail'];
$daliimaMail = $tag['daliimaMail'];
$neceMail = $tag['neceMail'];
//var_dump($tag);
?>

<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-10">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-envelope-alt"></i> Izmeni mail</h4>
            </div>
            <div class="widget-content">
                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-2"
                      action="/akcija.php?action=editmail">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ime </label>

                        <div class="col-md-10">
                            <input type="text" name="naziv" id="naziv" class="form-control required"
                                   value="<?php echo $FirstNameMail ?>">


                            <input type="hidden" name="id" id="id" value="<?php echo $idImail ?>">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Prezime </label>

                        <div class="col-md-10">
                            <input type="text" name="string" id="string" class="form-control required"
                                   value="<?php echo $LastNameMail ?>">

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Mail adresa</label>

                        <div class="col-md-10">
                            <input type="text" name="email" id="email"
                                   class="form-control email required"
                                   required="required"
                                   value="<?php echo $EmailAddressMail ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Vreme unosa adrese</label>

                        <div class="col-md-10">
                            <input type="text" name="vreme " id="vreme"
                                   class="form-control required"
                                   required="required"
                                   value="<?php echo $vrememailMail ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Poslato mailova</label>

                        <div class="col-md-10">
                            <input type="text" name="poslatoMail" id="poslatoMail"
                                   class="form-control  required"
                                   required="required"
                                   value="<?php echo $poslatoMail ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Da li ima mailova</label>

                        <div class="col-md-10">
                            <input type="text" name="daliimaMail" id="daliimaMail"
                                   class="form-control  required"
                                   required="required"
                                   value="<?php echo $daliimaMail ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nece mail</label>

                        <div class="col-md-10">
                            <input type="text" name="neceMail" id="neceMail"
                                   class="form-control  required"
                                   required="required"
                                   value="<?php echo $neceMail ?>">
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Izmeni mail" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<!-- /Page Content -->
