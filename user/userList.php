<?php
if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!'; 
}
session_start();
$idsession = session_id();
print_r($_SESSION);
echo($idsession);
?>