@extends('template')
@section('title')
Student History
@endsection
@section('main')
<div class="container">
<div class="row">
	<div class="hidden-xs hidden-sm hidden-md col-lg-12" >
		<canvas id="historyChart-lg" width="800" height="500"></canvas>
	</div>
  <div class="hidden-xs col-sm-12 col-md-12 hidden-lg" >
    <canvas id="historyChart-sm" width="800" height="500"></canvas>
  </div>
	<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
		<p>View in bigger screen for the history statistics=P</p>
	</div>
</div>
</div>
@endsection
@section('footer')
	<script type="text/javascript" src="../../js/date.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<!-- draw history chart -->
	<script>
    $(function(){
      var i, labels = [], week = "Week ";
      for (i=0; i < 15; i=i+2) {
        var aLabel = week.concat(i);
        labels.push(aLabel);
      }

      var CSS_COLOR_NAMES = ["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];
      var arrayDataSets =[], dataSet = {}, data = [];
      var currName = "", currWeek = 0, currStudent = 0;
      @foreach($score as $sc)
        var studentName = "{{$sc->student_name}}";
        if (currName != studentName) {
          if (data.length > 0) {
            var realData = [];
            var i = 0;
            for (i = 0; i < 15; i=i+2) {
              realData.push(data[i]);
            }
            dataSet = {label: currName, fill: false, lineTension: 0, 
              backgroundColor: CSS_COLOR_NAMES[currStudent],
              borderColor: CSS_COLOR_NAMES[currStudent],
              hidden: true,
              pointRadius: 0, data: realData};
            arrayDataSets.push(dataSet);
            data = [];
            currWeek = 0;
            currStudent = currStudent + 1;
            if (currStudent == CSS_COLOR_NAMES.length) {
              currStudent = 0;
            }
          }
          currName = studentName;
        }
        var thisDate = parseDate("{{$sc->effective_from}}");
        while (convertWeekToDate(currWeek).compareTo(thisDate) < 0 ) {
          if (data.length == 0) {
            data.push(0);
          } else {
            var temp = data[currWeek-1];
            data.push(temp);
          }
          currWeek = currWeek + 1;
        }
        if (data.length < currWeek) {
          data.push("{{$sc->sum}}");
        } else {
          data[data.length-1] = "{{$sc->sum}}";
        }
      @endforeach

      var historyData = {
        labels : labels,
        datasets : arrayDataSets
      };
      var history = $("#historyChart-sm");
      var chartOptions = {
        title: {
          display: true,
          fontSize: 20,
          text: "Students\' Sum of Score over Week"
        },
        legend: {
            display: true,
            
        }
      };

      var chartInstance = new Chart(history, {
        type: 'line',
        data: historyData,
        options: chartOptions
      });
    });



    $(function(){
      var i, labels = [], week = "Week ";
      for (i=0; i < 15; i++) {
      	var aLabel = week.concat(i);
      	labels.push(aLabel);
      }

      var CSS_COLOR_NAMES = ["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];
      var arrayDataSets =[], dataSet = {}, data = [];
      var currName = "", currWeek = 0, currStudent = 0;
      @foreach($score as $sc)
      	var studentName = "{{$sc->student_name}}";
      	if (currName != studentName) {
      		if (data.length > 0) {
      			dataSet = {label: currName, fill: false, lineTension: 0, 
              backgroundColor: CSS_COLOR_NAMES[currStudent],
              borderColor: CSS_COLOR_NAMES[currStudent],
              hidden: true,
              pointRadius: 0, data: data};
      			arrayDataSets.push(dataSet);
      			data = [];
      			currWeek = 0;
            currStudent = currStudent + 1;
            if (currStudent == CSS_COLOR_NAMES.length) {
              currStudent = 0;
            }
      		}
      		currName = studentName;
      	}
      	var thisDate = parseDate("{{$sc->effective_from}}");
      	while (convertWeekToDate(currWeek).compareTo(thisDate) < 0 ) {
      		if (data.length == 0) {
      			data.push(0);
      		} else {
      			var temp = data[currWeek-1];
      			data.push(temp);
      		}
      		currWeek = currWeek + 1;
      	}
      	if (data.length < currWeek) {
      		data.push("{{$sc->sum}}");
      	} else {
      		data[data.length-1] = "{{$sc->sum}}";
      	}
      @endforeach

      var historyData = {
        labels : labels,
        datasets : arrayDataSets
      };
      var history = $("#historyChart-lg");
      var chartOptions = {
        title: {
          display: true,
          fontSize: 20,
          text: "Students\' Sum of Score over Week"
        },
        legend: {
            display: true,
            
        }
      };

      var chartInstance = new Chart(history, {
        type: 'line',
        data: historyData,
        options: chartOptions
      });
    });

    function parseDate(dateString) {
    	return Date.parse(dateString);
    }

    function convertWeekToDate(week) {
    	var weekZeroDate = "2016-11-25"
    	var date = Date.parse(weekZeroDate);
    	var addDays = 7*week;
    	date.add({ days: addDays });
    	return date;
    }
  	</script>
@endsection