<?php
var_dump($_POST);
if (!empty($_POST['qcm_id'])) {
    QcmManager::deleteQCM(intval($_POST['qcm_id']));
} elseif (!empty($_POST['question_id'])) {
    QuestionManager::deleteQuestion(intval($_POST['question_id']));
} elseif (!empty($_POST['answer_id'])) {
    AnswerManager::deleteAnswer(intval($_POST['answer_id']));
}

header('Location: /');
