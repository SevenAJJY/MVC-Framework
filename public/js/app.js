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
 *  ======================================
 *  === AJAX Check User & Email Exists ===
 *  ======================================
 * */

let iElem = document.createElement("i");
let check_user_email = function (URL, selector, method, fieldName) {
  return new Promise((resolve, reject) => {
    let inputField = document.querySelector(selector);
    if (inputField !== null) {
      inputField.addEventListener(
        "blur",
        function () {
          let request = new XMLHttpRequest();
          request.open(method, URL);
          request.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );

          request.onload = function () {
            if (request.readyState == request.DONE && request.status == 200) {
              if (request.response == 1) {
                iElem.className = "fa-solid fa-circle-xmark u-error";
                if (inputField.classList.contains("bordersuccess")) {
                  inputField.classList.remove("bordersuccess");
                  inputField.classList.add("borderError");
                }
                inputField.classList.add("borderError");
              } else if (request.response == 2) {
                if (inputField.value !== "") {
                  if (inputField.classList.contains("borderError")) {
                    inputField.classList.remove("borderError");
                    inputField.classList.add("bordersuccess");
                  }
                  iElem.className = "fa-solid fa-circle-check u-success";
                  inputField.classList.add("bordersuccess");
                }
              }
              let iElems = inputField.parentNode.childNodes;
              for (let i = 0, ii = iElems.length; i < ii; i++) {
                if (iElems[i].nodeName.toLowerCase() == "i") {
                  iElems[i].parentNode.removeChild(iElems[i]);
                }
              }
              inputField.parentNode.appendChild(iElem);
            }
            // else {
            //   reject(Error("User already exists!"));
            // }
          };
          request.send(`${fieldName}=` + this.value);
        },
        false
      );
    }
  });
};

check_user_email(
  "http://sevenajjy.com/users/checkuserexistsajax",
  "input[name=Username]",
  "POST",
  "Username"
).then((result) => {});

check_user_email(
  "http://sevenajjy.com/users/checkemailexistsajax",
  "input[name=Email]",
  "POST",
  "Email"
).then((result) => {});

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

/**
 *  =======================================
 *  =========== Style Switcher ============
 *  =======================================
 * */

// Theme color
(() => {
  const hueSlider = document.querySelector(".js-hue-slider");
  const html = document.querySelector("html");

  const setHue = (value) => {
    html.style.setProperty("--hue", value);
    document.querySelector(".js-hue").innerHTML = value;
  };

  if (hueSlider != null) {
    hueSlider.addEventListener("input", function () {
      setHue(this.value);
      window.localStorage.setItem("--hue", this.value);
    });
  }

  const slider = (value) => {
    hueSlider.value = value;
  };

  if (window.localStorage.getItem("--hue") !== null) {
    setHue(window.localStorage.getItem("--hue"));
    slider(window.localStorage.getItem("--hue"));
  } else {
    const hue = getComputedStyle(html).getPropertyValue("--hue");
    setHue(hue);
    slider(hue.split(" ").join(""));
  }
})();

const styleSwitcherToggle = () => {
  const styleSwitcher = document.querySelector(".js-style-switcher");
  const styleSwitcherToggler = document.querySelector(
    ".js-style-switcher-toggler"
  );

  styleSwitcherToggler.addEventListener("click", function () {
    styleSwitcher.classList.toggle("open");
    if (styleSwitcher.classList.contains("open")) {
      this.innerHTML = `
        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="style__switcher-toggler-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M289.94 256l95-95A24 24 0 00351 127l-95 95-95-95a24 24 0 00-34 34l95 95-95 95a24 24 0 1034 34l95-95 95 95a24 24 0 0034-34z"></path></svg>
        `;
    } else {
      this.innerHTML = `<svg
      stroke="currentColor"
      fill="none"
      stroke-width="1.5"
      viewBox="0 0 24 24"
      aria-hidden="true"
      class="style__switcher-toggler-icon"
      height="1em"
      width="1em"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"
      ></path>
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
      ></path>
    </svg>`;
    }
  });
};
styleSwitcherToggle();

const themeColor = () => {
  const darkModeCheckbox = document.querySelector(".js-dark-mode");
  const themeMode = () => {
    if (window.localStorage.getItem("darkMode") === "null") {
      window.localStorage.setItem("darkMode", "enabled");
      document.body.classList.add("dark");
    } else {
      window.localStorage.setItem("darkMode", null);
      document.body.classList.remove("dark");
    }
  };

  darkModeCheckbox.addEventListener("click", function () {
    themeMode();
  });

  if (document.body.classList.contains("dark")) {
    darkModeCheckbox.checked = true;
  }
};
themeColor();

// show & hide style switcher
const showHideStyleSwitcher = function () {
  const inputCheckBox = document.querySelector("#displayStyleSwitcher");
  const styleSwitcher = document.querySelector(".js-style-switcher");

  if (inputCheckBox !== null) {
    inputCheckBox.addEventListener("click", (e) => {
      window.localStorage.setItem("DSS", e.target.checked);
      switchDisplay();
    });
  }

  const switchDisplay = () => {
    if (window.localStorage.getItem("DSS") === "true") {
      styleSwitcher.classList.add("styleSwitcherShow");
    } else {
      styleSwitcher.classList.remove("styleSwitcherShow");
    }
  };
  switchDisplay();

  if (inputCheckBox !== null) {
    if (styleSwitcher.classList.contains("styleSwitcherShow")) {
      inputCheckBox.checked = window.localStorage.getItem("DSS");
    }
  }
};
showHideStyleSwitcher();

/**
 *  Choose ' the statistics ' that will appear in the dashboard
 */
let errorsContainer = document.querySelector(".check_errors");
let allLiChoices = document.querySelectorAll(".settings_bottom li");
if (document.querySelector(".settings_bottom") != null) {
  document.querySelector(".settings_bottom").onclick = () => {
    let choicesChckd = document.querySelectorAll(
      ".settings_bottom [data-checked='checked']"
    );

    if (choicesChckd.length > 4) {
      errorsContainer.innerHTML =
        "― You can choose only four statistics to display in the control panel";
      errorsContainer.style.display = "block";
    } else {
      errorsContainer.innerHTML = "";
      errorsContainer.style.display = "none";
      let arr = [];
      choicesChckd.forEach((e) => {
        arr.push(e.dataset.stats);
      });

      log(arr);
      storeInLS(arr);
    }
  };
}

allLiChoices.forEach((li) => {
  li.addEventListener("click", (ele) => {
    if (!ele.currentTarget.dataset.checked) {
      ele.currentTarget.style.backgroundColor = "var(--main-color)";
    } else {
      ele.currentTarget.style.backgroundColor = "var(--color-stats-bg)";
    }
  });
});

/**
 * function to store data in local storage
 * @param array
 * @return void
 */
function storeInLS(arr) {
  console.log();
  window.localStorage.setItem("stats", JSON.stringify(arr));
}

if (
  localStorage.getItem("stats") == "[]" &&
  localStorage.getItem("stats") == null
) {
  storeInLS(["Users", "Sales", "Purchases", "Clients"]);
}

/**
 * function to get data from local storage
 * @return object
 */
function getFromLS(key) {
  if (window.localStorage.getItem(key) != null)
    return JSON.parse(window.localStorage.getItem(key));
}

function checkedInput() {
  let data = getFromLS("stats");
  allLiChoices.forEach((li) => {
    data.forEach((stats) => {
      if (stats === li.dataset.stats) {
        li.style.backgroundColor = "var(--main-color)";
      } else {
        li.style.backgroundColor = "var(--color-stats-bg)";
      }
    });
  });
  console.log(allLiChoices);
}
checkedInput();
