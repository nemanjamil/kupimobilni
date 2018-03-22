<?php

/*KategorijaArtikalaId	KategorijaArtikalaLink
1	market
154	baterije
155	auto-oprema
156	dodatna-oprema
157	moda
158	sve-za-decu
159	elektronika
160	racunari-beograd-cene
161	mobilni
162	igracke
163	sve-za-kucu
164	nedefinisanorazno
165	trash-nedefinisano
166	nole-urke
167	kancelarijski-pribor
168	alati-i-masine
169	basta-i-oprema-za-bastu
170	potrosni-materijal-burgije-testere
171	srafovi-srafovska-roba*/



$pieces = explode(",", KATEGORIJESAJT);

$upitBreArr = "SELECT sviParenti($KategorijaArtikalaIdOS) as kategTop;";
$uptBC = $db->rawQuery($upitBreArr);
$uptBCArray = explode(",", $uptBC[0]['kategTop']);
$lastTopKateg = (int) end($uptBCArray);

if ($lastTopKateg) {

    if (!in_array($lastTopKateg, $pieces)) {
        $opiszaError = 'Ima artikal ali ne sme da se vidi <br>';
        $opiszaError .=  'Dozvoljene kateg : '.KATEGORIJESAJT.'<br>';
        $opiszaError .=  'Kategorija za prikaz : '.$lastTopKateg.'<br>';

        $KategorijaArtikalaIdOS = '';
        $stranica = 'error';
    }

} else {
    echo 'Nema TopKategorija od artikla sto treba da dobijemo iz upita';
    echo '<br/>';
    die;
}




?>