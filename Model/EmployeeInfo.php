<?php
/**
 * @author TruongHV1
 */

namespace Model;

use Model\EmployeeInfoInterface;

class EmployeeInfo extends AbstractModel implements EmployeeInfoInterface {
    /**
     * Employee id
     * @var integer
     */
    protected $empId = null;
    //protected 

    /**
     * @inheritdocr
     */
    public function getEmpId(int $empId) {
        return $this->empId;
	}

	/**
	 * @inheritdoc
	 */
	public function setEmpId(int $empId) {
	    $this->empId= $empId;
	}

	/**
	 * Insert table
	 *
	 * @param $fields array need to set
	 * @return integer result
	 */
	public function exprot()
    {
        $query = "SELECT * from data ORDER BY emp_id DESC";
        return $result = $this->conn->execute($query);
    }

	public function insert($data)
	{
	    $table = 'data';
        // Lưu trữ danh sách field
        $field_list = '';
        // Lưu trữ danh sách giá trị tương ứng với field
        $value_list = '';

        // Lặp qua data
        foreach ($data as $key => $value){
            $field_list .= ",$key";
            $value_list .= ",'".mysql_escape_string($value)."'";
        }

        // Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';

        return  $result = $this->conn->execute($sql);
    }

	/**
	 * Insert table
	 *
	 * @param $fields array need to set
	 * @return integer result
	 */
	public function insertAll($data)
	{
	    $sql = "INSERT into data (emp_id, firstname, lastname, email, reg_date)
                        values ('" . $data['emp_id'] . "','" . $data['firstname'] . "','" . $data['lastname'] . "',
                       '" . $data['email'] . "','" . $data['reg_date'] . "')";

         return $result = $this->conn->execute($sql);
	}

	/**
	 * Update table
	 *
	 * @param $fields array need to set
	 * @$condition condition for update
	 * @return integer result
	 */
	public function update($data, $condition)
	{
	    $table = 'data';
        $sql = '';
        // Lặp qua data
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysql_escape_string($value)."',";
        }

        // Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$condition;

        return $result = $this->conn->execute($sql);
	}
}
