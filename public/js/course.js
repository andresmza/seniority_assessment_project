$(function() {

    })

    function showCourse(courseId) {
        $.ajax({
            url: `/courses/${courseId}`,
            type: "GET",
            data: {},
            beforeSend: function(data) {},
            success: function(data) {
                console.log(data)
                $('#showTitle').html(data.name);
                $('#showDescription').html(data.description);
                $('#showDuration').html(`Duration: ${data.duration} months.`);
                $('#showPrice').html(`Price: ${data.price} u$s.`);
                $('#showCourse').attr('checked', true);
            },
            error: function(xhr, status, error) {
            },
            complete: function(data) {
            },
        })
    }

    $('#closeShowCourse').on('click', function() {
        $('#showCourse').attr('checked', false);
    })

    function editCourse(course) {
        debugger
        $('#editCourseForm').attr('action', `/courses/${course.id}`)
        $('#editName').val(course.name);
        $('#editDescription').html(course.description);
        $('#editDuration').val(course.duration);
        $('#editPrice').val(course.price);
        $('#editCourse').attr('checked', true);
        
        // $.ajax({
        //     url: `/courses/${courseId}`,
        //     type: "GET",
        //     data: {},
        //     beforeSend: function(data) {},
        //     success: function(data) {
        //         console.log(data)
        //         $('#showTitle').html(data.name);
        //         $('#showDescription').html(data.description);
        //         $('#showDuration').html(`Duration: ${data.duration} months.`);
        //         $('#showPrice').html(`Price: ${data.price} u$s.`);
        //         $('#showCourse').attr('checked', true);
        //     },
        //     error: function(xhr, status, error) {
        //     },
        //     complete: function(data) {
        //     },
        // })
    }

    
    function showRemoveCourse(course) {
        $('#removeTitle').html(`Are you sure you want to remove ${course.subject.name}?`);
        $('#showRemoveCourse').attr('checked', true);
        $('#removeButton').attr('onClick', `removeCourse(${course.id})`);
    }
    
    function removeCourse(courseId) {
        $.ajax({
            url: `/courses/${courseId}`,
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
    
    $('#closeShowCourse').on('click', function() {
        $('#showCourse').attr('checked', false);
    })

    $('#closeEditCourse').on('click', function() {
        $('#showEditCourse').attr('checked', false);
    })

    $('#closeRemoveCourse').on('click', function() {
        $('#showRemoveCourse').attr('checked', false);
    })