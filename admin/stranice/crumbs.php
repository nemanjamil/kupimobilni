<?php
/**
 * Created by PhpStorm.
 * User: NemanjaMilivojevic
 * Date: 30.7.15.
 * Time: 19.55
 */
?>
<div class="crumbs">
    <ul id="breadcrumbs" class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo DPROOTADMIN . '/'; ?>">Pocetna</a>
        </li>
        <?php
        switch ($stranica) {
            case 'katedit':  // ovo katedit dobijas iz htaccse ali koji se nalazi u adminu
                echo '<li class="current"><a href="' . DPROOTADMIN . '/kategorije" title="">Kategorije</a></li>';
                break;
            case 1:
                echo "i equals 1";
                break;
            case 2:
                echo "i equals 2";
                break;
            case 'editartikal':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/str/listaartikalauser/0" title="">Lista artikala</a></li>';
                break;
            case 'listaartikalauser':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/listaartikala" title="">Lista artikala</a></li>';
                break;
            case 'editspecchild':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/speckategorije" title="">Specifikacije Kategorije</a></li>';
                break;
            case 'editverifdib':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/verifikacijadirektno" title="">Verifikacija Direktno Iz Baste </a></li>';
                break;
            case 'editverifls':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/verifikacijals" title="">Verifikacija Lokalna samouprava </a></li>';
                break;
            case 'kategEditHead':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/kategorijeHeader" title="">Header Kategorije </a></li>';
                break;
            case 'dodajspecchild':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/speckategorije" title="">Specifikacije Kategorije</a></li>';
                break;
            case 'editmail':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/newsletter" title="">Newsletter</a></li>';
                break;
            case 'editvest':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/vesti" title="">Vesti</a></li>';
                break;
            case 'editonama':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/reklionama" title="">Rekli o nama</a></li>';
                break;
            case 'vidiporudzbinu':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/listasvihporudzbina" title="">Lista porudzbina</a></li>';
                break;
            case 'editslider':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/glavni-slajder" title="">Slider</a></li>';
                break;
            case 'editkomentar':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/komentari" title="">Komentari</a></li>';
                break;
            case 'editkomitenta':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/listakomitenatasearch" title="">Lista komitenata</a></li>';
                break;
            case 'dodajKategHead':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/kategorijeHeader" title="">Header kategorije</a></li>';
                break;
            case 'editgrupuspec':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/speckategorije" title="">Spec kategorija</a></li>';
                break;
            case 'osnovnipodjezik':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/osnovnipodaciM" title="">Osnovni podaci</a></li>';
                break;
            case 'edittxtnaslovna':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/txtnaslovna" title="">Naslovna strana</a></li>';
                break;
            case 'edittxtzdravlje':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/txtzdravlje" title="">Stranica zdravlje</a></li>';
                break;
            case 'kateditzdravlje':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/kategorijeZdravlje" title="">Kategorije Zdravlje</a></li>';
                break;
            case 'editbrend':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/brendovifull" title="">Brendovi</a></li>';
                break;
            case 'dodajsenz':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/senzori" title="">Senzori</a></li>';
                break;
            case 'editsenzor':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/senzori" title="">Senzori</a></li>';
                break;
            case 'editpodkulturesve':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/podacikulturesve" title="">Podaci Kulture</a></li>';
                break;
            case 'editpodkulture':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/podacikulture" title="">Kultura, lokacija i senzori</a></li>';
                break;
            case 'editkulture':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/kulture" title="">Kultura</a></li>';
                break;
            case 'editsenz':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/dodajsenzor" title="">Senzori</a></li>';
                break;
            case 'editlokkulture':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/kulturalokacija" title="">Kultura i lokacija</a></li>';
                break;
            case 'editrecenzije':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/recenzije" title="">Recenzije</a></li>';
                break;
            case 'zaposao':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/listazaposao" title="">Lista prijava za posao</a></li>';
                break;
            case 'editmagacin':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/magacini" title="">Magacini</a></li>';
                break;
            case 'izmenisetvarijablu':
                echo '<li class="current"><a href="' . DPROOTADMIN . '/setovanjevarijabli" title="">Setovanje varijabli</a></li>';
                break;

        }
        ?>

    </ul>

    <ul class="crumb-buttons">
        <li><a href="/admin/listasvihporudzbina" title=""><i class="icon-signal"></i><span>Lista svih porudzbina</span></a></li>
        <li class="dropdown"><a href="#" title="" data-toggle="dropdown"><i class="icon-tasks"></i><span>Komitenti</span><i
                    class="icon-angle-down left-padding"></i></a>
            <ul class="dropdown-menu pull-right">
                <li><a href="/admin/dodajkomitenta" title=""><i class="icon-plus"></i>Dodaj komitenta</a></li>
                <li><a href="/admin/listaartikala" title=""><i class="icon-reorder"></i>Lista VP komitenata</a></li>

            </ul>
        </li>

        <!--<li class="range"><a href="#">
                <i class="icon-calendar"></i>
                <span></span>
                <i class="icon-angle-down"></i>
            </a></li>-->



    </ul>
</div>
