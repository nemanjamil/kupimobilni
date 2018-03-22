<!-- ============================================== LANGUAGE CURRENCY ============================================== -->
<ul class="list-unstyled list-inline">

    <li class="dropdown dropdown-small">
        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value"><img src="/assets/images/flag/<?php echo $jezikSrb;?>.jpg" alt="#"><?php echo $jezikSrb;?> <i class="fa fa-angle-down"></i></span></a>
        <ul class="dropdown-menu fadeIn animated">
           <!-- <li><a href="/akcija.php?action=promenajezika&string=srb&id=1"><img src="/assets/images/flag/<?php /*echo $jezikSrb;*/?>.jpg" alt="#"> срб ћир </a></li>-->
            <li><a href="/akcija.php?action=promenajezika&string=srblat&id=5"><img src="/assets/images/flag/<?php echo $jezikSrb;?>.jpg" alt="#"> srb </a></li>
            <!--<li><a href="/akcija.php?action=promenajezika&string=eng&id=2"><img src="/assets/images/flag/eng.jpg" alt="#"> eng</a></li>
            <li><a href="/akcija.php?action=promenajezika&string=ger&id=3"><img src="/assets/images/flag/ger.jpg" alt="#"> ger</a></li>
            <li><a href="/akcija.php?action=promenajezika&string=rus&id=4"><img src="/assets/images/flag/rus.jpg" alt="#"> rus</a></li>-->
        </ul>
    </li>
<?php
if ($valutasession == 1) {
    $valutaValuta = 'DIN';
    $ValutaIcon = 'money';
} elseif ($valutasession == 2) {
    $valutaValuta = 'USD';
    $ValutaIcon = 'usd';
} elseif ($valutasession == 3) {
    $valutaValuta = 'EUR';
    $ValutaIcon = 'eur';
}
?>
    <li class="dropdown dropdown-small">
        <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value"><i class="fa fa-<?php echo $ValutaIcon;?>"></i>
             <?php echo $valutaValuta;   /* echo ($valutasession=='money') ? 'RSD' : $valutasession;*/?>
                <i class="fa fa-angle-down"></i></span></a>
        <ul class="dropdown-menu fadeIn animated">
            <li><a href="/akcija.php?action=promenavalute&string=1"><span class="value"><i class="fa fa-money"></i> din</span></a></li>
           <!-- <li><a href="/akcija.php?action=promenavalute&string=2"><span class="value"><i class="fa fa-usd"></i> usd</span></a></li>
            <li><a href="/akcija.php?action=promenavalute&string=3"><span class="value"><i class="fa fa-eur"></i> eur</span></a></li>-->
        </ul>
    </li>

</ul><!-- /.nav -->
<!-- ============================================== LANGUAGE CURRENCY  ============================================== -->