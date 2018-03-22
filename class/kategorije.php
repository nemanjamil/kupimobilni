<?php

class kategorije extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }


    public function listaZdravljeKategorija($idKateg, $od, $do,$jezik)
    {

        $common = new common($this->dbConn);
        $y = '';
        $upitKateg = "CALL listaKategZdravljeParent($idKateg,$od,$do)";
        $katspGlavne = $this->dbConn->rawQuery($upitKateg);

        $i=1;



        if ($katspGlavne) {
            foreach ($katspGlavne AS $kay => $val) {

                $katId = $val['KategorijaArtikalaIdZdravlje'];
                $kl = $val['KategorijaArtikalaLinkZdravlje'];
                $KategorijaArtikalaSlika = $val['KategorijaArtikalaSlikaZdravlje'];

                if ($i==1) { $y .= '<div class="row odvojKategBaner">'; } else { $y .= ''; }


                $lokrel = $common->locationslikaOstalo(KATSLIKELZDRAVLJE,$katId);

                $ext = pathinfo($KategorijaArtikalaSlika, PATHINFO_EXTENSION);
                $fileName = pathinfo($KategorijaArtikalaSlika, PATHINFO_FILENAME);

                $mala_slika = $fileName . '.' . $ext; //_172


                $lok =   $lok = DCROOT.$lokrel.'/'.$mala_slika;
                if (file_exists($lok)) {
                    $slikaKategBaner = $lokrel.'/'.$mala_slika;

                } else {
                    $slikaKategBaner = '/assets/images/banners/15.jpg';
                }


                $y .= '<div class="col-md-3 col-sm-6 banner-1">';

                    $y .= '<div class="banner-outer">';
                        $y .= '<a href="/z/'.$kl.'">';
                            $y .= '<div class="image">';
                                $y .= '<img src="'.$slikaKategBaner.'" class="img-responsive" alt="#">';
                            $y .= '</div>';
                            $y .= '<div class="text">';
                                 $y .= '<h2>'.$val['TekstZdravlje'.$jezik].'</h2>';
                            $y .= '</div>';
                        $y .= '</a>';
                    $y .= '</div>';

                    $upitKategZdravlje = "CALL listaKategZdravljeParent($katId,$od,$do)";
                    $daliImaPodKatZdravlje = $this->dbConn->rawQuery($upitKategZdravlje);

                    if ($daliImaPodKatZdravlje) {

                       $y .= $this->podkatZdravlje($daliImaPodKatZdravlje,$jezik);

                    } else {
                        $y .= '';
                    }

                $y .= '</div>';


                if ($i==4) { $y .= '</div>'; } else { $y .= ''; }


                if ($i==4) { $i=1; } else { $i++; }

            }
        }



        return $y;

    }

  function podkatZdravlje($daliImaPodKatZdravlje,$jezik) {

      $y = '';

      if ($daliImaPodKatZdravlje) {
          $y .= '<div>';
            $y .= '<ul>';
          foreach ($daliImaPodKatZdravlje AS $kay => $val) {

              $kl = $val['KategorijaArtikalaLinkZdravlje'];
              $na = $val['TekstZdravlje'.$jezik];

              $y .= '<li><a href="/z/'.$kl.'">'.$na.'</a></li>';
          }
            $y .= '</ul>';
          $y .= '</div>';
      }
      return $y;


  }

    public function specPoKategoriji($idKategorije, $jezikId)
    {

        if (!$idKategorije) {
            echo 'Ne postoji ID kategorije';
            die;
        }

        if (!$jezikId) {
            echo 'Ne postoji Jezik ID';
            die;
        }

        $arrFulSpec = array();

        $cols = Array("SK.IdGrupeSpecKategorija", "SGN.NazivSpecGrupe");
        $this->dbConn->join("specifikacijagrupe SG", "SG.IdSpecGrupe = SK.IdGrupeSpecKategorija");
        $this->dbConn->join("specgrupenaz SGN", "SGN.IdSpecGrupe = SG.IdSpecGrupe AND SGN.IdLanguage = $jezikId");
        $this->dbConn->where('SK.IdSpecKategorija', $idKategorije);
        $katagorijeListaSpec = $this->dbConn->get("speckategorija SK", null, $cols);

        if ($katagorijeListaSpec) {
            foreach ($katagorijeListaSpec AS $k => $v) {
                $IdGrupeSpecKategorija = (int)$v['IdGrupeSpecKategorija'];
                $NazivSpecGrupe = $v['NazivSpecGrupe'];
                $ir['IdGrupeSpecKategorija'] = $IdGrupeSpecKategorija;
                $ir['NazivSpecGrupe'] = $NazivSpecGrupe;

                $arrFulSpec[] = $ir;
            }

        } else {
            $arrFulSpec = '';
        }
        return $arrFulSpec;

    }

    public function specPoArtiklu($specKateg, $ArtikalId, $jezikId)
    {

        if ($specKateg) {
            foreach ($specKateg AS $k => $v) {


                $IdGrupeSpecKategorija = (int)$v['IdGrupeSpecKategorija'];
                $NazivSpecGrupe = $v['NazivSpecGrupe'];

                $co = Array("SV.IdSpecVrednostiGrupe","SV.IdSpecVrednosti","SVN.SpecVredNaziv");
                $this->dbConn->join("specvrednosti SV", "SV.IdSpecVrednosti = SAP.IdSpecArtikalPovIme");
                $this->dbConn->join("specvrednaziv SVN", "SVN.IdSpecVrednosti = SV.IdSpecVrednosti AND SVN.IdLanguage = $jezikId");
                $this->dbConn->where("SAP.IdSpecArtikalPov", $ArtikalId);
                $this->dbConn->where("SAP.IdSpecArtikalGrupaPove", $IdGrupeSpecKategorija);
                $katagorijeListaSpec = $this->dbConn->get("specartikalpov SAP", null, $co);


                if ($katagorijeListaSpec) {
                    foreach ($katagorijeListaSpec AS $kk => $vv) {


                        $IdSpecVrednosti = $vv['IdSpecVrednosti'];
                        $ir['IdGrupeSpecKategorija'] = $IdGrupeSpecKategorija;
                        $ir['IdSpecVrednosti'] = $IdSpecVrednosti;

                        $arrFulSpecArtikal[] = $ir;
                    }

                }
            }

            return $arrFulSpecArtikal;
        }


    }

}