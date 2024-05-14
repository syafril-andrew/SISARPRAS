<?php

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController
{

	/**
	 * barang_id_tipe_barang_option_list Model Action
	 * @return array
	 */
	function barang_id_tipe_barang_option_list()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_tipe_barang AS value,nama_barang AS label FROM tipe_barang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	 * barang_Lokasi_barang_option_list Model Action
	 * @return array
	 */
	function barang_Lokasi_barang_option_list()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_lokasi AS value,Lokasi AS label FROM lokasi_barang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	 * barang_Kondisi_barang_option_list Model Action
	 * @return array
	 */
	function barang_Kondisi_barang_option_list()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_kondisi AS value,Kondisi AS label FROM kondisi_barang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	 * user_user_role_id_option_list Model Action
	 * @return array
	 */
	function user_user_role_id_option_list()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	 * user_username_value_exist Model Action
	 * @return array
	 */
	function user_username_value_exist($val)
	{
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
	 * user_email_value_exist Model Action
	 * @return array
	 */
	function user_email_value_exist($val)
	{
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
	 * barang_barangLokasi_barang_option_list Model Action
	 * @return array
	 */
	function barang_barangLokasi_barang_option_list()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_lokasi AS value,Lokasi AS label FROM lokasi_barang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	 * barang_barangid_tipe_barang_option_list Model Action
	 * @return array
	 */
	function barang_barangid_tipe_barang_option_list()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_tipe_barang AS value,nama_barang AS label FROM tipe_barang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	 * barang_barangKondisi_barang_option_list Model Action
	 * @return array
	 */
	function barang_barangKondisi_barang_option_list()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_kondisi AS value,Kondisi AS label FROM kondisi_barang";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
	 * getcount_barang Model Action
	 * @return Value
	 */
	function getcount_barang()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT SUM(jumlah_barang) AS num FROM barang";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);

		if (is_array($val)) {
			return $val[0];
		}
		return $val;
	}

	/**
	 * getcount_lokasibarang Model Action
	 * @return Value
	 */
	function getcount_lokasibarang()
	{
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM lokasi_barang";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);

		if (is_array($val)) {
			return $val[0];
		}
		return $val;
	}

	/**
	 * barchart_tipebarang Model Action
	 * @return array
	 */
	function barchart_tipebarang()
	{

		$db = $this->GetModel();
		$chart_data = array(
			"labels" => array(),
			"datasets" => array(),
		);

		//set query result for dataset 1
		$sqltext = "SELECT tb.id_tipe_barang, tb.nama_barang, b.id_barang, b.id_tipe_barang, b.merek_barang, SUM(b.jumlah_barang) AS count_of_merek_barang, b.Spesifikasi, b.Sumber, b.Photo, b.Lokasi_barang, b.Kondisi_barang, b.tanggal_input FROM tipe_barang AS tb JOIN barang AS b ON tb.id_tipe_barang=b.id_tipe_barang GROUP BY tb.nama_barang";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'count_of_merek_barang');
		$dataset_labels =  array_column($dataset1, 'nama_barang');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}
}
