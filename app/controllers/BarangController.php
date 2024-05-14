<?php

/**
 * Barang Page Controller
 * @category  Controller
 */
class BarangController extends SecureController
{
	function __construct()
	{
		parent::__construct();
		$this->tablename = "barang";
	}
	/**
	 * List page records
	 * @param $fieldname (filter record by a field) 
	 * @param $fieldvalue (filter field value)
	 * @return BaseView
	 */
	function index($fieldname = null, $fieldvalue = null)
	{
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array(
			"barang.id_barang",
			"barang.id_tipe_barang",
			"tipe_barang.nama_barang AS tipe_barang_nama_barang",
			"barang.merek_barang",
			"barang.Spesifikasi",
			"barang.Sumber",
			"barang.Photo",
			"barang.Lokasi_barang",
			"lokasi_barang.Lokasi AS lokasi_barang_Lokasi",
			"barang.Kondisi_barang",
			"kondisi_barang.Kondisi AS kondisi_barang_Kondisi",
			"barang.jumlah_barang",
			"barang.tanggal_input"
		);
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if (!empty($request->search)) {
			$text = trim($request->search);
			$search_condition = "(
				barang.id_barang LIKE ? OR 
				barang.id_tipe_barang LIKE ? OR 
				barang.merek_barang LIKE ? OR 
				barang.Spesifikasi LIKE ? OR 
				barang.Sumber LIKE ? OR 
				barang.Photo LIKE ? OR 
				barang.Lokasi_barang LIKE ? OR 
				barang.Kondisi_barang LIKE ? OR 
				barang.jumlah_barang LIKE ? OR 
				barang.tanggal_input LIKE ?
			)";
			$search_params = array(
				"%$text%", "%$text%", "%$text%", "%$text%", "%$text%", "%$text%", "%$text%", "%$text%", "%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			//template to use when ajax search
			$this->view->search_template = "barang/search.php";
		}
		$db->join("tipe_barang", "barang.id_tipe_barang = tipe_barang.id_tipe_barang", "INNER");
		$db->join("lokasi_barang", "barang.Lokasi_barang = lokasi_barang.id_lokasi", "INNER");
		$db->join("kondisi_barang", "barang.Kondisi_barang = kondisi_barang.id_kondisi", "INNER");
		if (!empty($request->orderby)) {
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		} else {
			$db->orderBy("barang.id_barang", ORDER_TYPE);
		}
		if ($fieldname) {
			$db->where($fieldname, $fieldvalue); //filter by a single field name
		}
		if (!empty($request->barang_Lokasi_barang)) {
			$val = $request->barang_Lokasi_barang;
			$db->where("barang.Lokasi_barang", $val, "=");
		}
		if (!empty($request->barang_id_tipe_barang)) {
			$val = $request->barang_id_tipe_barang;
			$db->where("barang.id_tipe_barang", $val, "=");
		}
		if (!empty($request->barang_Kondisi_barang)) {
			$val = $request->barang_Kondisi_barang;
			$db->where("barang.Kondisi_barang", $val, "=");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if ($db->getLastError()) {
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Barang";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("barang/list.php", $data); //render the full page
	}
	/**
	 * View record detail 
	 * @param $rec_id (select record by table primary key) 
	 * @param $value value (select record by value of field name(rec_id))
	 * @return BaseView
	 */
	function view($rec_id = null, $value = null)
	{
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array(
			"barang.id_barang",
			"barang.id_tipe_barang",
			"tipe_barang.nama_barang AS tipe_barang_nama_barang",
			"barang.merek_barang",
			"barang.Spesifikasi",
			"barang.Sumber",
			"barang.Photo",
			"barang.Lokasi_barang",
			"lokasi_barang.Lokasi AS lokasi_barang_Lokasi",
			"barang.Kondisi_barang",
			"kondisi_barang.Kondisi AS kondisi_barang_Kondisi",
			"barang.jumlah_barang",
			"barang.tanggal_input"
		);
		if ($value) {
			$db->where($rec_id, urldecode($value)); //select record based on field name
		} else {
			$db->where("barang.id_barang", $rec_id);; //select record based on primary key
		}
		$db->join("tipe_barang", "barang.id_tipe_barang = tipe_barang.id_tipe_barang", "INNER");
		$db->join("lokasi_barang", "barang.Lokasi_barang = lokasi_barang.id_lokasi", "INNER");
		$db->join("kondisi_barang", "barang.Kondisi_barang = kondisi_barang.id_kondisi", "INNER");
		$record = $db->getOne($tablename, $fields);
		if ($record) {
			$page_title = $this->view->page_title = "View  Barang";
			$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
			$this->view->report_title = $page_title;
			$this->view->report_layout = "report_layout.php";
			$this->view->report_paper_size = "A4";
			$this->view->report_orientation = "portrait";
		} else {
			if ($db->getLastError()) {
				$this->set_page_error();
			} else {
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("barang/view.php", $record);
	}
	/**
	 * Insert new record to the database table
	 * @param $formdata array() from $_POST
	 * @return BaseView
	 */
	function add($formdata = null)
	{
		if ($formdata) {
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("id_tipe_barang", "merek_barang", "Spesifikasi", "Sumber", "Photo", "Lokasi_barang", "Kondisi_barang", "jumlah_barang", "tanggal_input");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_tipe_barang' => 'required',
				'merek_barang' => 'required',
				'Spesifikasi' => 'required',
				'Sumber' => 'required',
				'Photo' => 'required',
				'Lokasi_barang' => 'required',
				'Kondisi_barang' => 'required',
				'jumlah_barang' => 'required',
				'tanggal_input' => 'required',
			);
			$this->sanitize_array = array(
				'id_tipe_barang' => 'sanitize_string',
				'merek_barang' => 'sanitize_string',
				'Spesifikasi' => 'sanitize_string',
				'Sumber' => 'sanitize_string',
				'Photo' => 'sanitize_string',
				'Lokasi_barang' => 'sanitize_string',
				'Kondisi_barang' => 'sanitize_string',
				'jumlah_barang' => 'sanitize_string',
				'tanggal_input' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if ($this->validated()) {
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if ($rec_id) {
					$this->set_flash_msg("Data berhasil ditambah", "success");
					return	$this->redirect("barang");
				} else {
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Barang";
		$this->render_view("barang/add.php");
	}
	/**
	 * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
	 * @return array
	 */
	function edit($rec_id = null, $formdata = null)
	{
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_barang", "id_tipe_barang", "merek_barang", "Spesifikasi", "Sumber", "Photo", "Lokasi_barang", "Kondisi_barang", "jumlah_barang", "tanggal_input");
		if ($formdata) {
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'id_tipe_barang' => 'required',
				'merek_barang' => 'required',
				'Spesifikasi' => 'required',
				'Sumber' => 'required',
				'Photo' => 'required',
				'Lokasi_barang' => 'required',
				'Kondisi_barang' => 'required',
				'jumlah_barang' => 'required',
				'tanggal_input' => 'required',
			);
			$this->sanitize_array = array(
				'id_tipe_barang' => 'sanitize_string',
				'merek_barang' => 'sanitize_string',
				'Spesifikasi' => 'sanitize_string',
				'Sumber' => 'sanitize_string',
				'Photo' => 'sanitize_string',
				'Lokasi_barang' => 'sanitize_string',
				'Kondisi_barang' => 'sanitize_string',
				'jumlah_barang' => 'sanitize_string',
				'tanggal_input' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if ($this->validated()) {
				$db->where("barang.id_barang", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if ($bool && $numRows) {
					$this->set_flash_msg("Data berhasil diubah", "success");
					return $this->redirect("barang");
				} else {
					if ($db->getLastError()) {
						$this->set_page_error();
					} elseif (!$numRows) {
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("barang");
					}
				}
			}
		}
		$db->where("barang.id_barang", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Barang";
		if (!$data) {
			$this->set_page_error();
		}
		return $this->render_view("barang/edit.php", $data);
	}
	/**
	 * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
	 * @return array
	 */
	function editfield($rec_id = null, $formdata = null)
	{
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_barang", "id_tipe_barang", "merek_barang", "Spesifikasi", "Sumber", "Photo", "Lokasi_barang", "Kondisi_barang", "jumlah_barang", "tanggal_input");
		$page_error = null;
		if ($formdata) {
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'id_tipe_barang' => 'required',
				'merek_barang' => 'required',
				'Spesifikasi' => 'required',
				'Sumber' => 'required',
				'Photo' => 'required',
				'Lokasi_barang' => 'required',
				'Kondisi_barang' => 'required',
				'jumlah_barang' => 'required',
				'tanggal_input' => 'required',
			);
			$this->sanitize_array = array(
				'id_tipe_barang' => 'sanitize_string',
				'merek_barang' => 'sanitize_string',
				'Spesifikasi' => 'sanitize_string',
				'Sumber' => 'sanitize_string',
				'Photo' => 'sanitize_string',
				'Lokasi_barang' => 'sanitize_string',
				'Kondisi_barang' => 'sanitize_string',
				'jumlah_barang' => 'sanitize_string',
				'tanggal_input' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if ($this->validated()) {
				$db->where("barang.id_barang", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if ($bool && $numRows) {
					return render_json(
						array(
							'num_rows' => $numRows,
							'rec_id' => $rec_id,
						)
					);
				} else {
					if ($db->getLastError()) {
						$page_error = $db->getLastError();
					} elseif (!$numRows) {
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			} else {
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
	 * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @return BaseView
	 */
	function delete($rec_id = null)
	{
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("barang.id_barang", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if ($bool) {
			$this->set_flash_msg("Data berhasil dihapus", "success");
		} elseif ($db->getLastError()) {
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("barang");
	}
}
