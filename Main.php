<?php

include "DataFeederInterface.php";
include "NodeInterface.php";
include "FileDataFeeder.php";
include "Node.php";
include "Root.php";

$root = new Root;
$feeder = new FileDataFeeder( 'data.txt' );
$root->setFeeder( $feeder );
$root->show();

