$(function(){
    $('input[name="sum"]').attr('disabled','disabled');
    sum();
    $('input[name="mc"], input[name="tc"], input[name="hw"], input[name="bs"], input[name="ks"], input[name="ac"]').change(function(){sum();});
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