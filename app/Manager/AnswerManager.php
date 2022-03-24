<?php

class AnswerManager
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

        $sql = "SELECT * FROM answers";
        $req = $pdo->query($sql);
        $products = $req->fetchAll(PDO::FETCH_ASSOC);

        return self::hydrateCollection($products);
    }

    public static function get(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT * FROM answers WHERE answer_id = :id";
        $req = $pdo->prepare($sql);
        $req->execute([
            'id' => $id
        ]);
        $product = $req->fetch(PDO::FETCH_ASSOC);
        return new Answer($product);
    }

    public static function getFromQuestion(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT * FROM answers WHERE question_id = :id";
        $req = $pdo->prepare($sql);
        $req->execute([
            'id' => $id
        ]);
        $items = $req->fetchAll(PDO::FETCH_ASSOC);
        return self::hydrateCollection($items);
    }

    private static function hydrateCollection(array $collection)
    {
        foreach ($collection as $index => $productInfo) {
            $collection[$index] = new Answer($productInfo);
        }

        return $collection;
    }
}
