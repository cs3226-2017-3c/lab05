$(function(){
    $('input[name="sum"]').attr('disabled','disabled');
    sum();
    $('input[name="mc"], input[name="tc"], input[name="hw"], input[name="bs"], input[name="ks"], input[name="ac"]').keyup(function(){updateSum();});
})

function sum(){
    var s = [];
    var e = $('input[name="mc"], input[name="tc"], input[name="hw"], input[name="bs"], input[name="ks"], input[name="ac"]');
    e.each(function(){
        s = s.concat($(this).val().split(","));
    });
    var sum = s.reduce((pv,cv)=>{
       return pv + (parseFloat(cv)||0);
    },0);

    $('input[name="sum"]').val(sum);    
}

function updateSum() {
    var MC = $('#mc').val();
    var TC = $('#tc').val();
    var HW = $('#hw').val();
    var Bs = $('#bs').val();
    var Ks = $('#ks').val();
    var Ac = $('#ac').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({ 
        type: "POST", 
        url:"/computeSum", 
        data:{ mc: MC,
            tc: TC,
            hw: HW,
            bs: Bs,
            ks: Ks,
            ac: Ac },
            success: function(data) {
                var sum = data.sum;
                //console.log("haha" + sum);
                $('#sum').val(sum);
            },
            error: function(xhr, textStatus, thrownError) {
                alert(' Error');
            }
        }); 
} 