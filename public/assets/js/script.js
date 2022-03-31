function archive_note(actionPath, token) {
    var params = {
        token: token,
        messageBefore: "Once your archive, this will not delete item but display in the archive section.",
        iconBefore: "warning",
        confirmButtonText: "Yes, archive it",
        messageSuccessTitle: "Archiving Success",
        messageSuccess: "Note has been archived successfully",
        tokenID: token,
        url: actionPath + token,
    };

    sweetAlert(params);
}

function delete_note(actionPath, token) {
    var params = {
        token: token,
        messageBefore: "This will go on the trash and not permanently be deleted.",
        iconBefore: "warning",
        confirmButtonText: "Yes, delete it",
        messageSuccessTitle: "Deleted Success",
        messageSuccess: "Note has been deleted successfully",
        tokenID: token,
        url: actionPath + token,
    };
    sweetAlert(params);
}

function restoreNoteFromTrash(actionPath, token) {
    var params = {
        token: token,
        messageBefore: "Once your restore, this will display again in its original location.",
        iconBefore: "warning",
        confirmButtonText: "Yes, restore it",
        messageSuccessTitle: "Restoring Success",
        messageSuccess: "Note has been restored successfully",
        tokenID: token,
        url: actionPath + token,
    };

    sweetAlert(params);
}

function sweetAlert(params) {
    Swal.fire({
        title: 'Are you sure?',
        text: params['messageBefore'],
        icon: params['iconBefore'],
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: params['confirmButtonText'],
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: params['url'],
                // data: {
                //     "btn_set": 1,
                //     "tokenID": params['tokenID'],
                // },
                success: function(response) {
                    Swal.fire({
                        title: params['messageSuccessTitle'],
                        text: params['messageSuccess'],
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        location.reload();
                    });
                }
            });
        }
    })
}