<?php

require_once __DIR__ . '/src/luffy/Randomizer.php';
use  luffy\random\Randomizer;

$rnd=new Randomizer('449c131f-0171-401e-80c9-xxxxxxxx');
//$data=$rnd->integers(10,1,100,100);
//$data=$rnd->decimalFractions(10,6);
//$data=$rnd->gaussians(20,0,1,5);
//$ch='abcdefghijklmnopqrstuvwxyz';
//$data=$rnd->strings(10,8,$ch);
//$data=$rnd->uuids(10);
//$data=$rnd->blobs(2,1024);
$data=$rnd->usage();
var_dump($data);