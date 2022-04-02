<?php if (!empty($_POST['qcmName'])) {

    if (empty($_POST['qcmName'])) {
        echo 'Veuillez renseigner un titre au QCM !';
        exit;
    }
    $qcm = new QCM($_POST['qcmName']);
    unset($_POST["qcmName"]);
    $keyQ = 0;
    if (empty($_POST['question1'])) {
        echo 'Veuillez renseigner au moins une question au QCM !';
        exit;
    }
    foreach ($_POST as $question) {
        if (!empty($question['title'] && !empty($question['AnswerRight']))) {
            $qcm->addQuestions(new Question($question['title']));
            if (count($question['answers']) <= 1) {
                echo 'Veuillez renseigner au moins deux réponses à chaque réponses du QCM !';
                exit;
            }
            if (empty($question['answers'][$question['AnswerRight'] - 1])) {
                echo 'La bonne réponse ne peux pas être une réponse vide !';
                exit;
            }
            foreach ($question['answers'] as $keyA => $value) {
                if (!empty($value)) {
                    $qcm->getQuestions()[$keyQ]->addAnswers(new Answer($value, $question['AnswerRight'] - 1 == $keyA ? 1 : 0));
                } else {
                    unset($question['answers'][$keyA]);
                    if (count($question['answers']) <= 1) {
                        echo 'Veuillez renseigner au moins deux réponses à chaque questions du QCM !';
                        exit;
                    }
                }
            }
        }

        $keyQ += 1;
    }
    try {
        $qcm->getQuestions();
        var_dump('ok');
        QcmManager::addQCM($qcm);
        header('Location: /');
    } catch (\Throwable $th) {
        var_dump($th);
        echo "Une des questions à mal été remplie, veuillez réessayer";
    }
} else {
    header('Location: add.php?error');
}
