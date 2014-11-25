<?php

return array(
    'driver' => 'smtp',
    'host' => 'smtp.mailgun.org',
    'port' => 587,
    'from' => array('address' => 'geogebraMag@no-reply.com', 'name' => 'Online Geogebra magazine'),
    'encryption' => 'tls',
    'username' => 'postmaster@sandboxe343130729c149e98f6d5c32fc63043d.mailgun.org',
    'password' => 'cb4bd3591a79812806ce5c9cb0a81868',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
);
/*
return array(
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => array('address' => 'geogebraMag@no-reply.com', 'name' => 'Online Geogebra magazine'),
    'encryption' => 'tls',
    'username' => '',
    'password' => '',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
);*/
