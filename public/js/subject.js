    $(function() {

    })

    function showSubject(subjectId) {
        $.ajax({
            url: `/subjects/${subjectId}`,
            type: "GET",
            data: {},
            beforeSend: function(data) {},
            success: function(data) {
                console.log(data)
                $('#showTitle').html(data.name);
                $('#showDescription').html(data.description);
                $('#showDuration').html(`Duration: ${data.duration} months.`);
                $('#showPrice').html(`Price: ${data.price} u$s.`);
                $('#showSubject').attr('checked', true);
            },
            error: function(xhr, status, error) {
            },
            complete: function(data) {
            },
        })
    }

    $('#closeShowSubject').on('click', function() {
        $('#showSubject').attr('checked', false);
    })

    function editSubject(subject) {
        debugger
        $('#editSubjectForm').attr('action', `/subjects/${subject.id}`)
        $('#editName').val(subject.name);
        $('#editDescription').html(subject.description);
        $('#editDuration').val(subject.duration);
        $('#editPrice').val(subject.price);
        $('#editSubject').attr('checked', true);
        
        // $.ajax({
        //     url: `/subjects/${subjectId}`,
        //     type: "GET",
        //     data: {},
        //     beforeSend: function(data) {},
        //     success: function(data) {
        //         console.log(data)
        //         $('#showTitle').html(data.name);
        //         $('#showDescription').html(data.description);
        //         $('#showDuration').html(`Duration: ${data.duration} months.`);
        //         $('#showPrice').html(`Price: ${data.price} u$s.`);
        //         $('#showSubject').attr('checked', true);
        //     },
        //     error: function(xhr, status, error) {
        //     },
        //     complete: function(data) {
        //     },
        // })
    }

    
    function showRemoveSubject(subject) {
        console.log(subject)
        $('#removeTitle').html(`Are you sure you want to remove ${subject.name}?`);
        $('#showRemoveSubject').attr('checked', true);
        $('#removeButton').attr('onClick', `removeSubject(${subject.id})`);
    }
    
    function removeSubject(subjectId) {
        $.ajax({
            url: `/subjects/${subjectId}`,
            type: "DELETE",
            data: {
                _token: _token,
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
    
    $('#closeShowSubject').on('click', function() {
        $('#showSubject').attr('checked', false);
    })

    $('#closeEditSubject').on('click', function() {
        $('#showEditSubject').attr('checked', false);
    })

    $('#closeRemoveSubject').on('click', function() {
        $('#showRemoveSubject').attr('checked', false);
    })
