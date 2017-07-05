<?php
$date=$_REQUEST['date'];
$nowdate = date("Y-m-d", TIME);
$yesteday=date('Y-m-d',strtotime($date.'-1 day'));
$tomorrow=date('Y-m-d',strtotime($date.'+1 day'));
$start=strtotime($date);
$end=strtotime($date)+24*3600-1;
$week = get_week($date);
$list=$db->getAll('select * from `main_info` where time between '.$start.' and '.$end.' order by time desc');
$title='恰客_发现Today的好产品！';
$dsp="恰客网，每天来分享你觉得很赞的产品";
$keywords="智能头条,人工智能,智能硬件,智能机器人,人工智能学习,无人驾驶,无人机,物联网,云计算";
$tj_user=$db->getAll('select count(*) as num,userid from `main_info` group by userid order by num desc limit 12');
include T('show','index');