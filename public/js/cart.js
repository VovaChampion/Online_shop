if (document.readyState == 'loading') 
{
    document.addEventListener('DOMContentLoaded', ready)
    console.log("Hello from cart.js")
} else {
    ready()
}
var cart = [];

function ready()
{
    let removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for (let i = 0; i < removeCartItemButtons.length; i++)
    {
        let button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    let quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for(let i = 0; i < quantityInputs.length; i++)
    {
        let input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    let addToCartButtons = document.getElementsByClassName('shop-item-button')
    for(let i = 0; i < addToCartButtons.length; i++)
    {
        let button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }
}

function removeCartItem(event)
{
    let buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChanged(event)
{
    const input = event.target
    if(isNaN(input.value) || input.value <= 0 )
    {
        input.value = 1
    }
    updateCartTotal()
    getTotalPrice()
}

function getCookie(name) 
{
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function deleteCookie()
{
    document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
}

function addToCartClicked(event)
{
    let button = event.target
    let shopItem = button.parentElement.parentElement
    let title = shopItem.getElementsByClassName('shop-item-title')[0].innerText
    let price = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    let id = shopItem.getElementsByClassName('shop-item-id')[0].value
    let qty = shopItem.getElementsByClassName('shop-item-qty')[0].value
    let imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src

   addItemToCart(title, price, imageSrc, id, qty)
   updateCartTotal()
   getTotalPrice()
} 

function addItemToCart(title, price, imageSrc, id, qty) //qty = 1, 
{
    let cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    let cartItems = document.getElementsByClassName('cart-items')[0]
    let cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    let cartItemQty = cartItems.getElementsByClassName('cart-quantity-input')
    //let qty=1;
    for(let i=0; i < cartItemNames.length; i++)
    {
        if(cartItemNames[i].innerText == title)
        {
            //cartItemQty[i].innerText = 1;
            alert('This item is already added to the cart')
            return
        }
    }
    let cartRowContents = `
        <div class="cart-item cart-column">
            <img class="cart-item-image" src="${imageSrc}" width="100" height="100">
            <span class="cart-item-title">${title}</span>
        </div>
        <span class="cart-price cart-column">${price}</span>
        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="${qty}"></input>
            <input class="cart-item-id" type="hidden" value="${id}">
            <button class="btn btn-danger" type="button">REMOVE</button>
        </div>`
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)

    //let cart = getCookie('cart');
    let cartitem = {
        'id': id,
        'title': title,
        'price': price,
        'qty': qty
    };

    cart.push(cartitem);

    document.cookie = "cart=" + JSON.stringify(cart);
    //<input class="cart-quantity-input" type="number" value="1">
}

function updateCartTotal()
{
    const cartItemContainer = document.getElementsByClassName('cart-items')[0]
    const cartRows = cartItemContainer.getElementsByClassName('cart-row')
    let total = 0;
    let totalQuantity = 0;
    for(let i = 0; i < cartRows.length; i++)
    {
        let cartRow = cartRows[i]
        let nameElement = cartRow.getElementsByClassName('cart-item-title')[0]
        let priceElement = cartRow.getElementsByClassName('cart-price')[0]
        let quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        let price = parseFloat(priceElement.innerText.replace('SEK',''))
        let quantity = quantityElement.value
        let name = nameElement.innerText
        // console.log(name)
        total = total + (price * quantity)
        totalQuantity = totalQuantity+Number(quantity)
    }
    total = Math.round(total * 100)/100
    document.getElementById('itemCount').innerText = totalQuantity;
    document.getElementsByClassName('cart-total-price')[0].innerText = 'SEK' +' '+ total;
    //console.log(total)
    
    // create hidden element for Stripe with total price
    
    /*
    let totalPrice = document.createElement('p');
    totalPrice.innerHTML = total;

    let hiddenElem = document.getElementById('payment-form');
    hiddenElem.appendChild(totalPrice);
    */
    
    // let hiddenElements = document.getElementById('payment-form').getElementsByTagName('p');
    // let lastChild = hiddenElements[hiddenElements.length - 1]
    // console.log(lastChild); 

}

function getTotalPrice()
{
    console.log('Get total');
    const myList = document.getElementsByClassName('cart-total-price')[0].lastChild;
    
    const totalPrice = myList.cloneNode(true);
    //console.log(totalPrice);

    const addPrice = document.getElementById('totalPrice').appendChild(totalPrice);

    //console.log(addPrice);
    // const myList = document.getElementsByClassName("cart-total-price");
    // console.log(myList);
    // const listChildren = myList.children;

    // const total = listChildren[0];
    // console.log(total);
    // const totalPrice = total.cloneNode(true);
    // console.log(totalPrice);
}