<div class="row">
    <div class="col-md-12 col-xs-6x">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-th-large"></i> Razno Test Nemanja</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">

                 <form enctype="multipart/form-data" class="form-horizontal row-border" method="post">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit OD</label>

                        <div class="col-md-10">
                            <input type="text" name="id" class="form-control digits" max="5"
                                   value="<?php echo $id;  ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Limit DO</label>

                        <div class="col-md-10">
                            <input type="text" name="br" class="form-control digits" max="5"
                                   value="<?php echo $br; ?>">
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" value="Ucitaj podatke" class="btn btn-primary pull-right">
                    </div>
                </form>

            </div>
        </div>
        <!-- /Validation Example 1 -->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i> Nemanja Test</h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>
            <div class="widget-content">
               <?php
               $gcm = new gcm($db);
               $push = new gcm_push();


               $data = array();
               $data['broj'] = '213';
               $data['message'] = 'This is a GCM Topic Message!';
               $data['image'] = 'http://www.androidhive.info/wp-content/uploads/2016/01/Air-1.png';

               /*$push->setTitle("Google Cloud Messaging");
               $push->setIsBackground(FALSE);
               $push->setFlag(PUSH_FLAG_USER);
               $push->setData($data);*/


               /*
                * Data
                * */
               // $push->setMessage("Poruka setMessage");
               $push->setData($data);

               /*
                * Notification
                * */
               $push->setNotifyBody("set Notify Body");
               $push->setNotifyTitle("set Notify Title");
               $push->setNotifyIcon("myicon");
               $push->setNotifyColor("#FFA07A");
               $push->setNotifySound("notification");


                $odg = $gcm->sendToTopic('global', $push->getPushData(),$push->getPushNotify());
                var_dump($odg);


               // the topic you want to send notification
               /*$topic = 'global';
               $per = $gcm->sendToTopic($topic,$data,$notifi ); //$push->getPush()
               var_dump($per);*/
               ?>
            </div>
        </div>
    </div>
</div>
<!--=== Page Content ===-->