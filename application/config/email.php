<?php defined('BASEPATH') OR exit('No direct script access allowed');



$config = Array(

  'protocol' => 'smtp',

  'smtp_host' => 'ssl://mail.pureuniverse.live',

  'smtp_port' => 465,

  'smtp_user' => get_instance()->config->item('email'),

  'smtp_pass' => 'Imvs@1234',

  'mailtype' => 'html',

  'charset' => 'iso-8859-1',

  'wordwrap' => TRUE

);