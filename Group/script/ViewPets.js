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
    url: 'http://ec2-13-239-38-4.ap-southeast-2.compute.amazonaws.com/Website/Grabbing_Animals.php',
  }).done(function(data) {
    if (data.isError === true) {
      document.getElementById('pets').innerHTML = "<p class='error'>"+data.message+"</p>";
    } else {
      let table = "<table><tr>";
      table += "<td>ID</td><td>Species</td><td>Breed</td><td>DOB</td>";
      table += "<td>Gender</td><td>PetName</td><td>PetDescription</td><td>Image</td>";
      (data.message).forEach(element => {
        table += "<tr>";
        Object.keys(element).forEach(elementKeys => {
          table += elementKeys === 'PetImage' ? `<td><image width="45" height="45" src="${element[elementKeys]}"/></td>` : `<td>${element[elementKeys]}</td>`;
        });
        table += "</tr>";
      });
      table += "</table>";
      document.getElementById('pets').innerHTML = table;
    }
  });
};