<?php
/**** @package    Basic MVC framework* @author     Jeremie Litzler* @copyright  Copyright (c) 2014* @license* @link* @since* @filesource*/// ------------------------------------------------------------------------
/**** Field_analyte Dao Class** @package     Application/PMTool* @subpackage  Models/Dao* @category    Field_analyte* @author      FWM DEV Team* @link*/
namespace Applications\PMTool\Models\Dao;if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');
class Field_analyte extends \Library\Entity{  public     $field_analyte_id,    $field_analyte_name_unit,    $pm_id;
  const     FIELD_ANALYTE_ID_ERR = 0,    FIELD_ANALYTE_NAME_UNIT_ERR = 1,    PM_ID_ERR = 2;
  // SETTERS //  public function setField_analyte_id($field_analyte_id) {      $this->field_analyte_id = $field_analyte_id;  }
  public function setField_analyte_name_unit($field_analyte_name_unit) {      $this->field_analyte_name_unit = $field_analyte_name_unit;  }
  public function setPm_id($pm_id) {      $this->pm_id = $pm_id;  }
  // GETTERS //  public function field_analyte_id() {    return $this->field_analyte_id;  }
  public function field_analyte_name_unit() {    return $this->field_analyte_name_unit;  }
  public function pm_id() {    return $this->pm_id;  }
}