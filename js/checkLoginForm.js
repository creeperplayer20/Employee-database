// Description: This file contains the functions that validate the login form
function validateLoginForm() {
  let formValid = true;

  // Get all form elements
  const emailElement = document.forms["loginForm"]["email"];
  const passwordElement = document.forms["loginForm"]["password"];

  // Check if all inputs are valid
  if (!isEmailInputValid(emailElement)) formValid = false;
  if (!isPasswordInputValid(passwordElement)) formValid = false;

  return formValid;
}

// Password validation
function isPasswordInputValid(passwordElement) {
  let valid = true;

  const parentElement = passwordElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = passwordElement.value;
  parentElement.classList.remove("error");

  if (value.length < 8) {
    valid = false;
    errorTextElement.innerHTML =
      "Password has to be at least 8 characters long!";
  }

  if (value.length > 32) {
    valid = false;
    errorTextElement.innerHTML = "Password is too long!";
  }

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// Email validation
function isEmailInputValid(emailElement) {
  let valid = true;

  const parentElement = emailElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = emailElement.value;
  parentElement.classList.remove("error");

  // Check if email is valid (special characters and spaces)
  if (!validateEmail(value)) {
    valid = false;
    errorTextElement.innerHTML = "Invalid email";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// Email validation for special characters and spaces (RFC 5322)
function validateEmail(email) {
  return String(email).match(
    /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/
  );
}
