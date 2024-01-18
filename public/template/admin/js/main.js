$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Xóa một menu
function removeRow(id, url) {
    if (confirm('Bạn có muốn xóa dòng này hay không?')) {
        $.ajax({
            type: "POST",
            dataType: "JSON",
            data: {  id: id }, 
            url: url,
            success: function (result) {
                if(result === false) {
                    alert(result.message);
                    location.reload();
                }
                else {
                    alert(result.message);
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}

// Upload file
$('#upload').change(function() {
    const form = new FormData();
    const fileInput = document.getElementById('upload');
    form.append('file', fileInput.files[0]);
    const url = '/shop/admin/upload/services';
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        data: form,
        url: url,
        success: function (result) {
            console.log(result.error)
            if (result.error == 'false') {
                $('#image_show').html('<a href=""><img src="/shop/' + result.url + '" target= "_blank" width="100px"></a>');
                $('#thumb').val(result.url);
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});
