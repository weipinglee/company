<?php

/**
 * 模型类 由于Yaf中会将以Model结尾的类看做模型类，会在当前项目模型中查找，所以更名为Data;
 * author: wplee
 * Date: 2016/1/28
 */

namespace Library;
use \Library\DB\DbFactory;
class M{



	protected $db = null;//DB实例

    private $tablePre = '';

	public $tableData = array();//插入或更新的数据

	private $tableName = '';

	private $whereStr = '';

	private $whereParam = array();

    private $fields   = '*';

    private $group    = '';

    private $order    = '';

    private $limit    = ' LIMIT 500';

	private $pk       = 'id';

	static private $check    = null;

	private $error   = '';
	
	public function __construct($tableName) {
		$this->db = DbFactory::getInstance();
		$this->tableName = $this->tablePre.$tableName;
	}

	//设置主键
	public function pk($pk){
		$this->pk = $pk;
	}
	/**
	 * 设置数据对象的值
	 * @access public
	 * @param string $name 名称
	 * @param mixed $value 值
	 * @return void
	 */
	public function __set($name,$value) {
		// 设置数据对象属性
		$this->tableData[$name]  =   $value;
	}

	/**
	 * 获取数据对象的值
	 * @access public
	 * @param string $name 名称
	 * @return mixed
	 */
	public function __get($name) {
		return isset($this->tableData[$name])?$this->tableData[$name]:null;
	}

	/**


	/**
	 * 检测数据对象的值
	 * @access public
	 * @param string $name 名称
	 * @return boolean
	 */
	public function __isset($name) {
		return isset($this->tableData[$name]);
	}

	/**
	 * 销毁数据对象的值
	 * @access public
	 * @param string $name 名称
	 * @return void
	 */
	public function __unset($name) {
		unset($this->tableData[$name]);
	}

	//获取错误信息
	public function getError(){
		return $this->error;
	}

	//开启事物
	public function beginTrans(){
		$this->db->beginTrans();
	}
	//事物回滚
	public function rollBack(){
		$this->db->rollBack();
	}
	//事物提交
	public function commit(){
		return $this->db->commit();

	}

	//是否在事务中
	public function inTrans(){
		return $this->db->inTrans();
	}

	/**
	 * @brief 设置新增或更改的数据
	 * @param $data array 更新或新增的数据
     */
	public function data($data){
		$this->tableData = $data;
		return $this;
	}

	/**
	 * 设置操作表名 或返回当前操作表名
	 * @param $tableName str 表名
	 * @return $this
     */
	public function table($tableName=''){
		if($tableName==''){
			return $this->tableName;
		}else{
			$this->tableName = $this->tablePre.$tableName;
			$this->clear();
			return $this;
		}
	}

	/**
	 *清除数据
	 *
     */
	private function clear(){
		$this->tableData = array();
		$this->whereStr = '';
		$this->whereParam = array();
		$this->fields   = '*';
		$this->group    = '';
		$this->order    = '';
		$this->limit    = ' LIMIT 500';
		$this->error = '';
	}

	/**
	 * @param $where array or str 查询条件
	 * @return string 查询条件字符串
	 */
	public function where($where){
		if(!isset($where))return false;
		$sql = '';
		$this->whereParam = array();//情况where数组
		if(is_array($where)){
			$sql .= ' WHERE ';
			foreach($where as $key=>$val){
				if(!is_array($val)){
					if($key=='_string'){
						$sql .= $val.' AND ';
					}
					else{
						$sql .= $key.' = :'.$key.' AND ';
						$this->whereParam[$key] = $val;
					}
				}
				else{
       				if($key=='_string'){
						$sql .= $val[0].' AND ';
						$this->whereParam = array_merge($this->whereParam,$val[1]);
					}
					else{
						foreach($val as $ekey => $eval){
							//非相等的情况
							switch(strtolower($ekey)){

								case 'neq' : {
									$sql .= $key.' <> :'.$key.$ekey.' AND ';
								}
									break;
								case 'gt' : {
									$sql .= $key.' > :'.$key.$ekey.' AND ';
								}
									break;
								case 'lt' : {
									$sql .= $key.' < :'.$key.$ekey.' AND ';
								}
									break;
								case 'eq' :
								default : {
									$sql .= $key.' = :'.$key.$ekey.' AND ';
								}
								break;

							}

							$this->whereParam[$key.$ekey] = $eval;
						}


					}
				}

			}
			$sql = substr($sql,0,-4);
			//$this->whereParam = $where;
		}
		else if(is_string($where)){
			$sql = ' WHERE '.$where;
		}
		$this->whereStr = $sql;
		return $this;
	}

	/**
	 * @brief 设置where条件绑定参数数组,where条件为str时设定
	 * @param $bindArr
	 * @return $this
     */
	public function bindWhere($bindArr){
		$this->whereParam = array_merge($this->whereParam,$bindArr);
		return $this;
	}

	/**
	 * @brief 替换bindWhere
	 * @param $bindArr
	 * @return $this
	 */
	public function bind($bindArr){
		$this->whereParam = array_merge($this->whereParam,$bindArr);
		return $this;
	}

    /**
     * @brief 设置查询的字段
     * @$fields array or str 查询字段
     */
    public function fields($fields='*'){
        if(is_string($fields))
            $this->fields = $fields;
        else if(is_array($fields)){
            $sql = '';
            foreach($fields as $key=>$val){
                $sql .= $val.',';
            }
            $sql = substr($sql,0,-1);
            $this->fields = $sql;
        }
        return $this;

    }


    /**
     *设置查询排序
     * @param string $order  排序依据字段，例如：id ,id DESC
     */
    public function order($order=''){
        if($order != ''){
            $this->order = ' ORDER BY '.$order;
        }
        return $this;


    }

    /**
     * 设置查询limit
     * @param $limit str
     */
    public function limit($limit=''){
        if($limit != ''){
            $this->limit = ' LIMIT '.$limit;
        }
		else $this->limit = '';
        return $this;
    }

	/**
     * @brief 新增数据
	 * @param bool $trans 是否应该在事务中
	 * @return bool
     */
	public function add($trans=0) {
		$res = false;

		if(!empty($this->tableData)){
			$insData = $this->tableData;

			$insertCol = '';
			$insertVal = '';
			foreach($insData as $key => $val)
			{
				$insertCol .= '`'.$key.'`,';
				$insertVal .= ':'.$key.',';
			}
			$sql = 'INSERT INTO '.$this->tableName.' ( '.rtrim($insertCol,',').' ) VALUES ( '.rtrim($insertVal,',').' ) ';

			$res =  $this->db->exec($sql,$this->tableData,'INSERT');
		}

		return $res;
	}

	/**
	 * 返回上次新增条目的id
	 * @return [type] [description]
	 */
	public function lastInsertId(){
		return $this->db->lastInsertId();
	}

	/**
	 * 插入多条数据
	 */
	public function adds($trans=0){
		$res = false;

		if(!empty($this->tableData)){
			$insData = $this->tableData;

			$insertCol = '';
			$insertVal = '';
			$bindData = array();
			foreach($insData as $key => $val)
			{
				$temp = '';
				if($insertCol==''){
					foreach($insData[$key] as $k=>$v){
						$insertCol .= '`'.$k.'`,';
					}
				}
				foreach($insData[$key] as $k=>$v){
					$temp .= ':'.$k.'_'.$key.',';
					$bindData[$k.'_'.$key] = $v;

				}
				$insertVal .= '('.rtrim($temp,',').'),';


			}
			$sql = 'INSERT INTO '.$this->tableName.' ( '.rtrim($insertCol,',').' ) VALUES  '.rtrim($insertVal,',');

			$res =  $this->db->exec($sql,$bindData,'INSERT');
		}

		return $res;
	}

	/**
	 * @brief 更新数据
	 * @param bool $trans
	 * @return bool|返回处理结果
     */
	public function update($trans=0){
		$res = false;

		if(!empty($this->tableData) && $this->whereStr != ''){
			$sql = 'UPDATE '.$this->tableName.' SET ';
			foreach($this->tableData as $key=>$val){
				$sql .= '`'.$key.'` = :'.$key.',';
			}
			$sql = rtrim($sql,',');

			$sql .= $this->whereStr;

			$res =  $this->db->exec($sql,array_merge($this->tableData,$this->whereParam),'UPDATE');
		}
		return $res;
	}

	/**
	 * 删除数据
	 * @return bool|返回处理结果
     */
	public function delete($trans=0){
		$res = false;

		if($this->whereStr != ''){
			$sql = 'DELETE FROM '.$this->tableName.$this->whereStr;
			$res =  $this->db->exec($sql,$this->whereParam,'DELETE');

		}
		return $res;
	}

    /**
     * @brief 获取多条数据
     * @param array or string $cols 查询字段,支持数组格式,如array('cols1','cols2')
     * @param array or string $orderBy 排序字段
     * @param array or string $desc 排列顺序 值: DESC:倒序; ASC:正序;
     * @param array or int $limit 显示数据条数 默认(500)
     * @return array 查询结果
     */
    public function select()
    {
        $sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->order.$this->limit ;
        $res =  $this->db->exec($sql,$this->whereParam,'SELECT');
        return $res;
    }

    /**
     * @brief 查询一条结果
     * @return array 返回处理结果
     */
    public function getObj(){
        $this->limit(1);
        $sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->order.$this->limit ;

        $res =  $this->db->exec($sql,$this->whereParam,'SELECT');
        return empty($res) ? array() : $res[0];
    }

	/**
	 * 获取一个字段
	 * @param string $field 字段
	 * @return 返回处理结果
     */
	public function getField($field){
		$this->limit(1)->fields($field);
		$sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->order.$this->limit ;
		$res =  $this->db->exec($sql,$this->whereParam,'SELECT');
		if(!empty($res))return $res[0][$field];
		return false;
	}

	/**
	 * 获取一个字段多条数据
	 *
	 */
	public function getFields($field){
		$this->fields($field);
		$sql = 'SELECT '.$this->fields.' FROM '.$this->tableName. $this->whereStr.$this->limit ;
		$res =  $this->db->exec($sql,$this->whereParam,'SELECT');
		if(!empty($res)){
			$arr = array();
			foreach($res as $key=>$val){
				$arr[] = $res[$key][$field];
			}
			return $arr;
		}
		return array();
	}

    /**
     * 执行一条sql
     * @param $sql
     * @return 查询结果
     */
    public function query($sql,$param=array(),$type=''){
        $res =  $this->db->exec($sql,array_merge($this->whereParam,$param),$type);
		return $res;
    }

	/**
	 * 字段值增长
	 * @access public
	 * @param string $field  字段名
	 * @param integer $step  增长值
	 * @return boolean
	 */
	public function setInc($field,$step=1,$trans=0) {

		if($this->whereStr!='') {
			$sql = 'UPDATE '.$this->tableName.' SET '.$field.' = '.$field.' + :step '.$this->whereStr;
			return $this->query($sql,array_merge(array('step'=>$step),$this->whereParam),'UPDATE');
		}
		return false;


	}

	/**
	 * 字段值增长
	 * @access public
	 * @param string $field  字段名
	 * @param integer $step  增长值
	 * @return boolean
	 */
	public function setDec($field,$step=1,$trans=0) {
		if($this->whereStr!='') {
			$sql = 'UPDATE '.$this->tableName.' SET '.$field.' = '.$field.' - :step '.$this->whereStr;
			return $this->query($sql,array_merge(array('step'=>$step),$this->whereParam),'UPDATE');
		}
		else return false;

	}

	/**
	 *插入更新，插入字段唯一键已存在则更新，不存在则插入
	 * @param array $insert 插入数据
	 * @param array $update 更新数据
	 * @param bool $trans
	 * @return 
     */
	public function insertUpdate($insert,$update,$trans=0){
		$sql = 'INSERT INTO '.$this->table();
		$insertCol = '';
		$insertVal = '';
		foreach($insert as $key => $val)
		{
			$insertCol .= '`'.$key.'`,';
			$insertVal .= ':'.$key.',';
		}
		$sql .= ' ( '.rtrim($insertCol,',').' ) VALUES ( '.rtrim($insertVal,',').' ) ON DUPLICATE KEY UPDATE';

		foreach($update as $key=>$val){
			$sql .= '`'.$key.'` = :'.$key.',';
		}
		$sql = rtrim($sql,',');
		return $this->bind(array_merge($insert,$update))->query($sql,array(),'UPDATE');

	}

	/**
	 * 数据验证
	 * @param array $rules 验证规则
	 * @param int $type 1 : 插入 2：更新
	 * @param array $data 要验证的数据
	 * @return bool 验证结果 如果返回false，会修改$this->error的值
	 */
	public function validate($rules,$data=array(),$type=''){
		$checkData = empty($data) ? $this->tableData : $data;
		if(!is_object(self::$check))
			self::$check = new check();
		return self::$check->validate($checkData,$rules,$this->error,$type,$this->pk);
	}






}
?>