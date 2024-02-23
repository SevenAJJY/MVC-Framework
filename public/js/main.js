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
 * @returns
 */
window.onload = async function () {
  try {
    let response = await fetch(JSONFILE);
    let products = await response.json();

    Object.entries(products).forEach((product) => {
      productInfos.push(product[1]);
      productNames.push(product[1].Name);
    });

    productInfos = productInfos.sort();

    addProducts();
  } catch (error) {
    console.log(error);
  }
};

function addProducts() {
  if (productOptions != null) productOptions.innerHTML = "";
  productNames = productNames.sort();
  if (productNames != null && productNames != undefined) {
    Object.entries(productNames).forEach((product) => {
      let li = `<li onclick="updateName(this)" data-name="${product[1]}" >${product[1]}</li>`;
      if (productOptions != null) {
        productOptions.insertAdjacentHTML("beforeend", li);
      }
    });
  }
}

function updateName(selectedProduct) {
  productSearchBox.value = "";
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

if (addBtn != null) {
  addBtn.onclick = function () {
    if (
      selectBtn.firstElementChild !== null &&
      selectBtn.firstElementChild.hasAttribute("data-name") &&
      selectBtn.firstElementChild.getAttribute('"data-name"') !== ""
    ) {
      productSelected = selectBtn.firstElementChild.dataset.name;
      let filtered = Object.values(productInfos).filter(function (product) {
        let productObj = product.Name == productSelected ? product : "";
        return productObj;
      });
      const productList = document.querySelector(
        "div.products_list table tbody"
      );
      if (filtered.length > 0) {
        let productInTable = `
          <tr>
            <td><p>${filtered[0].Name}</p></td>
            <td><input name="productq[]" onkeyup="checkQuantity(this,'${filtered[0].Name}')" onclick="checkQuantity(this,'${filtered[0].Name}')" class="input-products" type="number" required min="1" data-quantity="${filtered[0].Quantity}"></td>
            <td><input name="productp[]" type="number"  class="input-products" step="0.01" min="0" required  value="${filtered[0].SellPrice}"></td>
            <td><input name="productv[]" type="hidden" value="${filtered[0].ProductId}">
            <a onclick="removeProduct(this);" href="javascript:void(0);"><i class="fa fa-times"></i></a></td>
          </tr>
        `;
        productList.insertAdjacentHTML("beforeend", productInTable);
        /**
         * REMOVE THE PRODUCT SELECTED FROM THE SELECT LIST
         */
        productNames = Object.values(productNames).filter((product) => {
          return product != filtered[0].Name;
        });

        selectBtn.innerHTML = `<span>Select Product</span>`;

        addProducts();
      }
    }
  };
}

function removeProduct(product) {
  let parent = product.parentElement.parentElement;
  let productName;
  if (parent != null) {
    productName = parent.querySelector("td p").innerText;
  }
  productNames.push(productName);
  addProducts();
  parent.remove();
}
