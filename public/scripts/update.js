document.querySelectorAll('.deleteQuestion').forEach((element) => {
  element.addEventListener('click', removeQuestion);
});
document.querySelectorAll('.deleteAnswer').forEach((element) => {
  element.addEventListener('click', removeAnswer);
});
async function removeQCM() {
  await fetch('http://qcm.local/', {
    body:
      'qcm_id=' + document.querySelector('#qcm_id').value + '&button=delete',
    method: 'POST',
    mode: 'cors',
  });
}
function removeQuestion(e) {
  e.preventDefault();
  if (document.querySelectorAll('.deleteQuestion').length == 1) {
    if (
      confirm(
        'Si vous supprimez cette question, cela entrainera la suppression du QCM'
      )
    ) {
      removeQCM().then(() => {
        window.location.replace('/');
      });
    }
  } else {
    fetch('http://qcm.local/', {
      body: 'question_id=' + this.value + '&button=delete',
      method: 'POST',
      mode: 'cors',
    })
      .then((response) => {
        response.text();
      })
      .then((text) => {
        console.log(text);
      })
      .catch((error) => {
        console.log(error.message);
      });
  }
}

function removeAnswer(e) {
  e.preventDefault();
  let question = this.parentElement.parentElement.parentElement.parentElement;
  if (question.querySelectorAll('.deleteAnswer').length == 1) {
    if (
      confirm(
        'Si vous supprimez cette réponse, cela entrainera la suppression de la question'
      )
    ) {
      removeQuestion().then(() => {
        window.location.replace('/');
      });
    }
  } else {
    fetch('http://qcm.local/', {
      body: 'question_id=' + this.value + '&button=delete',
      method: 'POST',
      mode: 'cors',
    });
    this.parentElement.parentElement.remove();
  }
}
