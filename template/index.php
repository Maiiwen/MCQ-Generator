<?php include '../template/partials/top.php';
include '../app/Manager/QcmManager.php';

$qcms = QcmManager::getAll();
if (!empty($_POST)) {
    if ($_POST['button'] == "access") {
        if (!empty($_POST['qcm_id'])) {
            $url = "consult/" . $_POST['qcm_id'];
        } else {
            $url = "/";
        }

        header("Location: " . $url);
    }
    if ($_POST['button'] == "delete") {
        if (!empty($_POST['qcm_id']) || !empty($_POST['question_id']) || !empty($_POST['answer_id'])) {

            require '../app/Scripts/remove.php';
            exit;
        } else {
            $url = "/";

            header("Location: " . $url);
        }
    }
    if ($_POST['button'] == "modify") {
        if (!empty($_POST['qcm_id'])) {
            $url = "update/" . $_POST['qcm_id'];
        } else {
            $url = "/";
        }
        header("Location: " . $url);
    }
    if ($_POST['button'] == "add") {
        if (!empty($_POST['qcm_id']) || !empty($_POST['question_id']) || !empty($_POST['answer_id'])) {

            require '../app/Scripts/addHandler.php';
            exit;
        }
    }
}
?>


<div class="container mt-5">
    <div class="row">
        <form action="./" method="post">
            <div class="form-floating">
                <select required class="form-select" id="floatingSelect" name="qcm_id">
                    <option disabled selected>Selectionnez le QCM</option>
                    <?php foreach ($qcms as $qcm) : ?>
                        <option value="<?= $qcm->getId() ?>"><?= $qcm->getTitle() ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="floatingSelect">QCM</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="button" class="btn btn-outline-danger btn-lg mt-3 col-3" value="delete">Supprimer</button>
                <button type="submit" name="button" class="btn btn-outline-dark btn-lg mt-3 col-3" value="modify">Modifier</button>
                <button type="submit" name="button" class="btn btn-success btn-lg mt-3 col-3" value="access">Répondre</button>
            </div>


        </form>
        <div class="d-grid gap-2">
            <a href="/add" class="btn btn-outline-dark btn-lg mt-3 col-5 mx-auto">Créer un QCM</a>
        </div>
    </div>
</div>
<?php include '../template/partials/bottom.php' ?>