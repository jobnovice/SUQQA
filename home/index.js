alert("here")

// Get all the "Add to Cart" buttons
// alert("test");
let addToCartButtons = document.getElementsByClassName('add-to-cart-button');


for (let i = 0; i < addToCartButtons.length; i++) {
    addToCartButtons[i].addEventListener('click', function(event) {
        let clickedItemId = this.parentElement.firstElementChild.value;
        //    this.disabled = true;

        //   this.textContent = 'Added to cart';

        alert('Add to Cart clicked for item ID: ' + clickedItemId);
    });
}


txt_search = document.getElementById('input_search');
btn_search = document.getElementById('search-btn');
btn_search.addEventListener('click', search);
const allItems = document.querySelectorAll('.item-card');

function search() {

    result = Array.from(allItems).filter(div => div.textContent.includes(txt_search.value));
    console.log(txt_search.value);
    if (result.length != 0) {
        container = document.querySelector('main');
        container.replaceChildren(...result);
        console.log(result);

        //result.map(res=> container.append( res.parentElement.parentElement));
    } else {
        container = document.querySelector('main');
        container.innerHTML = "";
        msg = document.createElement("h2");
        msg.innerText = "There are no results found!!";
        container.appendChild(msg);
    }
    //console.log(result);
}