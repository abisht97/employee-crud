$('.ajax').on('click', function(e) {
    var url = $(this).data('url');
    var div = $(this).data('div');
    if(div=='' || div==undefined){
        var div = "#loadModal";
    }
    loadAjaxHTML(url,div);
    e.preventDefault();
});

function loadAjaxHTML(path,id,func = null){
    $.ajax({
        url: path,
        type:'GET'
    }).done(function(data) {
        $(id).html(data);
    }).fail(function(data){
        var errors = data;
        console.log("-========================",errors);
    });
}