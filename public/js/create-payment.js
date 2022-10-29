$(function() {
})
function showCreatePayment(id, subject) {
    console.log(id, subject)
    $('#subjectName').html(`Register payment for ${subject.name}?`);
    $('#amount').html(`Amount:  ${subject.price} u$s`);
    $('#createPayment').attr('checked', true);
    $('#confirmPay').attr('onClick', `createPayment(${id})`);
}

function createPayment(id) {
    $.ajax({
        url: `/payments`,
        type: "POST",
        data: {
            _token: _token,
            id: id,
        },
        beforeSend: function(data) {
            $('#confirmPay').attr('disabled', true);
        },
        success: function(data) {
            location.reload();
        },
        error: function(xhr, status, error) {
            toastr['error']('There are no pending payments for this course');
            $('#createPayment').attr('checked', false);
        },
        complete: function(data) {
            $$('#confirmPay').attr('disabled', false);
        },
    })
}

$('#closePayment').on('click', function() {
    $('#createPayment').attr('checked', false);
})
