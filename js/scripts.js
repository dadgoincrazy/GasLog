$(document).ready(function() {
	console.log('scripts.js loaded');
	
	// DataTable my tables
	$('#entries-table').dataTable({
		"lengthMenu": [3, 10, 25]
	});
	
	// Only allow numbers and decimals to be added on inputs with class input-money or input-decimal
	$('.input-money, .input-decimal').on('keypress', function() {
		var allowed = ['.', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
		
		if($.inArray(String.fromCharCode(event.which), allowed) == -1)
		{
			event.preventDefault();
		}
	});
	
	$('.msg').each(function() {
		
		$(this).delay(2000).animate({
			duration: 500,
			complete: function() { $('.msg').remove(); },
			width: "toggle",
			height: "toggle"
		});
	});
	
	$('.chart').each(function() {
		var func  = $(this).closest('.chart-container').attr('chart-func');
		var ctx   = this.getContext('2d');
		var chart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: [],
				datasets: []
			}
		});
		
		$.ajax({
			type: "get",
			url: func
		}).done(function(rdata) {
			var data = JSON.parse(rdata);
			console.log(data);
			
			chart.data.labels.push(...data.labels);
			chart.data.datasets.push(data.kilos);
			chart.data.datasets.push(data.cost);
			chart.data.datasets.push(data.litres);
			
			chart.update();
			
			console.log(chart);
		});
	});

});