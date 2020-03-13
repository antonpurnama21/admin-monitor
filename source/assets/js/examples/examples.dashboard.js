(function($) {

	'use strict';

	$('.modal-sizes').magnificPopup({
		type: 'inline',
		preloader: false,
		modal: true
	});

	/*
	Modal Dismiss
	*/
	$(document).on('click', '.modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

	/*
	Modal Confirm
	*/
	$(document).on('click', '.modal-confirm', function (e) {
		e.preventDefault();
		$.magnificPopup.close();

		new PNotify({
			title: 'Success!',
			text: 'Modal Confirm Message.',
			type: 'success'
		});
	});


	/*
	Nestable
	*/

	$('#nestable').nestable({
		handleClass: '1'
	});

	(function() {
		var ch = Gauge(
			document.getElementById("ch"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 10,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("fx"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 2,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("ad"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 6,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("io"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 4,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("tb"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 13,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("ip"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 8,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("mr"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 9,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("cs"),
				{
			  min: 0,
			  max: 10,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 3,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("mk"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 15,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("v1"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 10,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		var fx = Gauge(
			document.getElementById("v2"),
				{
			  min: 0,
			  max: 12,
			  dialStartAngle: 180,
			  dialEndAngle: 0,
			  value: 6,
			  viewBox: "0 0 100 50",
			  color: function(value) {
				if(value < 6) {
				  return "#5ee432";
				}else if(value < 12) {
				  return "#fffa50";
				}else {
				  return "#ef4655";
				}
			  }
			}
		  );
	})();

	(function() {
		Highcharts.chart('container-stats', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Test Case Overall'
			},
			subtitle: {
				text: 'Source: sumber'
			},
			xAxis: {
				categories: [
					'Quartel 1',
					'Quartel 2',
					'Quartel 3',
					'Quartel 4',
				],
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Total Bugs'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y} Bugs</b></td></tr>',
				footerFormat: '</table>',
				shared: false,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'Website Apps',
				data: [20, 15, 8, 6],
				color: '#FF0000'
		
			}, {
				name: 'Mobile Apps',
				data: [15,10,12,8],
				color: '#1089ff'
		
			}, {
				name: 'Setup Box',
				data: [5,4,4,2],
				color: '#fdd365'
		
			}]
		});
	})();
	


}).apply(this, [jQuery]);

$('.value-text').each(function (index, val) {
	var tx = $(val).text()
	$(val).text(tx + ' bugs')
});

// $('#btn-show').click(function () {
// 	var id = $('#btn_show').val();
// 	var x = document.getElementById("myDIV");
// 	if (x.style.display === "none") {
// 	  x.style.display = "block";
// 	} else {
// 	  x.style.display = "none";
// 	}
// })

// function myFunction() {
// 	var x = document.getElementById("myDIV");
// 	// var x = $('#myDIV').attr('id');
// 	if (x.style.display === "none") {
// 	  x.style.display = "block";
// 	} else {
// 	  x.style.display = "none";
// 	}
// }