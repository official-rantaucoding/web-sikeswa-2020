function grafik_jk_dashboard(url) {

	var cekidChartjk = document.getElementById("jkbarChart");
	if (cekidChartjk != null) {
		var lokasi = url + "other/getGrafikJk_pasien";
		var ctx = document.getElementById("jkbarChart").getContext('2d');
		var optionjkChart = {
			type: 'horizontalBar',
			data: {
				labels: ["Laki-Laki", "Perempuan", "Transeksual", "Tidak diketahui", "Tidak menentukan"],
				datasets: [{
					label: 'Jumlah JK',
					data: [],
					backgroundColor: [
						'#6495ED', '#FF1493', '#8B0000', '#696969', '#87CEFA'
					]
				}]
			},
			options: {
				legend: {
					display: false
				},
				scales: {
					xAxes: [{
						gridLines: {
							display: false,
						}
					}],
					yAxes: [{
						ticks: {
							beginAtZero: true
						},
						gridLines: {
							display: false,
						}
					}]
				},
				responsive: true,
				maintainAspectRatio: false,
				datasetFill: false
			}
		}

		$.getJSON(lokasi, function (data) {
			optionjkChart.data.datasets[0].data = data;
			var jkChart = new Chart(ctx, optionjkChart);
		});
	}

}

function grafik_pendidikan_dashboard(url) {
	var cekidChartdidik = document.getElementById("chartpendidikan");
	if (cekidChartdidik != null) {
		var urlpendidikan = url + "other/getGrafikpendidikan_pasien";
		var ctx = document.getElementById("chartpendidikan").getContext('2d');
		var optionpendidikanChart = {
			type: 'doughnut',
			data: {
				labels: [],
				datasets: [{
					data: [],
					backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#5F9EA0', '#FF1493', '#6495ED', '#8B0000', '#696969', '#87CEFA'],
				}]
			},
			options: {
				maintainAspectRatio: false,
				responsive: true,
				legend: {
					display: true,
					position: 'right',
				},
			}
		}

		$.getJSON(urlpendidikan, function (data) {
			optionpendidikanChart.data.datasets[0].data = data;
			optionpendidikanChart.data.labels[0] = "SD (" + data[0] + ")";
			optionpendidikanChart.data.labels[1] = "SMP (" + data[1] + ")";
			optionpendidikanChart.data.labels[2] = "SMA (" + data[2] + ")";
			optionpendidikanChart.data.labels[3] = "DI (" + data[3] + ")";
			optionpendidikanChart.data.labels[4] = "DII (" + data[4] + ")";
			optionpendidikanChart.data.labels[5] = "DIII (" + data[5] + ")";
			optionpendidikanChart.data.labels[6] = "DIV (" + data[6] + ")";
			optionpendidikanChart.data.labels[7] = "S1 (" + data[7] + ")";
			optionpendidikanChart.data.labels[8] = "S2 (" + data[8] + ")";
			optionpendidikanChart.data.labels[9] = "S3 (" + data[9] + ")";
			optionpendidikanChart.data.labels[10] = "Tidak Sekolah (" + data[10] + ")";
			optionpendidikanChart.data.labels[11] = "Belum Sekolah (" + data[11] + ")";
			var pendidikanChart = new Chart(ctx, optionpendidikanChart);
		});
	}

}

function grafik_desa_dashboard(url) {
	var cekidChartdesa = document.getElementById("chartdesa");
	if (cekidChartdesa != null) {
		var urldesa = url + "other/getGrafikdesa_pasien";
		var ctx = document.getElementById("chartdesa").getContext('2d');
		var optiondesaChart = {
			type: 'doughnut',
			data: {
				labels: [],
				datasets: [{
					data: [],
					backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
				}]
			},
			options: {
				maintainAspectRatio: false,
				responsive: true,
				legend: {
					display: true,
					position: 'right',
				},
			}
		}

		$.getJSON(urldesa, function (data) {
			optiondesaChart.data.datasets[0].data = data;
			optiondesaChart.data.labels[0] = "Soulowe (" + data[0] + ")";
			optiondesaChart.data.labels[1] = "Potoya (" + data[1] + ")";
			optiondesaChart.data.labels[2] = "Karawana (" + data[2] + ")";
			optiondesaChart.data.labels[3] = "Sidera (" + data[3] + ")";
			var desaChart = new Chart(ctx, optiondesaChart);
		});
	}
}

function grafik_umur_dashboard(url) {

	var cekidChartumur = document.getElementById("chartumur");
	if (cekidChartumur != null) {
		var urlumur = url + "other/getGrafikumur_pasien";
		var ctx = document.getElementById("chartumur").getContext('2d');
		var optionumurChart = {
			type: 'doughnut',
			data: {
				labels: [],
				datasets: [{
					data: [],
					backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#5F9EA0'],
				}]
			},
			options: {
				maintainAspectRatio: false,
				responsive: true,
				legend: {
					display: true,
					position: 'right',
				},
			}
		}

		$.getJSON(urlumur, function (data) {
			optionumurChart.data.datasets[0].data = data;
			optionumurChart.data.labels[0] = "< 18 tahun (" + data[0] + ")";
			optionumurChart.data.labels[1] = "18 - 25 tahun (" + data[1] + ")";
			optionumurChart.data.labels[2] = "26 - 30 tahun (" + data[2] + ")";
			optionumurChart.data.labels[3] = "31 - 35 tahun (" + data[3] + ")";
			optionumurChart.data.labels[4] = "36 - 40 tahun (" + data[4] + ")";
			optionumurChart.data.labels[5] = "41 - 45 tahun (" + data[5] + ")";
			optionumurChart.data.labels[6] = "> 45 tahun (" + data[6] + ")";

			var umurChart = new Chart(ctx, optionumurChart);
		});
	}

}

function grafikpetadasboard(url) {
	var urlpeta = url + 'other/getGrafikpeta_pasien';
	$.getJSON(urlpeta, function (data) {
		$('#nilai_potoya').html(data[1]);
		$('#nilai_sidera').html(data[3]);
		$('#nilai_karawana').html(data[2]);
		$('#nilai_peta_soluowe').html(data[0]);

		$('#wilayah_potoya').html("Wilayah Desa Potoya (" + data[1] + ")");
		$('#wilayah_sidera').html("Wilayah Desa Sidera (" + data[3] + ")");
		$('#wilayah_karawana').html("Wilayah Desa Karawana (" + data[2] + ")");
		$('#wilayah_soluowe').html("Wilayah Desa Soluowe (" + data[0] + ")");
	});
}

// finish dashboard grafik