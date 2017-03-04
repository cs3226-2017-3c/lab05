var cacheDataSets;

function drawChart(chartId){
  var url = "historyDataSet";
  var history = $(chartId);
  var i, labels = [], week = "Week ";
  for (i=0; i < 15; i++) {
    var aLabel = week.concat(i);
    labels.push(aLabel);
  }
  $.getJSON(url, function(dataSets){
    ajaxReceived = true;
    cacheDataSets = dataSets;
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

function drawChart(chartId, callback, anotherId){
  var url = "historyDataSet";
  var history = $(chartId);
  var i, labels = [], week = "Week ";
  for (i=0; i < 15; i++) {
    var aLabel = week.concat(i);
    labels.push(aLabel);
  }
  $.getJSON(url, function(dataSets){
    ajaxReceived = true;
    cacheDataSets = dataSets;
    var historyData = {
      labels : labels,
      datasets : dataSets
    };
    var chartInstance = new Chart(history, {
      type: 'line',
      data: historyData
    });
    if (callback) {
      callback(anotherId);
    }
  });
}

function drawChartSmall(chartId){
  var history = $(chartId);
  var i, labels = [], week = "Week ";
  for (i=0; i < 15; i=i+2) {
    var aLabel = week.concat(i);
    labels.push(aLabel);
  }
  var dataSets = eliminateOddWeek(cacheDataSets);
  var historyData = {
    labels : labels,
    datasets : dataSets
  };
  var chartInstance = new Chart(history, {
    type: 'line',
    data: historyData
  });
}

function eliminateOddWeek(dataSets) {
  var dataSetsCopy = dataSets;
  var i;
  var buffer;
  for (i=0; i<dataSetsCopy.length; i++) {
    var thisData = dataSetsCopy[i].data;
    var tempData = new Array();
    var j;
    for (j=0; j<thisData.length; j=j+2) {
      tempData.push(thisData[j]);
    }
    dataSetsCopy[i].data = tempData; 
  }
  return dataSetsCopy;
}

