import Datepicker from '@themesberg/tailwind-datepicker/Datepicker';
import Validator from 'validatorjs';
import _, { lastIndexOf } from 'lodash';

// Set validator language
Validator.useLang('id')

// Register datepicker
let registerDatePicker = (targetElement) => {
    const datepickerEl1 = targetElement.find('.tanggal-lahir')[0];
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

    // Add icon check in the last step
    $(step[current-1]).attr('data-content', '✓');
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
    $("select[name='total_student']").on('change', () => {
        // Remove student form except the first one
        $(".student-form").not(":eq(0)").remove()

        let totalStudent = $("select[name='total_student']").val()
        for(var i = 1; i < totalStudent; i++) {
            $('.student-form').first().clone().appendTo('.wrap-student').attr('id', 'studentForm' + (i+1)).find('.title-student').text(`Anak ${i+1}`)
            let studentForm = $(`#studentForm${i+1}`)
            let fields = studentForm.find('input, select')

            // Register datepicker to tanggal lahir in form 2 & 3
            registerDatePicker(studentForm);
            for(var a = 0; a < fields.length; a++) {
                // Remove value of the field while clonning form
                studentForm.find('input').val('')
                // Remove error text while clonning form
                studentForm.find('.error .label-text-alt').text('')

                // Rename attr name of the field after clonning form
                let nameAttr = $(fields[a]).attr('name')
                $(fields[a]).attr('name', nameAttr)
            }
        }
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
        data[fieldName] = ''

        $(`input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).keyup(_.debounce((e) => {
            let fieldValue = $(e.target).val()
            let fieldName = $(field).attr('name')

            // Copy value of no whatsapp orang tua
            if(fieldName === 'no_whatsapp_orang_tua') {
                $("input[name='no_whatsapp_anak[]']").val(fieldValue)
            }

            // store field value to data variable
            data[fieldName] = fieldValue;

            if (!_.isEmpty(rulesParam)) {
                rules = rulesParam
            }

            if (!_.isEmpty(errorMessage)) {
                error_message = errorMessage
            }

            let validation = new Validator(data, rules, error_message);
            validation.passes(); // true
            validation.fails(); // false

            $(`input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).closest('.form-control').find('.error .label-text-alt').text('')
            if (validation.errors.first(fieldName)) {
                $(`input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).closest('.form-control').find('.error .label-text-alt').text(validation.errors.first(field.name))
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

let addressRules = {
    provinsi: 'required',
    kota: 'required',
    kecamatan: 'required',
    alamat: 'required'
}

let addressErrorMessage = {
    "required.provinsi": "Provinsi wajib dipilih",
    "required.kota": "Kabupaten/kota wajib dipilih",
    "required.kecamatan": "Kecamatan/desa wajib dipilih",
    "required.alamat": "Alamat wajib diisi"
}

typingValidation('#address', addressRules, addressErrorMessage);

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

let typingValidationDynamicForm = (targetElement, rulesParam, errorMessage, totalStudent = 1) => {
    let formData = $(`${targetElement} .wrap-form`).find('input, select, textarea')
    let error_message = {}
    let rules = {}
    let data = {students: [{}]}

    formData.map((i, field) => {
        let fieldName = $(field).attr('name')

        // set field name as a key in data variable
        data.students[0][fieldName] = ''
        
        $(`input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).keyup(_.debounce((e) => {
            let fieldValue = $(e.target).val()
            let fieldName = $(field).attr('name')
            let getIndexElement = $(`input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}`).index(e.target);

            // store field value to data variable
            data.students[getIndexElement][fieldName] = fieldValue

            if (!_.isEmpty(rulesParam)) rules = rulesParam

            if (!_.isEmpty(errorMessage)) error_message = errorMessage

            let validation = new Validator(data, rules, error_message);
            validation.passes(); // true
            validation.fails(); // false

            $(`input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).eq(getIndexElement).closest('.form-control').find('.error .label-text-alt').text('')
            if (validation.errors.first(`students.${getIndexElement}.${fieldName}`)) {
                $(`input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).eq(getIndexElement).closest('.form-control').find('.error .label-text-alt').text(validation.errors.first(`students.${getIndexElement}.${fieldName}`))
            }
        }, 300))
    })

    setTimeout(() => {
        for (let i = 0; i < totalStudent; i++) {
            if (data.students.length < totalStudent) {
                // Create new object and push it to data variable
                let cloneStudent = _.clone(data.students[0])
                for (let student in cloneStudent) cloneStudent[student] = ''
                data.students.push(cloneStudent)
            }
            if (data.students.length > totalStudent) {
                let deleteCount = data.students.length - totalStudent
                data.students.splice(totalStudent, deleteCount)
            }
        }
    }, 500);
}

let studentRules = {
    'students.*.nama_lengkap_anak[]': 'required',
    'students.*.nama_panggilan_anak[]': 'required',
    'students.*.tanggal_lahir[]': 'required',
    'students.*.jenis_kelamin[]': 'required',
    'students.*.no_whatsapp_anak[]': 'required:numeric',
    'students.*.instagram[]': 'required',
    'students.*.facebook[]': 'required'
}
let studentErrorMessage = {
    "required.students.*.nama_lengkap_anak[]": "Nama lengkap wajib diisi",
    "required.students.*.nama_panggilan_anak[]": "Nama panggilan wajib diisi",
    "required.students.*.tanggal_lahir[]": "Tanggal lahir wajib diisi",
    "required.students.*.jenis_kelamin[]": "Jenis kelamin wajib dipilih",
    "required.students.*.no_whatsapp_anak[]": "No whatsapp wajib diisi",
    "numeric.students.*.no_whatsapp_anak[]": "No whatsapp harus berupa angka",
    "required.students.*.instagram[]": "Instagram wajib diisi",
    "required.students.*.facebook[]": "Facebook wajib diisi"
}

cloneStudentForm()
typingValidationDynamicForm('#student', studentRules, studentErrorMessage)

$("select[name='total_student']").on('change', (e) => {
    let totalStudent = $(e.target).val()

    typingValidationDynamicForm('#student', studentRules, studentErrorMessage, totalStudent)
})

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
        let paymentSlip = $("input[name='bukti_pembayaran']")
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
            $(`input[name='${key}'], select[name='${key}'], textarea[name='${key}']`).closest('.form-control').find('.error .label-text-alt').text('')
        }
        if (validation.fails()) {
            e.preventDefault()
            for (let key in validation.errors.errors) {
                $(`input[name='${key}'], select[name='${key}'], textarea[name='${key}']`).closest('.form-control').find('.error .label-text-alt').text(validation.errors.first(key))
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

let submitValidationDynamicForm = (targetElement, rulesParam, errorMessage, totalStudent = 1) => {
    let error_message = {}
    let rules = {}
    let data = {students: [{}]}

    $(`${targetElement} .btn.btn-primary`).on('click', (e) => {
        for (let oo = 0; oo < totalStudent; oo++) {
            let formData = $(`${targetElement} #studentForm${oo+1} .wrap-form`).find('input, select, textarea')

            formData.map((i, field) => {    
                let fieldValue = field.value
                let fieldName = $(field).attr('name')

                // set field name as a key in data variable
                data.students[0][fieldName] = ''

                if (data.students.length < totalStudent) {
                    // Create new object and push it to data variable
                    let cloneStudent = _.clone(data.students[0])
                    for (let student in cloneStudent) cloneStudent[student] = ''
                    data.students.push(cloneStudent)
                }
                if (data.students.length > totalStudent) {
                    let deleteCount = data.students.length - totalStudent
                    data.students.splice(totalStudent, deleteCount)
                }

                setTimeout(() => {
                    // store field value to data variable
                    data.students[oo][fieldName] = fieldValue

                    if (!_.isEmpty(rulesParam)) rules = rulesParam

                    if (!_.isEmpty(errorMessage)) error_message = errorMessage

                    let validation = new Validator(data, rules, error_message);
                    validation.passes(); // true
                    validation.fails(); // false

                    $(`#studentForm${oo+1} input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).closest('.form-control').find('.error .label-text-alt').text('')
                    if (validation.fails()) {
                        if (validation.errors.first(`students.${oo}.${fieldName}`)) {
                            $(`#studentForm${oo+1} input[name='${fieldName}'], select[name='${fieldName}'], textarea[name='${fieldName}']`).closest('.form-control').find('.error .label-text-alt').text(validation.errors.first(`students.${oo}.${fieldName}`))
                        }
                    }
                    
                    if(validation.passes())  {
                        if (data.students.length == totalStudent) {
                            if (current === 4) {
                                return
                            }
                            current = 3;
                            $(card[current]).addClass('show');
                            $(card[current-1]).removeClass('show');

                            // Activate steps
                            $(step[current]).addClass('step-primary');

                            // Add icon check in the last step
                            $(step[current-1]).attr('data-content', '✓');
                        }
                    }
                }, 500);
            })
        } // end for loop
    })
}

submitValidationDynamicForm('#student', studentRules, studentErrorMessage)

// Check total student
$("select[name='total_student']").on('change', (e) => {
    let totalStudent = $(e.target).val()

    submitValidationDynamicForm('#student', studentRules, studentErrorMessage, totalStudent)
})

let getRegencies = () => {
    $("select[name='provinsi']").on('change', (e) => {
        let selected = $(e.target).find('option:selected')
        let provinceId = selected.data('id')
        if (provinceId) {
            $.ajax({
                url: `/province/${provinceId}/regencies/`,
                type: 'GET',
                dataType: 'json',
                success:function(res){
                    $('select[name="kota"]').empty().append('<option disabled selected="selected">Pilih Kabupaten/Kota</option>');
                    $.each(res.data, function(key, value){
                        $('select[name="kota"]').append(`<option data-id="${value.id}" value="${value.name}">${value.name}</option>`);
                    });
                }
            });
        }
    })
}
getRegencies()

let getDistricts = () => {
    $("select[name='provinsi']").on('change', (e) => {
        let selected = $(e.target).find('option:selected')
        let provinceId = selected.data('id')
        if (provinceId) {
            $("select[name='kota']").on('change', (e) => {
                let selected = $(e.target).find('option:selected')
                let regencyId = selected.data('id')
                if (regencyId) {
                    $.ajax({
                        url: `/province/${provinceId}/regencies/${regencyId}/districts`,
                        type: 'GET',
                        dataType: 'json',
                        success:function(res){
                            $('select[name="kecamatan"]').empty().append('<option disabled selected="selected">Pilih Kecamatan/Desa</option>');
                            $.each(res.data, function(key, value){
                                $('select[name="kecamatan"]').append(`<option data-id="${value.id}" value="${value.name}">${value.name}</option>`);
                            });
                        }
                    });
                }
            })
        }
    })
}
getDistricts()