function toogleDisplayFormInsert() {
  form = document.getElementById("form-themSP");
  if (form.classList.contains("d-none")) {
    console.log("2");
    form.classList.remove('d-none');
    form.classList.add("d-block");
  } else if (form.classList.contains("d-block")) {
    form.classList.remove("d-block");
    form.classList.add("d-none");
  }
}