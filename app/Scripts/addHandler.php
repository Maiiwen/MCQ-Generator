<?php
if (!empty($_POST['qcm_id'])) {

    QuestionManager::addQuestion((new Question(''))
            ->addAnswers(new Answer('', 0))
            ->addAnswers(new Answer('', 0)),
        intval($_POST['qcm_id'])
    );
    $question_id = QuestionManager::getLastId();
    $question = QuestionManager::get($question_id);
    $answers = AnswerManager::getFromQuestion($question_id);
    foreach ($answers as $answer) {
        $question->addAnswers($answer);
    }

?>
    <div class="card px-4  py-2 mt-3">
        <div class="card-body">
            <button class="btn btn-outline-dark mb-3 deleteQuestion" value="<?= $question->getId() ?>">❌</button>
            <h5 class="card-title fw-bold">
                <div class="form-floating mb-3">
                    <input value="<?= $question->getTitle() ?>" type="text" required name="questions[<?= $question->getId() ?>][title]" class="form-control" placeholder="question">
                    <label for="floatingInput">Question</label>
                </div>
            </h5>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($question->getAnswers() as $answer) : ?>
                <li class="list-group-item">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input <?= $answer->getIsRight() ? 'checked' : '' ?> required class="form-check-input mt-4 mb-4" name="questions[<?= $question->getId() ?>][isRight]" type="radio" id="" name="rightAnswer" value="<?= $answer->getId() ?>">
                            <div class="form-floating mt-1">
                                <input value="<?= $answer->getTitle() ?>" type="text" class="form-control" id="floatingInput" name="questions[<?= $question->getId() ?>][answers][<?= $answer->getId() ?>]" placeholder="Réponse">
                                <label for="floatingInput">Réponse</label>
                            </div>
                        </label>
                        <button class="btn btn-outline-dark mb-1 deleteAnswer" value="<?= $answer->getId() ?>">❌</button>
                    </div>
                </li>
            <?php endforeach; ?>
            <div class="d-grid gap-2 mt-3" id="AnswerButton">
                <button class="btn btn-outline-dark" id="addAnswer">➕</button>
            </div>
        </ul>
    </div>
<?php

} elseif (!empty($_POST['question_id'])) {
    AnswerManager::addAnswer(new Answer('', 0), intval($_POST['question_id']));
    $answerID = Manager::lastInsertID();
?>
    <div class="form-check">
        <label class="form-check-label">
            <input required class="form-check-input mt-4 mb-4" name="questions[<?= $_POST['question_id'] ?>][isRight]" type="radio" id="" name="rightAnswer" value="<?= $answerID ?>">
            <div class="form-floating mt-1">
                <input value="" type="text" class="form-control" id="floatingInput" name="questions[<?= $_POST['question_id'] ?>][answers][<?= $answerID ?>]" placeholder="Réponse">
                <label for="floatingInput">Réponse</label>
            </div>
        </label>
        <button class="btn btn-outline-dark mb-1 deleteAnswer" value="<?= $answerID ?>">❌</button>
    </div>
<?php
}

// header('Location: /');
