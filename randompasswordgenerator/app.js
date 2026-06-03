const btnEl = document.getElementById("btn");

const inputEl = document.getElementById("input");

const copyIcon = document.querySelector(".fa-copy");

const alertContainerEl = document.querySelector(".alert-container");

btnEl.addEventListener("click", () => {
  alertContainerEl.classList.remove("active"); // removing the active class of the alert

  createPassword();
});

function createPassword() {
  const chars =
    "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ"; //password format text 

  const passwordLength = 14;// desire password lenght

  let password = "";// make the input field empty at the start.

  for (let index = 0; index < passwordLength; index++) {
    const randomNum = Math.floor(Math.random() * chars.length); //to generate randomly
    password += chars.substring(randomNum, randomNum + 1); //generate random password for the desire string
  }

  inputEl.value = password;// 
  alertContainerEl.innerText = inputEl.value + " copied!";// output the alert message
}

copyIcon.addEventListener("click", () => {
  copyPassword();

  if (inputEl.value) {
    
    alertContainerEl.classList.add("active");// adding the active class of the alert

    setTimeout(() => {
      alertContainerEl.classList.remove("active"); // adding the timer to the alert message.
    }, 2000);// 2000 means 2s
  }
});

function copyPassword() {
  inputEl.select(); //select method for web
  inputEl.setSelectionRange(0, 9999); //select method for mobile
  navigator.clipboard.writeText(inputEl.value); // copy to clipboard function
}
