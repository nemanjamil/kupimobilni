<?php
class adminfunkc extends MysqliDb
{

    protected $db;

    public function __construct($db)
    {
        $this->dbConn = $db;
    }

    public function  getKatodID($id)
    {

        $cols = Array("KategorijaArtikalaId", "ParentKategorijaArtikalaId", "KategorijaArtikalaNaziv", "KategorijaArtikalaLink");
        $this->dbConn->where('KategorijaArtikalaId', $id);
        $results = $this->dbConn->getOne("kategorijeartikala", null, $cols);

        if ($this->dbConn->count > 0) {
            return $results;
        } else {
            $results = 'Nema kategorije';
            return $results;
        }
    }


    public function  listaKateg($idagro,$i,$jezikId)
    {
        $cols = Array("KategorijaArtikalaId", "ParentKategorijaArtikalaId","KN.NazivKategorije","KategorijaArtikalaMesto","KategorijaArtikalaActive","KategorijaArtikalaLink");
        $this->dbConn->join("kategorijeartikalanaslov KN","KN.IdKategorije = kategorijeartikala.KategorijaArtikalaId AND KN.IdLanguage = $jezikId");

        if ($idagro) {
            $this->dbConn->where('ParentKategorijaArtikalaId', $idagro);
        } else {
            $this->dbConn->where("ParentKategorijaArtikalaId IS NULL");
        }
        $this->dbConn->orderBy ("KategorijaArtikalaMesto","asc");
        $user = $this->dbConn->get("kategorijeartikala", null, $cols);

        //$i = 0;
        foreach ($user as $key => $value) {
            $KategorijaArtikalaId = $value['KategorijaArtikalaId'];
            $KategorijaArtikalaActive = $value['KategorijaArtikalaActive'];

            $ParentKategorijaArtikalaId = $value['ParentKategorijaArtikalaId'];
            $ParentKategorijaArtikalaId = ($ParentKategorijaArtikalaId) ? $ParentKategorijaArtikalaId : 'NULL';


            $m[$i]['name'] = $value['NazivKategorije'];
            //$m[$i]['name'] = $value['KategorijaArtikalaLink'];
            $m[$i]['open'] = 'true';
            $m[$i]['mestolok'] = ($value['KategorijaArtikalaMesto']) ? $value['KategorijaArtikalaMesto'] : '0';


            // Da li taj ID ima podkategorije, Za to koristimo storedProdecuru
            // ovde smo stavli 5 da bi prikazao sve kategorije
            $upit = "daLiImaPodkat($KategorijaArtikalaId,0,5)";
            $this->dbConn->where($upit);
            if ($this->dbConn->has('kategorijeartikala')) {
                $m[$i]['isParent'] = 'true';
                $m[$i]['nocheck'] = 'true';
                $m[$i]['parentId'] = $ParentKategorijaArtikalaId;

                $m[$i]['url'] = 'kat/'.$KategorijaArtikalaId;
                $m[$i]['target'] = '_blank';
                // click:"alert('I can not jump...');"

                //$m[$i] = $this->listaKateg($KategorijaArtikalaId,$i+1);

            } else {
                $m[$i]['url'] = 'kat/'.$KategorijaArtikalaId;
                $m[$i]['isParent'] = 'false';
                $m[$i]['parentId'] = $ParentKategorijaArtikalaId;
            }

            $m[$i]['id'] = $KategorijaArtikalaId;
            $i++;
        }

        return $m;
    }


    public function  listaKategZdravlje($idagro,&$array)
    {


        $cols = Array("KategorijaArtikalaIdZdravlje", "ParentKategorijaArtikalaIdZdravlje", "KategorijaArtikalaLinkZdravlje",
            "KategorijaArtikalaMestoZdravlje","KategorijaArtikalaActiveZdravlje","KategorijaArtikalaSlikaZdravlje");

        if ($idagro) {
            $this->dbConn->where('ParentKategorijaArtikalaIdZdravlje', $idagro);
        } else {
            $this->dbConn->where("ParentKategorijaArtikalaIdZdravlje IS NULL");
           // $this->dbConn->where('ParentKategorijaArtikalaId', 1);
        }
        $this->dbConn->orderBy ("KategorijaArtikalaMestoZdravlje","asc");
        $user = $this->dbConn->get("kategorijezdravlje", null, $cols);

        //$i = 0;
        foreach ($user as $key => $value) {
            $KategorijaArtikalaId = $value['KategorijaArtikalaIdZdravlje'];
            $KategorijaArtikalaActive = $value['KategorijaArtikalaActiveZdravlje'];

            $ParentKategorijaArtikalaId = $value['ParentKategorijaArtikalaIdZdravlje'];
            $ParentKategorijaArtikalaId = ($ParentKategorijaArtikalaId) ? $ParentKategorijaArtikalaId : 'NULL';


            $m['id'] = $KategorijaArtikalaId;
            $m['name'] = $value['KategorijaArtikalaLinkZdravlje'];
            $m['open'] = 'true';
            $m['pId'] = $ParentKategorijaArtikalaId;
            $m['url'] = 'str/kateditzdravlje/'.$KategorijaArtikalaId;

            if ($value['KategorijaArtikalaActiveZdravlje']>0) {
                $m['checked'] = true;
            }else {
                $m['checked'] = '';
            }

           /* $m['isParent'] = 'true';
            $m['target'] = '_blank';
            $m['mestolok'] = ($value['KategorijaArtikalaMesto']) ? $value['KategorijaArtikalaMesto'] : '0';*/

            /*, "ParentKategorijaArtikalaIdZdravlje", "KategorijaArtikalaLinkZdravlje",
                "KategorijaArtikalaMestoZdravlje","KategorijaArtikalaActiveZdravlje","KategorijaArtikalaSlikaZdravlje"*/
            $cols = Array("KategorijaArtikalaIdZdravlje");
            $this->dbConn->where ("ParentKategorijaArtikalaIdZdravlje", $KategorijaArtikalaId);
            $users = $this->dbConn->get ("kategorijezdravlje", null, $cols);
            if ($this->dbConn->count > 0){

               $m['nocheck'] = 'false';

               $this->listaKategZdravlje($KategorijaArtikalaId,$array);

            } else {
                $m['nocheck'] = 'false';
            }

            $array[] = $m;


        }

        return $array;
    }


    public function  listaKategZdravljeArt($idagro,$idArtikla,&$array)
    {


        $cols = Array("KategorijaArtikalaIdZdravlje", "ParentKategorijaArtikalaIdZdravlje", "KategorijaArtikalaLinkZdravlje",
            "KategorijaArtikalaMestoZdravlje","KategorijaArtikalaActiveZdravlje","KategorijaArtikalaSlikaZdravlje");

        if ($idagro) {
            $this->dbConn->where('ParentKategorijaArtikalaIdZdravlje', $idagro);
        } else {
            $this->dbConn->where("ParentKategorijaArtikalaIdZdravlje IS NULL");
            // $this->dbConn->where('ParentKategorijaArtikalaId', 1);
        }
        $this->dbConn->orderBy ("KategorijaArtikalaMestoZdravlje","asc");
        $user = $this->dbConn->get("kategorijezdravlje", null, $cols);

        //$i = 0;
        foreach ($user as $key => $value) {
            $KategorijaArtikalaId = $value['KategorijaArtikalaIdZdravlje'];
            $KategorijaArtikalaActive = $value['KategorijaArtikalaActiveZdravlje'];

            $ParentKategorijaArtikalaId = $value['ParentKategorijaArtikalaIdZdravlje'];
            $ParentKategorijaArtikalaId = ($ParentKategorijaArtikalaId) ? $ParentKategorijaArtikalaId : 'NULL';


            $m['id'] = $KategorijaArtikalaId;
            $m['name'] = $value['KategorijaArtikalaLinkZdravlje'];
            $m['open'] = 'true';
            $m['pId'] = $ParentKategorijaArtikalaId;
            $m['url'] = '/admin/str/kateditzdravlje/'.$KategorijaArtikalaId;



            $podkate = '';
            $this->dbConn->where ("IdZdravljeArtikli", $idArtikla);
            $this->dbConn->where ("IdOdKategZdravlje", $KategorijaArtikalaId);
            $kaaty = $this->dbConn->getOne("povezkatzdravlje");





            if ($kaaty) {
                $m['checked'] = true;

            }else {
                $m['checked'] = '';
            }



            $cols = Array("KategorijaArtikalaIdZdravlje");
            $this->dbConn->where ("ParentKategorijaArtikalaIdZdravlje", $KategorijaArtikalaId);
            $users = $this->dbConn->get ("kategorijezdravlje", null, $cols);

            if ($this->dbConn->count > 0){

                $m['nocheck'] = 'true';

                $this->listaKategZdravljeArt($KategorijaArtikalaId,$idArtikla,$array);

            } else {
                $m['nocheck'] = 'false';
            }

            $array[] = $m;


        }

        return $array;
    }







}