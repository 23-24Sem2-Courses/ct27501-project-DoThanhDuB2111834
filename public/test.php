<?php

$systemTimezone = date_default_timezone_get();
date_default_timezone_set('Asia/Ho_Chi_Minh');

$date = date('Y-m-d H:i:s');
echo "$date";