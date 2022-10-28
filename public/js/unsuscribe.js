$(function() {
})
function showUnsuscribe(id, subject) {
    console.log(id, subject)
    $('#titleUnsuscribe').html(`Unsuscribe from ${subject.name}?`);
    $('#unsuscribe').attr('checked', true);
    $('#confirmUnsuscribe').attr('onClick', `unsuscribe(${id})`);
}

function unsuscribe(id) {
    $.ajax({
        url: `/courses/unsuscribe/${id}`,
        type: "DELETE",
        data: {
            _token: _token,
            id: id,
        },
        beforeSend: function(data) {},
        success: function(data) {
            location.reload();
        },
        error: function(xhr, status, error) {
        },
        complete: function(data) {
        },
    })
}

$('#closeUnsuscribe').on('click', function() {
    $('#unsuscribe').attr('checked', false);
})
