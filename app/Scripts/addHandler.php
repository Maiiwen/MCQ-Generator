<?php
if (!empty($_POST['qcm_id'])) {
    QuestionManager::addQuestion((new Question(''))
            ->addAnswers(new Answer('', 0))
            ->addAnswers(new Answer('', 0)),
        intval($_POST['qcm_id'])
    );
    echo "Hey";
} elseif (!empty($_POST['question_id'])) {
    AnswerManager::addAnswer(new Answer('', 0), intval($_POST['question_id']));
    echo "Hey";
}

// header('Location: /');
