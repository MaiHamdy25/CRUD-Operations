function viewUser(id) {
    $.post('view.php', { emp_id: id }, function(data) {
        $('#popup-content').html(data);
        document.getElementById('popup').style.display = 'block';
    }).fail(function(xhr, status, error) {
        alert('Error fetching user data: ' + error);
    });
}

function editUser(id) {
    window.location.href = `edit.php?emp_id=${id}`;
}

function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        $.post('delete.php', { emp_id: id }, function(response) {
            if (response.success) {
                $(`#row-${id}`).remove();
            } else {
                alert('Failed to delete user.');
            }
        }, 'json');
    }
}
function showPopup() {
    document.getElementById('popup').style.display = 'block';
    document.body.classList.add('popup-open');
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
    document.body.classList.remove('popup-open');
}

