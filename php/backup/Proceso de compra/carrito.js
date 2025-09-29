let cart = [];
let total = 0;

function addToCart(productName, productPrice) {
    cart.push({ name: productName, price: productPrice });
    updateCart();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
}

function updateCart() {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';
    total = 0;

    cart.forEach((item, index) => {
        total += item.price;
        const li = document.createElement('li');
        li.innerHTML = `${item.name} - ₱ ${item.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")} <button onclick="removeFromCart(${index})">Eliminar</button>`;
        cartItems.appendChild(li);
    });

    document.getElementById('total').innerText = `Total: ₱ ${total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`;
}

function checkout() {
    if (cart.length === 0) {
        alert(" Estimado cliente. Su carrito está vacío Error de compra.");
        return;
        
    }
    alert("Estimado cliente. Su transacción fue exitosa");
    return;
}