<?php
error_reporting(-1);
ini_set('display_errors','On');
mb_internal_encoding('UTF-8');
date_default_timezone_set("Europe/Paris");


mail("asurion61@gmail.com", "PayPal IPN : ", "paypal_ipn_status = ", "From: asurion61@gmaim.com");
