function login_register(username, password, type) {
  let baseUrl = 'http://ec2-13-239-38-4.ap-southeast-2.compute.amazonaws.com/Website/';
  baseUrl += type === 'login' ? 'Login_Staff.php' : 'Register_Staff.php';
  $.ajax({
    method: "POST",
    dataType: "json",
    url: baseUrl,
    data: {
      username,
      password,
    },
  }).done(function(data) {
    if (data.isError === true) {
      alert(`Error: ${data.message}`);
      return data;
    } else {
      alert(`Success: ${data.message}`);
      if (type === 'login') {
        window.location.href = 'ViewContact.html';
      } else {
        window.location.href = 'StaffLogin.html';
      }
    }
  });
}

function loginForm() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  login_register(username, password, 'login');
  return true;
}

function registerForm() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  login_register(username, password, 'register');
  return true;
}
