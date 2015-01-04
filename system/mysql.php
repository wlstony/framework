<?php
class Mysql {
	private $_pdo;
	private $_connected = false;
	function __construct() {
		$config = Config::get('db.db_config');
		try{
			//it is not a persistant connection
			$this->_pdo = new PDO($config['dsn'], $config['username'], $config['password']);
			$this->_pdo->query('set names utf8;');
			$this->_connected = true;
		}
		catch(PDOException $e) {
			Log::add('pdo error: ' . $e->getMessage(), 'database');
			alert_message('Server is busy, please try again later!');
			
		}
	}
	function query($sql, $objname='') {
		if(! $sql) return false;
		
		if($this->_connected) {
			try{
				$pdo_statment = $this->_pdo->query($sql);
				$pdo_statment->setFetchMode(PDO::FETCH_CLASS, $objname);
				return $pdo_statment->fetchAll();
		
			}
			catch(PDOException $e) {
				Log::add('pdo error when try to call "query": ' . $e->getMessage(), 'database');
				alert_message('Server is busy, please try again later!');
				return false;
			}
		}
		else {
			Log::add('pdo error: try to call "query" with unconnected PDO', 'database');
			alert_message('Server is busy, please try again later!');
		}
	}

	function execute($sql) {
		if(! $sql) return false;

		if($this->_connected) {
			try{
				$affected_count = $this->_pdo->exec($sql);
				return $affected_count;
			}
			catch(PDOException $e) {
				Log::add('pdo error when try to call "execute": ' . $e->getMessage(), 'database');
				alert_message('Server is busy, please try again later!');
				return false;
			}
		}
		else {
			Log::add('pdo error: try to call "execute" with unconnected PDO', 'database');
			alert_message('Server is busy, please try again later!');
			return false;
		}
	}
}