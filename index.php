<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablice PHP</title>
</head>
<body>
<h2>Zadanie 1</h2>

<?php
$tab1 = array(7, 3, 1, 6, 9, 5, 4, 10, 2, 2);
echo "5 komórka tab1: " . $tab1[4] . "<br>";
$tab1[6] = 12;
$tab2 = $tab1;
$tab3 = array();
for ($i = 0; $i < count($tab1); $i++) {
    $tab3[$i] = $tab1[$i] + $tab2[$i];
}
$tab2 = array_reverse($tab1);
echo "<h3>Tablica tab1:</h3>";
print_r($tab1);
echo "<h3>Tablica tab2:</h3>";
print_r($tab2);
echo "<h3>Tablica tab3:</h3>";
print_r($tab3);
?>

<h2>Zadanie 2</h2>
<form method="post">
    Podaj liczby oddzielone przecinkami:<br>
    <input type="text" name="liczby" required>
    <input type="submit" value="Oblicz">
</form>

<?php
if (isset($_POST['liczby'])) {

    $tablica = array_map('intval', explode(',', $_POST['liczby']));

    echo "Najmniejsza liczba: " . min($tablica) . "<br>";
    echo "Największa liczba: " . max($tablica) . "<br>";

    echo "Średnia: " . (array_sum($tablica) / count($tablica)) . "<br>";

    echo "Ilość wystąpień liczby 3: " . count(array_keys($tablica, 3)) . "<br>";

    sort($tablica);
    echo "<br>Tablica posortowana: ";
    print_r($tablica);

    $ile = count($tablica);

    if ($ile % 2 == 0) {
        $mediana = ($tablica[$ile / 2 - 1] + $tablica[$ile / 2]) / 2;
    } else {
        $mediana = $tablica[floor($ile / 2)];
    }

    echo "<br>Mediana: " . $mediana . "<br>";

    echo "<br>Trzy najmniejsze: ";
    print_r(array_slice($tablica, 0, 3));

    echo "<br>Trzy największe: ";
    print_r(array_slice($tablica, -3));

    foreach ($tablica as &$liczba) {
        $liczba = $liczba * $liczba;
    }
    unset($liczba);

    echo "<br><br>Elementy podniesione do kwadratu: ";
    print_r($tablica);

    $parzyste = 0;
    $nieparzyste = 0;
    $podzielne = 0;

    foreach ($tablica as $liczba) {
        if ($liczba % 2 == 0) {
            $parzyste++;
        } else {
            $nieparzyste++;
        }

        if ($liczba % 3 == 0) {
            $podzielne++;
        }
    }

    echo "<br>Liczby parzyste: " . $parzyste;
    echo "<br>Liczby nieparzyste: " . $nieparzyste;
    echo "<br>Liczby podzielne przez 3: " . $podzielne;
}
?>

<h2>Zadanie 3</h2>
<form method="post">
    Podaj 10-literowy wyraz:
    <input type="text" name="wyraz" maxlength="10" required>
    <input type="submit" value="Zatwierdź">
</form>

<?php
if (isset($_POST['wyraz'])) {
    if (strlen($_POST['wyraz']) != 10) {
        echo "Wyraz musi mieć dokładnie 10 liter!";
    } else {
        $tablica = str_split($_POST['wyraz']);
        foreach ($tablica as &$litera) {
            if ($litera == strtoupper($litera)) {
                $litera = strtolower($litera);
            } else {
                $litera = strtoupper($litera);
            }
        }
        unset($litera);

        echo "<br>Tablica po zamianie liter: ";
        print_r($tablica);

        shuffle($tablica);

        echo "<br><br>Tablica w losowej kolejności: ";
        print_r($tablica);

    }
}
?>

<h2>Zadanie 4</h2>

<form method="post">
    Podaj liczbę a:
    <input type="number" name="a" required>
    <input type="submit" value="Oblicz">
</form>

<?php
if (isset($_POST['a'])) {
    $a = (int)$_POST['a'];

    $tablica = array();

    for ($i = 0; $i < 100; $i++) {
        $tablica[$i] = rand(1, 20);
    }

    echo "<h3>Tablica A:</h3>";
    print_r($tablica);

    $max = max($tablica);
    echo "<br><br>Największa liczba: " . $max;
    echo "<br>Ilość wystąpień: " . count(array_keys($tablica, $max));

    echo "<h3>Liczby nieparzyste:</h3>";
    foreach ($tablica as $liczba) {
        if ($liczba % 2 != 0) {
            echo $liczba . " ";
        }
    }

    echo "<h3>Elementy o nieparzystych indeksach:</h3>";
    for ($i = 1; $i < 100; $i += 2) {
        echo $tablica[$i] . " ";
    }

    echo "<h3>Liczby z przedziału <5, 15):</h3>";
    $ile = 0;

    foreach ($tablica as $liczba) {
        if ($liczba >= 5 && $liczba < 15) {
            echo $liczba . " ";
            $ile++;
        }
    }

    echo "<br>Ilość liczb: " . $ile;

    $najblizsza = $tablica[0];
    foreach ($tablica as $liczba) {
        if (abs($liczba - $a) < abs($najblizsza - $a)) {
            $najblizsza = $liczba;
        }
    }

    echo "<h3>Element najbliższy liczbie a:</h3>";
    echo $najblizsza;

    $min = min($tablica);
    $indeks = array_search($min, $tablica);

    echo "<h3>Minimum i jego sąsiedzi:</h3>";
    echo "Minimum: " . $min . "<br>";

    if ($indeks > 0) {
        echo "Poprzednik: " . $tablica[$indeks - 1] . "<br>";
    } else {
        echo "Brak poprzednika<br>";
    }

    if ($indeks < 99) {
        echo "Następnik: " . $tablica[$indeks + 1] . "<br>";
    } else {
        echo "Brak następnika<br>";
    }

    $tab2 = array();
    foreach ($tablica as $liczba) {
        if ($liczba > 10) {
            $tab2[] = $liczba;
        }
    }

    echo "<h3>Nowa tablica – liczby większe od 10:</h3>";
    print_r($tab2);

    $tab3 = array();
    $suma = 0;
    for ($i = 0; $i < 100; $i++) {
        $suma += $tablica[$i];
        $tab3[$i] = $suma;
    }

    echo "<h3>Tablica sum:</h3>";
    print_r($tab3);

    rsort($tablica);

    echo "<h3>Tablica posortowana malejąco:</h3>";
    print_r($tablica);

    $wystapienia = array_count_values($tablica);
    echo "<h3>Liczby występujące przynajmniej 3 razy:</h3>";

    foreach ($wystapienia as $liczba => $ilosc) {
        if ($ilosc >= 3) {
            echo $liczba . " – " . $ilosc . " razy<br>";
        }
    }
}
?>

<h2>Zadanie 5</h2>
<?php
$tablica = array();
$a = 0;
$b = 1;

for ($i = 0; $i < 100; $i++) {
    $tablica[$i] = $a;
    $c = $a + $b;
    $a = $b;
    $b = $c;
}

echo "<h3>Ciąg Fibonacciego:</h3>";
print_r($tablica);

$tablica = array();

for ($i = 0; $i < 100; $i++) {
    $tablica[$i] = pow(2, $i);
}

echo "<h3>Potęgi liczby 2:</h3>";
print_r($tablica);

$tablica = array();

for ($i = 0; $i < 100; $i++) {
    $tablica[$i] = 3 * ($i + 1);
}

echo "<h3>Ciąg 3, 6, 9, 12...</h3>";
print_r($tablica);

$tablica = array();
$liczba = 2;

for ($i = 0; $i < 100; $i++) {
    $tablica[$i] = $liczba;
    $liczba *= 2;
}

echo "<h3>Ciąg 2, 4, 8, 16, 32...</h3>";
print_r($tablica);
?>
</body>
</html>