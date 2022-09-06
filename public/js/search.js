document.getElementById('search-bar').addEventListener('keyup', search);
$(window).on('load', search());
function search() {
    var url = new URL(window.location.href);
    var curPage = url.searchParams.get("page");
    let input = document.getElementById('search-bar').value,
        table = window.location.pathname.split('/').at(-1);
    $.ajax({
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        url: '/search',
        data: {
            table, input,page:curPage,
        },
        // dataType:"JSON",
        success: function (data) {
            $('#table').html(data);
        }
    })
}
