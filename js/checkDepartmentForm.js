// Description: This file contains the functions that check the department form
function validateDepartmentForm() {
  let formValid = true;

  // Get all form elements
  const departmentNameElement =
    document.forms["departmentForm"]["departmentName"];
  const abbreviationElement = document.forms["departmentForm"]["abbreviation"];
  const cityElement = document.forms["departmentForm"]["city"];

  // Check if all inputs are valid
  if (!isDepartmentNameInputValid(departmentNameElement)) formValid = false;
  if (!isAbbreviationInputValid(abbreviationElement)) formValid = false;
  if (!isCityInputValid(cityElement)) formValid = false;

  // Escape HTML characters
  if (formValid) {
    departmentNameElement.value = escapeHtml(departmentNameElement.value);
    abbreviationElement.value = escapeHtml(abbreviationElement.value);
    cityElement.value = escapeHtml(cityElement.value);
  }

  return formValid;
}

// Department name validation
function isDepartmentNameInputValid(departmentNameElement) {
  let valid = true;

  const parentElement = departmentNameElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = departmentNameElement.value;
  parentElement.classList.remove("error");

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
  }

  if (value.length > 16) {
    valid = false;
    errorTextElement.innerHTML = "Department name is too long!";
  }

  if (!validateSpecialCharacters(value)) {
    valid = false;
    errorTextElement.innerHTML = "Special characters are not allowed!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// Abbreviation validation
function isAbbreviationInputValid(abbreviationElement) {
  let valid = true;

  const parentElement = abbreviationElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = abbreviationElement.value;

  parentElement.classList.remove("error");

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
  }

  if (value.length > 3) {
    valid = false;
    errorTextElement.innerHTML = "Abbreviation is too long!";
  }

  if (value.match(/[^a-zA-Z0-9]/)) {
    valid = false;
    errorTextElement.innerHTML = "Special characters are not allowed!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// City validation
function isCityInputValid(cityElement) {
  let valid = true;

  const parentElement = cityElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = cityElement.value;
  parentElement.classList.remove("error");

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
  }

  if (!validateSpecialCharacters(value)) {
    valid = false;
    errorTextElement.innerHTML = "Special characters are not allowed!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// Special characters validation
function validateSpecialCharacters(value) {
  return String(value).match(/^[a-zA-Z\u00C0-\u017F\s]*$/);
}

// Escape HTML characters
function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, "&")
    .replace(/</g, "<")
    .replace(/>/g, ">")
    .replace(/"/g, '"')
    .replace(/'/g, "'");
}
