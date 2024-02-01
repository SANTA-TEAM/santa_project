/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import { data } from 'jquery';
import './styles/app.scss';
import 'bootstrap/dist/js/bootstrap.bundle';

const giftForm = document.getElementById('giftForm');
const fields = document.querySelectorAll('#giftForm select');

const idOrder = document.getElementById('gift_filter_order');
const idAge = document.getElementById('gift_filter_age');
const idCat = document.getElementById('gift_filter_category');

const giftContainer = document.getElementById('gift-list');
let removeButton = document.querySelectorAll('.remove-gift');


fields.forEach((field) => {
  field.addEventListener('change', (e) => {

    let order = idOrder.value;
    let age = idAge.value;
    let category = idCat.value;

    order = order === '' ? 'null' : order;
    age = age === '' ? 'null' : age;
    category = category === '' ? 'null' : category;

    const url = '/cadeaux/filtre';

    const body = {
      order: order,
      age: age,
      category: category
    };

    console.log(body);
    const fetchResponse = fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(body)
    })
      .then((res) => {
        console.log(res);
        return res.json();
      })
      .then((datas) => {
        console.log(datas);
        giftList.innerHTML = '';
        for (data of datas) {
          console.log(data);
          let html = document.createElement('div');
          html.classList.add('p-2', 'col-6', 'col-md-4');
          html.innerHTML = `

              <div style="height: 200px;" class="position-relative rounded-1">
                <img class="z-n1 object-fit-cover top-0 start-0 h-100 w-100 position-absolute" src="uploads/reindeers/0c783d4036aabf5952329468830bd63b.png" alt="photo de {{ gift.name }}" />
                <h3 class="position-absolute bottom-0 w-100 start-0 bg-dark bg-opacity-25 text-white px-3 py-1 mt-5 mb-0"> ${data.name}</h3>
              `;
          const giftList = document.getElementById('giftList');
          giftList.append(html);
        }
      })
      .catch((err) => {
        console.log(err);
      });
  });
})

removeButton.forEach((clickedButton) => {
  clickedButton.addEventListener('click', () => {
    const url = '/letter';
    console.log(url);
    let cart = [];

    const body = {};

    removeButton.forEach((button, index) => {
      if (button.id !== clickedButton.id) {
        cart.push(button.id)
        body[index] = button.id
      }
    })

    const updateGift = fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(body)
    })
      .then((res) => {
        console.log(res);
        return res.json();
      })
      .then((datas) => {
        console.log(datas)
        clickedButton.parentElement.remove();
      })
      .then(() => { 
        removeButton = document.querySelectorAll('.remove-gift') 
        console.log(removeButton)
      })
  })
})
