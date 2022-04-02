<?php include '../template/partials/top.php' ?>

<h1 class="text-center">Création d'un QCM</h1>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-11 col-lg-9 col-xl-8 col-xl-6 mx-auto ">
            <form action="add" method="POST" id="form">
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

<?php include '../template/partials/bottom.php' ?>