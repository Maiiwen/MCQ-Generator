let buttonValid = document.querySelector('#buttonValid');
let form = document.querySelector('#form');
questionNumber = 1;

//   prettier-ignore
function questionTemplate() { element = document.createElement('div')
element.innerHTML ='\
<div class="card px-4  py-2 mt-3">\
    <div class="card-body">\
        <h5 class="card-title fw-bold">\
            <div class="form-floating mb-3">\
                <input type="text" required name="question' + questionNumber + '[title]" class="form-control" placeholder="question">\
                <label for="floatingInput">Question</label>\
            </div>\
        </h5>\
    </div>\
    <ul class="list-group list-group-flush">\
        <li class="list-group-item">\
            <div class="form-check">\
                <label class="form-check-label">\
                    <input required class="form-check-input mt-4 mb-4" name="question' + questionNumber + '[AnswerRight]" type="radio" id="" name="rightAnswer" value="1">\
                    <div class="form-floating mt-1">\
                        <input type="text" class="form-control" id="floatingInput" name="question' + questionNumber + '[answers][]" placeholder="Réponse">\
                        <label for="floatingInput">Réponse</label>\
                    </div>\
                </label>\
            </div>\
        </li>\
        <li class="list-group-item">\
            <div class="form-check">\
                <label class="form-check-label">\
                    <input required class="form-check-input mt-4 mb-4" name="question' + questionNumber + '[AnswerRight]" type="radio" id="" name="rightAnswer" value="2">\
                    <div class="form-floating mt-1">\
                        <input type="text" class="form-control" id="floatingInput" name="question' + questionNumber + '[answers][]" placeholder="Réponse">\
                        <label for="floatingInput">Réponse</label>\
                    </div>\
                </label>\
            </div>\
        </li>\
        <div class="d-grid gap-2 mt-3" id="AnswerButton">\
            <button class="btn btn-outline-dark" id="addAnswer">➕</button>\
        </div>\
    </ul>\
</div>'
return element}

function addQuestion(e) {
  if (e) {
    e.preventDefault();
  }
  buttonValid.remove();
  form.appendChild(questionTemplate());
  questionNumber++;
  form.appendChild(buttonValid);
  document.querySelectorAll('#addAnswer').forEach((element) => {
    element.removeEventListener('click', addAnswer);
  });
  document.querySelectorAll('#addAnswer').forEach((element) => {
    element.addEventListener('click', addAnswer);
  });
}

function addAnswer(e) {
  e.preventDefault();
  e.target.parentElement.parentElement.insertBefore(
    e.target.parentElement.previousElementSibling.cloneNode(true),
    e.target.parentElement
  );
  e.target.parentElement.parentElement.appendChild(e.target.parentElement);
  e.target.parentElement.previousElementSibling.querySelector('input').value =
    parseInt(
      e.target.parentElement.previousElementSibling.querySelector('input').value
    ) + 1;
}
document.querySelector('#addQuest').addEventListener('click', addQuestion);
addQuestion();
