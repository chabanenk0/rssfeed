<!doctype html>
<html>
<head>
    <title>Просмотр новости</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>Просмотр новости</h1>
<h2><?php echo $record->getTitle(); ?></h2>
<p><?php echo $record->getDescription(); ?></p>
<p>Джерело: <a href='source/<?php echo $sourceId ?>/'><?php echo $sourceName ?></a> </p>
</body>
</html>