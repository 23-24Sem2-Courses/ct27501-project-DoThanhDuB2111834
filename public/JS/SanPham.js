function toogleDisplayFormInsert() {
  form = document.getElementById("form-themSP");
  if (form.classList.contains("d-none")) {
    console.log("2");
    form.classList.remove("d-none");
    form.classList.add("d-block");
  } else if (form.classList.contains("d-block")) {
    form.classList.remove("d-block");
    form.classList.add("d-none");
  }
}

function sortTableSanPham() {
  var order = document.getElementById("inputOrderSanPham").value;
  var table = document.getElementById("body-sanPhamTable");
  var rows = Array.from(table.rows);
  rows.sort(function (a, b) {
    var aValue = a.cells[4].textContent;
    var bValue = b.cells[4].textContent;
    return aValue.localeCompare(bValue);
  });
  if (order == "asc"){
    for (var i = 0; i < rows.length; i++) {
      table.appendChild(rows[i]);
    }
  }
  else if (order == "desc") {
    for (var i = rows.length - 1; i >= 0; i--) {
      table.appendChild(rows[i]);
    }
  }
}
