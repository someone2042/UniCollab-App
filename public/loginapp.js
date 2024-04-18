// const sign_in_btn = document.querySelector("#sign-in-btn");
// const sign_up_btn = document.querySelector("#sign-up-btn");
// const container = document.querySelector(".container");

// sign_up_btn.addEventListener("click", () => {
//   container.classList.add("sign-up-mode");
// });

// sign_in_btn.addEventListener("click", () => {
//   container.classList.remove("sign-up-mode");
// });
const container = document.querySelector(".container");
const signUpBtn = document.querySelector("#sign-up-btn");
const signInBtn = document.querySelector("#sign-in-btn");

// Check for stored preference on page load
const signUpMode = localStorage.getItem("sign-up-mode");

if (signUpMode === "true") {
  container.classList.add("sign-up-mode");
} else {
  container.classList.remove("sign-up-mode");
}

signUpBtn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
  localStorage.setItem("sign-up-mode", true); // Store preference
});

signInBtn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
  localStorage.setItem("sign-up-mode", false); // Store preference
});