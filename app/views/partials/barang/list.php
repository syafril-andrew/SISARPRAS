<?php
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("barang/add");
$can_edit = ACL::is_allowed("barang/edit");
$can_view = ACL::is_allowed("barang/view");
$can_delete = ACL::is_allowed("barang/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list" data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
	<?php
	if ($show_header == true) {
	?>
		<div class="bg-light p-3 mb-3">
			<div class="container-fluid">
				<div class="row ">
					<div class="col ">
						<h4 class="record-title">Barang</h4>
					</div>
					<div class="col-sm-3 ">
						<?php if ($can_add) { ?>
							<?php $modal_id = "modal-" . random_str(); ?>
							<button data-toggle="modal" data-target="#<?php echo $modal_id ?>" class="btn btn btn-primary my-1">
								<i class="fa fa-plus"></i>
								Tambah Barang
							</button>
							<div data-backdrop="true" id="<?php echo $modal_id ?>" class="modal fade" role="dialog" aria-labelledby="<?php echo $modal_id ?>" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-body p-0 reset-grids">
											<div class=" ">
												<?php
												$this->render_page("barang/add");
												?>
											</div>
										</div>
										<div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
											<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">&times;</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col-sm-4 ">
						<form class="search" action="<?php print_link('barang'); ?>" method="get">
							<div class="input-group">
								<input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search" placeholder="Search" />
								<div class="input-group-append">
									<button class="btn btn-primary"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-12 comp-grid">
						<div class="">
							<!-- Page bread crumbs components-->
							<?php
							if (!empty($field_name) || !empty($_GET['search'])) {
							?>
								<hr class="sm d-block d-sm-none" />
								<nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
									<ul class="breadcrumb m-0 p-1">
										<?php
										if (!empty($field_name)) {
										?>
											<li class="breadcrumb-item">
												<a class="text-decoration-none" href="<?php print_link('barang'); ?>">
													<i class="fa fa-angle-left"></i>
												</a>
											</li>
											<li class="breadcrumb-item">
												<?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
											</li>
											<li class="breadcrumb-item active text-capitalize font-weight-bold">
												<?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
											</li>
										<?php
										}
										?>
										<?php
										if (get_value("search")) {
										?>
											<li class="breadcrumb-item">
												<a class="text-decoration-none" href="<?php print_link('barang'); ?>">
													<i class="fa fa-angle-left"></i>
												</a>
											</li>
											<li class="breadcrumb-item text-capitalize">
												Search
											</li>
											<li class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
										<?php
										}
										?>
									</ul>
								</nav>
								<!--End of Page bread crumbs components-->
							<?php
							}
							?>
						</div>
					</div>
					<div class="col-md-4 comp-grid">
						<form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
							<div class="card mb-3">
								<div class="card-header h4 h4">Lokasi Barang</div>
								<div class="p-2">
									<select name="barang_Lokasi_barang" class="form-control custom ">
										<option value="">Pilih data ...</option>
										<?php
										$barang_Lokasi_barang_options = $comp_model->barang_barangLokasi_barang_option_list();
										if (!empty($barang_Lokasi_barang_options)) {
											foreach ($barang_Lokasi_barang_options as $option) {
												$value = (!empty($option['value']) ? $option['value'] : null);
												$label = (!empty($option['label']) ? $option['label'] : $value);
												$selected = $this->set_field_selected('barang_Lokasi_barang', $value);
										?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>">
													<?php echo $label; ?>
												</option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<hr />
							<div class="form-group text-center">
								<button class="btn btn-primary">Filter</button>
							</div>
						</form>
					</div>
					<div class="col-md-4 comp-grid">
						<form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
							<div class="card mb-3">
								<div class="card-header h4 h4">Tipe Barang</div>
								<div class="p-2">
									<select name="barang_id_tipe_barang" class="form-control custom ">
										<option value="">Pilih data ...</option>
										<?php
										$barang_id_tipe_barang_options = $comp_model->barang_barangid_tipe_barang_option_list();
										if (!empty($barang_id_tipe_barang_options)) {
											foreach ($barang_id_tipe_barang_options as $option) {
												$value = (!empty($option['value']) ? $option['value'] : null);
												$label = (!empty($option['label']) ? $option['label'] : $value);
												$selected = $this->set_field_selected('barang_id_tipe_barang', $value);
										?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>">
													<?php echo $label; ?>
												</option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<hr />
							<div class="form-group text-center">
								<button class="btn btn-primary">Filter</button>
							</div>
						</form>
					</div>
					<div class="col-md-4 comp-grid">
						<form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
							<div class="card mb-3">
								<div class="card-header h4 h4">Kondisi Barang</div>
								<div class="p-2">
									<select name="barang_Kondisi_barang" class="form-control custom ">
										<option value="">Select a value ...</option>
										<?php
										$barang_Kondisi_barang_options = $comp_model->barang_barangKondisi_barang_option_list();
										if (!empty($barang_Kondisi_barang_options)) {
											foreach ($barang_Kondisi_barang_options as $option) {
												$value = (!empty($option['value']) ? $option['value'] : null);
												$label = (!empty($option['label']) ? $option['label'] : $value);
												$selected = $this->set_field_selected('barang_Kondisi_barang', $value);
										?>
												<option <?php echo $selected; ?> value="<?php echo $value; ?>">
													<?php echo $label; ?>
												</option>
										<?php
											}
										}
										?>
									</select>
								</div>
							</div>
							<hr />
							<div class="form-group text-center">
								<button class="btn btn-primary">Filter</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
	<div class="">
		<div class="container-fluid">
			<div class="row ">
				<div class="col-md-12 comp-grid">
					<?php $this::display_page_errors(); ?>
					<div class="filter-tags mb-2">
						<?php
						if (!empty(get_value('barang_Lokasi_barang'))) {
						?>
							<div class="filter-chip card bg-light">
								<b>Barang Lokasi Barang :</b>
								<?php
								if (get_value('barang_Lokasi_baranglabel')) {
									echo get_value('barang_Lokasi_baranglabel');
								} else {
									echo get_value('barang_Lokasi_barang');
								}
								$remove_link = unset_get_value('barang_Lokasi_barang', $this->route->page_url);
								?>
								<a href="<?php print_link($remove_link); ?>" class="close-btn">
									&times;
								</a>
							</div>
						<?php
						}
						?>
						<?php
						if (!empty(get_value('barang_id_tipe_barang'))) {
						?>
							<div class="filter-chip card bg-light">
								<b>Tipe Barang :</b>
								<?php
								if (get_value('barang_id_tipe_baranglabel')) {
									echo get_value('barang_id_tipe_baranglabel');
								} else {
									echo get_value('barang_id_tipe_barang');
								}
								$remove_link = unset_get_value('barang_id_tipe_barang', $this->route->page_url);
								?>
								<a href="<?php print_link($remove_link); ?>" class="close-btn">
									&times;
								</a>
							</div>
						<?php
						}
						?>
						<?php
						if (!empty(get_value('barang_Kondisi_barang'))) {
						?>
							<div class="filter-chip card bg-light">
								<b>Kondisi Barang :</b>
								<?php
								if (get_value('barang_Kondisi_baranglabel')) {
									echo get_value('barang_Kondisi_baranglabel');
								} else {
									echo get_value('barang_Kondisi_barang');
								}
								$remove_link = unset_get_value('barang_Kondisi_barang', $this->route->page_url);
								?>
								<a href="<?php print_link($remove_link); ?>" class="close-btn">
									&times;
								</a>
							</div>
						<?php
						}
						?>
					</div>
					<div class=" animated fadeIn page-content">
						<div id="barang-list-records">
							<div id="page-report-body" class="table-responsive">
								<table class="table  table-striped table-sm text-left">
									<thead class="table-header bg-light">
										<tr>
											<?php if ($can_delete) { ?>
												<th class="td-checkbox">
													<label class="custom-control custom-checkbox custom-control-inline">
														<input class="toggle-check-all custom-control-input" type="checkbox" />
														<span class="custom-control-label"></span>
													</label>
												</th>
											<?php } ?>
											<th class="td-sno">#</th>
											<th class="td-id_tipe_barang"> Tipe Barang</th>
											<th class="td-merek_barang"> Merek Barang</th>
											<th class="td-Spesifikasi"> Spesifikasi</th>
											<th class="td-Sumber"> Sumber</th>
											<th class="td-Photo"> Photo</th>
											<th class="td-Lokasi_barang"> Lokasi Barang</th>
											<th class="td-Kondisi_barang"> Kondisi Barang</th>
											<th class="td-Kondisi_barang"> Jumlah Barang</th>
											<th class="td-tanggal_input"> Tanggal Input</th>
											<th class="td-btn"></th>
										</tr>
									</thead>
									<?php
									if (!empty($records)) {
									?>
										<tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
											<!--record-->
											<?php
											$counter = 0;
											foreach ($records as $data) {
												$rec_id = (!empty($data['id_barang']) ? urlencode($data['id_barang']) : null);
												$counter++;
											?>
												<tr>
													<?php if ($can_delete) { ?>
														<th class=" td-checkbox">
															<label class="custom-control custom-checkbox custom-control-inline">
																<input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_barang'] ?>" type="checkbox" />
																<span class="custom-control-label"></span>
															</label>
														</th>
													<?php } ?>
													<th class="td-sno"><?php echo $counter; ?></th>
													<td class="td-id_tipe_barang">
														<a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("tipe_barang/view/" . urlencode($data['id_tipe_barang'])) ?>">
															<i class="fa fa-eye"></i> <?php echo $data['tipe_barang_nama_barang'] ?>
														</a>
													</td>
													<td class="td-merek_barang">
														<span <?php if ($can_edit) { ?> data-value="<?php echo $data['merek_barang']; ?>" data-pk="<?php echo $data['id_barang'] ?>" data-url="<?php print_link("barang/editfield/" . urlencode($data['id_barang'])); ?>" data-name="merek_barang" data-title="Enter Merek Barang" data-placement="left" data-toggle="click" data-type="text" data-mode="popover" data-showbuttons="left" class="is-editable" <?php } ?>>
															<?php echo $data['merek_barang']; ?>
														</span>
													</td>
													<td class="td-Spesifikasi">
														<span <?php if ($can_edit) { ?> data-pk="<?php echo $data['id_barang'] ?>" data-url="<?php print_link("barang/editfield/" . urlencode($data['id_barang'])); ?>" data-name="Spesifikasi" data-title="Enter Spesifikasi" data-placement="left" data-toggle="click" data-type="textarea" data-mode="popover" data-showbuttons="left" class="is-editable" <?php } ?>>
															<?php echo $data['Spesifikasi']; ?>
														</span>
													</td>
													<td class="td-Sumber">
														<span <?php if ($can_edit) { ?> data-value="<?php echo $data['Sumber']; ?>" data-pk="<?php echo $data['id_barang'] ?>" data-url="<?php print_link("barang/editfield/" . urlencode($data['id_barang'])); ?>" data-name="Sumber" data-title="Enter Sumber" data-placement="left" data-toggle="click" data-type="text" data-mode="popover" data-showbuttons="left" class="is-editable" <?php } ?>>
															<?php echo $data['Sumber']; ?>
														</span>
													</td>
													<td class="td-Photo"><?php Html::page_img($data['Photo'], 50, 50, 1); ?></td>
													<td class="td-Lokasi_barang">
														<a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("lokasi_barang/view/" . urlencode($data['Lokasi_barang'])) ?>">
															<i class="fa fa-eye"></i> <?php echo $data['lokasi_barang_Lokasi'] ?>
														</a>
													</td>
													<td class="td-Kondisi_barang">
														<a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("kondisi_barang/view/" . urlencode($data['Kondisi_barang'])) ?>">
															<i class="fa fa-eye"></i> <?php echo $data['kondisi_barang_Kondisi'] ?>
														</a>
													</td>
													<td class="td-jumlah_barang">
														<span <?php if ($can_edit) { ?> data-value="<?php echo $data['jumlah_barang']; ?>" data-pk="<?php echo $data['id_barang'] ?>" data-url="<?php print_link("barang/editfield/" . urlencode($data['id_barang'])); ?>" data-name="jumlah_barang" data-title="Enter Jumlah Barang" data-placement="left" data-toggle="click" data-type="text" data-mode="popover" data-showbuttons="left" class="is-editable" <?php } ?>>
															<?php echo $data['jumlah_barang']; ?>
														</span>
													</td>
													<td class="td-tanggal_input">
														<span <?php if ($can_edit) { ?> data-value="<?php echo $data['tanggal_input']; ?>" data-pk="<?php echo $data['id_barang'] ?>" data-url="<?php print_link("barang/editfield/" . urlencode($data['id_barang'])); ?>" data-name="tanggal_input" data-title="Enter Tanggal Input" data-placement="left" data-toggle="click" data-type="text" data-mode="popover" data-showbuttons="left" class="is-editable" <?php } ?>>
															<?php echo $data['tanggal_input']; ?>
														</span>
													</td>
													<th class="td-btn">
														<?php if ($can_view) { ?>
															<a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("barang/view/$rec_id"); ?>">
																<i class="fa fa-eye"></i> Lihat
															</a>
														<?php } ?>
														<?php if ($can_edit) { ?>
															<a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("barang/edit/$rec_id"); ?>">
																<i class="fa fa-edit"></i> Edit
															</a>
														<?php } ?>
														<?php if ($can_delete) { ?>
															<a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("barang/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Apakah anda yakin ingin menghapus data ini?" data-display-style="modal">
																<i class="fa fa-times"></i>
																Hapus
															</a>
														<?php } ?>
													</th>
												</tr>
											<?php
											}
											?>
											<!--endrecord-->
										</tbody>
										<tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
									<?php
									}
									?>
								</table>
								<?php
								if (empty($records)) {
								?>
									<h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
										<i class="fa fa-ban"></i> Data kosong
									</h4>
								<?php
								}
								?>
							</div>
							<?php
							if ($show_footer && !empty($records)) {
							?>
								<div class=" border-top mt-2">
									<div class="row justify-content-center">
										<div class="col-md-auto justify-content-center">
											<div class="p-3 d-flex justify-content-between">
												<?php if ($can_delete) { ?>
													<button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("barang/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
														<i class="fa fa-times"></i> Delete Selected
													</button>
												<?php } ?>
												<div class="dropup export-btn-holder mx-1">
													<button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fa fa-save"></i> Cetak
													</button>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
														<?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
														<a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
															<img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
														</a>
														<?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
														<a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
															<img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
														</a>
														<?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
														<a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
															<img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
														</a>
														<?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
														<a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
															<img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
														</a>
														<?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
														<a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
															<img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<?php
											if ($show_pagination == true) {
												$pager = new Pagination($total_records, $record_count);
												$pager->route = $this->route;
												$pager->show_page_count = true;
												$pager->show_record_count = true;
												$pager->show_page_limit = true;
												$pager->limit_count = $this->limit_count;
												$pager->show_page_number_list = true;
												$pager->pager_link_range = 5;
												$pager->render();
											}
											?>
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
