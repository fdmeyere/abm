$(document).ready(function(){
	$.ajax({
		url : "https://azurebackupmonitor.azurewebsites.net/test/php-mysql-chartjs/testline.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var hostname = [];
			var freedata_follower = [];
			var freeusr2_follower = [];
			var credat_follower = [];
			var freetmp_follower = [];


			for(var i in data) {
				credat_follower.push(data[i].credat);
				freedata_follower.push(data[i].freedata);
				freeusr2_follower.push(data[i].freeusr2);
				freetmp_follower.push(data[i].freetmp);
			}

			var chartdata = {
				labels: credat_follower,
				datasets: [
					
					{
						label: "Vrije Ruimte op /data",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(211, 72, 54, 0.75)",
						borderColor: "rgba(211, 72, 54, 1)",
						pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
						pointHoverBorderColor: "rgba(211, 72, 54, 1)",
						data: freedata_follower
					},
							
					{
						label: "Vrije Ruimte op /usr2",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(29, 202, 255, 0.75)",
						borderColor: "rgba(29, 202, 255, 1)",
						pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
						pointHoverBorderColor: "rgba(29, 202, 255, 1)",
						data: freeusr2_follower
					},
					{
						label: "Vrije Ruimte op /tmp",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: freetmp_follower
					}
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error : function(data) {

		}
	});
});