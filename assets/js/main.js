const add_cart = document.querySelectorAll(".add_cart");
const form_cart = document.querySelector("#checkOutForm");
const check_out_btn = document.querySelector("#checkOutBtn");

if (add_cart) {
    add_cart.forEach(btn => {
        btn.addEventListener('click', () => {
            let added_item = btn.parentNode.cloneNode(true);
            btn.parentNode.classList.add('disabledbtn');
            form_cart.prepend(added_item);
            // Remove dislabed button in the cloned element
            added_item.children[4].removeAttribute('disabled');
            // Remove Cart Function
            removeCart();
            // Remove dsiabled button for proceed to check out btn
            check_out_btn.removeAttribute('disabled');
        });
    });
}

function removeCart() {

    const remove_cart = document.querySelectorAll('.remove_cart');

    if (remove_cart) {
        remove_cart.forEach(element => {
            element.addEventListener('click', () => {
                let id = element.getAttribute('id');
                added_item = document.querySelector("#parent_" + id).classList.remove('disabledbtn');
                element.parentNode.remove();
            });
        });
    }
}