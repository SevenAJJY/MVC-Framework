$(document).click(function () {
  $("div.select_checkbox div.options").slideUp();
  $("a.open_controls")
    .html('<i class="fa fa-caret-square-o-left"></i>')
    .css({ color: "#735602" });
  $("div.controls_container").hide();
  $("div.controls_container").css({ top: 6 });
});

$("a.addProduct").click(function (evt) {
  evt.preventDefault();
  if ($("select[name=products]").val() != "") {
    $("div.products_list table").append(
      "<tr><td>" +
        "" +
        "<p>" +
        $("select[name=products] option:selected").text() +
        "</p></td>" +
        '<td><input name="productq[]" onkeyup="checkQuantity(this, \'' +
        $("select[name=products] option:selected").text() +
        "')\" onclick=\"checkQuantity(this, '" +
        $("select[name=products] option:selected").text() +
        '\')" class="input-products" type="number" required min="1" data-quantity="' +
        $("select[name=products] option:selected").attr("data-quantity") +
        '"></td>' +
        '<td><input name="productp[]" class="input-products" type="number" required min="' +
        $("select[name=products] option:selected").attr("data-price") +
        '" value="' +
        $("select[name=products] option:selected").attr("data-price") +
        '">' +
        '<input name="productv[]" type="hidden" value="' +
        $("select[name=products]").val() +
        '"> ' +
        "</td>" +
        '<td><a onclick="removeProduct(this);" href="javascript:void(0);"><i class="fa fa-times"></i></a></td>' +
        "</tr>"
    );
    $("select[name=products] option:selected").remove();
  }
});

function removeProduct(t) {
  var parent = $(t).parent().parent();
  var price = $(parent).find("input[name*=productp]").val();
  var text = $(parent).find("p").text();
  var value = $(parent).find("input[name*=productv]").val();
  $("select[name=products]").append(
    '<option data-price="' +
      price +
      '" value="' +
      value +
      '">' +
      text +
      "</option>"
  );
  $(parent).remove();
}

$("input.purchaseBtn").click(function (evt) {
  if (document.querySelector("input[name*=product]") == null) {
    evt.preventDefault();
    alert(
      "Désolé, vous devez choisir des articles dans la liste et les ajouter à la facture"
    );
  }
});

let iElem = document.createElement("i");
// let checkUserExists =
(function (URL, selector, method, fieldName) {
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
})(
  "http://sevenajjy.com/users/checkuserexistsajax",
  "input[name=Username]",
  "POST",
  "Username"
).then((result) => {});

// usernameField.addEventListener("blur", () => {
//   checkUserExists("http://sevenajjy.com/users/checkuserexistsajax");
// });
