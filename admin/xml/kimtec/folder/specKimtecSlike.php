<!--<Table>
    <ProductCode>0231603</ProductCode>
    <ProductName>VIVAX HOME friteza FF-2400 IX</ProductName>
    <ProductType>CE - Friteza</ProductType>
    <Brand>Vivax</Brand>
    <Model>FF-2400 IX</Model>
    <PartNo/>
    <Warranty>24</Warranty>
    <PackageWeight>4.800</PackageWeight>
    <PackageDimensionLength>29.500</PackageDimensionLength>
    <PackageDimensionWidth>44.500</PackageDimensionWidth>
    <PackageDimensionHeight>28.000</PackageDimensionHeight>
    <TechnicalDescription>VIVAX HOME friteza FF-2400 IX, Snaga [W] 2400, Kapacitet [l] 3,  Boja inox, varijabilni termostat 0°-190°C</TechnicalDescription>
    <MarketingDescription>VIVAX HOME friteza FF-2400 IX, Kapacitet: 3 l, Varijabilni termostat 0°-190°C, Metalno kućište sa plastičnim držačima, Signalna lampica, Snaga: 2400 W, INOX</MarketingDescription>
    <ProductImageUrl>https://b2b.kimtec.rs/slike/0231603_big.jpg</ProductImageUrl>
    <IsComputerComponent>false</IsComputerComponent>
    <ChangeDateTime>2014-03-18 15:01:00</ChangeDateTime>
    <BrojPovratnihNaknada>0</BrojPovratnihNaknada>
  </Table> -->


<?php

$querySlike = '/NewDataSet/Table[ProductCode="' . $ProductCode . '"]';
$entriesSlike = $dockatalogxpath->query($querySlike);

if ($entriesSlike) {

    foreach ($entriesSlike as $entry) {

        $ProductName = $entry->getElementsByTagName("ProductName");
        $ProductName = $ProductName->item(0)->nodeValue;
        $ProductName = $common->isEmpty($ProductName);
        $naziv = $ProductName;
        $pokazi .= '<li>$ProductName : ' . $ProductName . '</li>';
        $pokazi .= '<li>$naziv : ' . $naziv . '</li>';


        $url_artikla = $common->friendly_convert($ProductName);
        $pokazi .= '<li>$url_artikla : ' . $url_artikla . '</li>';

        $TechnicalDescription = $entry->getElementsByTagName("TechnicalDescription");
        $TechnicalDescription = $TechnicalDescription->item(0)->nodeValue;
        $pokazi .= '<li>$TechnicalDescription : ' . $TechnicalDescription . '</li>';

        $MarketingDescription = $entry->getElementsByTagName("MarketingDescription");
        $MarketingDescription = $MarketingDescription->item(0)->nodeValue;
        $MarketingDescription = $common->clearvariableTekst($MarketingDescription);

        $ProductImageUrl = $entry->getElementsByTagName("ProductImageUrl");
        $ProductImageUrl = $ProductImageUrl->item(0)->nodeValue;
        $pokazi .= '<li>$ProductImageUrl : ' . $ProductImageUrl . '</li>';

        $pokazi .= '<li></li>';
    }

} else {
    $pokazi .= '<li>Nema podataka</li>';
}
?>