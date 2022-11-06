<script>
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
    $(".check").click(function() {
        if( !$(this).prop('checked') ){
            $('#checkAll').prop('checked', $(this).prop('checked'))
        }
        $check = Array.from($(".check")).every(function(item){
            return item.checked;
        });
        if($check) $('#checkAll').prop('checked', $check)
    });
    function editToAjax(obj, idEdit, append){
        // console.log($('#' + append + ' textarea'));
        // console.log($(obj).attr('href-link'));
        $.ajax({
            url: $(obj).attr('href-link'),
            type: 'GET',
            success: function (result) {
                $('#' + append + ' textarea').text(result.data.messenger);
            },
            error: function (err) {
                console.log('error', err);
            }
        });
    }
</script>