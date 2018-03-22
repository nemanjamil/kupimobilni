<!--=== Page Content ===-->
<div class="row">
    <div class="col-md-12">
        <div class="widget box">
            <div class="widget-header">
                <h4><i class="icon-reorder"></i><strong style="color: red">WolfCraft</strong> Povuci podatke sa sajta
                </h4>

                <div class="toolbar no-padding">
                    <div class="btn-group">
                        <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                    </div>
                </div>
            </div>

            <div class="widget-content">


                <?php if ($codelumenlink) { ?>

                     <form action="/akcija.php?action=povucispeclumen" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="id" value="<?php echo  $ArtikalId ?>">
                        <input type="hidden" name="koji_link" value="<?php echo  $codelumenlink ?>">
                        <button type="submit">POVUCI SPECIFIKACIJU WOLFCRAFT</button>
                    </form>


                <?php }
                ?>

            </div>
        </div>
    </div>

</div>



