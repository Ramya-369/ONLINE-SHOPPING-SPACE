let pincodes = [521201,521202,521203,521204,521205];
let pincodeBtn = document.querySelector(".pincode-checker-btn");
pincodeBtn.addEventListener("click", checkPincode);
function checkPincode(){
let message = document.querySelector(".message");
let pincodeValue = document.querySelector(".pincode").value;
let value = Number(pincodeValue);
// console.Log(value); O
if(pincodes.includes(value)){
let html;
html = `<h3>${value} is available for delivery </h3>`;
message.innerHTML = html;
message.style.color ="green";
}
else{
let html;
html = `<h3> oops woops we have not started deliver on this ${value} pincode </h3>`;
message.innerHTML = html;
message.style.color = "red";
}
}