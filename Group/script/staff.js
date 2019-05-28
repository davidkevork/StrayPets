function login_register(username, password, type) {
  let baseUrl = 'http://ec2-13-239-38-4.ap-southeast-2.compute.amazonaws.com/Website/run.php';
  $.ajax({
    method: "POST",
    dataType: "json",
    url: baseUrl,
    data: {
      username,
      password,
      type,
    },
  }).done(function(data) {
    if (data.isError === true) {
      alert(`Error: ${data.message}`);
      return data;
    } else {
      alert(`Success: ${data.message}`);
      if (type === 'LoginStaff') {
        window.location.href = 'ViewContact.html';
      } else {
        window.location.href = 'StaffLogin.html';
      }
    }
  });
}

function submitForm() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const type = document.getElementById('type').value;
  login_register(username, password, type);
  return true;
}