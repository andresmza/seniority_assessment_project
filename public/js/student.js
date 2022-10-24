    $(function() {

    })

    function showStudent(studentId) {
        console.log('object')
        $.ajax({
            url: `/students/${studentId}`,
            type: "GET",
            data: {},
            beforeSend: function(data) {},
            success: function(data) {
                console.log(data)
                $('#showFullName').html(`${data.name} ${data.lastname}`);
                $('#showDNI').html(`DNI: ${data.dni}`);
                $('#showEmail').html(`Email: ${data.email}`);
                $('#showStudent').attr('checked', true);
            },
            error: function(xhr, status, error) {
            },
            complete: function(data) {
            },
        })
    }

    $('#closeShowStudent').on('click', function() {
        $('#showStudent').attr('checked', false);
    })

    function editStudent(student) {
        debugger
        $('#editStudentForm').attr('action', `/students/${student.id}`)
        $('#editName').val(student.name);
        $('#editDescription').html(student.description);
        $('#editDuration').val(student.duration);
        $('#editPrice').val(student.price);
        $('#editStudent').attr('checked', true);
        
        // $.ajax({
        //     url: `/students/${studentId}`,
        //     type: "GET",
        //     data: {},
        //     beforeSend: function(data) {},
        //     success: function(data) {
        //         console.log(data)
        //         $('#showTitle').html(data.name);
        //         $('#showDescription').html(data.description);
        //         $('#showDuration').html(`Duration: ${data.duration} months.`);
        //         $('#showPrice').html(`Price: ${data.price} u$s.`);
        //         $('#showStudent').attr('checked', true);
        //     },
        //     error: function(xhr, status, error) {
        //     },
        //     complete: function(data) {
        //     },
        // })
    }

    
    function showRemoveStudent(student) {
        console.log(student)
        $('#removeTitle').html(`Are you sure you want to remove ${student.name}?`);
        $('#showRemoveStudent').attr('checked', true);
        $('#removeButton').attr('onClick', `removeStudent(${student.id})`);
    }
    
    function removeStudent(studentId) {
        $.ajax({
            url: `/students/${studentId}`,
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
    
    $('#closeShowStudent').on('click', function() {
        $('#showStudent').attr('checked', false);
    })

    $('#closeEditStudent').on('click', function() {
        $('#showEditStudent').attr('checked', false);
    })

    $('#closeRemoveStudent').on('click', function() {
        $('#showRemoveStudent').attr('checked', false);
    })
