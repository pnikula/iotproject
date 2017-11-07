
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// muodostetaan yhteys tietokantaan
try {
$yhteys = new PDO("mysql:host=139.59.155.145;dbname=locatiot", "locatiot",
"raspberry");
}
catch (PDOException $e) {
die("ERROR: " . $e->getMessage());
}
// virheenkäsittely: virheet aiheuttavat poikkeuksen
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// merkistö: käytetään latin1merkistöä;
//toinen yleinen vaihtoehto on utf8.
$yhteys->exec("SET NAMES latin1");
// valmistetaan kysely
$kysely = $yhteys->prepare("SELECT * FROM locatiot");
// suoritetaan kysely
$kysely->execute();

echo "<table>";
// käsitellään tulostaulun rivit yksi kerrallaan
while ($rivi = $kysely->fetchAll(PDO::FETCH_COLUMN)) {
echo "<tr>";
echo "<td>" . htmlspecialchars($rivi["ID"]) . "</td>";
echo "<td>" . htmlspecialchars($rivi["Latitude"]) . "</td>";
echo "<td>" . htmlspecialchars($rivi["Longitude"]) . "</td>";
echo "<td>" . htmlspecialchars($rivi["Timestamp"]) . "</td>";
echo "</tr>";
}
echo "</table>";
?>
