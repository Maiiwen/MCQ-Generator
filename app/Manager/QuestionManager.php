<?php
require '../app/Manager/AnswerManager.php';
class QuestionManager extends Manager
{

    public static function getAll()
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT * FROM questions";
        $req = $pdo->query($sql);
        $products = $req->fetchAll(PDO::FETCH_ASSOC);

        return self::hydrateCollection($products);
    }

    public static function get(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT * FROM questions WHERE question_id = :id";
        $req = $pdo->prepare($sql);
        $req->execute([
            'id' => $id
        ]);
        $item = $req->fetch(PDO::FETCH_ASSOC);
        return new Question($item['question_title'], $item['question_id']);
    }
    public static function getFromQcm(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT * FROM questions WHERE qcm_id = :id";
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
            $collection[$index] = new Question($item['question_title'], $item['question_id']);
        }

        return $collection;
    }

    public static function addQuestion(Question $question, int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "INSERT INTO `questions`(`question_title`, `qcm_id`) VALUES (:question_title,:qcm_id)";
        $res = $pdo->prepare($sql);
        $res->execute(
            ["question_title" => $question->getTitle(), "qcm_id" => $id]
        );

        $questionId = $pdo->lastInsertId();
        foreach ($question->getAnswers() as $value) {
            AnswerManager::addAnswer($value, $questionId);
        }
    }
    public static function updateQuestion(Question $question)
    {
        $pdo = self::getPdoInstance();

        $sql = "UPDATE `questions` 
        SET `question_title` = :question_title
        WHERE `questions`.`question_id` = :question_id";
        $res = $pdo->prepare($sql);
        $res->execute(
            [
                "question_title" => $question->getTitle(),
                "question_id" => $question->getId()
            ]
        );
        foreach ($question->getAnswers() as $value) {
            if ($value->getId() == 0) {
                AnswerManager::addAnswer($value, $question->getId());
            } else {
                AnswerManager::updateAnswer($value);
            }
        }
    }
    public static function deleteQuestion(int $id)
    {
        $pdo = self::getPdoInstance();

        $sql = "DELETE FROM `questions` WHERE `question_id` = :question_id ";
        $res = $pdo->prepare($sql);
        $res->execute(
            ["question_id" => $id]
        );
    }
    public static function getLastId(): int
    {
        $pdo = self::getPdoInstance();

        $sql = "SELECT MAX(question_id) as question_id FROM questions;";
        $res = $pdo->prepare($sql);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);

        return $result['question_id'];
    }
}
