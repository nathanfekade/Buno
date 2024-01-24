const inputs = document.querySelectorAll("input");
const form = document.getElementById("form");
const errors = document.querySelectorAll(".sign-up div span:last-child");

console.log(form);

form.addEventListener("submit", (e) => {
  inputs.forEach((input) => {
    if (input.value === "" || input.value == null) {
      errors.forEach((error) => {
        error.style.display="inline"
    }) 
    }
    else {
      errors.forEach((error) => {
        error.style.display="none";
      })
    }
    // e.preventDefault();

  });
  e.preventDefault();
});
