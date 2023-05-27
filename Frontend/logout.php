<?php
session_start();

// قم بإزالة البيانات المخزنة في الجلسة
session_unset();

// قم بإنهاء الجلسة
session_destroy();

// قم بتوجيه المستخدم إلى صفحة تسجيل الدخول
header("Location: http://localhost/Frontend/login.php");
exit();
?>