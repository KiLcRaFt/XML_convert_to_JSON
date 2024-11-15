<?php
// Загружаем XML файл
$xml = simplexml_load_file('Kompaania.xml')

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Kompaania</title>
    <style>
        #KompaaniaTable {
            margin-left: auto;
            margin-right: auto;
        }
        #KompaaniaTable, #KompaaniaTable th, #KompaaniaTable td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
        #KompaaniaTable th {
            background-color: #0d0d0d;
            color: #ffffff;
        }
    </style>
</head>
<body>
<h2>Projekti Aruanded</h2>
<?php
require('nav_menu.php');
?>
<div style="display: flex; justify-content: center; margin-bottom: 10px;">
    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; width: 50%;">
        <div>
            <label for="filterNimi">Nime otsimine: </label>
            <input type="text" id="filterNimi" onkeyup="filterTable()" placeholder="Sisestage nimi"/>
        </div>
        <div>
            <label for="filterAmet">Amet otsimine: </label>
            <input type="text" id="filterAmet" onkeyup="filterTable()" placeholder="Sisestage amet"/>
        </div>
        <div>
            <label for="filterKuupaev">Kuupäev otsimine: </label>
            <input type="text" id="filterKuupaev" onkeyup="filterTable()" placeholder="Sisestage kuupäev"/>
        </div>
    </div>
</div>
<hr/>
<table id="KompaaniaTable">
    <tr>
        <th>Nimi</th>
        <th>Amet</th>
        <th>Palk</th>
        <th>Kuupäev</th>
        <th>Töö algus</th>
        <th>Töö lõpp</th>
    </tr>

    <?php foreach ($xml->Tootaja as $tootaja): ?>
        <tr>
            <td><?php echo htmlspecialchars($tootaja->{"nimi-perenimi"}); ?></td>
            <td><?php echo htmlspecialchars($tootaja->amet); ?></td>
            <td><?php echo htmlspecialchars($tootaja->palk); ?></td>
            <td><?php echo htmlspecialchars($tootaja->igapaevased_andmed->kuupaev); ?></td>
            <td><?php echo htmlspecialchars($tootaja->igapaevased_andmed->toopaev_algus); ?></td>
            <td><?php echo htmlspecialchars($tootaja->igapaevased_andmed->toopaev_lopp); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    function filterTable() {
        var filterNimi = document.getElementById("filterNimi").value.toLowerCase();
        var filterKuupaev = document.getElementById("filterKuupaev").value;
        var filterAmet = document.getElementById("filterAmet").value.toLowerCase();
        var table = document.getElementById("KompaaniaTable");
        var rows = table.getElementsByTagName("tr");

        for (var i = 1; i < rows.length; i++) {
            var nimiCell = rows[i].getElementsByTagName("td")[0];
            var ametCell = rows[i].getElementsByTagName("td")[1];
            var kuupaevCell = rows[i].getElementsByTagName("td")[3];

            var nimiText = nimiCell ? nimiCell.textContent.toLowerCase() : "";
            var ametText = ametCell ? ametCell.textContent.toLowerCase() : "";
            var kuupaevText = kuupaevCell ? kuupaevCell.textContent : "";

            if ((nimiText.includes(filterNimi) || filterNimi === "") &&
                (ametText.includes(filterAmet) || filterAmet === "") &&
                (kuupaevText.includes(filterKuupaev) || filterKuupaev === "")) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>
</body>
</html>
