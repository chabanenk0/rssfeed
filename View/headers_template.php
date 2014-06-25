<!doctype html>
<html>
<head>
    <title>Список свежеспарсенных новостей</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>Список свежеспарсенных новостей</h1>
<?php
    for ($i = $minPageNumber; $i <= $maxPageNumber; $i++) {
        echo "<a href='?page=$i'>$i</a>\n";
    }
    echo "<p>";
    if ($pageNumber > 0) {
        echo '<a href=?page='. ($pageNumber) .'>&lt;--Туда</a> ';
    } else {
        echo '&lt;--Туда ';
    }

    if ($pageNumber < $maxPossiblePage - 1) {
        echo '<a href=?page='. ($pageNumber+2) .'>Сюда--&gt;</a> ';
    } else {
        echo 'Сюда--&gt; ';
    }
?>
<ul>
    <?php
        foreach ($recordsArray as $record) {
    ?>
    <li>
        <?php echo $record->getId().'. <a href=\'item?id='.$record->getId().'\'>'.$record->getTitle().'</a>'; ?>
    </li>
        <?php
        }
        ?>
</table>
</body>
</html>