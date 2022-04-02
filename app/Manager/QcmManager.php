<?php
require '../app/Manager/Manager.php';
require '../app/Manager/QuestionManager.php';
class QcmManager extends Manager
{

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
        $items = $req->fetch(PDO::FETCH_ASSOC);
        return new QCM($items['qcm_title'], $items['qcm_id']);
    }

    private static function hydrateCollection(array $collection)
    {
        foreach ($collection as $index => $item) {
            $collection[$index] = new QCM($item['qcm_title'], $item['qcm_id']);
        }

        return $collection;
    }

    public static function addQCM(QCM $qcm)
    {
        $pdo = self::getPdoInstance();

        $sql = "INSERT INTO `qcm`(`qcm_title`) VALUES (:qcm_title)";
        $res = $pdo->prepare($sql);
        $res->execute(
            ["qcm_title" => $qcm->getTitle()]
        );

        $qcmId = $pdo->lastInsertId();
        foreach ($qcm->getQuestions() as $value) {
            QuestionManager::addQuestion($value, $qcmId);
        }
    }

    public static function updateQCM(QCM $qcm)
    {
        $pdo = self::getPdoInstance();

        $sql = "UPDATE `qcm` 
        SET `qcm_title` = :qcm_title
        WHERE `qcm`.`qcm_id` = :qcm_id";
        $res = $pdo->prepare($sql);
        $res->execute(
            [
                "qcm_title" => $qcm->getTitle(),
                "qcm_id" => $qcm->getId()
            ]
        );
        foreach ($qcm->getQuestions() as $value) {
            if ($value->getId() == 0) {
                QuestionManager::addQuestion($value, $qcm->getId());
            } else {
                QuestionManager::updateQuestion($value);
            }
        }
    }

    public static function deleteQCM(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "DELETE FROM `qcm` WHERE `qcm`.`qcm_id` = :qcm_id ";
        $res = $pdo->prepare($sql);
        $res->execute(
            ["qcm_id" => $id]
        );
    }
}
