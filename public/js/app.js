// per il debug
const log = console.log;
const image = document.querySelector(".upload-image");
const inputFile = document.querySelector("input[type=file]");
const divContainer = document.querySelector(".image__upload");
const togglePass2 = document.querySelector(".togglePass2"),
  input2 = document.querySelector(".input2");
const menuBtn = document.getElementById("menu-btn");
const navBar = document.getElementById("navbar");
const menu_n = document.querySelector(".menu-n");
const bHidden = document.querySelector("body");
const burger = document.querySelector(".menu-icon-n");
const homeContent = document.querySelector(".home-content");
const body = document.querySelector("body"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");
const togglePass = document.querySelector(".togglePass"),
  input = document.querySelector(".input");
const offset = 50;

let darkMode = localStorage.getItem("darkMode");
let arrow = document.querySelectorAll(".arrow");
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
let imageBtn = document.querySelector(".image");

let showHideImageBox = () => {
  if (image != null) {
    if (image.dataset.action == "create") {
      divContainer.classList.add("hide");
    }
  }
};

showHideImageBox();
if (inputFile !== null) {
  inputFile.addEventListener("change", (e) => {
    divContainer.classList.remove("hide");
    image.src = URL.createObjectURL(e.target.files[0]);
  });
}

/**
 *  ===================================
 *  ========== Navbar Menu ============
 *  ===================================
 * */

menuBtn.addEventListener("click", () => {
  menu_n.classList.toggle("menu-n-open");
  bHidden.classList.toggle("element-none");
  if (bHidden.classList.contains("element-none")) {
    homeContent.style.transitionDelay = ".1s";
  } else {
    homeContent.style.transitionDelay = ".7s";
  }
});

burger.addEventListener("click", () => {
  burger.classList.toggle("burger__close");
});

window.addEventListener("scroll", () => {
  if (pageYOffset > offset) {
    navBar.classList.add("navbar-active");
  } else {
    navBar.classList.remove("navbar-active");
  }
});

/**
 *  ===============================
 *  ========== Dark Mode ==========
 *  ===============================
 * */

/**
 *  Check if dark mode is enabled
 *  if it's enabled, turn it off
 *  if it's disabled, turn it on
 */
const enableDarkMode = () => {
  // add the class dark to the body
  document.body.classList.add("dark");
  // update darkMode in the localStorage
  localStorage.setItem("darkMode", "enabled");
};

const disableDarkMode = () => {
  // add the class dark to the body
  document.body.classList.remove("dark");
  // update darkMode in the localStorage
  localStorage.setItem("darkMode", null);
};

if (darkMode === "enabled") {
  enableDarkMode();
}

modeSwitch.addEventListener("click", () => {
  if (body.classList.contains("dark")) {
    modeText.innerText = "Light Mode";
  } else {
    modeText.innerText = "Dark Mode";
  }

  darkMode = localStorage.getItem("darkMode");

  if (darkMode !== "enabled") {
    enableDarkMode();
  } else {
    disableDarkMode();
  }
});

/**
 *  ===============================
 *  ========== Sidebar ==========
 *  ===============================
 * */

for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e) => {
    let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
  });
}

sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});
imageBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

/**
 *  ===============================
 *  ======== Password eyes ========
 *  ===============================
 * */

if (togglePass !== null) {
  togglePass.onclick = () => {
    if (input.type === "password") {
      input.type = "text";
      togglePass.classList.replace("fa-eye-slash", "fa-eye");
    } else {
      input.type = "password";
      togglePass.classList.replace("fa-eye", "fa-eye-slash");
    }
  };
}
/**
 *  ===============================
 *  ==== Confirm Password eyes ====
 *  ===============================
 * */

if (togglePass2 !== null) {
  togglePass2.addEventListener("click", () => {
    if (input2.type === "password") {
      input2.type = "text";
      togglePass2.classList.replace("fa-eye-slash", "fa-eye");
    } else {
      input2.type = "password";
      togglePass2.classList.replace("fa-eye", "fa-eye-slash");
    }
  });
}

/**
 *  ===================================
 *  ===== Ajax Check User Exists ======
 *  ===================================
 * */

// (function () {
//   let userNameField = document.querySelector("input[name=Username]");

//   if (null !== userNameField) {
//     userNameField.addEventListener(
//       "blur",
//       function () {
//         let req = new XMLHttpRequest();
//         req.open("POST", "http://sevenajjy.com/users/checkuserexistsajax");
//         req.setRequestHeader(
//           "Content-type",
//           "application/x-www-form-urlencoded"
//         );

//         req.onreadystatechange = function () {
//           let iElem = document.createElement("i");
//           let borderInput = document.querySelector(".Username");
//           if (req.readyState == req.DONE && req.status == 200) {
//             if (req.response == 1) {
//               iElem.className = "fa-solid fa-circle-xmark u-error";
//               borderInput.classList.toggle("borderError");
//             } else if (req.response == 2) {
//               if (userNameField.value !== "") {
//                 iElem.className = "fa-solid fa-circle-check u-success";
//                 borderInput.classList.toggle("bordersuccess");
//               }
//             }
//             let iElems = userNameField.parentNode.childNodes;
//             for (let i = 0, ii = iElems.length; i < ii; i++) {
//               if (iElems[i].nodeName.toLowerCase() == "i") {
//                 iElems[i].parentNode.removeChild(iElems[i]);
//               }
//             }
//             userNameField.parentNode.appendChild(iElem);
//           }
//         };

//         req.send("Username=" + this.value);
//       },
//       false
//     );
//   }
// })();
/**
 *  ===================================
 *  ===== Ajax Check Email Exists ======
 *  ===================================
 * */

// (function () {
//   let emailField = document.querySelector("input[name=Email]");
//   if (null !== emailField) {
//     emailField.addEventListener(
//       "blur",
//       function () {
//         let req_2 = new XMLHttpRequest();
//         req_2.open("POST", "http://sevenajjy.com/users/checkemailexistsajax");
//         req_2.setRequestHeader(
//           "Content-type",
//           "application/x-www-form-urlencoded"
//         );

//         req_2.onload = function () {
//           let iElem_2 = document.createElement("i");
//           log(req_2.response);
//           if (req_2.readyState == req_2.DONE && req_2.status == 200) {
//             if (req_2.response == 1) {
//               iElem_2.className = "fa-solid fa-circle-xmark u-error";
//             } else if (req_2.response == 2) {
//               iElem_2.className = "fa-solid fa-circle-check u-success";
//             }
//             let iElems_2 = emailField.parentNode.childNodes;
//             for (let i = 0, ii = iElems_2.length; i < ii; i++) {
//               if (iElems_2[i].nodeName.toLowerCase() == "i") {
//                 iElems_2[i].parentNode.removeChild(iElems_2[i]);
//               }
//             }
//             emailField.parentNode.appendChild(iElem_2);
//           }
//         };

//         req_2.send("Email=" + this.value);
//       },
//       false
//     );
//   }
// })();

/**
 *  ===================================
 *  ========== Profile Menu ===========
 *  ===================================
 * */

function menuToggle() {
  const toggleMenu = document.querySelector(".u-menu");
  toggleMenu.classList.toggle("active");
}

/**
 *  ===================================
 *  ====== Validation Receipt =========
 *  ===================================
 * */

function validateReceipt(s1, s2, s3, s4, s5) {
  let paymentType = document.getElementById(s1);
  let namkName = document.getElementById(s2);
  let bankAccountNumber = document.getElementById(s3);
  let checkNumber = document.getElementById(s4);
  let transferedTo = document.getElementById(s5);

  let bankname_input = document.getElementById("bankname");
  let checknumber_input = document.getElementById("checknumber");
  let bankaccountnumber_input = document.getElementById("bankaccountnumber");
  let transferedto_input = document.getElementById("transferedto");

  if (paymentType.value == 1) {
    namkName.disabled = false;
    namkName.style.display = "block";

    checkNumber.disabled = false;
    checkNumber.style.display = "block";

    bankAccountNumber.disabled = false;
    bankAccountNumber.style.display = "none";
    bankaccountnumber_input.removeAttribute("required");

    transferedTo.disabled = false;
    transferedTo.style.display = "none";
    transferedto_input.removeAttribute("required");
  } else if (PaymentType.value == 2) {
    checkNumber.disabled = true;
    checkNumber.style.display = "none";
    checknumber_input.removeAttribute("required");

    bankAccountNumber.disabled = false;
    bankAccountNumber.style.display = "block";

    transferedTo.disabled = false;
    transferedTo.style.display = "block";

    namkName.disabled = false;
    namkName.style.display = "block";
  } else if (PaymentType.value == 3) {
    bankAccountNumber.disabled = true;
    bankAccountNumber.style.display = "none";
    bankaccountnumber_input.removeAttribute("required");

    transferedTo.disabled = true;
    transferedTo.style.display = "none";
    transferedto_input.removeAttribute("required");

    checkNumber.disabled = true;
    checkNumber.style.display = "none";
    checknumber_input.removeAttribute("required");

    namkName.disabled = true;
    namkName.style.display = "none";
    bankname_input.removeAttribute("required");
  }
}

/**
 *  ===================================
 *  ====== Check product Quantity =========
 *  ===================================
 * */

let errors = new Map();
checkQuantity = (input, pName) => {
  if (Number.parseInt(input.value) > input.dataset.quantity) {
    input.style.border = "2px solid var(--color-danger)";
    if (!errors.has(pName)) {
      errors.set(pName, input.dataset.quantity);
      showErrors();
    }
  } else {
    deleteErrors(pName);
    input.style.border = "2px solid var(--color-success)";
  }
};

let deleteErrors = (productName) => {
  if (errors.has(productName)) {
    errors.delete(productName);
    showErrors();
  }
};

let showErrors = () => {
  let errorsContainer = document.querySelector(".quantity__errors");
  errorsContainer.innerHTML = "";
  if (errors.size != 0) {
    for (const [key, value] of errors.entries()) {
      let span = document.createElement("span");
      span.className = "quantity_error";
      span.innerHTML = `
          <i class="fa-solid fa-circle-exclamation check _icon-message t2"></i>
          The quantity written for the product <code>${key}</code> is greater than the quantity available in stock (<code>${value}</code>)
      `;
      errorsContainer.appendChild(span);
    }
  }
};

let salesForm = document.querySelector(".check");
if (salesForm != null) {
  salesForm.onclick = (event) => {
    if (errors.size != 0) event.preventDefault();
  };
}
