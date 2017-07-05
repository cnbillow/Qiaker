<?php
$id=$_REQUEST['id'];
$url=$db->findOne('select url from `main_info` where id='.$id);
header('location:'.$url);