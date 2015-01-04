<?php
require_once FRAME_ROOT . '/system/mysql.php';
abstract class ORM{
	protected $id;
	protected $_table;
	protected $_relationMaps;
	abstract function _get_relation_map();

	function save() {
		$maps = (array)$this->_get_relation_map();
		$sql = '';
		//update
		if($this->id) {
			$columns = '';
			foreach($maps as $k => $v) {
				//do not handle the 'property' which does not contain in maps
				if(property_exists($this, $k) && isset($this->$k)) {
					$columns .= "`{$v}`='{$this->$k}',";
				}
			}
			$columns = rtrim($columns, ',');//remove the last ','
			if(! $columns) return false;

			$sql =  strtr('UPDATE %table SET %columns WHERE id=%id LIMIT 1', array(
					'%table' => $this->_table,
					'%columns' => $columns,
					'%id' => $this->id
				)) ;
		}//insert
		else {
			$columns = array();
			$values = array();
			foreach($maps as $k => $v) {
				//do not handle the 'property' which does not contain in maps
				if(property_exists($this, $k) && isset($this->$k)) {
					$columns[] = "`{$v}`";
					$values[] = "'{$this->$k}'";
				}
			}
			if(! $columns || ! $values) return false;
			$sql = strtr('INSERT INTO %table(%column) VALUES(%value)', array(
					'%table' => $this->_table,
					'%column' => implode(',', $columns),
					'%value' => implode(',', $values)
				));
		}
		$mysql = new Mysql();
		return $mysql->execute($sql);
	}

	function get_table() {
		return $this->_table;
	}

}
//query one record from database
function O() {

}
//query multi-record from database
/*$params = array(
	'where' => array('property' => '1') or property=1,
	'orderby' => array('property1' => 'd', 'property2' => 'a') or property=1,
	'start' => 0,
	'count' => 10
)
*/
function Q($objname, $params=array()) {
	$obj_file = FRAME_ROOT  . '/model/' . strtolower($objname) . '.php';
	if(! $objname || ! file_exists($obj_file)) return array();

	require_once $obj_file;
	$object_name =  ucfirst($objname) . '_Model';
	$o = new $object_name;
	$maps = $o->_get_relation_map();
	$condition = '';
	if(isset($params['where'])) {
		if(is_array($params['where'])) {
			foreach ($params['where'] as $wk => $wv) {
				$condition .= " `{$maps[$wk]}`='{$wv}' AND ";
			}
			$condition = ' WHERE ' . rtrim($condition, 'AND ');
		}
		else {
			$condition = ' WHERE ' . $params['where'];
		}
	}

	$orderby = '';
	if(isset($params['orderby'])) {
		if(is_array($params['orderby'])) {
			foreach ($params['orderby'] as $wk => $wv) {
				$by = $wv == 'd' ? 'DESC' : 'ASC';
				$orderby .= "`{$maps[$wk]}` {$by},";
			}
			$orderby = ' ORDER BY ' . rtrim($orderby, ',');
		}
		else {
			$orderby = ' ORDER BY ' . $params['orderby'];
		}
	}

	$start = isset($params['start']) ? $params['start'] : 0;
	$count = isset($params['count']) ? $params['count'] : 20;

	
	$sql = strtr('SELECT * FROM %table %condition %orderby LIMIT %start, %count', array(
			'%table' => $o->get_table(),
			'%condition' => $condition,
			'%orderby' => $orderby,
			'%start' => $start,
			'%count' => $count
		));
	$mysql = new Mysql();
	$result = $mysql->query($sql, $object_name);
	return $result;
}
