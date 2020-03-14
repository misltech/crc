function check_pass() {
    const pass1 = document.getElementById('pass_1');
    const pass2 = document.getElementById('pass_2');
    const message = document.getElementById('message');
    const submit = document.getElementById('submit');
    if (pass1.value == pass2.value) {
      message.innerHTML = '';
      message.style.display = 'none';
      message.style.visibility = 'hidden';
      submit.disabled = false;
    } else {
      submit.disabled = true;
      message.style.display = 'block';
      message.style.visibility = 'visible';
      message.style.color = 'red';
      message.innerHTML = 'Passwords do not match.';
    }
  }
  