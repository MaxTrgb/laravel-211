import axios from "axios";

const modal = document.getElementById('modal');
const openModalButton = document.getElementById('openModal');
const closeModalButton = document.getElementById('closeModal');

openModalButton.addEventListener('click', () => {
    modal.classList.remove('hidden');
});
closeModalButton.addEventListener('click', () => {
    modal.classList.add('hidden');
});
modal.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.classList.add('hidden');
    }
});

if (document.querySelector('.add-to-cart-btn')) {
    document.querySelector('.add-to-cart-btn').addEventListener('click', function () {
        const id = this.dataset.id;

        axios.get(`/cart/add-product/${id}`)
            .then(function (response) {
                showCartBody(response.data);
            })
    });
}

document.querySelector('.cart-body').addEventListener('click', async (e) => {
    if (e.target.classList.contains('remove-product-btn')) {
        const id = e.target.dataset.id;

        const response = await axios.delete(`/cart/remove-product/${id}`);
        showCartBody(response.data);

    }
});

document.querySelector('.clear-cart').addEventListener('click', async () => {
    const response = await axios.delete('/cart/clear');
    showCartBody(response.data)
});


const showCartBody = (cart) => {
    document.querySelector('.cart-body').innerHTML = cart;
    modal.classList.remove('hidden');
}
document.querySelectorAll('.update-cart-btn').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.dataset.id;
        const action = this.dataset.action;

        axios.post('/cart/update', { id: productId, action: action })
            .then(response => {
                showCartBody(response.data.cart);
                document.querySelector('.total-sum').textContent = response.data.totalSum;
            })
            .catch(error => console.error('Error updating cart:', error));
    });
});

