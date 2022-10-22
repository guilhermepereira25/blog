<?php

$mysql = new mysqli('localhost', 'root', 'Gui@250802', 'blog');
$mysql->set_charset('utf8');

if ($mysql == FALSE) {
    echo "Banco desconectado";
}

?>