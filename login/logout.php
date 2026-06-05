<?php

session_start();

session_destroy();

header("Location: /LaNotte/public/index.php");
exit();