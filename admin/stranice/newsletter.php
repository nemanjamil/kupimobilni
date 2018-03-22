<?php
/**
 * Project: agro
 * Created by PhpStorm.
 * User: Nikola
 * Date: 28. 08. 2015.
 * Time: 14:35
 */
?>
<!--=== Page Content ===-->

<div class="row">
    <?php include 'listanewsletter.php' ?>
    <div class="col-md-8">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-envelope-alt"></i>Mail za newsletter</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">

                <form enctype="multipart/form-data" method="post" class="form-horizontal row-border" id="validate-1"
                      action="/akcija.php?action=dodajmailnews">


                    <input type="hidden" name="id" id="id">

                    <!--FirstNameMail-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Ime </label>

                        <div class="col-md-10">
                            <input type="text" name="naziv" id="naziv" class="form-control" >
                        </div>
                    </div>

                    <!--LastNameMail-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Prezime</label>

                        <div class="col-md-10">
                            <input type="text" name="string" id="string" class="form-control">
                        </div>
                    </div>

                    <!--EmailAddressMail-->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mail adresa</label>

                        <div class="col-md-10">
                            <input type="text" name="email" id="email"
                                   class="form-control email required"
                                   required="required">
                        </div>
                    </div>


                    <!--Button unesi-->
                    <div class="form-actions">
                        <input type="submit" value="Dodaj mail" class="btn btn-primary pull-right">
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>

<!-- /Page Content -->
