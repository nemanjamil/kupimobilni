<!-- ============================================== BLOG CATEGORY ============================================== -->
<?php
//saveti po kategoriji-meni sa strane
$cols = Array("K.KategorijaArtikalaLink", "KN.NazivKategorije", "V.IdKategVesti");
$db->join("kategorijeartikala K", "K.KategorijaArtikalaId = V.IdKategVesti");
$db->join("kategorijeartikalanaslov KN", "KN.IdKategorije=K.KategorijaArtikalaId", "LEFT");
$db ->where("V.SajtVesti = '1'");
$db ->where(" KN.IdLanguage = $jezikId");
$db->groupBy("V.IdKategVesti", "DESC");
$dataVesti = $db->get("vesti V", null, $cols);
$kategVesti = '';
if ($dataVesti) {

    $kategVesti .= '<div class="blog-category wow fadeIn">
	<h3 class="section-title">' . $jsonlang[202][$jezikId] . '</h3>
	<ul class="list-group">';
    foreach ($dataVesti as $k => $v):

        $IdKategVestiKateg = $v['IdKategVesti'];
        $KatVestiKat = $v['NazivKategorije'];
        $KategorijaArtikalaLinkKat = $v['KategorijaArtikalaLink'];

        $katLinkKatVes = '/' . $KategorijaArtikalaLinkKat . '/kv';


        $kategVesti .= '<li class="list-group-item"><a href="' . $katLinkKatVes . '">' . $KatVestiKat . '</a></li>';

    endforeach;

    $kategVesti .= '</ul></div>';
}
echo $kategVesti;
?>