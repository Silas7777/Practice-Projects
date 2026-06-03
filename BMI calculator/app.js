let btn = document.getElementById("btn");
let height = document.getElementById("height");
let weight = document.getElementById("weight");
let bmiInput = document.getElementById("bmi-result");
const weightCondition = document.getElementById("weight-condition");

function calculateBMI() {
  // console.log("clicked");
  heightVal = height.value / 100;
  weightVal = weight.value;
  // console.log(heightVal, weightVal);

  const bmiVal = weightVal / (heightVal * heightVal);
  // console.log(bmiVal);
  bmiInput.value = bmiVal;

  if (bmiVal < 18.5) {
    weightCondition.innerHTML = "Under Weight";
  } else if (bmiVal >= 18.5 && bmiVal <= 24.9) {
    weightCondition.innerHTML = "Normal Weight";
  } else if (bmiVal >= 25 && bmiVal <= 29.9) {
    weightCondition.innerHTML = "OverWeight";
  } else if (bmiVal <= 30) {
    weightCondition.innerHTML = "Obesity";
  }
}

btn.addEventListener("click", calculateBMI);
