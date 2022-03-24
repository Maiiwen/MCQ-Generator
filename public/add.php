<?php include '../app/includes/top.php';
if ($_POST) {
    include '../app/includes/pdo.php';
    if (!empty($_POST['qcmName'])) {
        $sql = "INSERT INTO `qcm`(`qcm_title`) VALUES (:qcm_title)";
        $res = $pdo->prepare($sql);
        $res->execute(["qcm_title" => $_POST["qcmName"]]);
        $qcmId = $pdo->lastInsertId();
        unset($_POST["qcmName"]);
        var_dump($_POST);
        $keys = array_keys($_POST);

        foreach ($_POST as $question) {
            $sql = "INSERT INTO `questions`(`question_title`, `qcm_id`) VALUES (:question_title,:qcm_id)";
            $res = $pdo->prepare($sql);
            $res->execute(["question_title" => $question['title'], "qcm_id" => $qcmId]);
            $questId = $pdo->lastInsertId();
            foreach ($question['answers'] as $key => $value) {
                $sql = "INSERT INTO `answers`(`answer_title`, `answer_isRight`, `question_id`) VALUES (:answer_title,:answer_isRight,:question_id)";
                var_dump($question['AnswerRight'] - 1 == $key);
                $res = $pdo->prepare($sql);
                $res->execute(["answer_title" => $value, "answer_isRight" => $question['AnswerRight'] - 1 == $key ? 1 : 0, "question_id" => $questId]);
            }
        }
    } else {
        header('Location: add.php?error');
    }

    exit;
}

?>

<h1 class="text-center">Création d'un QCM</h1>
<?php if (isset($_GET['error'])) { ?>

<?php } ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-11 col-lg-9 col-xl-8 col-xl-6 mx-auto ">
            <form action="add.php" method="POST" id="form">
                <div class="form-floating mb-3">
                    <input type="text" required name="qcmName" class="form-control" placeholder="question">
                    <label for="floatingInput">Nom du QCM</label>
                </div>
                <div class="d-grid gap-2 mt-3" id="buttonValid">
                    <button class="btn btn-outline-dark btn-lg" id="addQuest">➕</button>
                    <button class="btn btn-outline-dark btn-lg" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="scripts/addQCM.js"></script>

<?php include '../app/includes/bottom.php' ?>