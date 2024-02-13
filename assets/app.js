import './bootstrap.js';
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

const dom = document.querySelector('#snow-container');


const department = document.querySelector('.department');
const cityDropdown = document.querySelector('.ts-dropdown-content');


// Date counter

let nextXmas = new Date('2022-12-25 00:00:00');
const timeUpdate = 10000;
const count = document.getElementById('count');

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

    const fetchResponse = fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(body)
    })
      .then((res) => {
        return res.json();
      })
      .then((datas) => {

        giftList.innerHTML = '';
        for (data of datas) {
          if (!data.images[0]) {
            data.images = 'assets/images/x-masGift.jpg'
          } else {
            data.images = `uploads/gifts/${data.images[0]}`
          }

          let html = document.createElement('div');
          html.classList.add('p-2', 'col-6', 'col-md-4');
          html.innerHTML = `

              <div style="height: 200px;" class="position-relative rounded-1">
                <img class="z-n1 object-fit-cover top-0 start-0 h-100 w-100 position-absolute" src="${data.images}" alt="photo de ${data.name}" />
                <span class="position-absolute bottom-0 w-100 start-0 bg-dark bg-opacity-75 text-white px-3 py-1 mt-5 mb-0"> ${data.name}</span>
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
        return res.json();
      })
      .then((datas) => {
        clickedButton.parentElement.parentElement.remove();
      })
      .then(() => {
        removeButton = document.querySelectorAll('.remove-gift')
      })
  })
})


// falling snow settings 
const snowConfig = () => {

  const snow = document.createElement('div');
  snow.classList.add('snow');

  let positionX = Math.random() * window.innerWidth;
  snow.style.left = positionX + 'px';
  dom.append(snow);
}

const resetSnow = (e) => {
  const position = window.getComputedStyle(e);
  const positionY = parseInt(position.getPropertyValue('top'));
  const windowHeight = dom.clientHeight;

  if (positionY >= windowHeight) {
    e.remove();
  }
};

const fallingSnow = () => {
  const snowElements = document.querySelectorAll('.snow');
  snowElements.forEach((e) => {
    resetSnow(e)
  })

  if (snowElements.length < 200) {
    snowConfig();
  }
};

setInterval(fallingSnow, 250);


// date counter settings
const update = (i) => {
  const now = new Date();

  while (now > nextXmas) {
    nextXmas.setYear(nextXmas.getFullYear() + 1);
  }

  // get time : 
  let hours = 23 - now.getHours();
  let minutes = 60 - now.getMinutes();
  let days = nextXmas.getDate() - now.getDate();
  let months = nextXmas.getMonth() - now.getMonth();

  if (days < 0) {
    if ((now.getMonth() + 1) === 2) { // february
      days = 28 - Math.abs(days);
    } else if (
      (now.getMonth() + 1) == 1 ||
      (now.getMonth() + 1) == 3 ||
      (now.getMonth() + 1) === 5 ||
      (now.getMonth() + 1) === 7 ||
      (now.getMonth() + 1) === 8 ||
      (now.getMonth() + 1) === 10 ||
      (now.getMonth() + 1) === 12) { // 31 days months
      days = 31 - Math.abs(days);
    } else { // 30 days months
      days = 30 - Math.abs(days);
    }

    months = months - 1;
  }



  let counter = "";
  counter += (months != 0) ? months + " mois " : '';
  counter += (days != 0) ? days + " jours <br /> " : '';
  counter += (hours != 0) ? hours + " heures " : '';
  counter += (minutes != 0) ? minutes + " minutes " : '';

  count.innerHTML = counter;
  i++;
  setTimeout(() => { update(i) }, timeUpdate)
}

if (count) {
  update(1);
}

if (department) {
  department.addEventListener('change', () => {
    console.log(department.value);
    const url = '/letter';
    console.log(url);
    const body = {
      'department': parseInt(department.value)
    }

    console.log(body);
    const fetchResponse = fetch(
      url, {
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
      })
  })
}

