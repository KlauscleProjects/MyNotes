function archive_note(actionPath, token) {
    var params = {
        token: token,
        messageBefore: "Once your archive, this will not delete item but display in the archive section.",
        iconBefore: "warning",
        confirmButtonText: "Yes, archive it",
        messageSuccessTitle: "Archiving Success",
        messageSuccess: "Note has been archived successfully",
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
        url: actionPath + token,
    };
    sweetAlert(params);
}

function restoreNote(actionPath, token) {
    var params = {
        token: token,
        messageBefore: "Once your restore, this will display again in its original location.",
        iconBefore: "warning",
        confirmButtonText: "Yes, restore it",
        messageSuccessTitle: "Restoring Success",
        messageSuccess: "Note has been restored successfully.",
        url: actionPath + token,
    };

    sweetAlert(params);
}

function deleteNotePermanently(actionPath, token) {
    var params = {
        token: token,
        messageBefore: "This will be deleted permanently and cannot be restored.",
        iconBefore: "warning",
        confirmButtonText: "Yes, delete it",
        messageSuccessTitle: "Deleted Permanenty",
        messageSuccess: "Note has been deleted permanently.",
        url: actionPath + token,
    };

    sweetAlert(params);
}

function deleteTag(actionPath, token) {
    var params = {
        token: token,
        messageBefore: "This will be deleted permanently and cannot be restored.",
        iconBefore: "warning",
        confirmButtonText: "Yes, delete it",
        messageSuccessTitle: "Deleted Permanenty",
        messageSuccess: "Tag has been deleted permanently.",
        url: actionPath + token,
    };

    sweetAlert(params);
}

//=============== ARCHIVE SELECTION ACTION
function myFunction() {

    var selectedBox = [];
    $("input:checkbox[name=checkBoxArray]:checked").each(function() {
        selectedBox.push($(this).val());
    });

    var x = document.getElementById("bulk-div");
    if (selectedBox.length == 0) {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function bulk_option_btn(actionpath) {
    //alert("Hey");

    var bulk_option = document.getElementById("bulk_options").value;

    var selectedBox = [];
    $("input:checkbox[name=checkBoxArray]:checked").each(function() {
        selectedBox.push($(this).val());
    });

    if (selectedBox.length == 0) {
        alert("Please select item to do this operation.");
        return;
    }

    switch (bulk_option) {
        case '1':
            the_messageBefore = selectedBox.length + " items will only place on your archive, this will not delete items.";
            the_messageSuccessTitle = "Archived success";
            the_messageSuccess = "Selected items has been archived successfully.";
            break;
        case '2':
            the_messageBefore = selectedBox.length + " items will go on the trash and not permanently be deleted."
            the_messageSuccessTitle = "Deleted success";
            the_messageSuccess = "Selected items has been deleted successfully.";
            break;
        case '3':
            the_messageBefore = selectedBox.length + " items will be unarchive and back again to notes section."
            the_messageSuccessTitle = "Unarchived success";
            the_messageSuccess = "Selected items has been unarchived successfully.";
            break;
        case '4':
            the_messageBefore = selectedBox.length + " items will be restore, this will display again in its original location."
            the_messageSuccessTitle = "Restored success";
            the_messageSuccess = "Selected items has been restored successfully.";
            break;
        case '5':
            the_messageBefore = selectedBox.length + " items will be deleted permanently and cannot be restored."
            the_messageSuccessTitle = "Deleted success";
            the_messageSuccess = "Selected items has been deleted permanently.";
            break;
        default:
            alert("Please select an action to apply.");
            break;
    }

    var params = {
        messageBefore: the_messageBefore,
        iconBefore: "warning",
        confirmButtonText: "Confirm",
        messageSuccessTitle: the_messageSuccessTitle,
        messageSuccess: the_messageSuccess,
        count: selectedBox.length,
        tokens: selectedBox,
        url: actionpath + bulk_option
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
                data: {
                    //for bulk selection only
                    "btn_set": 1,
                    "tokens[]": params['tokens'],
                },
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