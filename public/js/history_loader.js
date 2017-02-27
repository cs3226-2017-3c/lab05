$(function(){
       showChart();
})

function showChart() {

    console.log("asdhauisbfisbvofv");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({ 
        type: "POST", 
        url:"/getHistoryHtml", 
        data:{},
            success: function(data) {
                $('.loader').css('display','none');
                var chart = data.htmlString;

                console.log("111111");
                $('#historyLoaded').html(chart);

                console.log("222222");
                // $.getScript( "js/rank.js", function( data, textStatus, jqxhr ) {

                //     console.log( "Rank was performed." );
                // });


            },
            error: function(xhr, textStatus, thrownError) {
                
                alert(' Error');
            }
        }); 
} 
