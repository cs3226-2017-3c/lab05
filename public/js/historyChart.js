function drawChart(chartId){
  var i, labels = [], week = "Week ";
  for (i=0; i < 15; i++) {
    var aLabel = week.concat(i);
    labels.push(aLabel);
  }
  var url = "historyDataSet";
  $.getJSON(url, function(dataSets){
    var history = $(chartId);
    var historyData = {
        labels : labels,
        datasets : dataSets
    };
    var chartInstance = new Chart(history, {
        type: 'line',
        data: historyData
    });
  });
}