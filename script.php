<?php
require_once ('src/ProgressionValidator.php');

$validator = new src\ProgressionValidator($argv[1]);
$validator->validate();