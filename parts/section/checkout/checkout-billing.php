<!-- ========================================== CHECKOUT BILLING ========================================= -->
<div class="row billing">		

	<div class="col-md-6 col-sm-6 form-rimbus">

			<div class="form-group">
				<label for="exampleInputIme" class="info-title"><?php echo $jsonlang[140][$jezikId]; ?>
					<span>*</span></label>
		    	<input required type="text" name="KomitentIme" placeholder=""  value="<?php echo $KomitentIme; ?>" id="exampleInputIme" class="form-control text-input">
		  	</div>

	</div><!-- /.col -->

	<div class="col-md-6 col-sm-6 form-rimbus">

			<div class="form-group">
				<label for="exampleInputlastname" class="info-title"><?php echo $jsonlang[141][$jezikId]; ?>
					<span>*</span></label>
			    <input required type="text" name="KomitentPrezime" placeholder="" value="<?php echo $KomitentPrezime; ?>" id="exampleInputlastname" class="form-control text-input">
			</div>

	</div><!-- /.col -->
	
	<div class="col-md-6 col-sm-6 form-rimbus">
		<!--<form role="form" class="register-form">-->
			<div class="form-group">
				<label for="exampleInputaddress" class="info-title"><?php echo $jsonlang[56][$jezikId]; ?>
					<span>*</span></label>
			    <input required type="text" name="KomitentAdresa" placeholder="" value="<?php echo $KomitentAdresa; ?>" id="exampleInputaddress" class="form-control text-input">
			</div>
		<!--</form>-->
	</div><!-- /.col -->

	<!--<div class="col-md-6 col-sm-6 form-rimbus">
		<form role="form" class="register-form">
			<div class="form-group">
			    <label for="exampleInputaddress2" class="info-title">Address Line 2</label>
			    <input type="text" placeholder="" id="exampleInputaddress2" class="form-control text-input">
			</div>
		</form>
	</div>-->
	
	<!--<div class="col-md-6 col-sm-6 form-rimbus">
		<form role="form" class="register-form">
			<div class="form-group">
			    <label for="exampleInputcompanyname" class="info-title">Country <span>*</span></label>
			    <input type="text" placeholder="" id="exampleInputcompanyname" class="form-control text-input">
			</div>
		</form>
	</div>-->

	<div class="col-md-6 col-sm-6 form-rimbus">

			<div class="form-group">
				<label for="exampleInputcitytown" class="info-title"><?php echo $jsonlang[143][$jezikId]; ?><span>*</span></label>
			    <input required type="text" name="KomitentMesto" placeholder="" value="<?php echo $KomitentMesto; ?>" id="exampleInputcitytown" class="form-control text-input">
			</div>

	</div><!-- /.col -->

	<!--<div class="col-md-6 col-sm-6 form-rimbus">
		<form role="form" class="register-form">
			<div class="form-group">
			    <label for="exampleInputstate" class="info-title">state <span>*</span></label>
			    <input type="text" name="KomitentPosBroj" placeholder="" id="exampleInputstate" class="form-control text-input">
			</div>
		</form>
	</div>-->

	<div class="col-md-6 col-sm-6 form-rimbus">

			<div class="form-group">
				<label for="exampleInputpostcode" class="info-title"><?php echo $jsonlang[137][$jezikId]; ?>
					<span>*</span></label>
			    <input required type="text" name="KomitentPosBroj"  placeholder="" value="<?php echo $KomitentPosBroj; ?>" id="exampleInputpostcode" class="form-control text-input">
			</div>

	</div><!-- /.col -->

	<div class="col-md-6 col-sm-6 form-rimbus">

			<div class="form-group">
				<label for="exampleInputemailid" class="info-title"><?php echo $jsonlang[31][$jezikId]; ?> <span>*</span></label>
			    <input required type="email" name="email" placeholder="" value="<?php echo $KomitentEmail; ?>" id="exampleInputemailid" class="form-control input-email">
			</div>

	</div><!-- /.col -->

	<div class="col-md-6 col-sm-6 form-rimbus">

			<div class="form-group">
				<label for="exampleInputmobile" class="info-title"><?php echo $jsonlang[151][$jezikId]; ?> <span>*</span></label>
			    <input required type="text" name="KomitentMobTel" placeholder="" value="<?php echo $KomitentMobTel; ?>"  id="exampleInputmobile" class="form-control text-input">
			</div>

	</div><!-- /.col -->

	<div class="col-md-6 col-sm-6 form-rimbus">

			<div class="form-group">
				<label for="exampleInputPhone" class="info-title"><?php echo $jsonlang[148][$jezikId]; ?>
					<span>*</span></label>
				<input required type="text"  name="KomitentTelefon" placeholder="" value="<?php echo $KomitentTelefon; ?>"  id="exampleInputPhone" class="form-control text-input">
			</div>

	</div><!-- /.col -->

	<div class="col-md-12 col-sm-12 form-rimbus">

			<div class="form-group">
				<label for="exampleInputPhone" class="info-title"><?php echo $jsonlang[152][$jezikId]; ?> </label>

				<textarea style="height: 100px;" class="form-control" id="exampleInputComments" name="napomena"
						  placeholder="<?php echo $jsonlang[153][$jezikId]; ?> "></textarea>


			</div>

	</div><!-- /.col -->




</div><!-- /.row -->
<!-- ========================================== CHECKOUT BILLING : END ========================================= -->