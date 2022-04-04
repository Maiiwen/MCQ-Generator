document.querySelectorAll('.deleteQuestion').forEach((element) => {
  element.addEventListener('click', removeQuestion);
});
document.querySelectorAll('.deleteAnswer').forEach((element) => {
  element.addEventListener('click', removeAnswer);
});

document.querySelectorAll('#addAnswer').forEach((element) => {
  element.addEventListener('click', addAnswer);
});
document.querySelectorAll('#addQuest').forEach((element) => {
  element.addEventListener('click', addQuestion);
});

function addAnswer(e) {
  e.preventDefault();
  fetchAdd(
    document.querySelector('#qcm_id').value,
    this.parentElement.parentElement.parentElement.querySelector('button').value
  ).then(() => {
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'button';
    input.value = 'update';
    document.querySelector('form').appendChild(input);
    document.querySelector('form').submit();
  });
}
function addQuestion(e) {
  e.preventDefault();
  fetchAdd(document.querySelector('#qcm_id').value).then(() => {
    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'button';
    input.value = 'update';
    document.querySelector('form').appendChild(input);
    document.querySelector('form').submit();
  });
}

function removeQuestion(e) {
  if (e) {
    e.preventDefault();
    value1 = this.value;
  } else {
    value1 = document;
  }
  this.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector(
    '.deleteQuestion'
  ).value;

  if (document.querySelectorAll('.deleteQuestion').length == 1) {
    if (
      confirm(
        'Si vous supprimez cette question, cela entrainera la suppression du QCM'
      )
    ) {
      fetchDel('qcm_id', document.querySelector('#qcm_id').value).then(() => {
        window.location.replace('/');
      });
    }
  } else {
    fetchDel('question_id', value1);
    this.parentElement.parentElement.remove();
  }
}

function removeAnswer(e) {
  e.preventDefault();
  let question = this.parentElement.parentElement.parentElement;
  if (question.querySelectorAll('.deleteAnswer').length <= 2) {
    if (
      confirm(
        'Si vous supprimez cette réponse, cela entrainera la suppression de la question'
      )
    ) {
      removeQuestion().then(() => {
        window.location.replace('/');
      });
    }
  } else if (this.parentElement.parentElement.querySelector('input').checked) {
    alert('Vous ne pouvez pas supprimer une question juste !');
  } else {
    fetchDel('answer_id', this.value);
    this.parentElement.parentElement.remove();
  }
}

async function fetchDel(content, value) {
  await fetch('http://qcm.local/', {
    credentials: 'omit',
    headers: {
      'User-Agent':
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:98.0) Gecko/20100101 Firefox/98.0',
      Accept:
        'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
      'Accept-Language': 'fr,fr-FR;q=0.8,en-US;q=0.5,en;q=0.3',
      'Content-Type': 'application/x-www-form-urlencoded',
      'Upgrade-Insecure-Requests': '1',
    },
    referrer: 'http://qcm.local/',
    body: content + '=' + value + '&button=delete',
    method: 'POST',
    mode: 'cors',
  });
  // .then((response) => {
  //   response.text();
  // })
  // .then((data) => {
  //   console.log(data);
  // });
}
async function fetchAdd(qcm_id, question_id = undefined) {
  await fetch('http://qcm.local/', {
    credentials: 'omit',
    headers: {
      'User-Agent':
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:98.0) Gecko/20100101 Firefox/98.0',
      Accept:
        'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
      'Accept-Language': 'fr,fr-FR;q=0.8,en-US;q=0.5,en;q=0.3',
      'Content-Type': 'application/x-www-form-urlencoded',
      'Upgrade-Insecure-Requests': '1',
    },
    referrer: 'http://qcm.local/',
    body:
      (question_id == undefined
        ? 'qcm_id=' + qcm_id
        : 'question_id=' + question_id) + '&button=add',
    method: 'POST',
    mode: 'cors',
  });

  // .then((response) => {
  //   return response.text();
  // })
  // .then((data) => {
  //   document.body.innerHTML += data;
  // });
}
