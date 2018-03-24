<!-- ============================================== LANGUAGE CURRENCY ============================================== -->
<ul class="list-unstyled list-inline">

<?php
if ($valutasession == 1) {
    $valutaValuta = 'DIN';
    $ValutaIcon = 'money';
} elseif ($valutasession == 3) {
    $valutaValuta = 'USD';
    $ValutaIcon = 'usd';
} elseif ($valutasession == 4) {
    $valutaValuta = 'EUR';
    $ValutaIcon = 'eur';
}
?>
    <li class="dropdown dropdown-small ">
        <a href="#" class="dropdown-toggle bojasivaccc" data-hover="dropdown" data-toggle="dropdown"><span class="value"><i class="fa fa-<?php echo $ValutaIcon;?>"></i>
             <?php echo $valutaValuta;   /* echo ($valutasession=='money') ? 'RSD' : $valutasession;*/?>
                <i class="fa fa-angle-down"></i></span></a>
        <ul class="dropdown-menu fadeIn animated">
            <li><a href="/akcija.php?action=promenavalute&string=1"><span class="value"><i class="fa fa-money"></i> din</span></a></li>
            <li><a href="/akcija.php?action=promenavalute&string=3"><span class="value"><i class="fa fa-usd"></i> usd</span></a></li>
            <li><a href="/akcija.php?action=promenavalute&string=4"><span class="value"><i class="fa fa-eur"></i> eur</span></a></li>
        </ul>
    </li>

</ul><!-- /.nav -->
<!-- ============================================== LANGUAGE CURRENCY  ============================================== -->