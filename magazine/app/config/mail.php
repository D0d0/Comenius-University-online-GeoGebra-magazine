<?php

return array(
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => array('address' => 'geogebraMag@no-reply.com', 'name' => 'Online Geogebra magazine'),
    'encryption' => 'tls',
    'username' => 'geogebramag@gmail.com',
    'password' => 'DaucusCarota',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
);
