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
    $(card).find('.back').on('click', (e) => {
        e.preventDefault()
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
    nama_orang_tua: 'required',
    email: 'required|email',
    no_whatsapp_orang_tua: 'required|numeric',
    kata_sandi: 'required',
    konfirmasi_kata_sandi: 'required|same:kata_sandi'
}, {
    "required.nama_orang_tua": "Nama Orang tua/wali wajib diisi",
    "required.email": "Email wajib diisi",
    "email.email": "Format email tidak valid",
    "required.no_whatsapp_orang_tua": "Nomor telefon wajib diisi",
    "numeric.no_whatsapp_orang_tua": "Nomor telefon harus berupa angka",
    "required.kata_sandi": "Kata sandi wajib diisi",
    "required.konfirmasi_kata_sandi": "Konfirmasi kata sandi wajib diisi",
    "same.konfirmasi_kata_sandi": "Konfirmasi kata sandi tidak sama"
});

typingValidation('#address', {
    provinsi: 'required',
    kota: 'required',
    kecamatan: 'required'
}, {
    "required.provinsi": "Provinsi wajib dipilih",
    "required.kota": "Kabupaten/kota wajib dipilih",
    "required.kecamatan": "Kecamatan/desa wajib dipilih"
});

typingValidation('#student', {
    nama_lengkap_anak: 'required',
    nama_panggilan_anak: 'required',
    tanggal_lahir: 'required',
    jenis_kelamin: 'required',
    no_whatsapp_anak: 'required|numeric',
    instagram: 'required',
    facebook: 'required'
}, {
    "required.nama_lengkap_anak": "Nama lengkap wajib dipilih",
    "required.nama_panggilan_anak": "Nama panggilan wajib dipilih",
    "required.tanggal_lahir": "Tanggal lahir wajib dipilih",
    "required.jenis_kelamin": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak": "No whatsapp wajib dipilih",
    "numeric.no_whatsapp_anak": "No whatsapp harus berupa angka",
    "required.instagram": "Instagram wajib dipilih",
    "required.facebook": "Facebook wajib dipilih"
});

typingValidation('#survey', {
    motivasi: 'required',
    sumber_info: 'required',
    posting_hasil_karya: 'required'
}, {
    "required.motivasi": "Motivasi wajib dipilih",
    "required.sumber_info": "Sumber informasi wajib dipilih",
    "required.posting_hasil_karya": "Posting wajib dipilih"
});

typingValidation('#payment', {
    bukti_pembayaran: 'required',
    jangka_pendaftaran: 'required',
    catatan: 'required',
    nama_bank: 'required',
    nominal: 'required'
}, {
    "required.bukti_pembayaran": "Bukti transfer wajib dipilih",
    "required.jangka_pendaftaran": "Jangka pendataran wajib dipilih",
    "required.catatan": "Catatan wajib dipilih",
    "required.nama_bank": "Nama bank wajib dipilih",
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
        let paymentSlip = $('input[name=bukti_pembayaran]')
        let paymentSlipValue = paymentSlip.val();
        if (paymentSlip.length) {
            data['bukti_pembayaran'] = paymentSlipValue
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
                return
            }
            nextStep()
        }
    })
}

submitValidation('#account-info', {
    nama_orang_tua: 'required',
    email: 'required|email',
    no_whatsapp_orang_tua: 'required|numeric',
    kata_sandi: 'required',
    konfirmasi_kata_sandi: 'required|same:kata_sandi'
}, {
    "required.nama_orang_tua": "Nama Orang tua/wali wajib diisi",
    "required.email": "Email wajib diisi",
    "email.email": "Format email tidak valid",
    "required.no_whatsapp_orang_tua": "Nomor telefon wajib diisi",
    "numeric.no_whatsapp_orang_tua": "Nomor telefon harus berupa angka",
    "required.kata_sandi": "Kata sandi wajib diisi",
    "required.konfirmasi_kata_sandi": "Konfirmasi kata sandi wajib diisi",
    "same.konfirmasi_kata_sandi": "Konfirmasi kata sandi tidak sama"
});

submitValidation('#address', {
    provinsi: 'required',
    kota: 'required',
    kecamatan: 'required'
}, {
    "required.provinsi": "Provinsi wajib dipilih",
    "required.kota": "Kabupaten/kota wajib dipilih",
    "required.kecamatan": "Kecamatan/desa wajib dipilih"
});

submitValidation('#student', {
    nama_lengkap_anak: 'required',
    nama_panggilan_anak: 'required',
    tanggal_lahir: 'required',
    jenis_kelamin: 'required',
    no_whatsapp_anak: 'required:numeric',
    instagram: 'required',
    facebook: 'required'
}, {
    "required.nama_lengkap_anak": "Nama lengkap wajib diisi",
    "required.nama_panggilan_anak": "Nama panggilan wajib diisi",
    "required.tanggal_lahir": "Tanggal lahir wajib diisi",
    "required.jenis_kelamin": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak": "No whatsapp wajib diisi",
    "numeric.no_whatsapp_anak": "No whatsapp harus berupa angka",
    "required.instagram": "Instagram wajib diisi",
    "required.facebook": "Facebook wajib diisi"
});

submitValidation('#survey', {
    motivasi: 'required',
    sumber_info: 'required',
    posting_hasil_karya: 'required'
}, {
    "required.motivasi": "Motivasi wajib diisi",
    "required.sumber_info": "Sumber informasi wajib dipilih",
    "required.posting_hasil_karya": "Posting wajib dipilih"
});

submitValidation('#payment', {
    bukti_pembayaran: 'required',
    jangka_pendaftaran: 'required',
    catatan: 'required',
    nama_bank: 'required',
    nominal: 'required'
}, {
    "required.bukti_pembayaran": "Bukti transfer wajib diisi",
    "required.jangka_pendaftaran": "Jangka pendataran wajib dipilih",
    "required.catatan": "Catatan wajib diisi",
    "required.nama_bank": "Nama bank wajib diisi",
    "required.nominal": "Nominal wajib diisi"
});