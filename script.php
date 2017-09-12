<?php
require_once ('src/ProgressionValidator.php');

if (isset($argv[1])) {
   $validator = new src\ProgressionValidator($argv[1]);
   $validator->validate();    
} else {
    echo 'You need to specify an argument';
}
