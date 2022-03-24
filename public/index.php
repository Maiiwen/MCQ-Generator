<?php
ini_set("xdebug.var_display_max_depth", '-1');

// On inclue les classes
require '../app/Entity/QCM.php';
require '../app/Entity/Question.php';
require '../app/Entity/Answer.php';

if (!empty($_GET['c'])) {
    if ($_GET['c'] === "add") {
        require '../template/add.php';
    }
    if (!empty($_GET['p'])) {
        if ($_GET['c'] == 'consult') {
            require '../app/Object/QCMOBJ.php';
        }
    }
} else {
    require '../template/qcmSelection.php';
}
