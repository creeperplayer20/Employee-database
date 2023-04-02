// Description: This file contains all the functions that are used to validate the registration form
function validateRegistrationForm() {
  let formValid = true;

  // Get all form elements
  const nameElement = document.forms["registrationForm"]["name"];
  const emailElement = document.forms["registrationForm"]["email"];
  const passwordElement = document.forms["registrationForm"]["password"];
  const passwordConfirmElement =
    document.forms["registrationForm"]["confirmPassword"];
  const companyNameElement = document.forms["registrationForm"]["companyName"];

  // Check if all inputs are valid
  if (!isNameInputValid(nameElement)) formValid = false;
  if (!isPasswordInputValid(passwordElement)) formValid = false;
  if (!isPasswordConfirmVaild(passwordConfirmElement)) formValid = false;
  if (!isEmailInputValid(emailElement)) formValid = false;
  if (!isCompanyNameValid(companyNameElement)) formValid = false;

  // If form is valid, check if there are any XSS attacks and escape special characters
  if (formValid) {
    const name = escapeHtml(nameElement.value);
    const email = escapeHtml(emailElement.value);
    const password = escapeHtml(passwordElement.value);
    const companyName = escapeHtml(companyNameElement.value).escapePHP(
      companyNameElement.value
    );
  }

  return formValid;
}

// Name and surname validation
function isNameInputValid(nameElement) {
  let valid = true;

  const parentElement = nameElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = nameElement.value;
  parentElement.classList.remove("error");

  if (value.length < 3) {
    valid = false;
    errorTextElement.innerHTML = "Name has to be at least 3 characters long!";
  }

  if (value.length > 32) {
    valid = false;
    errorTextElement.innerHTML = "Name is too long!";
  }

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
  }

  if (!validateName(value)) {
    valid = false;
    errorTextElement.innerHTML = "Name can only contain letters!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
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

  // Check if password confirmation is valid
  isPasswordConfirmVaild(document.forms["registrationForm"]["confirmPassword"]);

  return valid;
}

// Password confirmation validation
function isPasswordConfirmVaild(passwordConfirmElement) {
  let valid = true;

  const parentElement = passwordConfirmElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  // Get password element (to compare passwords)
  const passwordElement = document.forms["registrationForm"]["password"];

  const value = passwordConfirmElement.value;
  parentElement.classList.remove("error");

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
  }

  // Check if passwords match
  if (value != passwordElement.value) {
    valid = false;
    errorTextElement.innerHTML = "Passwords do not match!";
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

// Company name validation
function isCompanyNameValid(companyNameElement) {
  let valid = true;

  const parentElement = companyNameElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = companyNameElement.value;
  parentElement.classList.remove("error");

  if (value.length < 3) {
    valid = false;
    errorTextElement.innerHTML =
      "Company name has to be at least 3 characters long!";
  }

  if (value.length > 64) {
    valid = false;
    errorTextElement.innerHTML = "Company name is too long!";
  }

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
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

// Validation for name and surname (letters and diacritics)
function validateName(name) {
  return String(name).match(/^[a-zA-Z\u00C0-\u017F\s]*$/);
}

// XSS = Cross-site scripting filter (html)
function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, "&")
    .replace(/</g, "<")
    .replace(/>/g, ">")
    .replace(/"/g, '"')
    .replace(/'/g, "'");
}

// XSS = Cross-site scripting filter (PHP)
function escapePHP(unsafe) {
  return unsafe
    .replace(/&/g, "&")
    .replace(/</g, "<")
    .replace(/>/g, ">")
    .replace(/"/g, '"')
    .replace(/'/g, "'");
}
