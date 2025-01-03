<?php
session_start();
session_unset(); // Hủy tất cả các session
session_destroy(); // Hủy phiên làm việc
header('Location: login.php');
exit();
