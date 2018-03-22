<?php


/*$upitArtArrayBrend = "
SELECT
  A.ArtikalId,
  A.KategorijaArtikalId,
  A.ArtikalMPCena,
  A.ArtikalVPCena,
  A.ArtikalLink,
  A.ArtikalStanje,
  A.ArtikalNaAkciji,
  A.ArtikalBrendId,
  BR.BrendIme,
  BR.BrendLink
  FROM
  artikli A
  JOIN brendovi BR
  ON BR.BrendId = A.ArtikalBrendId
  WHERE A.KategorijaArtikalId = '$KategorijaArtikalaIdOS'
  AND A.ArtikalAktivan >= 1
  AND (SELECT   vidljivMpUser (A.KategorijaArtikalId,$tipUsera)) = 1
";*/
//$upitBrendArray = "SELECT DISTINCT ArtikalBrendId,BrendIme,BrendLink FROM ( $upitArtArrayBrend ) AS T2"; // GROUP BY BrendLink

$upitBrendArray = "CALL listaBrendUKateg($KategorijaArtikalaIdOS,$KomitentId,$jezikId);";
$upitBrendKat = $db->rawQuery($upitBrendArray);


?>