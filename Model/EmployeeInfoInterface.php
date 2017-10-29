<?php
/**
 * @author TruongHV1
 */

namespace Model;

interface EmployeeInfoInterface {
    /**
     * Get employee id
     *
     * @param int $empId
     * @return number
     */
    public function getEmpId(int $empId);

	/**
	 * Set employee id
	 *
	 * @param int $empId
	 */
	public function setEmpId(int $empId);
}
