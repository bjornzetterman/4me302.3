<?php
session_start();
//destroy means that the session is destroyed, removed and since we save our state of the application in the sseion it will be not logged in after this.
session_destroy();
header("Location: login.html");
?>