import Datepicker from '@themesberg/tailwind-datepicker/js/Datepicker';
import Validator from 'validatorjs';
import _ from 'lodash';

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

// Validation
let formData = $('#account-info form').serializeArray();
formData.forEach((field) => {
    $(`input[name=${field.name}]`).keyup(_.debounce(() => {
        let formData = $('#account-info form').serializeArray();
    
        let data = {}
        formData.forEach(val => {
            data[val.name] = val.value;
        });
        
        let rules = {
            name: 'required',
            email: 'required|email',
            phone: 'required',
            password: 'required',
            confirm_password: 'same:password'
        };
    
        let error_message = {
            "required.name": "Nama Orang tua/wali wajib diisi",
            "required.email": "Email wajib diisi",
            "email.email": "Format email tidak valid",
            "required.phone": "Nomor telefon wajib diisi",
            "required.password": "Kata sandi wajib diisi",
            "same.confirm_password": "Konfirmasi password dan password harus sama"
        }
    
        let validation = new Validator(data, rules, error_message);
        validation.passes(); // true
        validation.fails(); // false
    
        $(`input[name=${field.name}]`).siblings('.error').find('.label-text-alt').text('')
        if (validation.errors.first(field.name)) {
            $(`input[name=${field.name}]`).siblings('.error').find('.label-text-alt').text(validation.errors.first(field.name))
        }
    }, 700))
});