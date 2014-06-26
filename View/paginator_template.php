<?php
for ($i = $minPageNumber; $i <= $maxPageNumber; $i++) {
    $textrow = "<a href='?page=$i'>$i</a>\n";
    if ($i == $pageNumber + 1) {
        $textrow = '<b>'.$textrow.'</b>';
    }
    echo $textrow;
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
