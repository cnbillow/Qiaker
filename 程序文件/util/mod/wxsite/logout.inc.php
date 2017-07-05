<?php
unset($_SESSION['userid']);
unset($_SESSION['username']);
Cookie::delete('Uin');
Cookie::delete('auth');
Cookie::delete('Uas');
header('location:/');