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
        echo "<a href='list.php?page=$i'>$i</a>\n";
    }
    echo "<p>";
    if ($pageNumber > 0) {
        echo '<a href=list.php?page='. ($pageNumber) .'>&lt;--Туда</a> ';
    } else {
        echo '&lt;--Туда ';
    }

    if ($pageNumber < $maxPossiblePage) {
        echo '<a href=list.php?page='. ($pageNumber+2) .'>Сюда--&gt;</a> ';
    } else {
        echo 'Сюда--&gt; ';
    }
?>
<table border="1">
    <tr>
    <th>Заголовок</th>
    <th>Текст</th>
    <th>Источник</th>
    <th>Дата</th>
    </tr>
    <?php
        foreach ($recordsArray as $record) {
            ?>

            <tr>
                <td>
                    <?php echo $record->getTitle(); ?>
                </td>
                <td>
                    <?php echo $record->getDescription(); ?>
                </td>
                <td>
                    <?php echo $record->getSource(); ?>
                </td>
                <td>
                    <?php echo $record->getPubdate(); ?>
                </td>
            </tr>
        <?php
        }
    ?>
</table>
</body>
</html>