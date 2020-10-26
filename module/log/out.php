<?php
session_start();
session_destroy();

echo "<script>window.history.back(-1);</script>";
?>