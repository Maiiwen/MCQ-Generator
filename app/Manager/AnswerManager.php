<?php
class AnswerManager extends Manager
{

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
        $item = $req->fetch(PDO::FETCH_ASSOC);
        return new Answer($item['answer_title'], $item['answer_isRight'], $item['answer_id']);
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
        foreach ($collection as $index => $item) {
            $collection[$index] = new Answer($item['answer_title'], $item['answer_isRight'], $item['answer_id']);
        }

        return $collection;
    }

    public static function addAnswer(Answer $answer, int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "INSERT INTO `answers`(`answer_title`, `answer_isRight`, `question_id`) VALUES (:answer_title,:answer_isRight,:question_id)";
        $res = $pdo->prepare($sql);
        $res->execute(
            ["answer_title" => $answer->getTitle(), "answer_isRight" => $answer->getIsRight() ? 1 : 0, "question_id" => $id]
        );
    }

    public static function updateAnswer(Answer $answer)
    {
        $pdo = self::getPdoInstance();
        $sql = "UPDATE `answers` 
        SET `answer_title` = :answer_title, 
        `answer_isRight` = :answer_isRight
        WHERE `answer_id` = :answer_id";
        $res = $pdo->prepare($sql);
        $res->execute(
            [
                "answer_title" => $answer->getTitle(),
                "answer_isRight" => $answer->getIsRight() ? 1 : 0,
                "answer_id" => $answer->getId()
            ]
        );
    }
    public static function deleteAnswer(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "DELETE FROM `answers` WHERE `answer_id` = :answer_id ";
        $res = $pdo->prepare($sql);
        $res->execute(
            ["answer_id" => $id]
        );
    }
}
