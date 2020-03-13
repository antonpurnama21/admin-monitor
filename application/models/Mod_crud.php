<?php 
class Mod_crud extends CI_Model
{

	
	// public function getData($table = null, $where = null)
	// {
	// 	if ($where === null) {
	// 		return $this->db->get($table)->result_array();	
	// 	}else{
	// 		return $this->db->get_where($table, $where)->result_array();
	// 	}
	// }

	function getData2($type = null, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null, $like = null)
	{
		$command = "SELECT $select FROM $table";
	 	if ($joins != null)
			{	
				foreach($joins as $key => $values)
				{
					$command .= " LEFT JOIN $key ON $values ";
				}
			}
			
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}

		if ($like != null AND $where == null)
			{
				$command .= ' WHERE '.$like;
			}elseif ($like != null AND $where != null) {
				$command .= ' AND '.'('.$like.')';
			}

		if ($group != null)
			{	
				$command .= ' GROUP BY '.implode(', ',$group);
			}

		if ($order != null)
			{	
				$command .= ' ORDER BY '.implode(', ',$order);
			}
		if ($limit != null)
			{
				if ($offset != null)
					{
						$command .= " LIMIT $offset, $limit";
					}else{
						$command .= " LIMIT $limit";
					}	
			}
		$data = $this->db->query($command);
		if ($data->num_rows() > 0)
		{
			return  ($type == 'result') ? $data->result() : $data->row();
		}else{
			return false;
		}
	}

	public function deleteData($table = null, $where = null)
	{
		$this->db->delete($table, $where);
		return $this->db->affected_rows();
	}

	public function insertData($table = null, $data = null)
	{
		$this->db->insert($table, $data);
		return $this->db->affected_rows();
	}

	public function insertBatch($table = null, $data = null)
	{
		$this->db->insert_batch($table, $data);
		return $this->db->affected_rows();
	}

	public function updateData($table = null, $data = null, $where = null)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}
	
	function getData($type, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null)
	{
		if ($select != null) 
		{
			$data = $this->db->select($select);
		}

		if ($joins != null) 
		{	
			foreach($joins as $key => $values)
			{
				$data = $this->db->join($key, $values,'LEFT');
			}
		}

		if ($where != null)
		{	
			foreach ($where as $key => $values) {
				$data = $this->db->where($key, $values);
			}
		}

		if ($group != null)
		{	
			$data = $this->db->group_by($group);
		}

		if ($order != null)
		{	
			foreach($order as $key => $values){
				$data = $this->db->order_by($key, $values);
			}
		}

		if ($limit != null)
		{
			if ($offset != null)
			{
				$data = $this->db->limit($limit, $offset);
			}else{
				$data = $this->db->limit($limit);
			}	
		}

		if ($table != null) 
		{
			$data = $this->db->get($table);
		}
		
		if ($data->num_rows() > 0)
		{
			return  ($type == 'result') ? $data->result() : $data->row();
		}else{
			return false;
		}

	}

	function getCountData($type, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null)
	{
		if ($select != null) 
		{
			$data = $this->db->select($select);
		}

		if ($joins != null) 
		{	
			foreach($joins as $key => $values)
			{
				$data = $this->db->join($key, $values,'LEFT');
			}
		}

		if ($where != null)
		{	
			foreach ($where as $key => $values) {
				$data = $this->db->where($key, $values);
			}
		}

		if ($group != null)
		{	
			$data = $this->db->group_by($group);
		}

		if ($order != null)
		{	
			foreach($order as $key => $values){
				$data = $this->db->order_by($key, $values);
			}
		}

		if ($limit != null)
		{
			if ($offset != null)
			{
				$data = $this->db->limit($limit, $offset);
			}else{
				$data = $this->db->limit($limit);
			}	
		}

		if ($table != null) 
		{
			$data = $this->db->get($table);
		}
		
		return $data->num_rows();

	}

	function autoNumber($field, $table, $format, $digit)
	{
		$qry = $this->db->query("SELECT MAX(RIGHT($field,$digit)) AS KodeAkhir FROM $table WHERE $field LIKE '$format%'");
		if ($qry->num_rows() > 0){
			$nextCode = $qry->row('KodeAkhir') + 1;
		}else{
			$nextcode = 1;
		}
		$kode = $format.sprintf("%0".$digit."s", $nextCode);
		return $kode;
	}

	function checkData($row, $table, $where)
	{
		$command = "SELECT $row FROM $table";
		if ($where != null)
			{	
				$command .= ' WHERE '.implode(' AND ',$where);
			}
		
		$data = $this->db->query($command);
		if ($data->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}

	}

	function getCount($table_name){
		return $this->db->count_all($table_name);
	}

	function getCount_byID($table_name, $where){
		foreach ($where as $key => $values) {
			$data = $this->db->where($key, $values);
		}
		$data = $this->db->get($table_name);
		return $data->num_rows();
		
	}

	function qry($type = null, $command)
	{
		$data = $this->db->query($command);
		if ($type != null)
		{
			if ($type == 'bool') {
				return $data;
			}else{
				return ($type == 'result') ? $data->result() : $data->row();
			}
		}else{
			if ($data->num_rows() > 0)
			{
				return true;
			}else{
				return false;
			}
		}
	}
}