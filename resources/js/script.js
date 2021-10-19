import Datepicker from '@themesberg/tailwind-datepicker/js/Datepicker';

// Register datepicker
const datepickerEl = document.getElementById('tanggal_lahir');
new Datepicker(datepickerEl, {});


let register = $('#register');
let card = register.find('.card');
let steps = $('.steps');
let step = steps.find('.step');
let current = 0;

let nextStep = () => {
    $(card[current]).find('.next').on('click', (e) => {
        e.preventDefault();
        current+= 1;
        $(card[current]).addClass('show');
        $(card[current-1]).removeClass('show');
        
        // Activate steps
        $(step[current]).addClass('step-primary');
        // Run the function again after change the card
        nextStep();
    })
}
nextStep();