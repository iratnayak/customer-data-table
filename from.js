
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#datatable').DataTable({
        'serverSide': true,
        'processing': true,
        'paging': true,
        'order': [],
        'ajax': {
            'url': 'fetch_data.php',
            'type': 'post',
        },
        'fnCreatedRow': function(nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
        },
        'columnDefs': [{
            'targets': [0, 5],
            'orderable': false,
        }]
    });

        // Reset form fields when modal is shown
        $('#addUserModal').on('shown.bs.modal', function () {
            $('#saveUserForm')[0].reset(); // Reset the form fields
        });

        // Handle form submission for adding a user
        $(document).on('submit', '#saveUserForm', function(event) {
            event.preventDefault();
            var name = $('#inputUsername').val();
            var email = $('#inputEmail').val();
            var mobile = $('#inputMobile').val();
            var city = $('#inputCity').val();
            if (name !== '' && email !== '' && mobile !== '' && city !== '') {
                $.ajax({
                    url: "add_user.php",
                    data: { name: name, email: email, mobile: mobile, city: city },
                    type: 'post',
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'success') {
                            table.ajax.reload(); // Reload the data
                            alert('User successfully added');
                            $('#inputUsername').val(''); 
                            $('#inputEmail').val('');
                            $('#inputMobile').val('');
                            $('#inputCity').val('');
                            $('#addUserModal').modal('hide'); // Close the modal
                        }
                    }
                });
            } else {
                alert("Please fill all the required fields");
            }
        });

        // Handle form submission for updating a user
        $(document).on('submit', '#updateUserForm', function(event) {
            event.preventDefault();
            var id = $('#id').val();
            var trid = $('#trid').val();
            var username = $('#_inputUsername').val();
            var email = $('#_inputEmail').val();
            var mobile = $('#_inputMobile').val();
            var city = $('#_inputCity').val();
            if (username !== '' && email !== '' && mobile !== '' && city !== '') {
                $.ajax({
                    url: "update_user.php",
                    data: { id: id, username: username, email: email, mobile: mobile, city: city },
                    type: 'post',
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'success') {
                            var button = '<a href="javascript:void();" class="btn btn-sm btn-info editBtn" data-id="'+ id +'">Edit</a><a href="javascript:void();" class="btn btn-sm btn-danger deleteBtn" data-id="'+ id +'">Delete</a>';
                            var row = table.row("[id='"+ trid +"']");
                            row.row("[id='"+ trid +"']").data([id, username, email, mobile, city, button]).draw();
                            $('#editUserModal').modal('hide'); 
                        } else {
                            alert('Update failed');
                        }
                    }
                });
            } else {
                alert("Please fill all the required fields");
            }
        });

        // Show edit modal with user data
        $(document).on('click', '.editBtn', function(event) {
            var id = $(this).data('id');
            var trid = $(this).closest('tr').attr('id');
            $.ajax({
                url: "get_single_user.php",
                data: { id: id },
                type: "post",
                success: function(data) {
                    var json = JSON.parse(data);
                    $('#id').val(json.id);
                    $('#trid').val(trid);
                    $('#_inputUsername').val(json.username);
                    $('#_inputEmail').val(json.email);
                    $('#_inputMobile').val(json.mobile);
                    $('#_inputCity').val(json.city);
                    $('#editUserModal').modal('show');
                }
            });
        });
    // Handle the delete button click event
    $(document).on('click', '.deleteBtn', function(event) {
    var id = $(this).data('id');
    console.log('Attempting to delete ID:', id);  // Debugging line

    $.ajax({
        url: "delete_user.php",
        data: { id: id },
        type: "post",
        success: function(data) {
            console.log('Server Response:', data);  // Debugging line
            try {
                var json = JSON.parse(data);
                var status = json.status;
                if (status == 'success') {
                    console.log('Successfully deleted ID:', id);
                    // Find the row by the data and remove it
                    var row = table.rows(function(idx, data, node) {
                        console.log('Checking row data:', data);  // Debugging line
                        return data[0] == id; // Assuming the first column contains the ID
                    });

                    console.log('Rows found:', row.count());  // Debugging line
                    if (row.count() > 0) {
                        row.remove().draw(false);
                        console.log('Row successfully removed from DataTable');
                    } else {
                        console.log('No matching row found in DataTable for ID:', id);
                    }
                } else {
                    console.log('Deletion failed on server:', json.message);
                    alert('Delete failed: ' + json.message);
                }
            } catch (e) {
                console.error('Error parsing JSON response:', e);
                alert('Delete failed: Invalid server response');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);  // Debugging line
            alert('Delete failed');
        }
    });
});


});
