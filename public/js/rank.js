$(document).ready(function() 
{ 
    addRank();
} 
); 

function addRank()
{
    var rank=1;
    var table = document.getElementById("myTable");

    var sumIndex = table.rows[1].cells.length - 1;
    var largest = parseFloat(table.rows[1].cells[sumIndex].innerHTML);
    for (var i = 1, row; row = table.rows[i]; i++) {
        var current_sum = parseFloat(table.rows[i].cells[sumIndex].innerHTML);
        if ( current_sum == largest ) {
            table.rows[i].cells[0].innerHTML = rank;
        } else if (current_sum < largest) {
            largest = current_sum;
            rank = table.rows[i].cells[0].innerHTML;
        } else {
            console.log('Should not reach here');
        }
    }
}


