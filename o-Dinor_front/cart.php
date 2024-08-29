<!-- cart.php -->
<div class="card_atc">
  <h1>Your Cart</h1>
  <!-- <div style="overflow-y: auto;"> -->
  <ul class="listCard_atc"></ul>
  <div class="checkOut">
    <div class="total">0</div>
    <div class="closeShopping">Close</div>
  </div>
  <!-- </div> -->
</div>

<script>
  let openShopping = document.querySelector(".btn_add");
  let closeShopping = document.querySelector(".closeShopping");
  let listCard = document.querySelector(".listCard_atc");
  let total = document.querySelector(".total");

  // Initialize the cart from local storage or an empty object
  let listCards = JSON.parse(localStorage.getItem('cart')) || {};

  function addToCart() {
    const selectedColor = document.querySelector('input[name="color"]:checked');
    const selectedSize = document.querySelector('input[name="size"]:checked');

    if (!selectedColor || !selectedSize) {
      alert('Please select both a color and size.');
      return;
    }

    document.body.classList.add("active");
    document.body.style.overflow = "hidden";

    // Get the selected product details
    const productId = <?= json_encode($product_id); ?>;
    const productName = <?= json_encode($product['name']); ?>;
    const productRate = <?= json_encode($product['rate']); ?>;
    const productImage = <?= json_encode($images[0]); ?>;
    const color = selectedColor.value;
    const size = selectedSize.value;

    addToCard(productId, productName, productRate, productImage, color, size);
  }

  function addToCard(id, name, rate, image, color, size) {
    const uniqueKey = `${id}_${color}_${size}`;

    if (!listCards[uniqueKey]) {
      listCards[uniqueKey] = {
        id: id,
        name: name,
        rate: rate,
        image: image,
        color: color,
        size: size,
        quantity: 1
      };
    } else {
      listCards[uniqueKey].quantity += 1;
    }

    saveCart();
    reloadCard();
  }

  function reloadCard() {
    listCard.innerHTML = "";
    let totalPrice = 0;
    let count = 0;

    Object.keys(listCards).forEach(key => {
      const product = listCards[key];
      if (product) {
        totalPrice += product.rate * product.quantity;
        count += product.quantity;

        let newDiv = document.createElement("li");
        newDiv.innerHTML = `
          <div><img src="${product.image}" alt="${product.name}" /></div>
          <div>${product.name}</div>
          <div><span style="display:inline-block; width: 20px; height: 20px; background-color: ${product.color}; border-radius: 50%; border: 1px solid #ccc;"></span></div>
          <div>${product.size}</div>
          <div>LKR ${product.rate}</div>
          <div>${product.quantity}</div>
          <div>
              <button onClick="changeQuantity('${key}', ${product.quantity - 1})">-</button>
              <div class="count">${product.quantity}</div>
              <button onClick="changeQuantity('${key}', ${product.quantity + 1})">+</button>
          </div>
      `;
        listCard.appendChild(newDiv);
      }
    });

    total.innerText = totalPrice.toLocaleString();
  }

  function changeQuantity(key, quantity) {
    if (quantity <= 0) {
      delete listCards[key];
    } else {
      listCards[key].quantity = quantity;
    }
    saveCart();
    reloadCard();
  }

  function saveCart() {
    // Convert the listCards object to a JSON string and save it to localStorage
    localStorage.setItem('cart', JSON.stringify(listCards));
  }

  document.addEventListener('DOMContentLoaded', function () {
    reloadCard();
  });

  document.querySelector(".closeShopping").addEventListener("click", () => {
    document.body.classList.remove("active");
    document.body.style.overflow = "auto";
  });

  function showCart() {
    document.body.classList.add("active");
    document.body.style.overflow = "hidden";
  }
</script>