<?php

$months = array('', 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
if (isset($_GET['month']) && isset($_GET['years'])) {
    $userMonth = $_GET['month'];
    $userYears = $_GET['years'];
}
function calendar($userYears, $userMonth)
{
    $date =  new DateTime("$userYears-$userMonth");
    $date2 = new DateTime("$userYears-$userMonth-01");
    $weekDays = array('Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim');
    $lastDiv =  0;
    $monthStart = $date2->format('w');
    $totalDay = $date->format('t');
    $date4 = new DateTime("$userYears-$userMonth-$totalDay");



    foreach ($weekDays as $key => $weekDay) {
        echo "<div class='cal red bold'><div class='weekDay'><h2 class='pday'>" . $weekDay . "</h2></div></div>";
    }
    if ($monthStart == 0) {
        for ($sunday = 6; $sunday > 0; $sunday--) {
            $date2 = new DateTime("$userYears-$userMonth-01");
            $date3 = $date2->modify('-' . $sunday . 'days');
            echo  '<div class="cal empty"><p>' . $date3->format('d') . '</p></div>';
            $lastDiv = $lastDiv + 1;
        }
    } else {
        for ($blankBlock = ($monthStart - 1); $blankBlock > 0; $blankBlock--) {
            $date2 = new DateTime("$userYears-$userMonth-01");
            $date3 = $date2->modify('-' . $blankBlock . 'days');
            echo  '<div class="cal empty"><p>' . $date3->format('d') . '</p></div>';
            $date2 = new DateTime("$userYears-$userMonth-01");

            $lastDiv = $lastDiv + 1;
        }
    }
    for ($monthDay = 1; $monthDay <= $date->format('t'); $monthDay++) {
        if ($monthDay < 10) {
            echo '<div class ="cal" data-divDate="' . $date->format('Y-m') . '-0' . $monthDay . '"><p>' . $monthDay . '</p></div>';
            $lastDiv = $lastDiv + 1;
        } else {
            echo '<div class ="cal" data-divDate="' . $date->format('Y-m') . '-' . $monthDay . '"><p>' . $monthDay . '</p></div>';
            $lastDiv = $lastDiv + 1;
        }
    }
    for ($lastDiv; $lastDiv % 7 != 0; $lastDiv = $lastDiv + 1) {
        $date5 = $date4->modify('+1 days');
        echo  '<div class="cal empty"><p>' . $date5->format('d') . '</p></div>';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Pixels&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <main>
        <div class="left">
        <div id="showEvent" class="displayNone">
        </div>
        </div>
        <div class="right">
            <!-- SELECT MONTH / YEAR -->
            <?php if (!isset($_GET['month']) && !isset($_GET['years'])) { ?>
                <h3>POUR AFFICHER LE CALENDRIER VEUILLEZ D'ABORD SELECTIONNER UN MOIS ET UNE ANNEE</h3>
            <?php } ?>
            <form>
                <select name="month">
                    <?php foreach ($months as $indexmonth => $month) {
                        if ($indexmonth === 0) { ?>
                            <option value="" disabled>---- Choissez un mois -----</option>
                        <?php } elseif ($month == $months[$userMonth]) { ?>
                            <option selected="selected" value="<?= $indexmonth ?>"><?= $month ?></option>
                        <?php } else { ?>
                            <option value="<?= $indexmonth ?>"><?= $month ?></option>
                    <?php }
                    } ?>
                </select>
                <select name="years">
                    <option value="" disabled>---- Choissez une année -----</option>
                    <?php for ($i = 1970; $i <= 2070; $i++) {
                        if ($i == $userYears) { ?>
                            <option selected="selected" value="<?= $i ?>"><?= $i ?></option>
                        <?php } else { ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <button>CALENDRIER</button>
            </form>
            <!-- CALENDRIER -->

            <?php if (isset($_GET['month']) && isset($_GET['years'])) { ?>
                <div class="subcontainer">
                    <h1><?= $months[$userMonth] . " " . $userYears ?></h1>
                </div>
                <div class="container" id="container">
                    <?= calendar($userYears, $userMonth) ?>
                </div>
            <?php } ?>

            <!-- AJOUT D EVENT -->

            <form method="post" id="eventForm">
                <label for="eventTitle">Titre</label>
                <input type="text" name="eventTitle" id="eventTitle">
                <label for="eventDate">Date</label>
                <input type="date" name="eventDate" id="eventDate">
                <label for="eventDescription">Description</label>
                <input type="text" name="eventDescription" id="eventDescription">
                <button type="submit">AJOUTER</button>

            </form>
        </div>
    </main>

    <script src="script.js"></script>

</body>

</html>