<?php
include '../app/Manager/QcmManager.php';

// récupération du QCM
$qcmObj = QcmManager::get($_GET['p']);

// récupération des questions du QCM
$questions = QuestionManager::getFromQcm($_GET['p']);

// Création et hydratation des objets du QCM

foreach ($questions as $question) {

    // création/ajout de la question au QCM
    $newQuestion = new Question($question->getTitle(), $question->getId());
    $qcmObj->addQuestions($newQuestion);
    // récupération des réponses à la question 
    $answers = AnswerManager::getFromQuestion($newQuestion->getId());
    // création/ajout des réponses à la question
    foreach ($answers as $answer) {
        $newQuestion->addAnswers(new Answer($answer->getTitle(), $answer->getIsRight(), $answer->getId()));
    }
}
