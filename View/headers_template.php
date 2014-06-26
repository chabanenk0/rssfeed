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
<ul>
    <?php
        foreach ($recordsArray as $record) {
    ?>
    <li>
        <?php echo $record->getId().'. <a href=\'../showItems/?id='.$record->getId().'\'>'.$record->getTitle().'</a>'; ?>
    </li>
        <?php
        }
        ?>
</ul>
</table>
</body>
</html>
