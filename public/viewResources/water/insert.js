'use strict';

$('#frmInsertWater').formValidation(objectValidate(
{
	txtResult:
	{
		validators:
		{
			notEmpty:
			{
				message: '<b style="color: red;">Este campo es requerido.</b>'
			},
			regexp:
			{
				message : '<b style="color: red;">Formato incorrecto. [Ejemplo: 0.1, 0.5, 1.0].</b>',
				regexp : /^[0-1]\.[0-9]$/
			}
		}
	}
}));

var areaChartData=
{
	labels  : labelsGraphic.split(','),
	datasets: [
		{
			label               : 'Electronics',
			fillColor           : '#f5f5f5',
			strokeColor         : '#999999',
			pointColor          : 'rgba(210, 214, 222, 1)',
			pointStrokeColor    : '#c1c7d1',
			pointHighlightFill  : '#fff',
			pointHighlightStroke: 'rgba(220,220,220,1)',
			data                : dataGraphic.split(',')
		}
	]
};

$(function()
{
	var barChartCanvas=$('#barChart').get(0).getContext('2d');
	var barChart=new Chart(barChartCanvas);
	var barChartData=areaChartData;

	var barChartOptions=
	{
		//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		scaleBeginAtZero        : true,
		//Boolean - Whether grid lines are shown across the chart
		scaleShowGridLines      : true,
		//String - Colour of the grid lines
		scaleGridLineColor      : 'rgba(0,0,0,.05)',
		//Number - Width of the grid lines
		scaleGridLineWidth      : 1,
		//Boolean - Whether to show horizontal lines (except X axis)
		scaleShowHorizontalLines: true,
		//Boolean - Whether to show vertical lines (except Y axis)
		scaleShowVerticalLines  : true,
		//Boolean - If there is a stroke on each bar
		barShowStroke           : true,
		//Number - Pixel width of the bar stroke
		barStrokeWidth          : 2,
		//Number - Spacing between each of the X value sets
		barValueSpacing         : 5,
		//Number - Spacing between data sets within X values
		barDatasetSpacing       : 1,
		//String - A legend template
		legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		//Boolean - whether to make the chart responsive
		responsive              : true,
		maintainAspectRatio     : true
	}

	barChartOptions.datasetFill = false;
	barChart.Bar(barChartData, barChartOptions);
});

function sendFrmInsertWater()
{
	var isValid=null;

	$('#frmInsertWater').data('formValidation').resetForm();
	$('#frmInsertWater').data('formValidation').validate();

	isValid=$('#frmInsertWater').data('formValidation').isValid();

	if(!isValid)
	{
		incorrectNote();

		return;
	}

	confirmDialogSend('frmInsertWater');
}