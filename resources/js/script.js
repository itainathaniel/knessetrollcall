$(document).ready(function(){
	if ($('#graph').length > 0) {
		console.log(categories);
		buildGraph();
	}
});

function buildGraph() {
	$('#graph').highcharts({
		chart: {
			type: 'columnrange',
			inverted: true,
		},

		title: {
			text: 'נוכחות חברי כנסת לאורך היום'
		},

		subtitle: {
			text: 'תאריך כלשהו'
		},

		xAxis: {
			categories: categories
		},

		yAxis: {
			title: {
				text: 'Week'
			}
		},

		tooltip: {
			valueSuffix: '°C'
		},

		plotOptions: {
			columnrange: {
				//stacking: 'normal'
				grouping:false
			},
			column: {
				//stacking: 'normal'
			}
		},

		legend: {
			enabled: false
		},

		series: series
	});
}
