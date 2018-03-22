<table style="width:100%;" class="strip" border="0">
    <tbody>

    <tr class="even">
        <td><?php echo $jsonlang[348][$jezikId] ?></td>
        <td><span itemprop="brand"><a href="/<?php echo $BrendIme ?>/b"> <?php echo $BrendIme ?></a></span></td>
    </tr>
<?php if($ProizvodjacIme){ ?>
    <tr class="even">
        <td><?php echo $jsonlang[426][$jezikId] ?></td>
        <td><span itemprop="brand"> <?php echo $ProizvodjacIme ?></span></td>
    </tr>
<?php }?>
    <tr class="odd">
        <td><?php echo $jsonlang[419][$jezikId]; ?></td>
        <td>
            <?php echo '<a href="/'.$KategorijaArtikalaLink.'">'.$KategorijaArtikalaNaziv.'</a>';?>
        </td>
    </tr>

    <tr class="even">
        <td>Status :</td>
        <td class="<?php echo $hovBack; ?>"><?php echo $stanjeProizInfo; ?></td>
    </tr>


    <tr class="odd">
        <td>Id code :</td>
        <td><?php echo $ArtikalId; ?></td>
    </tr>

    <tr class="even">
        <td>Code :</td>
        <td><?php echo $proizVendorCode; ?></td>
    </tr>

    <!--<tr class="even">
        <td>Akcijska i redovna cena</td>
        <td>
            Akcijska cena je = <?php /*echo $cenaSamoBrojFormatInfo.' '.$cenaPrikazExtInfo; */?>
            <br>
            Android cena je = <?php /*echo $cenaSamoBrojFormatInfoApp.' '.$cenaPrikazExtInfoApp; */?>
        </td>
    </tr>-->

    <tr class="odd">
        <td>Opis</td>
        <td>
            <?php echo $OpisArtikliTekstovi; ?>
        </td>
    </tr>



    </tbody>
</table>