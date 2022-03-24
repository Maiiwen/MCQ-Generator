<?php

class QcmManager
{

    private static $pdo;

    public static function getPdoInstance()
    {
        if (self::$pdo == NULL) // Je créer un singleton de PDO ici dans le but de ne pas l'instancier à chaque appel de la méthode
        {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=qcm', 'root', '');
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        return self::$pdo;
    }

    public static function getAll()
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT * FROM qcm";
        $req = $pdo->query($sql);
        $products = $req->fetchAll(PDO::FETCH_ASSOC);

        // return $products;
        return self::hydrateCollection($products);
    }

    public static function get(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT * FROM qcm WHERE qcm_id = :id";
        $req = $pdo->prepare($sql);
        $req->execute([
            'id' => $id
        ]);
        $product = $req->fetch(PDO::FETCH_ASSOC);
        return new QCM($product);
    }

    private static function hydrateCollection(array $collection)
    {
        foreach ($collection as $index => $productInfo) {
            $collection[$index] = new QCM($productInfo);
        }

        return $collection;
    }
}
