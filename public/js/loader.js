$(function(){
       showTable();
})

function showTable() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ 
        type: "POST", 
        url:"/getIndexHtml", 
        data:{},
            success: function(data) {
                $('.loader').css('display','none');
                var table = data.htmlString;

                
                $('#tableLoaded').html(table);

                $.getScript( "js/highlight.js", function( data, textStatus, jqxhr ) {

                    console.log( "Highlight was performed." );
                });

                $.getScript( "js/rank.js", function( data, textStatus, jqxhr ) {

                    console.log( "Rank was performed." );
                });


            },
            error: function(xhr, textStatus, thrownError) {
                
                alert(' Error');
            }
        }); 
} 
