// Description: This file contains the functions that check the employee form
function validateEmployeeForm() {
  let formValid = true;

  // Get the values from the form
  const firstNameElement = document.getElementById("firstName").value;
  const lastNameElement = document.getElementById("lastName").value;
  const entryDateElement = document.getElementById("entryDate").value;
  const selectDepartmentElement =
    document.getElementById("selectDepartment").value;

  if (!isFirstNameInputValid(firstNameElement)) formValid = false;
  if (!isLastNameInputValid(lastNameElement)) formValid = false;
  if (!isEntryDateElementValid(entryDateElement)) formValid = false;
  if (!isSelectDepartmentValid(selectDepartmentElement)) formValid = false;

  // If form is valid, check if there are any XSS attacks and escape special characters
  if (formValid) {
    const firstName = escapeHtml(firstNameElement);
    const lastName = escapeHtml(lastNameElement);
  }

  return formValid;
}

// First name validation
function isFirstNameInputValid(firstNameElement) {
  let valid = true;

  const parentElement = firstNameElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = firstNameElement.value;
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

  if (!validateSpecialCharacters(value)) {
    valid = false;
    errorTextElement.innerHTML = "Name can only contain letters!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// Last name validation
function isLastNameInputValid(lastNameElement) {
  let valid = true;

  const parentElement = lastNameElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = lastNameElement.value;
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

  if (!validateSpecialCharacters(value)) {
    valid = false;
    errorTextElement.innerHTML = "Name can only contain letters!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// Entry date validation
function isEntryDateElementValid(entryDateElement) {
  let valid = true;

  const parentElement = entryDateElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = entryDateElement.value;
  parentElement.classList.remove("error");

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
  }

  if (!valid) parentElement.classList.add("error");

  return valid;
}

// Select department validation
function isSelectDepartmentValid(selectDepartmentElement) {
  let valid = true;

  const parentElement = selectDepartmentElement.parentElement;
  const errorTextElement = parentElement.querySelector(".error-text");

  const value = selectDepartmentElement.value;
  parentElement.classList.remove("error");

  if (value.length === 0) {
    valid = false;
    errorTextElement.innerHTML = "Field is required!";
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
