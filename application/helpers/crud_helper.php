<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* @Function_name : insert
* @Return_type : Boolean
*/
if (!function_exists('insert'))
{
	function insert($table = null, $data = null)
	{
		$CI =& get_instance();

		$insert = $CI->mod->insertData($table, $data);
		if ($insert) :
			return true;
		else :
			return false;
		endif;
	}
}

/*
* @Function_name : update
* @Return_type : Boolean
*/
if (!function_exists('update'))
{
	function update($table = null, $data = null, $where)
	{
		$CI =& get_instance();

		$update = $CI->mod->updateData($table, $data, $where);
		if ($update) :
			return true;
		else :
			return false;
		endif;
	}
}

if (!function_exists('getData'))
{
	function getData($type, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null)
	{
		$CI =& get_instance();

		$get = $CI->mod->getData($type, $select, $table, $limit, $offset, $joins, $where, $group, $order);
		if ($get) :
			return $get;
		else :
			return false;
		endif;
	}
}


