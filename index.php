<?php
if (isset($_POST['submit'])) {
    $xmlDoc = new DOMDocument("1.0", "UTF-8");
    $xmlDoc->preserveWhiteSpace = false;
    if (file_exists('tooted.xml')) {
        $xmlDoc->load('tooted.xml');
    } else {
        $xml_root = $xmlDoc->createElement("tooted");
        $xmlDoc->appendChild($xml_root);
    }

    $xml_root = $xmlDoc->documentElement;
    $xml_toode = $xmlDoc->createElement("toode");

    foreach ($_POST as $voti => $vaartus) {
        if ($voti != 'submit') {
            $kirje = $xmlDoc->createElement($voti, $vaartus);
            $xml_toode->appendChild($kirje);
        }
    }

    $xml_root->appendChild($xml_toode);
    $xmlDoc->save('tooted.xml');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toote lisamine</title>
    <script src="script.js" defer></script>
</head>
<body>
<h2>Toote sisestamine</h2>
<form action="" method="post" name="vorm1">
    <table>
        <tr>
            <td><label for="nimetus">Toote nimetus:</label></td>
            <td><input type="text" name="nimetus" id="nimetus" autofocus></td>
        </tr>
        <tr>
            <td><label for="kirjeldus">Kirjeldus:</label></td>
            <td><input type="text" name="kirjeldus" id="kirjeldus"></td>
        </tr>
        <tr>
            <td><label for="hind">Hind:</label></td>
            <td><input type="text" name="hind" id="hind"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" id="submit" value="Sisesta"></td>
            <td></td>
        </tr>
    </table>
</form>

<button onclick="toggleXML()">Näita XML</button>
<pre id="xmlContent" style="display:none; border:1px solid #000; padding:10px;"></pre>

<h2>Tooted</h2>
<div id="xmlTable"></div>
</body>
</html>
