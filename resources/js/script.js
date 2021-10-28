import Datepicker from '@themesberg/tailwind-datepicker/js/Datepicker';
import Validator from 'validatorjs';
import _ from 'lodash';

// Set validator language
Validator.useLang('id')

// Register datepicker
const datepickerEl = document.getElementById('tanggal_lahir');
new Datepicker(datepickerEl, {});


// Next register steps
let card = $('#register').find('.card');
let steps = $('.steps');
let step = steps.find('.step');
let current = 0;

let nextStep = () => {
    current++;
    $(card[current]).addClass('show');
    $(card[current-1]).removeClass('show');
    
    // Activate steps
    $(step[current]).addClass('step-primary');
}

let backStep = () => {
    current--;
    $(card[current]).addClass('show');
    $(card[current+1]).removeClass('show');
    
    // Activate steps
    $(step[current+1]).removeClass('step-primary');
}

let backStepAction = () => {
    $(card[current+1]).find('.back').on('click', (e) => {
        e.preventDefault()
        // Re-run function
        backStepAction()
        
        backStep()
    })
}
backStepAction()

// Multiple form of student
let cloneStudentForm = () => {
    $('select[name=total_student]').on('change', () => {
        // Remove student form except the first one
        $(".student-form").not(":eq(0)").remove()

        let totalStudent = $('select[name=total_student]').val();
        let cloneIndex = $('.student-form').length + 1;
        for(var i = 1; i < totalStudent; i++) {
            $('.student-form').first().clone().appendTo('.wrapper-form').attr('id', 'studentForm' + (i+1));
        }
    })
}
cloneStudentForm()

// Typing validation
let typingValidation = (targetElement, rulesParam, errorMessage) => {
    let formData = $(`${targetElement} form`).serializeArray();
    formData.forEach((field) => {
        $(`input[name=${field.name}], select[name=${field.name}], textarea[name=${field.name}]`).keyup(_.debounce(() => {
            let formData = $(`${targetElement} form`).serializeArray();
            let error_message = {}
            let rules = {}
            let data = {}

            if (formData.length > 0) {
                formData.forEach(val => {
                    data[val.name] = val.value;
                });
            }
            
            if (!_.isEmpty(rulesParam)) {
                rules = rulesParam
            }
        
            if (!_.isEmpty(errorMessage)) {
                error_message = errorMessage
            }
        
            let validation = new Validator(data, rules, error_message);
            validation.passes(); // true
            validation.fails(); // false
        
            $(`input[name=${field.name}], select[name=${field.name}], textarea[name=${field.name}]`).closest('.form-control').find('.error .label-text-alt').text('')
            if (validation.errors.first(field.name)) {
                $(`input[name=${field.name}], select[name=${field.name}], textarea[name=${field.name}]`).closest('.form-control').find('.error .label-text-alt').text(validation.errors.first(field.name))
            }
        }, 700))
    });
}

typingValidation('#account-info', {
    name: 'required',
    email: 'required|email',
    phone: 'required|numeric',
    password: 'required',
    confirm_password: 'required|same:password'
}, {
    "required.name": "Nama Orang tua/wali wajib diisi",
    "required.email": "Email wajib diisi",
    "email.email": "Format email tidak valid",
    "required.phone": "Nomor telefon wajib diisi",
    "numeric.phone": "Nomor telefon harus berupa angka",
    "required.password": "Kata sandi wajib diisi",
    "required.confirm_password": "Konfirmasi kata sandi wajib diisi",
    "same.confirm_password": "Konfirmasi kata sandi tidak sama"
});

typingValidation('#address', {
    province: 'required',
    city: 'required',
    district: 'required'
}, {
    "required.province": "Provinsi wajib dipilih",
    "required.city": "Kabupaten/kota wajib dipilih",
    "required.district": "Kecamatan/desa wajib dipilih"
});

typingValidation('#student', {
    full_name: 'required',
    nickname: 'required',
    date_birth: 'required',
    gender: 'required',
    phone_number: 'required|numeric',
    instagram: 'required',
    facebook: 'required'
}, {
    "required.full_name": "Nama lengkap wajib dipilih",
    "required.nickname": "Nama panggilan wajib dipilih",
    "required.date_birth": "Tanggal lahir wajib dipilih",
    "required.gender": "Jenis kelamin wajib dipilih",
    "required.phone_number": "No whatsapp wajib dipilih",
    "numeric.phone_number": "No whatsapp harus berupa angka",
    "required.instagram": "Instagram wajib dipilih",
    "required.facebook": "Facebook wajib dipilih"
});

typingValidation('#survey', {
    motivation: 'required',
    source_info: 'required',
    publish: 'required'
}, {
    "required.motivation": "Motivasi wajib dipilih",
    "required.source_info": "Sumber informasi wajib dipilih",
    "required.publish": "Posting wajib dipilih"
});

typingValidation('#payment', {
    payment_slip: 'required',
    registration_period: 'required',
    note: 'required',
    bank_name: 'required',
    nominal: 'required'
}, {
    "required.payment_slip": "Bukti transfer wajib dipilih",
    "required.registration_period": "Jangka pendataran wajib dipilih",
    "required.note": "Catatan wajib dipilih",
    "required.bank_name": "Nama bank wajib dipilih",
    "required.nominal": "Nominal wajib dipilih"
});

// Submit validation
let submitValidation = (targetElement, rulesParam, errorMessage) => {
    // let formData = $(`${targetElement} form`).serializeArray();

    $(`${targetElement} .btn.btn-primary`).on('click', () => {
        let formData = $(`${targetElement} form`).serializeArray();
        let error_message = {}
        let rules = {}
        let data = {}

        if (formData.length > 0) {
            formData.forEach(val => {
                data[val.name] = val.value;
            });
        }

        // add payment slip to variable data in manually
        let paymentSlip = $('input[name=payment_slip]')
        let paymentSlipValue = paymentSlip.val();
        if (paymentSlip.length) {
            data['payment_slip'] = paymentSlipValue
        }
        
        if (!_.isEmpty(rulesParam)) {
            rules = rulesParam
        }
    
        if (!_.isEmpty(errorMessage)) {
            error_message = errorMessage
        }
    
        let validation = new Validator(data, rules, error_message);
        validation.checkAsync()
        
        for (let key in validation.input) {
            $(`input[name=${key}], select[name=${key}], textarea[name=${key}]`).closest('.form-control').find('.error .label-text-alt').text('')
        }
        if (validation.fails()) {
            for (let key in validation.errors.errors) {
                $(`input[name=${key}], select[name=${key}], textarea[name=${key}]`).closest('.form-control').find('.error .label-text-alt').text(validation.errors.first(key))
            }
        }

        if(validation.passes())  {
            if (current === 4) {
                return;
            }
            nextStep()
        }
    })
}

submitValidation('#account-info', {
    name: 'required',
    email: 'required|email',
    phone: 'required|numeric',
    password: 'required',
    confirm_password: 'required|same:password'
}, {
    "required.name": "Nama Orang tua/wali wajib diisi",
    "required.email": "Email wajib diisi",
    "email.email": "Format email tidak valid",
    "required.phone": "Nomor telefon wajib diisi",
    "numeric.phone": "Nomor telefon harus berupa angka",
    "required.password": "Kata sandi wajib diisi",
    "required.confirm_password": "Konfirmasi kata sandi wajib diisi",
    "same.confirm_password": "Konfirmasi kata sandi tidak sama"
});

submitValidation('#address', {
    province: 'required',
    city: 'required',
    district: 'required'
}, {
    "required.province": "Provinsi wajib dipilih",
    "required.city": "Kabupaten/kota wajib dipilih",
    "required.district": "Kecamatan/desa wajib dipilih"
});

submitValidation('#student', {
    full_name: 'required',
    nickname: 'required',
    date_birth: 'required',
    gender: 'required',
    phone_number: 'required:numeric',
    instagram: 'required',
    facebook: 'required'
}, {
    "required.full_name": "Nama lengkap wajib diisi",
    "required.nickname": "Nama panggilan wajib diisi",
    "required.date_birth": "Tanggal lahir wajib diisi",
    "required.gender": "Jenis kelamin wajib dipilih",
    "required.phone_number": "No whatsapp wajib diisi",
    "numeric.phone_number": "No whatsapp harus berupa angka",
    "required.instagram": "Instagram wajib diisi",
    "required.facebook": "Facebook wajib diisi"
});

submitValidation('#survey', {
    motivation: 'required',
    source_info: 'required',
    publish: 'required'
}, {
    "required.motivation": "Motivasi wajib diisi",
    "required.source_info": "Sumber informasi wajib dipilih",
    "required.publish": "Posting wajib dipilih"
});

submitValidation('#payment', {
    payment_slip: 'required',
    registration_period: 'required',
    note: 'required',
    bank_name: 'required',
    nominal: 'required'
}, {
    "required.payment_slip": "Bukti transfer wajib diisi",
    "required.registration_period": "Jangka pendataran wajib dipilih",
    "required.note": "Catatan wajib diisi",
    "required.bank_name": "Nama bank wajib diisi",
    "required.nominal": "Nominal wajib diisi"
});