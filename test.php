<?php
$fp = fopen(dirname(__FILE__) . '/' . date('YmdHis'). '.txt', 'w+');
fwrite($fp, '现在的时间是' . date('Y-m-d H:i:s'));
fclose($fp);
