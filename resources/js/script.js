import Datepicker from '@themesberg/tailwind-datepicker/js/Datepicker';
import Validator from 'validatorjs';
import _, { forEach } from 'lodash';
import { each } from 'jquery';

// Set validator language
Validator.useLang('id')

// Register datepicker
let registerDatePicker = (targetElement) => {
    const datepickerEl1 = targetElement.find('#tanggal_lahir')[0];
    new Datepicker(datepickerEl1, {});
}
registerDatePicker($('#studentForm1'))


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
let cloneStudentForm = (cb) => {
    $('select[name=total_student]').on('change', () => {
        // Remove student form except the first one
        $(".student-form").not(":eq(0)").remove()

        let totalStudent = $('select[name=total_student]').val()
        for(var i = 1; i < totalStudent; i++) {
            $('.student-form').first().clone().appendTo('.wrapper-form').attr('id', 'studentForm' + (i+1));
            let studentForm = $(`#studentForm${i+1}`);
            let fields = studentForm.find('input, select');

            // Register datepicker to tanggal lahir in form 2 & 3
            registerDatePicker(studentForm);
            for(var a = 0; a < fields.length; a++) {
                // Remove value of the field while clonning form
                studentForm.find('input').val('')
                // Remove error text while clonning form
                studentForm.find('.error .label-text-alt').text('')

                // Rename attr name of the field after clonning form
                let nameAttr = $(fields[a]).attr('name')
                $(fields[a]).attr('name', nameAttr + (i+1))
            }
        }

        // re-run function validation typing while jumlah anak is change
        cb()
    })
}

// Typing validation
let typingValidation = (targetElement, rulesParam, errorMessage) => {
    let formData = $(`${targetElement} .wrap-form`).find('input, select, textarea')
    let error_message = {}
    let rules = {}
    let data = {}

    formData.map((i, field) => {
        let fieldName = $(field).attr('name')

        // set field name as a key in data variable
        data[fieldName] = '';

        $(`input[name=${fieldName}], select[name=${fieldName}], textarea[name=${fieldName}]`).keyup(_.debounce((e) => {
            let fieldValue = $(e.target).val()
            let fieldName = $(field).attr('name')

            // store field value to data variable
            data[fieldName] = fieldValue;
            
            if (!_.isEmpty(rulesParam)) {
                let filterRules = []
                let listFields = $(`${targetElement} .wrap-form`).find('input, textarea, select')
                for(let i = 0; i < listFields.length; i++) {
                    let nameField = $(listFields[i]).attr('name')
                    filterRules.push(nameField)
                }
                rules = _.pick(rulesParam, filterRules)
            }
        
            if (!_.isEmpty(errorMessage)) {
                error_message = errorMessage
            }
        
            let validation = new Validator(data, rules, error_message);
            validation.passes(); // true
            validation.fails(); // false
        
            $(`input[name=${fieldName}], select[name=${fieldName}], textarea[name=${fieldName}]`).closest('.form-control').find('.error .label-text-alt').text('')
            if (validation.errors.first(fieldName)) {
                $(`input[name=${fieldName}], select[name=${fieldName}], textarea[name=${fieldName}]`).closest('.form-control').find('.error .label-text-alt').text(validation.errors.first(field.name))
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
    no_whatsapp_anak: 'required:numeric',
    instagram: 'required',
    facebook: 'required',
    nama_lengkap_anak2: 'required',
    nama_panggilan_anak2: 'required',
    tanggal_lahir2: 'required',
    jenis_kelamin2: 'required',
    no_whatsapp_anak2: 'required:numeric',
    instagram2: 'required',
    facebook2: 'required',
    nama_lengkap_anak3: 'required',
    nama_panggilan_anak3: 'required',
    tanggal_lahir3: 'required',
    jenis_kelamin3: 'required',
    no_whatsapp_anak3: 'required:numeric',
    instagram3: 'required',
    facebook3: 'required'
}, {
    "required.nama_lengkap_anak": "Nama lengkap wajib diisi",
    "required.nama_panggilan_anak": "Nama panggilan wajib diisi",
    "required.tanggal_lahir": "Tanggal lahir wajib diisi",
    "required.jenis_kelamin": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak": "No whatsapp wajib diisi",
    "numeric.no_whatsapp_anak": "No whatsapp harus berupa angka",
    "required.instagram": "Instagram wajib diisi",
    "required.facebook": "Facebook wajib diisi",
    "required.nama_lengkap_anak2": "Nama lengkap wajib diisi",
    "required.nama_panggilan_anak2": "Nama panggilan wajib diisi",
    "required.tanggal_lahir2": "Tanggal lahir wajib diisi",
    "required.jenis_kelamin2": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak2": "No whatsapp wajib diisi",
    "numeric.no_whatsapp_anak2": "No whatsapp harus berupa angka",
    "required.instagram2": "Instagram wajib diisi",
    "required.facebook2": "Facebook wajib diisi",
    "required.nama_lengkap_anak3": "Nama lengkap wajib diisi",
    "required.nama_panggilan_anak3": "Nama panggilan wajib diisi",
    "required.tanggal_lahir3": "Tanggal lahir wajib diisi",
    "required.jenis_kelamin3": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak3": "No whatsapp wajib diisi",
    "numeric.no_whatsapp_anak3": "No whatsapp harus berupa angka",
    "required.instagram3": "Instagram wajib diisi",
    "required.facebook3": "Facebook wajib diisi"
})
cloneStudentForm(() => {
    typingValidation('#student', {
        nama_lengkap_anak: 'required',
        nama_panggilan_anak: 'required',
        tanggal_lahir: 'required',
        jenis_kelamin: 'required',
        no_whatsapp_anak: 'required:numeric',
        instagram: 'required',
        facebook: 'required',
        nama_lengkap_anak2: 'required',
        nama_panggilan_anak2: 'required',
        tanggal_lahir2: 'required',
        jenis_kelamin2: 'required',
        no_whatsapp_anak2: 'required:numeric',
        instagram2: 'required',
        facebook2: 'required',
        nama_lengkap_anak3: 'required',
        nama_panggilan_anak3: 'required',
        tanggal_lahir3: 'required',
        jenis_kelamin3: 'required',
        no_whatsapp_anak3: 'required:numeric',
        instagram3: 'required',
        facebook3: 'required'
    }, {
        "required.nama_lengkap_anak": "Nama lengkap wajib diisi",
        "required.nama_panggilan_anak": "Nama panggilan wajib diisi",
        "required.tanggal_lahir": "Tanggal lahir wajib diisi",
        "required.jenis_kelamin": "Jenis kelamin wajib dipilih",
        "required.no_whatsapp_anak": "No whatsapp wajib diisi",
        "numeric.no_whatsapp_anak": "No whatsapp harus berupa angka",
        "required.instagram": "Instagram wajib diisi",
        "required.facebook": "Facebook wajib diisi",
        "required.nama_lengkap_anak2": "Nama lengkap wajib diisi",
        "required.nama_panggilan_anak2": "Nama panggilan wajib diisi",
        "required.tanggal_lahir2": "Tanggal lahir wajib diisi",
        "required.jenis_kelamin2": "Jenis kelamin wajib dipilih",
        "required.no_whatsapp_anak2": "No whatsapp wajib diisi",
        "numeric.no_whatsapp_anak2": "No whatsapp harus berupa angka",
        "required.instagram2": "Instagram wajib diisi",
        "required.facebook2": "Facebook wajib diisi",
        "required.nama_lengkap_anak3": "Nama lengkap wajib diisi",
        "required.nama_panggilan_anak3": "Nama panggilan wajib diisi",
        "required.tanggal_lahir3": "Tanggal lahir wajib diisi",
        "required.jenis_kelamin3": "Jenis kelamin wajib dipilih",
        "required.no_whatsapp_anak3": "No whatsapp wajib diisi",
        "numeric.no_whatsapp_anak3": "No whatsapp harus berupa angka",
        "required.instagram3": "Instagram wajib diisi",
        "required.facebook3": "Facebook wajib diisi"
    })
})

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
    let error_message = {}
    let rules = {}
    let data = {}

    $(`${targetElement} .btn.btn-primary`).on('click', (e) => {
        let formData = $(`${targetElement} .wrap-form`).find('input, textarea, select')

        formData.map((i, field) => {
            let fieldValue = $(field).val()
            let fieldName = $(field).attr('name')

            data[fieldName] = fieldValue;
        });

        // add payment slip to variable data in manually
        let paymentSlip = $('input[name=bukti_pembayaran]')
        let paymentSlipValue = paymentSlip.val();
        if (paymentSlip.length) {
            data['bukti_pembayaran'] = paymentSlipValue
        }
        
        if (!_.isEmpty(rulesParam)) {
            let filterRules = []
            let listFields = $(`${targetElement} .wrap-form`).find('input, textarea, select')
            for(let i = 0; i < listFields.length; i++) {
                let nameField = $(listFields[i]).attr('name')
                filterRules.push(nameField)
            }
            rules = _.pick(rulesParam, filterRules)
        }
    
        if (!_.isEmpty(errorMessage)) {
            error_message = errorMessage
        }
    
        let validation = new Validator(data, rules, error_message);
        validation.checkAsync()
        
        // remove error text
        for (let key in validation.input) {
            $(`input[name=${key}], select[name=${key}], textarea[name=${key}]`).closest('.form-control').find('.error .label-text-alt').text('')
        }
        if (validation.fails()) {
            e.preventDefault()
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
    facebook: 'required',
    nama_lengkap_anak2: 'required',
    nama_panggilan_anak2: 'required',
    tanggal_lahir2: 'required',
    jenis_kelamin2: 'required',
    no_whatsapp_anak2: 'required:numeric',
    instagram2: 'required',
    facebook2: 'required',
    nama_lengkap_anak3: 'required',
    nama_panggilan_anak3: 'required',
    tanggal_lahir3: 'required',
    jenis_kelamin3: 'required',
    no_whatsapp_anak3: 'required:numeric',
    instagram3: 'required',
    facebook3: 'required'
}, {
    "required.nama_lengkap_anak": "Nama lengkap wajib diisi",
    "required.nama_panggilan_anak": "Nama panggilan wajib diisi",
    "required.tanggal_lahir": "Tanggal lahir wajib diisi",
    "required.jenis_kelamin": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak": "No whatsapp wajib diisi",
    "numeric.no_whatsapp_anak": "No whatsapp harus berupa angka",
    "required.instagram": "Instagram wajib diisi",
    "required.facebook": "Facebook wajib diisi",
    "required.nama_lengkap_anak2": "Nama lengkap wajib diisi",
    "required.nama_panggilan_anak2": "Nama panggilan wajib diisi",
    "required.tanggal_lahir2": "Tanggal lahir wajib diisi",
    "required.jenis_kelamin2": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak2": "No whatsapp wajib diisi",
    "numeric.no_whatsapp_anak2": "No whatsapp harus berupa angka",
    "required.instagram2": "Instagram wajib diisi",
    "required.facebook2": "Facebook wajib diisi",
    "required.nama_lengkap_anak3": "Nama lengkap wajib diisi",
    "required.nama_panggilan_anak3": "Nama panggilan wajib diisi",
    "required.tanggal_lahir3": "Tanggal lahir wajib diisi",
    "required.jenis_kelamin3": "Jenis kelamin wajib dipilih",
    "required.no_whatsapp_anak3": "No whatsapp wajib diisi",
    "numeric.no_whatsapp_anak3": "No whatsapp harus berupa angka",
    "required.instagram3": "Instagram wajib diisi",
    "required.facebook3": "Facebook wajib diisi"
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