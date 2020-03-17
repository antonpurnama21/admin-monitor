<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
This helper combination with Mod_crud
*/
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

/*
* @Function_name : delete
* @Return_type : Boolean
*/
if (!function_exists('delete'))
{
	function delete($table = null, $where = null)
	{
		$CI =& get_instance();

		$update = $CI->mod->deleteData($table = null, $where = null);
		if ($update) :
			return true;
		else :
			return false;
		endif;
	}
}

/*
* @Function_name : getData
* @Return_type : array
*/
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

/*
* @Function_name : getData2
* @Return_type : array
*/
if (!function_exists('getData2'))
{
	function getData2($type, $select, $table, $limit = null, $offset = null, $joins = null, $where = null, $group = null, $order = null)
	{
		$CI =& get_instance();

		$get = $CI->mod->getData2($type, $select, $table, $limit, $offset, $joins, $where, $group, $order);
		if ($get) :
			return $get;
		else :
			return false;
		endif;
	}
}

/*
* @Function_name : update
* @Return_type : string
*/
if (!function_exists('autoNumber'))
{
	function autoNumber($field, $table, $format, $digit)
	{
		$CI =& get_instance();

		$get = $CI->mod->autoNumber($field, $table, $format, $digit);
		if ($get) :
			return $get;
		else :
			return false;
		endif;
	}
}