<?php

class Manager
{
    private static $pdo;

    protected static function getPdoInstance()
    {
        if (self::$pdo == NULL) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=qcm', 'root', '');
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        return self::$pdo;
    }
}
