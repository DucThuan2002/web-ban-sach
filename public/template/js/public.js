$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ajax loadmore trang chủ
function loadMore()
{
    const page = $("#page").val();
    var pageNumber = parseInt(page, 10);

    $.ajax({
        type: "POST",
        dataType: "JSON",
        data: {  page }, 
        url: '/shop/services/load-products',
        success: function (result) {
            if(result.html != '')
            {
                $("#loadProduct").append(result.html);
                $("#page").val(pageNumber +1);
            }
            else
            {
                alert("Đã hết sản phẩm");
                $("#button-loadMore").css("display", "none");
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
    
}