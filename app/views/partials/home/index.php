<?php
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
	<div class="bg-light p-3 mb-3">
		<div class="container">
			<div class="row ">
				<div class="col-md-12 comp-grid">
					<h4>The Dashboard</h4>
				</div>
			</div>
		</div>
	</div>
	<div class="">
		<div class="container">
			<div class="row ">
				<div class="col-sm-6 comp-grid">
					<?php $rec_count = $comp_model->getcount_barang();  ?>
					<a class="animated zoomIn record-count alert alert-info" href="<?php print_link("barang/") ?>">
						<div class="row">
							<div class="col-2">
								<i class="fa fa-archive "></i>
							</div>
							<div class="col-8">
								<div class="flex-column justify-content align-center">
									<div class="title">Barang</div>
									<small class=""></small>
								</div>
							</div>

							<div class="col-2">
								<h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
							</div>

						</div>
					</a>
				</div>
				<div class="col-sm-6 comp-grid">
					<?php $rec_count = $comp_model->getcount_lokasibarang();  ?>
					<a class="animated zoomIn record-count alert alert-secondary" href="<?php print_link("lokasi_barang/") ?>">
						<div class="row">
							<div class="col-2">
								<i class="fa fa-map-signs "></i>
							</div>
							<div class="col-8">
								<div class="flex-column justify-content align-center">
									<div class="title">Lokasi Barang</div>
									<small class=""></small>
								</div>
							</div>

							<div class="col-2">
								<h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
							</div>

						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="">
		<div class="container">
			<div class="row ">
				<div class="col-md-12 comp-grid">
					<div class="card card-body">
						<?php
						$chartdata = $comp_model->barchart_tipebarang();
						?>
						<div>
							<h4>Tipe Barang</h4>
							<small class="text-muted"></small>
						</div>
						<hr />
						<canvas id="barchart_tipebarang"></canvas>
						<script>
							$(function() {
								var chartData = {
									labels: <?php echo json_encode($chartdata['labels']); ?>,
									datasets: [{
										label: 'Jumlah Barang',
										backgroundColor: 'rgba(0 , 0 , 160, 0.5)',
										type: '',
										borderWidth: 3,
										data: <?php echo json_encode($chartdata['datasets'][0]); ?>,
									}]
								}
								var ctx = document.getElementById('barchart_tipebarang');
								var chart = new Chart(ctx, {
									type: 'bar',
									data: chartData,
									options: {
										scaleStartValue: 0,
										responsive: true,
										scales: {
											xAxes: [{
												ticks: {
													display: true
												},
												gridLines: {
													display: true
												},
												categoryPercentage: 1.0,
												barPercentage: 0.8,
												scaleLabel: {
													display: true,
													labelString: ""
												},
											}],
											yAxes: [{
												ticks: {
													beginAtZero: true,
													display: true
												},
												scaleLabel: {
													display: true,
													labelString: ""
												}
											}]
										},
									},
								})
							});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
