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
const log = console.log;
let errors = new Map();
checkQuantity = (input, pName) => {
  log(input.value);
  log(input.dataset.quantity);

  if (Number.parseInt(input.value) > input.dataset.quantity) {
    input.style.border = "2px solid var(--color-danger)";
    if (!errors.has(pName)) {
      errors.set(pName, input.dataset.quantity);
      showErrors();
    }
  } else {
    if (errors.has(pName)) {
      errors.delete(pName);
      showErrors();
    }
    input.style.border = "2px solid var(--color-success)";
  }
  // let select = document.querySelector("select[name=products]");
  // select.addEventListener("change", (e) => {
  //   const select = e.target;
  //   const desc = select.selectedOptions[0];
  // });
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
