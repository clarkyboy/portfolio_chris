<?php
 session_start();
 session_destroy(); // ghis will destroy all session related activities
 header('Location: index.php');
?>