<?php
/**
 * 数据库操作类
 *
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
defined('IN_IA') or exit('Access Denied');
define('PDO_DEBUG', true);

class DB {

	private $pdo;
	private $cfg;
	private $errors = array();

	public function getPDO() {
		return $this->pdo;
	}

	public function __construct($name = 'default') {
		global $_W;
		if(is_array($name)) {
			$cfg = $name;
		} else {
			$cfg = $_W['config']['db'][$name];
		}
		if(empty($cfg)) {
			message("没有找到名为 {$name} 的数据库配置项.");
		}
		$dsn = "mysql:dbname={$cfg['database']};host={$cfg['host']};port={$cfg['port']}";
		$dbclass = '';
		$options = array();
		if (class_exists('PDO')) {
			if (extension_loaded("pdo_mysql") && in_array('mysql', PDO::getAvailableDrivers())) {
				$dbclass = 'PDO';
				$options = array(PDO::ATTR_PERSISTENT => $cfg['pconnect']);
			} else {
				include IA_ROOT . '/source/library/pdo/PDO.class.php';
				$dbclass = '_PDO';
			}
		} else {
			include IA_ROOT . '/source/library/pdo/PDO.class.php';
			$dbclass = 'PDO';
		}
		$this->pdo = new $dbclass($dsn, $cfg['username'], $cfg['password'], $options);
		$sql = "SET NAMES '{$cfg['charset']}';";
		$this->pdo->exec($sql);
		$this->pdo->exec("SET sql_mode='';");
		$this->cfg = $cfg;
		if(PDO_DEBUG) {
			$info = array();
			$info['sql'] = $sql;
			$info['error'] = $this->pdo->errorInfo();
			$this->debug(false, $info);
		}
	}

	public function query($sql, $params = array()) {
		if (empty($params)) {
			$result = $this->pdo->exec($sql);
			if(PDO_DEBUG) {
				$info = array();
				$info['sql'] = $sql;
				$info['error'] = $this->pdo->errorInfo();
				$this->debug(false, $info);
			}
			return $result;
		}
		$statement = $this->pdo->prepare($sql);
		if (!is_object($statement)) {
			$this->debug(false, array('sql' => $sql, 'error' => array('', '-1', '当前连接数据库用户没有执行该条语句的权限，请检查mysql权限配置')));
			return false;
		}
		$result = $statement->execute($params);
		if(PDO_DEBUG) {
			$info = array();
			$info['sql'] = $sql;
			$info['params'] = $params;
			$info['error'] = $statement->errorInfo();
			$this->debug(false, $info);
		}
		if (!$result) {
			return false;
		} else {
			return $statement->rowCount();
		}
	}

	public function fetchcolumn($sql, $params = array(), $column = 0) {
		$statement = $this->pdo->prepare($sql);
		if (!is_object($statement)) {
			$this->debug(false, array('sql' => $sql, 'error' => array('', '-1', '当前连接数据库用户没有执行该条语句的权限，请检查mysql权限配置')));
			return false;
		}
		$result = $statement->execute($params);
		if(PDO_DEBUG) {
			$info = array();
			$info['sql'] = $sql;
			$info['params'] = $params;
			$info['error'] = $statement->errorInfo();
			$this->debug(false, $info);
		}
		if (!$result) {
			return false;
		} else {
			return $statement->fetchColumn($column);
		}
	}

	public function fetch($sql, $params = array()) {
		$statement = $this->pdo->prepare($sql);
		if (!is_object($statement)) {
			$this->debug(false, array('sql' => $sql, 'error' => array('', '-1', '当前连接数据库用户没有执行该条语句的权限，请检查mysql权限配置')));
			return false;
		}
		$result = $statement->execute($params);
		if(PDO_DEBUG) {
			$info = array();
			$info['sql'] = $sql;
			$info['params'] = $params;
			$info['error'] = $statement->errorInfo();
			$this->debug(false, $info);
		}
		if (!$result) {
			return false;
		} else {
			return $statement->fetch(pdo::FETCH_ASSOC);
		}
	}

	public function fetchall($sql, $params = array(), $keyfield = '') {
		$statement = $this->pdo->prepare($sql);
		if (!is_object($statement)) {
			$this->debug(false, array('sql' => $sql, 'error' => array('', '-1', '当前连接数据库用户没有执行该条语句的权限，请检查mysql权限配置')));
			return false;
		}
		$result = $statement->execute($params);
		if(PDO_DEBUG) {
			$info = array();
			$info['sql'] = $sql;
			$info['params'] = $params;
			$info['error'] = $statement->errorInfo();
			$this->debug(false, $info);
		}
		if (!$result) {
			return false;
		} else {
			if (empty($keyfield)) {
				return $statement->fetchAll(pdo::FETCH_ASSOC);
			} else {
				$temp = $statement->fetchAll(pdo::FETCH_ASSOC);
				$rs = array();
				if (!empty($temp)) {
					foreach ($temp as $key => &$row) {
						if (isset($row[$keyfield])) {
							$rs[$row[$keyfield]] = $row;
						} else {
							$rs[] = $row;
						}
					}
				}
				return $rs;
			}
		}
	}

	public function update($table, $data = array(), $params = array(), $glue = 'AND') {
		$fields = $this->implode($data, ',');
		$condition = $this->implode($params, $glue);
		$params = array_merge($fields['params'], $condition['params']);
		$sql = "UPDATE " . $this->tablename($table) . " SET {$fields['fields']}";
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return $this->query($sql, $params);
	}
        public function update_card($table, $data = array(), $params = array(), $glue = 'AND'){
                $fields = $this->implode($data, ',');
		$condition = $this->implode($params, $glue);
		$params = array_merge(array(), $condition['params']);
                $sql = "UPDATE " . $this->tablename($table) . " SET ";
                $sql .= " price = CASE cardid ";
                foreach ($data as $key => $val){
                    $val1 = $this->assoc_unique($val);
                    $sql .=" WHEN ".$key." THEN ".$val1["price"];
                }
                $sql .= " END, upper_lim = CASE cardid ";
                foreach ($data as $key => $val){
                    $val1 = $this->assoc_unique($val);
                    $sql .=" WHEN ".$key." THEN ".$val1["upper_lim"];
                }
                $sql .= " END, commission_ratio = CASE cardid ";
                foreach ($data as $key => $val){
                    //$val1 = $this->assoc_unique($val);
                    $sql .=" WHEN ".$key." THEN ".$val["commission_ratio"];
                }
                $sql .= " END, use_years = CASE cardid ";
                foreach ($data as $key => $val){
                    
                    $sql .=" WHEN ".$key." THEN ".$val["use_years"];
                }
                $sql .= " END, discount = CASE cardid ";
                foreach ($data as $key => $val){
                    
                    $sql .=" WHEN ".$key." THEN ".$val["discount"];
                }
                $sql .= " END, upper_lim2 = CASE cardid ";
                foreach ($data as $key => $val){
                    //$val1 = $this->assoc_unique($val);
                    $sql .=" WHEN ".$key." THEN ".$val["upper_lim2"];
                }
                $sql .=' END ';
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
                return $this->query($sql, $params);
        }

        public function insert($table, $data = array(), $replace = FALSE) {
		$cmd = $replace ? 'REPLACE INTO' : 'INSERT INTO';
		$condition = $this->implode($data, ',');
		return $this->query("$cmd " . $this->tablename($table) . " SET {$condition['fields']}", $condition['params']);
	}

	public function insertid() {
		return $this->pdo->lastInsertId();
	}

	public function delete($table, $params = array(), $glue = 'AND') {
		$condition = $this->implode($params, $glue);
		$sql = "DELETE FROM " . $this->tablename($table);
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return $this->query($sql, $condition['params']);
	}

	public function begin() {
		$this->pdo->beginTransaction();
	}

	public function commit() {
		$this->pdo->commit();
	}

	public function rollback() {
		$this->pdo->rollBack();
	}

	private function implode($params, $glue = ',') {
		$result = array('fields' => ' 1 ', 'params' => array());
		$split = '';
		$suffix = '';
		if (in_array(strtolower($glue), array('and', 'or'))) {
			$suffix = '__';
		}
		if (!is_array($params)) {
			$result['fields'] = $params;
			return $result;
		}
		if (is_array($params)) {
			$result['fields'] = '';
			foreach ($params as $fields => $value) {
				$result['fields'] .= $split . "`$fields` =  :{$suffix}$fields";
				$split = ' ' . $glue . ' ';
				$result['params'][":{$suffix}$fields"] = is_null($value) ? '' : $value;
			}
		}
		return $result;
	}

	public function run($sql, $stuff = 'ims_') {
		if(!isset($sql) || empty($sql)) return;

		$sql = str_replace("\r", "\n", str_replace(' ' . $stuff, ' ' . $this->cfg['tablepre'], $sql));
		$sql = str_replace("\r", "\n", str_replace(' `' . $stuff, ' `' . $this->cfg['tablepre'], $sql));
		$ret = array();
		$num = 0;
		foreach(explode(";\n", trim($sql)) as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			foreach($queries as $query) {
				$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
			}
			$num++;
		}
		unset($sql);
		foreach($ret as $query) {
			$query = trim($query);
			if($query) {
				$this->query($query);
			}
		}
	}

	public function fieldexists($tablename, $fieldname) {
		$isexists = $this->fetch("DESCRIBE " . $this->tablename($tablename) . " `{$fieldname}`");
		return !empty($isexists) ? true : false;
	}

	public function indexexists($tablename, $indexname) {
		if (!empty($indexname)) {
			$indexs = pdo_fetchall("SHOW INDEX FROM " . $this->tablename($tablename));
			if (!empty($indexs) && is_array($indexs)) {
				foreach ($indexs as $row) {
					if ($row['Key_name'] == $indexname) {
						return true;
					}
				}
			}
		}
		return false;
	}

	public function tablename($table) {
		return "`{$this->cfg['tablepre']}{$table}`";
	}

	public function debug($output = true, $append = array()) {
		if(!empty($append)) {
			$output = false;
			array_push($this->errors, $append);
		}
		if($output) {
			print_r($this->errors);
		} else {
			if (!empty($append['error'][1])) {
				$traces = debug_backtrace();
				$ts = '';
				foreach($traces as $trace) {
					$trace['file'] = str_replace('\\', '/', $trace['file']);
					$trace['file'] = str_replace(IA_ROOT, '', $trace['file']);
					$ts .= "file: {$trace['file']}; line: {$trace['line']}; <br />";
				}
				$params = var_export($append['params'], true);
				message("SQL: <br/>{$append['sql']}<hr/>Params: <br/>{$params}<hr/>SQL Error: <br/>{$append['error'][2]}<hr/>Traces: <br/>{$ts}");
			}
		}
		return $this->errors;
	}
        public function assoc_unique($arr) {
            $arr_out =array();  
                   foreach($arr as $k => $v)  
                   {  
                        $key_out = $v['name']."-".$v['age']; //提取内部一维数组的key(name age)作为外部数组的键  
  
                        if(array_key_exists($key_out,$arr_out)){  
                            continue;  
                        }  
                        else{  
                             $arr_out[$key_out] = $arr[$k]; //以key_out作为外部数组的键  
                             $arr_wish[$k] = $arr[$k];  //实现二维数组唯一性  
                        }  
                   }  
                   return $arr_wish;  
        }
}
