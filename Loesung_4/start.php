<?php
spl_autoload_register(function ($class) {
    include str_replace("\\", "/", $class) . ".php";
});
session_start();
define("CHAT_SERVER_URL", "https://online-lectures-cs.thi.de/chat/");
define("CHAT_SERVER_ID","63175f31-934e-42cb-a27b-9678bf16e83b");
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
?>
