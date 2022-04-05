<?php include '../template/partials/top.php';
?>




<div class="container">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-11 col-lg-9 col-xl-8 col-xl-6 mx-auto ">
      <input type="hidden" id="qcm_id" value="<?= $qcmObj->getId() ?>">
      <h1 class=" text-center">Modification d'un QCM</h1>
      <form action="/update/<?= $qcmObj->getId() ?>" method="POST" id="form">
        <div class="form-floating mb-3">
          <input value="<?= $qcmObj->getTitle() ?>" type="text" required name="qcmName" class="form-control" placeholder="question">
          <label for="floatingInput">Nom du QCM</label>
        </div>
        <?php foreach ($qcmObj->getQuestions() as $question) : ?>
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
        <?php endforeach; ?>
        <?php if (!empty($message)) : ?>
          <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            <strong>Une erreur est survenue !</strong> <?= $message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif ?>
        <div class="d-grid gap-2 mt-3" id="buttonValid">
          <button class="btn btn-outline-dark btn-lg" id="addQuest">➕</button>
          <button class="btn btn-outline-dark btn-lg" type="submit">Valider</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="../scripts/update.js"></script>
<?php include '../template/partials/bottom.php' ?>