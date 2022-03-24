<?php
include '../app/Manager/QcmManager.php';
include '../app/Manager/AnswerManager.php';
include '../app/Manager/QuestionManager.php';


// récupération du QCM
$qcmObj = QcmManager::get($_GET["qcm"]);

// récupération des questions du QCM
$questions = QuestionManager::getFromQcm($_GET["qcm"]);

// Création et hydratation des objets du QCM

foreach ($questions as $question) {

    // création/ajout de la question au QCM
    $newQuestion = new Question(['question_id' => $question->getId(), 'question_title' => $question->getTitle()]);
    $qcmObj->addQuestions($newQuestion);
    // récupération des réponses à la question 
    $answers = AnswerManager::getFromQuestion($newQuestion->getId());
    // création/ajout des réponses à la question
    foreach ($answers as $answer) {
        $newQuestion->addAnswers(new Answer(['answer_id' => $answer->getId(), 'answer_title' => $answer->getTitle(), 'answer_isRight' => $answer->getIsRight()]));
    }
}

$qcmObj->show();



// var_dump($qcmObj);
