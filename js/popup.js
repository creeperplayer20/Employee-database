// showPopup function
function showPopup(name) {
  $("#" + name).css("display", "block");
  $("#" + name)
    .children()
    .css("display", "block");
}

// hidePopup function
function hidePopup(name) {
  $("#" + name).css("display", "none");
  $("#" + name)
    .children()
    .css("display", "none");
}
