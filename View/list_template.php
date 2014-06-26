<!doctype html>
<html>
<head>
    <title>Список свежеспарсенных новостей</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>Список свежеспарсенных новостей</h1>
<?php
    include "paginator_template.php";
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