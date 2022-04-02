<?php

// var_dump($_POST);
if (!empty($_POST['qcmName'])) {
    $qcm = new QCM($_POST['qcmName'], $_GET['p']);
    unset($_POST["qcmName"]);
    $keyQ = 0;
    if (empty($_POST['questions'])) {
        $message = 'Veuillez renseigner au moins une question au QCM !';
        include '../template/update.php';
        exit;
    }
    foreach ($_POST['questions'] as $question_id => $question) {
        if (!empty($question['title'] && !empty($question['isRight']))) {
            $qcm->addQuestions(new Question($question['title'], $question_id));
            if (count($question['answers']) <= 1) {
                $message = 'Veuillez renseigner au moins deux réponses à chaque réponses du QCM !';
                include '../template/update.php';
                exit;
            }
            if (empty($question['isRight'])) {
                $message = 'La bonne réponse ne peux pas être une réponse vide !';
                include '../template/update.php';
                exit;
            }
            foreach ($question['answers'] as $answer_id => $answer) {
                if (!empty($answer)) {
                    $qcm->getQuestions()[$keyQ]->addAnswers(new Answer($answer, $question['isRight'] == $answer_id ? 1 : 0, $answer_id));
                } else {
                    unset($question['answers'][$answer_id]);
                    if (count($question['answers']) <= 1) {
                        $message = 'Veuillez renseigner au moins deux réponses à chaque questions du QCM !';
                        include '../template/update.php';
                        exit;
                    }
                }
            }
        }
        $keyQ += 1;
    }
    try {
        // $qcm->getQuestions();
        // var_dump('ok');
        // var_dump($qcm);
        QcmManager::updateQCM($qcm);
        $url = "/update/${_GET["p"]}";
        header("Location: $url");
    } catch (\Throwable $th) {
        $message = "une erreur est survenue, veuillez réessayer";
        include '../template/update.php';
    }
} else {
    $message = 'Veuillez renseigner un titre au QCM !';
    include '../template/update.php';
    exit;
}
