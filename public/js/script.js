//datepicker
$('#datepicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd-mm-yyyy'
}).datepicker;

// Toastr.js -->> alert plugin
function toastr_alert(alert, message, title) {
    toastr[alert](message, title)

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}

// skill ajax
$('#btn-skill').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        url: '/skill',
        type: 'POST',
        dataType: 'json',
        data: $('#form-skill').serialize(),
        success: function (data) {
            // cari elemen dgn id list-skill dan lakukkan innerHtml dgn isi data['view]
            $('#list-skill').html(data['view']);
            // kosongkan isi elemen dgn id skill
            $('#skill').val('');
            // fokus k elemen dgn id skill
            $('#skill').focus();
            console.log(data);
        },
        error: function (xhr, status, data) {
            if (data.status === 422) {
                var errors = data.responseJSON;
                $.each(data.responseJSON, function (key, value) {
                    $('#experience').html(value['experience']);
                });
            }
            console.log(xhr.eror + 'ERROR STATUS : ' + status);
        },
        complete: function () {
            alreadyloading = false;
        }
    });

    // Toastr.js -->> alert plugin
    toastr_alert("success", "Kemampuan Anda telah tersimpan!", "Success")
});


// experience ajax
$('#btn-experience').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        url: '/experience',
        type: 'POST',
        dataType: 'json',
        data: $('#form-experience').serialize(),
        success: function (data) {
            // cari elemen dgn id list-experience dan lakukkan innerHtml dgn isi data['view]
            $('#list-experience').html(data['view']);
            // kosongkan isi elemen dgn id experience
            $('#experience').val('');
            // fokus k elemen dgn id experience
            $('#experience').focus();
            console.log(data);
        },
        error: function (xhr, status, data) {
            if (data.status === 422) {
                var errors = data.responseJSON;
                $.each(data.responseJSON, function (key, value) {
                    $('#experience').html(value['experience']);
                });
            }
            console.log(xhr.eror + 'ERROR STATUS : ' + status);
        },
        complete: function () {
            alreadyloading = false;
        }
    });

    // Toastr.js -->> alert plugin
    toastr_alert("success", "Pengalaman Anda telah tersimpan!", "Success")
});






$(document).ready(function () {
    // plugin summernote WYSIWYG editor
    $('#textarea').summernote();

    // show kolom apply job
    $('#btn-show-kolom-apply').on('click', function (e) {
        // munculkan Kolom alasan ingin Apply
        $('#kolom-apply').show();

        // hide button Apply
        $('#btn-show-kolom-apply').hide();
    });
});