<table class="strip" border="0">
    <tbody>

    <tr class="even">
        <td><?php echo $jsonlang[17][$jezikId];?></td>
        <td><?php echo $jsonOsn[$jezikId]["NacinKupovineOsnPodaci"]; ?></td>
    </tr>
    <tr class="odd">
        <td><?php echo $jsonlang[380][$jezikId];?></td>
        <td><?php echo $jsonlang[381][$jezikId];?> - <a href="/contact-us" target="_blank" title="Lokacija" target="_blank"><?php echo $jsonlang[276][$jezikId];?></a></td>
    </tr>

    <tr class="even">
        <td><?php echo $jsonlang[252][$jezikId];?></td>
        <td><?php echo $jsonlang[382][$jezikId];?></td>
    </tr>

    <tr class="odd">
        <td><?php echo $jsonlang[383][$jezikId];?></td>
        <td><?php echo $jsonlang[384][$jezikId];?><br>
            <?php echo $jsonlang[385][$jezikId].$jsonlang[388][$jezikId];?> <a href="http://www.aks-sabac.com/cenovnik.html" target="_blank"> <?php echo $jsonlang[386][$jezikId];?> </a>
            <?php echo $jsonlang[387][$jezikId];?>
        </td>

    </tr>
    <tr class="even">
        <td><?php echo $jsonlang[389][$jezikId];?>:</td>
        <td><?php echo $jsonlang[390][$jezikId];?></td>
    </tr>
    <tr class="odd">
        <td><?php echo $jsonlang[260][$jezikId];?></td>
        <td> <?php echo $jsonlang[333][$jezikId];?>:
            <ul>
                <li><b><?php echo $jsonlang[391][$jezikId] . '</b> - '. $jsonlang[392][$jezikId] ;?><a href="/placanje-na-rate" target="_blank" class="bojacrvenaprod"><b><?php echo ' '. $jsonlang[247][$jezikId]. ' ' . $jsonlang[248][$jezikId];?></b></a></li>
                <li><?php echo $jsonlang[393][$jezikId];?></li>
            </ul>
        </td>
    </tr>
    <?php
    if($cenaPrikazBrojInfo){

    ?>

    <tr class="even">

        <td><?php echo $jsonlang[332][$jezikId];?></td>
        <td><p><?php echo $jsonlang[394][$jezikId];?></p>
            <p><?php echo $jsonlang[395][$jezikId]. '<b>' . $jsonlang[391][$jezikId];?></b></p>
            <p><?php echo $jsonlang[396][$jezikId]. ' 3 ' . $jsonlang[397][$jezikId]. $jsonlang[398][$jezikId];?> <b><?php $jedrat = number_format($cenaPrikazBrojInfo / 3 * 1.08, 2, ",", "."); echo $jedrat. ' '. $valutasession;?></b></p>
            <p><?php echo $jsonlang[396][$jezikId]. ' 6 ' . $jsonlang[399][$jezikId]. $jsonlang[398][$jezikId];?> <b><?php $dvarat = number_format($cenaPrikazBrojInfo / 6 * 1.10, 2, ",", "."); echo $dvarat. ' '. $valutasession;?></b></p>
            <p><?php echo $jsonlang[396][$jezikId]. ' 9 ' . $jsonlang[399][$jezikId]. $jsonlang[398][$jezikId];?> <b><?php $trirat = number_format($cenaPrikazBrojInfo / 9 * 1.15, 2, ",", "."); echo $trirat. ' '. $valutasession;?></b></p>

            </p><div><?php echo $jsonlang[400][$jezikId]. '<strong> 3 </strong>'. $jsonlang[397][$jezikId];?></div>
            <ul>
                <li><?php echo $jsonlang[401][$jezikId] ; ?> <strong> <?php echo $jedrat.' </strong> '.  $valutasession;?></li>
                <li><?php echo $jsonlang[402][$jezikId] .' 30 '. $jsonlang[231][$jezikId].' <strong> '.' ' . $jedrat.' </strong>'. $valutasession;?></li>
                <li><?php echo $jsonlang[402][$jezikId] .' 60 '. $jsonlang[231][$jezikId].' <strong> '.' ' . $jedrat.' </strong>'. $valutasession;?></li>
            </ul>
        </td>

        <?php }?>
    <tr class="odd">
        <td style="background-color: red;color: white"><strong><?php echo $jsonlang[152][$jezikId];?></strong></td>
        <td style="background-color: red;color: white"><strong><?php echo FROMNAME . ' ' . $jsonlang[403][$jezikId];?></strong></td>
    </tr>
    <?php
    if($cenaPrikazBrojInfo){

        ?>

        <tr class="even">
            <td><?php echo $jsonlang[71][$jezikId];?></td>
            <td><?php echo $jsonlang[404][$jezikId]. ' <strong>' . ' '.  number_format($cenaPrikazBrojInfo * 1.15,2, ",", "."). ' ' .$valutasession;?></strong></td>
        </tr>
    <?php }?>
    </tbody>
</table>