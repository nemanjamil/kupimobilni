<!-- ============================================== BLOG CATEGORY ============================================== -->
<div class="blog-category minvisina">

	<?php


    if ($idOdUserName) {

	$cols = Array("K.*", "KO.OpisKomitent");
	$db->where("K.KomitentId", $idOdUserName);
	$db->join("komitentiopisnew KO", "KO.KomitentId = K.KomitentId AND KO.IdLanguage =  '$jezikId'", "LEFT");
	$komitent = $db->getOne("komitenti K",$cols);


	$KomitentNazivKomKom = $komitent['KomitentNaziv'];
	$KomitentImeKom = $komitent['KomitentIme'];
	$KomitentPrezimeKom = $komitent['KomitentPrezime'];
	$komitentOpisKom = $komitent['KomOpis'.$jezik];
	$KomitentiSlikaKom = $komitent['KomitentiSlika'];
	$KomitentiUserNameKom = $komitent['KomitentUserName'];
	$KomitentIdKom = $komitent['KomitentId'];


	$lokrel = $common->locationslikaOstaloKomitent(KOMSLIKE, $idOdUserName);

	$ext = pathinfo($KomitentiSlikaKom, PATHINFO_EXTENSION);
	$fileName = pathinfo($KomitentiSlikaKom, PATHINFO_FILENAME);

	$mala_slika = $fileName . '_srednja.' . $ext;


	$lok = DCROOT . $lokrel . '/' . $mala_slika;
	if (file_exists($lok)) {
		$slikaKomitent = '<img  class="img-responsive" src="' . $lokrel . '/' . $mala_slika . '" alt="">';
	}


	?>

    <div class="col-xs-12 col-sm-12 col-md-12">
		<h3><?php  echo  $jsonlang[13][$jezikId].'</h3> '; ?> <!-- <a href="/<?php /*echo $KomitentiUserNameKom; */?>"> <?php /* echo  $jsonlang[178][$jezikId]; */?></a>-->
    </div>


		<div class="clearfix odvojKategBaner"></div>

		<?php $db->where("EmailNarudz", $KomitentEmail);
		$db->orderBy("IdNarudzbine", "DESC");
		$data = $db->get('narudzbine', 5);

		if($data){
		?>
    	<div class="col-xs-6 col-sm-6 col-md-6">
				<div class="widget box">
					<div class="widget-header">
						<h4><i class="icon-list-alt"></i> <?php echo $jsonlang[237][$jezikId]; ?></h4>

						<div class="toolbar">
							<div class="btn-group">
								<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
							</div>
						</div>
					</div>
					<div class="widget-content">
						<table
							class="table table-striped table-bordered table-hover table-checkable datatable ">
							<thead>
							<tr>
								<th><?php echo $jsonlang[238][$jezikId]; ?></th>
								<th><?php echo $jsonlang[239][$jezikId]; ?></th>
								<th><?php echo $jsonlang[152][$jezikId]; ?></th>
								<th><?php echo $jsonlang[241][$jezikId]; ?></th>
							</tr>
							</thead>
							<tbody>
							<?php
							//$db->join("kategorijeartikala k", "a.KategorijaArtikalId=k.KategorijaArtikalaId", "LEFT");
							//$db->join("brendovi b", "a.ArtikalBrendId=b.BrendId", "LEFT");
							//$db->join("valuta v", "a.ArtikalValutaId=v.ValutaId", "LEFT");
							// $data = $db->get("artikli a", null, "v.ValutaValuta,b.BrendIme,k.KategorijaArtikalaNaziv, a.KategorijaArtikalId, a.ArtikalId, a.ArtikalNaziv, a.ArtikalVPCena, a.ArtikalMPCena, a.ArtikalKratakOpis");


							$i = 1;
							foreach ($data as $sds => $link) {
								$IdNarudzbine = $link['IdNarudzbine'];
								$VremeNarudz = $link['VremeNarudz'];
								$fdate = date('d.m.Y. H:i', strtotime($VremeNarudz));
								$NapomenaNarudz = $link['NapomenaNarudz'];

								$tab .= '<tr>';
								$tab .= '<td>' . $IdNarudzbine . '</td>';
								$tab .= '<td>' . $fdate . '</td>';
								$tab .= '<td>' . $NapomenaNarudz . '</td>';

								$tab .= '<td class="align-center" >';
								$tab .= '<div class="btn-group" >';
								$tab .= '<a href="/p/str/vidimojuporudzbinu/' . $UserKomitentUserName . '/' . $IdNarudzbine . '"> <button class="btn btn-primary"> ' . $jsonlang[242][$jezikId] . '</button > </a>';
								$tab .= '</div >';
								$tab .= '</td > ';
								$tab .= '</tr>';
							}
							echo $tab; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="col-xs-6 col-sm-6 col-md-4">
			<div class="widget box">
				<div class="widget-header">
					<h4><?php echo $KomitentImeKom.' '.$KomitentPrezimeKom ?></h4>
					<div class="toolbar">
						<div class="btn-group">
							<span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
						</div>
					</div>

				</div>
				<div class="widget-content">
					<?php echo  $slikaKomitent; ?>
				</div>
			</div>
		</div>


    <?php }  ?>

</div><!-- /.blog-category -->
<!-- ============================================== BLOG CATEGORY : END ============================================== -->