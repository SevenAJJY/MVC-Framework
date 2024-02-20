// $(document).click(function () {
//   $("div.select_checkbox div.options").slideUp();
//   $("a.open_controls")
//     .html('<i class="fa fa-caret-square-o-left"></i>')
//     .css({ color: "#735602" });
//   $("div.controls_container").hide();
//   $("div.controls_container").css({ top: 6 });
// });

const wrapper = document.querySelector(".select_wrapper");
const selectBtn = document.querySelector(".select_btn");
const productOptions = document.querySelector(".product_options");
const productSearchBox = document.querySelector(".product_search");
const addBtn = document.querySelector("a.addProduct");
const JSONFILE = "/uploads/data/ProductList.json";
/**
 * We will fetch all products names from database & store them in this empty array
 * @var array
 */
let productNames = [];
let productInfos = [];

// const selectedProduct = "";

if (selectBtn != null) {
  selectBtn.addEventListener("click", (e) => {
    wrapper.classList.toggle("active");
  });
}

/**
 * get all product Names names and store him in  suggestions
 * @returns void
 */
async function getAllCountriesNames() {
  try {
    let response = await fetch(JSONFILE);
    let products = await response.json();

    Object.entries(products).forEach((product) => {
      productInfos.push(product[1]);
      productNames.push(product[1].Name);
      // console.log(product[1]);
    });

    productNames = productNames.sort();
    productInfos = productInfos.sort();
    addProducts(productNames);
  } catch (error) {
    console.log(error);
  }
}

function addProducts(products, selectedLi = "") {
  // productOptions.innerHTML = "";
  // console.log(products);
  if (products != null && products != undefined) {
    Object.entries(products).forEach((product) => {
      console.log(product[1] == selectedLi.innerText ? "selected" : "");
      let isSelected = product[1] == selectedLi.innerText ? "selected" : "";
      let li = `<li onclick="updateName(this)" class="${isSelected}" data-name="${product[1]}" >${product[1]}</li>`;
      if (productOptions != null) {
        productOptions.insertAdjacentHTML("beforeend", li);
      }
    });
  }
}

function updateName(selectedProduct) {
  productSearchBox.value = "";
  addProducts(productNames, selectedProduct);
  wrapper.classList.remove("active");
  selectBtn.firstElementChild.textContent = selectedProduct.innerText;
  selectBtn.firstElementChild.setAttribute(
    "data-name",
    selectedProduct.dataset.name
  );
}

if (productSearchBox != null) {
  productSearchBox.addEventListener("keyup", (e) => {
    let arr = [];
    let searchedValue = e.currentTarget.value.trim().toUpperCase();

    arr = Object.values(productNames)
      .filter((data) => {
        return data.startsWith(searchedValue);
      })
      .map(
        (data) =>
          `<li onclick="updateName(this)" data-name="${data}" >${data}</li>`
      )
      .join("");
    productOptions.innerHTML = arr
      ? arr
      : `<p class="pro-notfound">Oops! product not found</p>`;
  });
}

addBtn.onclick = function () {
  if (selectBtn.firstElementChild.hasAttribute("data-name")) {
    productSelected = selectBtn.firstElementChild.dataset.name;
    console.log(productInfos);
  }
};

getAllCountriesNames();
// addProducts();

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
        '<td><input type="number" name="productp[]" class="input-products" step="0.01" min="0" required  value="' +
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
