<?php
ini_set("xdebug.var_display_max_depth", '-1');

// On inclue les classes
require '../app/Entity/QCM.php';

if (!empty($_GET['c'])) {
    if ($_GET['c'] === "add") {
        if ($_POST) {
            require '../app/Manager/QcmManager.php';
            require '../app/Scripts/add.php';
            exit;
        } else {
            require '../template/add.php';
        }
    }

    if (!empty($_GET['p'])) {
        if ($_GET['c'] == 'consult') {
            require '../app/Object/QCMOBJ.php';
            $qcmObj->show();
        }
        if ($_GET['c'] === "update") {
            require '../app/Object/QCMOBJ.php';
            if ($_POST) {
                require '../app/Scripts/update.php';
            } else {
                require '../template/update.php';
            }
        }
    }
} else {
    require '../template/index.php';
}
