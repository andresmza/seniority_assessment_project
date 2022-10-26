    $(function() {

    })

    function showAdmin(adminId) {
        $.ajax({
            url: `/admins/${adminId}`,
            type: "GET",
            data: {},
            beforeSend: function(data) {},
            success: function(data) {
                $('#showFullName').html(`${data.name} ${data.lastname}`);
                $('#showDNI').html(`DNI: ${data.dni}`);
                $('#showEmail').html(`Email: ${data.email}`);
                $('#showAdmin').attr('checked', true);
            },
            error: function(xhr, status, error) {
            },
            complete: function(data) {
            },
        })
    }

    $('#closeShowAdmin').on('click', function() {
        $('#showAdmin').attr('checked', false);
    })

    function editAdmin(admin) {
        $('#editAdminForm').attr('action', `/admins/${admin.id}`)
        $('#editName').val(admin.name);
        $('#editDescription').html(admin.description);
        $('#editDuration').val(admin.duration);
        $('#editPrice').val(admin.price);
        $('#editAdmin').attr('checked', true);
    }

    
    function showRemoveAdmin(admin) {
        $('#removeTitle').html(`Are you sure you want to remove ${admin.name}?`);
        $('#showRemoveAdmin').attr('checked', true);
        $('#removeButton').attr('onClick', `removeAdmin(${admin.id})`);
    }
    
    function removeAdmin(adminId) {
        $.ajax({
            url: `/admins/${adminId}`,
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
    
    $('#closeShowAdmin').on('click', function() {
        $('#showAdmin').attr('checked', false);
    })

    $('#closeEditAdmin').on('click', function() {
        $('#showEditAdmin').attr('checked', false);
    })

    $('#closeRemoveAdmin').on('click', function() {
        $('#showRemoveAdmin').attr('checked', false);
    })
