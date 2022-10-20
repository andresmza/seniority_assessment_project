    $(function() {

    })

    function showTeacher(teacherId) {
        console.log('object')
        $.ajax({
            url: `/teachers/${teacherId}`,
            type: "GET",
            data: {},
            beforeSend: function(data) {},
            success: function(data) {
                console.log(data)
                $('#showFullName').html(`${data.name} ${data.lastname}`);
                $('#showDNI').html(`DNI: ${data.dni}`);
                $('#showEmail').html(`Email: ${data.email}`);
                $('#showTeacher').attr('checked', true);
            },
            error: function(xhr, status, error) {
            },
            complete: function(data) {
            },
        })
    }

    $('#closeShowTeacher').on('click', function() {
        $('#showTeacher').attr('checked', false);
    })

    function editTeacher(teacher) {
        debugger
        $('#editTeacherForm').attr('action', `/teachers/${teacher.id}`)
        $('#editName').val(teacher.name);
        $('#editDescription').html(teacher.description);
        $('#editDuration').val(teacher.duration);
        $('#editPrice').val(teacher.price);
        $('#editTeacher').attr('checked', true);
        
        // $.ajax({
        //     url: `/teachers/${teacherId}`,
        //     type: "GET",
        //     data: {},
        //     beforeSend: function(data) {},
        //     success: function(data) {
        //         console.log(data)
        //         $('#showTitle').html(data.name);
        //         $('#showDescription').html(data.description);
        //         $('#showDuration').html(`Duration: ${data.duration} months.`);
        //         $('#showPrice').html(`Price: ${data.price} u$s.`);
        //         $('#showTeacher').attr('checked', true);
        //     },
        //     error: function(xhr, status, error) {
        //     },
        //     complete: function(data) {
        //     },
        // })
    }

    
    function showRemoveTeacher(teacher) {
        console.log(teacher)
        $('#removeTitle').html(`Are you sure you want to remove ${teacher.name}?`);
        $('#showRemoveTeacher').attr('checked', true);
        $('#removeButton').attr('onClick', `removeTeacher(${teacher.id})`);
    }
    
    function removeTeacher(teacherId) {
        $.ajax({
            url: `/teachers/${teacherId}`,
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
    
    $('#closeShowTeacher').on('click', function() {
        $('#showTeacher').attr('checked', false);
    })

    $('#closeEditTeacher').on('click', function() {
        $('#showEditTeacher').attr('checked', false);
    })

    $('#closeRemoveTeacher').on('click', function() {
        $('#showRemoveTeacher').attr('checked', false);
    })
