var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";

  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }

  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }

  fixStepIndicator(n)
}

function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "" && currentTab!=2) {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}

function activateT1() {
    var checkBox = document.getElementById("Tenure1");
    var input = document.getElementById("inputT1");
    if (checkBox.checked == true){
      input.style.display = "block";
    } else {
       input.style.display = "none";
    }
  }

  function activateT2() {
    var checkBox = document.getElementById("Tenure2");
    var input = document.getElementById("inputT2");
    if (checkBox.checked == true){
      input.style.display = "block";
    } else {
       input.style.display = "none";
    }
  }

  function activateT3() {
    var checkBox = document.getElementById("Tenure3");
    var input = document.getElementById("inputT3");
    if (checkBox.checked == true){
      input.style.display = "block";
    } else {
       input.style.display = "none";
    }
  }

  function activateT4() {
    var checkBox = document.getElementById("Tenure4");
    var input = document.getElementById("inputT4");
    if (checkBox.checked == true){
      input.style.display = "block";
    } else {
       input.style.display = "none";
    }
  }

  function activateT5() {
    var checkBox = document.getElementById("Tenure5");
    var input = document.getElementById("inputT5");
    if (checkBox.checked == true){
      input.style.display = "block";
    } else {
       input.style.display = "none";
    }
  }