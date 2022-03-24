<?php include '../template/partials/top.php' ?>
<a href="/" class="btn btn-secondary m-2">Retour à la sélection</a>
<?php if ($_POST) : ?>
  <a href="?qcm=<?= $_GET['p'] ?>" class="btn btn-secondary m-2">Retour au questionnaire</a>
<?php

endif; ?>

<div class="container">
  <div class="row">
    <div class="col-12 col-sm-12 col-md-11 col-lg-9 col-xl-8 col-xl-6 mx-auto ">
      <form action="" method="POST">
        <?php foreach ($this->getQuestions() as $keyQ => $question) : ?>
          <div class="card px-4  py-2 mt-3">
            <div class="card-body">
              <h5 class="card-title fw-bold"><?= $question->getTitle() ?></h5>
            </div>
            <ul class="list-group list-group-flush">
              <?php foreach ($question->getAnswers() as $keyA => $answer) : ?>
                <li class="list-group-item">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input <?= $_POST && $_POST[$keyQ] == $keyA ? "checked" : "" ?> <?= $_POST ? "disabled" : "" ?> class="form-check-input" type="radio" id="<?= $keyQ ?>" name="<?= $keyQ ?>" value="<?= $keyA ?>">
                      <?= $answer->getTitle() ?>
                    </label>
                  </div>
                </li>
              <?php endforeach; ?>

              <?php if ($_POST) :
                $isTrue = $question->getAnswers()[$_POST[$keyQ]]->getIsRight() ?>

                <div class="alert <?= $isTrue ? "alert-success" : "alert-danger" ?> mt-2" role="alert">
                  Réponse <?= $isTrue ? "juste" : "fausse" ?> !
                </div>
              <?php else : ?>
                <li class="list-group-item">
                </li>
              <?php
              endif; ?>
            </ul>
          </div>
        <?php endforeach; ?>
        <?php if (!$_POST) : ?>
          <div class="d-grid gap-2 mt-3">
            <button class="btn btn-outline-dark btn-lg" type="submit">Vérifier</button>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>
<?php include '../template/partials/bottom.php' ?>