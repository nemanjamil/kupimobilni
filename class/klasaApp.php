<?php

class klasaApp extends MysqliDb
{

    protected $db;
    protected $tplFunctions;

    public function __construct($db)
    {
        $this->dbConn = $db;
        $this->tplFunctions = new common($db);
    }


    function recursiveKategHead($idKateg,$idLanguage, array $m, $limit=false)
    {
        $tree = array();
        $limit = $limit+1;
        if ($idKateg) {

            $cols = Array("KH.IdKategHead", "KH.ParentKategHead", "KH.LinkKategHead", "KH.AktivanKategHead", "KH.MestoKategHead","KHN.NaslovKategHead");
            $this->dbConn->JOIN('kategheadnaslov KHN', "KHN.IdKategHead = KH.IdKategHead AND KHN.LanguageId = $idLanguage");
            $this->dbConn->where('KH.ParentKategHead', $idKateg);
            $this->dbConn->orderBy('MestoKategHead', "DESC");
            $users = $this->dbConn->get("kateghead KH", null, $cols);

            if ($this->dbConn->count > 0) {
                foreach ($users as $user) {

                    $IdKategHead = $user['IdKategHead'];
                    $ParentKategHead = $user['ParentKategHead'];
                    $NaslovKategHead = $user['NaslovKategHead'];
                    $LinkKategHead = $user['LinkKategHead'];
                    $AktivanKategHead = $user['AktivanKategHead'];


                    $o['IdKategHead'] = $IdKategHead;
                    $o['ParentKategHead'] = $ParentKategHead;
                    $o['NaslovKategHead'] = $NaslovKategHead;
                    $o['LinkKategHead'] = $LinkKategHead;
                    $o['AktivanKategHead'] = $AktivanKategHead;

                    if ($ParentKategHead == $idKateg) {
                        $children = $this->recursiveKategHead( $IdKategHead,$idLanguage,$users,$limit);
                        if ($children) {
                            $o['child'] = $children;
                        }
                        $tree[] = $o;
                    }


                }
            }
        }

        return $tree;


    }

    function recursiveKategMasine($idKateg, array $m, $limit=false,$jezikId)
    {
        $tree = array();
        $limit = $limit+1;
        if ($idKateg) {

            $cols = Array("KA.KategorijaArtikalaId", "KA.ParentKategorijaArtikalaId", "KA.KategorijaArtikalaActive", "KA.KategorijaArtikalaMesto",
                "KAN.NazivKategorije", "KA.KategorijeVidljivZaMP", "KA.KategorijaArtikalaSlika",
                "KA.KategorijaArtikalaLink", "KA.KategorijaArtikalaActiveMasine",
                "CAST(  (SELECT daLiImaPodkatUser(KA.KategorijaArtikalaId,1,3) ) AS SIGNED )AS daLiImaPodKat,
			     CAST(  (SELECT daLiKatImaArtikala(KA.KategorijaArtikalaId) ) AS SIGNED )AS kolikoImaArt");
            $this->dbConn->join("kategorijeartikalanaslov KAN","KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $jezikId");
            $this->dbConn->where('KA.ParentKategorijaArtikalaId', $idKateg);
            $users = $this->dbConn->get("kategorijeartikala KA", null, $cols);

            if ($this->dbConn->count > 0) {
                foreach ($users as $user) {

                    $KategorijaArtikalaId = $user['KategorijaArtikalaId'];
                    $ParentKategorijaArtikalaId = $user['ParentKategorijaArtikalaId'];
                    $KatIme = $user['NazivKategorije'];
                    $KategorijeVidljivZaMP = $user['KategorijeVidljivZaMP'];
                    $KategorijaArtikalaSlika = $user['KategorijaArtikalaSlika'];
                    $KategorijaArtikalaLink = $user['KategorijaArtikalaLink'];
                    $KategorijaArtikalaActiveMasine = $user['KategorijaArtikalaActiveMasine'];

                    $daLiImaPodKat = $user['daLiImaPodKat'];
                    $KategorijaArtikalaMesto = $user['KategorijaArtikalaMesto'];
                    $kolikoImaArt = $user['kolikoImaArt'];


                    $lokrel = $this->tplFunctions->locationslikaOstalo(KATSLIKELOK,$KategorijaArtikalaId);

                    $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                    $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

                    $mala_slika = $fileName . '_172.' . $ext;

                    $lok = DCROOT.$lokrel.'/'.$mala_slika;
                    if (is_file($lok)) {
                        $slikaKategBaner = DPROOT.'/'.$lokrel.'/'.$mala_slika;
                    } else {
                        $slikaKategBaner = DPROOT.'/assets/images/banners/2.jpg';
                    }


                    $o['KategorijaArtikalaId'] = $KategorijaArtikalaId;
                    $o['ParentKategorijaArtikalaId'] = $ParentKategorijaArtikalaId;
                    $o['KatIme'] = $KatIme;
                    $o['KategorijeVidljivZaMP'] = $KategorijeVidljivZaMP;
                    $o['KategorijaArtikalaSlika'] = $slikaKategBaner;
                    $o['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;
                    $o['KategorijaArtikalaActiveMasine'] = $KategorijaArtikalaActiveMasine;
                    $o['daLiImaPodKat'] = $daLiImaPodKat;
                    $o['KategorijaArtikalaMesto'] = $KategorijaArtikalaMesto;
                    $o['kolikoImaArt'] = $kolikoImaArt;

                    if ($user['ParentKategorijaArtikalaId'] == $idKateg) {
                        $children = $this->recursiveKategMasine( $user['KategorijaArtikalaId'],$users,$limit,$jezikId);
                        if ($children) {
                            $o['child'] = $children;
                        }
                        $tree[] = $o;
                    }


                }
            }
        }
        // array_push($m, $tree);
        return $tree;
        //$m['child'] = $tree;

    }

    function podkategorijeOdKat($idKateg,$userId,$jezikId)
    {
        $tree = array();

        if ($idKateg) {

            $upitKateg = "CALL listaKategPoIdUser($idKateg,1,$userId,$jezikId,'','');";
            $kategLista = $this->dbConn->rawQuery($upitKateg);

           /* $cols = Array("KA.KategorijaArtikalaId", "KA.ParentKategorijaArtikalaId", "KA.KategorijeVidljivZaMP", "KA.KategorijaArtikalaSlika",
                "KA.KategorijaArtikalaLink", "KA.KategorijaArtikalaActiveMasine","KAN.NazivKategorije");
            $this->dbConn->join('kategorijeartikalanaslov KAN', "KAN.IdKategorije = KA.KategorijaArtikalaId AND KAN.IdLanguage = $idJezik");
            $this->dbConn->where('KA.ParentKategorijaArtikalaId', $idKateg);
            $users = $this->dbConn->get("kategorijeartikala KA", null, $cols);*/

            //if ($this->dbConn->count > 0) {
            if ($kategLista) {
                foreach ($kategLista as $key => $user) {

                    $KategorijaArtikalaId = $user['KategorijaArtikalaId'];
                    $ParentKategorijaArtikalaId = $user['ParentKategorijaArtikalaId'];
                    $KatIme = $user['NazivKategorije'];
                    $KategorijeVidljivZaMP = $user['KategorijeVidljivZaMP'];
                    $KategorijaArtikalaSlika = $user['KategorijaArtikalaSlika'];
                    $KategorijaArtikalaLink = $user['KategorijaArtikalaLink'];
                    $KategorijaArtikalaActiveMasine = $user['KategorijaArtikalaActiveMasine'];
                    $KategorijaArtikalaActive = $user['KategorijaArtikalaActive'];
                    $daLiImaPodKat = (int) $user['daLiImaPodKat'];
                    $KategorijaArtikalaMesto = $user['KategorijaArtikalaMesto'];
                    $kolikoImaArt = (int) $user['kolikoImaArt'];




                    $lokrel = $this->tplFunctions->locationslikaOstalo(KATSLIKELOK,$KategorijaArtikalaId);

                    $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                    $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

                    $mala_slika = $fileName . '_172.' . $ext;

                    $lok = DCROOT.$lokrel.'/'.$mala_slika;
                    if (is_file($lok)) {
                        $slikaKategBaner = DPROOT.'/'.$lokrel.'/'.$mala_slika;
                    } else {
                        $slikaKategBaner = DPROOT.'/assets/images/banners/2.jpg';
                    }


                    $o['KategorijaArtikalaId'] = $KategorijaArtikalaId;
                    $o['ParentKategorijaArtikalaId'] = $ParentKategorijaArtikalaId;
                    $o['KatIme'] = $KatIme;
                    $o['KategorijeVidljivZaMP'] = $KategorijeVidljivZaMP;
                    $o['KategorijaArtikalaSlika'] = $slikaKategBaner;
                    $o['KategorijaArtikalaLink'] = $KategorijaArtikalaLink;
                    $o['KategorijaArtikalaActiveMasine'] = $KategorijaArtikalaActiveMasine;
                    $o['KategorijaArtikalaActive'] = $KategorijaArtikalaActive;
                    $o['daLiImaPodKat'] = $daLiImaPodKat;
                    $o['kolikoImaArt'] = $kolikoImaArt;
                    $o['KategorijaArtikalaMesto'] = $KategorijaArtikalaMesto;

                    $tree[] = $o;


                }
            } else {
                $tree = NULL;
            }
        } else {
            $tree = NULL;
        }
        // array_push($m, $tree);
        return $tree;
        //$m['child'] = $tree;

    }

    function buildTree(array $elements, $idKateg) {

        $cols = Array("KA.KategorijaArtikalaId", "KA.ParentKategorijaArtikalaId", "KA.Katsrblat", "KA.KategorijeVidljivZaMP", "KA.KategorijaArtikalaSlika",
            "KA.KategorijaArtikalaLink", "KA.KategorijaArtikalaActiveMasine");
        $this->dbConn->where('KA.ParentKategorijaArtikalaId', $idKateg);
        $elements = $this->dbConn->get("kategorijeartikala KA", null, $cols);


        $branch = array();

        if ($this->dbConn->count > 0) {
             foreach ($elements as $element) {
                if ($element['ParentKategorijaArtikalaId'] == $idKateg) {
                    $children = $this->buildTree($elements, $element['KategorijaArtikalaId']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
        }

        return $branch;
    }


}