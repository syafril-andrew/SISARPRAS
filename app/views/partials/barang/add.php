<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add" data-display-type="" data-page-url="<?php print_link($current_page); ?>">
	<?php
	if ($show_header == true) {
	?>
		<div class="bg-light p-3 mb-3">
			<div class="container">
				<div class="row ">
					<div class="col ">
						<h4 class="record-title">Add New Barang</h4>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
	<div class="">
		<div class="container">
			<div class="row ">
				<div class="col-md-7 comp-grid">
					<?php $this::display_page_errors(); ?>
					<div class="bg-light p-3 animated fadeIn page-content">
						<form id="barang-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("barang/add?csrf_token=$csrf_token") ?>" method="post">
							<div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="id_tipe_barang">Tipe Barang <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<select required="" id="ctrl-id_tipe_barang" name="id_tipe_barang" placeholder="Select a value ..." class="custom-select">
													<option value="">Select a value ...</option>
													<?php
													$id_tipe_barang_options = $comp_model->barang_id_tipe_barang_option_list();
													if (!empty($id_tipe_barang_options)) {
														foreach ($id_tipe_barang_options as $option) {
															$value = (!empty($option['value']) ? $option['value'] : null);
															$label = (!empty($option['label']) ? $option['label'] : $value);
															$selected = $this->set_field_selected('id_tipe_barang', $value, "");
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
									</div>
								</div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="merek_barang">Merek Barang <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-merek_barang" value="<?php echo $this->set_field_value('merek_barang', ""); ?>" type="text" placeholder="Enter Merek Barang" required="" name="merek_barang" class="form-control " />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="Spesifikasi">Spesifikasi <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<textarea placeholder="Enter Spesifikasi" id="ctrl-Spesifikasi" required="" rows="5" name="Spesifikasi" class=" form-control"><?php echo $this->set_field_value('Spesifikasi', ""); ?></textarea>
												<!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
											</div>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="Sumber">Sumber <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-Sumber" value="<?php echo $this->set_field_value('Sumber', ""); ?>" type="text" placeholder="Enter Sumber" required="" name="Sumber" class="form-control " />
											</div>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="Photo">Photo <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<div class="dropzone required" input="#ctrl-Photo" fieldname="Photo" data-multiple="false" dropmsg="Pilih file dan tarik kesini" btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
													<input name="Photo" id="ctrl-Photo" required="" class="dropzone-input form-control" value="<?php echo $this->set_field_value('Photo', ""); ?>" type="text" />
													<!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
													<div class="dz-file-limit animated bounceIn text-center text-danger"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="Lokasi_barang">Lokasi Barang <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<select required="" id="ctrl-Lokasi_barang" name="Lokasi_barang" placeholder="Select a value ..." class="custom-select">
													<option value="">Select a value ...</option>
													<?php
													$Lokasi_barang_options = $comp_model->barang_Lokasi_barang_option_list();
													if (!empty($Lokasi_barang_options)) {
														foreach ($Lokasi_barang_options as $option) {
															$value = (!empty($option['value']) ? $option['value'] : null);
															$label = (!empty($option['label']) ? $option['label'] : $value);
															$selected = $this->set_field_selected('Lokasi_barang', $value, "");
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
									</div>
								</div>
								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="Kondisi_barang">Kondisi Barang <span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<select required="" id="ctrl-Kondisi_barang" name="Kondisi_barang" placeholder="Select a value ..." class="custom-select">
													<option value="">Select a value ...</option>
													<?php
													$Kondisi_barang_options = $comp_model->barang_Kondisi_barang_option_list();
													if (!empty($Kondisi_barang_options)) {
														foreach ($Kondisi_barang_options as $option) {
															$value = (!empty($option['value']) ? $option['value'] : null);
															$label = (!empty($option['label']) ? $option['label'] : $value);
															$selected = $this->set_field_selected('Kondisi_barang', $value, "");
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
									</div>
								</div>

								<div class="form-group ">
									<div class="row">
										<div class="col-sm-4">
											<label class="control-label" for="jumlah_barang">Jumlah Barang<span class="text-danger">*</span></label>
										</div>
										<div class="col-sm-8">
											<div class="">
												<input id="ctrl-jumlah_barang" value="<?php echo $this->set_field_value('jumlah_barang', ""); ?>" type="text" placeholder="Enter Jumlah Barang" required="" name="jumlah_barang" class="form-control " />
											</div>
										</div>
									</div>
								</div>
								<input id="ctrl-tanggal_input" value="<?php echo $this->set_field_value('tanggal_input', date_now()); ?>" type="hidden" placeholder="Enter Tanggal Input" required="" name="tanggal_input" class="form-control " />
							</div>
							<div class="form-group form-submit-btn-holder text-center mt-3">
								<div class="form-ajax-status"></div>
								<button class="btn btn-primary" type="submit">
									Kirim
									<i class="fa fa-send"></i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
