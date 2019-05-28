$.makeTable = function (mydata) {
  var table = $('<table border=1>');
  var tblHeader = "<tr>";
  for (var k in mydata[0]) tblHeader += "<th>" + k + "</th>";
  tblHeader += "</tr>";
  $(tblHeader).appendTo(table);
  $.each(mydata, function (index, value) {
      var TableRow = "<tr>";
      $.each(value, function (key, val) {
          TableRow += "<td>" + val + "</td>";
      });
      TableRow += "</tr>";
      $(table).append(TableRow);
  });
  return ($(table));
};

window.onload = () => {
  $.ajax({
    dataType: "json",
    url: 'http://ec2-13-239-38-4.ap-southeast-2.compute.amazonaws.com/Website/run.php?type=GrabbingData',
  }).done(function(data) {
    if (data.isError === true) {
      document.getElementById('contact').innerHTML = "<p class='error'>"+data.message+"</p>";
    } else {
      let table = "<table><tr>";
      table += "<td>Id</td><td>First Name</td><td>Last Name</td><td>Date of Birth</td>";
      table += "<td>Gender</td><td>Street Address</td><td>Suburb/Town</td><td>State</td>";
      table += "<td>Post Code</td><td>Email Address</td><td>Phone Number</td><td>Pet State</td>";
      table += "<td>Comment</td><td>Date</td></tr>";
      (data.message).forEach(element => {
        table += "<tr>";
        Object.keys(element).forEach(elementKeys => {
          table += `<td>${element[elementKeys]}</td>`;
        });
        table += "</tr>";
      });
      table += "</table>";
      document.getElementById('contact').innerHTML = table;
    }
  });
};