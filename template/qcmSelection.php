<?php include '../template/partials/top.php';
include '../app/Manager/QcmManager.php';

$qcms = QcmManager::getAll();
if ($_POST) {
    $url = "index.php?qcm=" . $_POST['qcm_id'];
    header("Location: " . $url);
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
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-outline-dark btn-lg mt-3">Accéder au QCM</button>
            </div>

        </form>
        <div class="d-grid gap-2">
            <a href="/add.php" class="btn btn-outline-dark btn-lg mt-3">Créer un QCM</a>
        </div>
    </div>
</div>
<?php include '../template/partials/bottom.php' ?>