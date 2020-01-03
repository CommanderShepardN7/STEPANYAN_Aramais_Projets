function clickTableTr(){

    $('table tr').click(function(){
        window.location = $(this).data('href')+'id= '+$(this).data('id');
        return false;
    });
}
