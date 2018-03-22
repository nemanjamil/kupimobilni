<?php
/**
 * Project: masine
 * Created by PhpStorm.
 * User: Nikola
 * Date: 22. 02. 2016.
 * Time: 12:00
 */

//super ponuda
$countSuper = "SELECT COUNT(ArtikalId) AS BR1 FROM artikli WHERE ArtikalAktivan >= 1  AND ArtikalNaAkciji = 6";
$countSuperPonuda = $db -> rawQueryOne ($countSuper);
$SuperPonuda = $countSuperPonuda['BR1'];

//najprodavaniji
$countNaj = "SELECT COUNT(ArtikalId) AS BR2 FROM artikli WHERE ArtikalAktivan >= 1  AND ArtikalNaAkciji = 7";
$countNajprodavaniji = $db -> rawQueryOne ($countNaj);
$Najprodavaniji = $countNajprodavaniji['BR2'];

//super ponuda
$countNovi = "SELECT COUNT(ArtikalId) AS BR3 FROM artikli WHERE ArtikalAktivan >= 1  AND ArtikalNaAkciji = 8";
$countNoviArt = $db -> rawQueryOne ($countNovi);
$Novi = $countNoviArt['BR3'];





?>