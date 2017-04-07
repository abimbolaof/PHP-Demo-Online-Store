<?php 
ini_set('session.gc_maxlifetime', 60*60*48);
session_set_cookie_params(60*60*48);
session_start();
?>