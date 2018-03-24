<!--Kasnije dodati troskove prevoza i sl. u neku tabelu ukoliko bude potrebno-->
<!-- ============================================== ESTIMATE SHIP TAX ============================================== -->
<div class="col-md-4 col-sm-6 estimate wow fadeInUp" data-wow-delay="0.2s">
    <table class="table">
        <thead>
        <tr>
            <th>
                <span class="estimate-title"><?php echo $jsonlang[134][$jezikId]; ?></span>

                <p><?php echo $jsonlang[134][$jezikId]; ?>.</p>

                <?php
                $upikPr = "SELECT GetKurs (1, '$sesValuta') * " . TROSKOVIPREVOZA . " as cenaPrevoz";
                $kPrevoz = $db->rawQueryOne($upikPr);
                $cprev = $kPrevoz['cenaPrevoz'];
                $cenaPrevoz = $common->formatCenaExt($cprev, $sesValuta);

                $dost .= '<p>' . $jsonlang[279][$jezikId] . ' ' . $cenaPrevoz . '. ' . $jsonlang[253][$jezikId] . '.</p>';

                echo $dost;

                ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <!--<tr>
            <td>
                <div class="custom-select">
                    <ul class="list-unstyled">
                        <li class="country">
                            <label>Country <span class="mandatory">*</span></label>
                            <select class="styled">
                                <option>--Select options--</option>
                                <option>India</option>
                                <option>SriLanka</option>
                                <option>united kingdom</option>
                                <option>saudi arabia</option>
                                <option>united arab emirates</option>
                            </select>
                        </li>

                        <li class="sate">
                            <label>State/Province <span class="mandatory">*</span></label>
                            <select class="styled">
                                <option>--Select options--</option>
                                <option>TamilNadu</option>
                                <option>Kerala</option>
                                <option>Andhra Pradesh</option>
                                <option>Karnataka</option>
                                <option>Madhya Pradesh</option>
                            </select>
                        </li>
                        <li class="zip-code">
                            <label class="info-title control-label">Zip/Postal Code</label>
                            <input type="text" class="form-control " placeholder="">
                        </li>
                    </ul>
                </div>
                <button type="submit" class="btn btn-primary">GET A QOUTE</button>
            </td>
        </tr>-->
        </tbody>
    </table>
</div>

<!--<div class="col-md-4 col-sm-6 discount-code wow fadeInUp" data-wow-delay="0.4s">
	<table class="table">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Discount Code</span>
					<p>Enter your coupon code if you have one..</p>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
							<input type="text" class="form-control " placeholder="">
						</div>
						<button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
					</td>
				</tr>
		</tbody>
	</table>
</div>-->

<div class="col-md-4 col-sm-12 cart-total wow fadeInUp" data-wow-delay="0.6s">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td class="sub-total"><span><?php echo $jsonlang[131][$jezikId]. ' ' .  $jsonlang[288][$jezikId];?> </span></td>
            <td class="sub-amount"><span><?php echo $common->formatCenaSamoBrojId($ukupnaKorpa, $valutasession); ?></span></td>
        </tr>
        <tr>
            <td class="grand-total"><span><?php echo $jsonlang[131][$jezikId]; ?>:</span></td>
            <td class="total-amount">
                <span><?php echo $common->formatCenaSamoBrojId($ukupnaKorpa + $cprev, $valutasession).' '.$common->formatCenaExt($ukupnaKorpa, $valutasession) ?></span></td>
        </tr>
        <tr>
            <td colspan="2" class="cart-button">
                <button onclick="location.href='/checkout';" value="Proceed to checkout"
                        class="btn btn-primary"><?php echo $jsonlang[17][$jezikId]; ?></button>

            </td>
        </tr>
        <!--<tr>
            <td colspan="2" class="tag-line">
                <span>Checkout with multiples address!</span>
            </td>
        </tr>-->
        </tbody>
        <!-- /tbody -->
    </table>
    <!-- /table -->
</div>
<!-- /.cart-shopping-total -->
<!-- ============================================== ESTIMATE SHIP TAX : END ============================================== -->