<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dao_generator
 *
 * @author x666207
 */

namespace generators;

class dao_gen {

  protected $file_name, $writer;
  public $file_contents;
  private $_CRLF = "\n\r", $_LF = "\r", $_TAB2 = "  ", $_TAB4 = "    ", $_TAB6 = "      ", $_TAB8 = "        ";
  
  public function __construct($params) {
    $this->file_name = $params["file_name"];
  }

  public function OpenWriter($params) {
    $this->writer = fopen($params["file_name"], 'w') or die("can't open file");
  }

  public function CloseWriter($params) {
    fclose($this->writer);
  }

  public function AddPhpOpenTag() {
    fwrite($this->writer, "<?php" . $this->_CRLF);
  }

  public function AddNameSpace($namespace) {
    fwrite($this->writer, "namespace " . $namespace . ";");
  }

  public function AddFileDescription($table_name) {
    fwrite($this->writer, "/**" . $this->_LF . "*" . $this->_LF);
    fwrite($this->writer, "* @package    Basic MVC framework" . $this->_LF);
    fwrite($this->writer, "* @author     Jeremie Litzler" . $this->_LF);
    fwrite($this->writer, "* @copyright  Copyright (c) " . date("Y") . $this->_LF);
    fwrite($this->writer, "* @license" . $this->_LF);
    fwrite($this->writer, "* @link" . $this->_LF);
    fwrite($this->writer, "* @since" . $this->_LF);
    fwrite($this->writer, "* @filesource" . $this->_LF);
    fwrite($this->writer, "*/" . $this->_LF);
    fwrite($this->writer, "// ------------------------------------------------------------------------" . $this->_CRLF);
    fwrite($this->writer, "/**" . $this->_LF . "*" . $this->_LF);
    fwrite($this->writer, "* " . ucfirst($table_name) ." Dao Class" . $this->_LF);
    fwrite($this->writer, "*" . $this->_LF);
    fwrite($this->writer, "* @package     Application/PMTool" . $this->_LF);
    fwrite($this->writer, "* @subpackage  Models/Dao" . $this->_LF);
    fwrite($this->writer, "* @category    " . ucfirst($table_name) . $this->_LF);
    fwrite($this->writer, "* @author      FWM DEV Team" . $this->_LF);
    fwrite($this->writer, "* @link" . $this->_LF);
    fwrite($this->writer, "*/" . $this->_CRLF);
  }

  public function AddScriptNotAllowedLine() {
    fwrite($this->writer, $this->_LF . "if ( ! defined('__EXECUTION_ACCESS_RESTRICTION__')) exit('No direct script access allowed');");
  }

  public function ClassStart($params) {
    $output = $this->_CRLF . "class " . ucfirst($params['class_name']) . " extends " . $params['base_class'] . "{" . $this->_LF;
    fwrite($this->writer, $output);
  }

  public function ClassEnd() {
    fwrite($this->writer, $this->_LF . "}");
  }

  public function AddPropertiesAndConsts($columns) {
    //Write the public properties
    fwrite($this->writer, $this->_TAB2 . "public " . $this->_LF);
    $columnCount = 0;
    foreach ($columns as $columnName => $columnMeta) {
      if (count($columns) - 1 === $columnCount) {
        fwrite($this->writer, $this->_TAB4 . "$" . $columnMeta[0]["Field"] . ";" . $this->_CRLF);
      } else {
        fwrite($this->writer, $this->_TAB4 . "$" . $columnMeta[0]["Field"] . "," . $this->_LF);
      }
      $columnCount += 1;
    }
    //Write the constants
    fwrite($this->writer, $this->_TAB2 . "const " . $this->_LF);
    $columnCount = 0;
    foreach ($columns as $columnName => $columnMeta) {
      if (count($columns) - 1 === $columnCount) {
        fwrite($this->writer, $this->_TAB4 . strtoupper($columnMeta[0]["Field"]) . "_ERR = " . $columnCount . ";" . $this->_CRLF);
      } else {
        fwrite($this->writer, $this->_TAB4 . strtoupper($columnMeta[0]["Field"]) . "_ERR = " . $columnCount . "," . $this->_LF);
      }
      $columnCount += 1;
    }
  }

  public function AddSetters($columns) {
    fwrite($this->writer, $this->_TAB2 . "// SETTERS //" . $this->_LF);
    foreach ($columns as $columnName => $columnMeta) {
      $output = $this->_TAB2 . "public function set" . ucfirst($columnMeta[0]["Field"]) . "($" . $columnMeta[0]["Field"] . ") {" . $this->_LF;
      //$output .= $this->_TAB4 . "if (empty($" . $column_name . ")) {" . $this->_LF;
      //$output .= $this->_TAB6 . '$this->erreurs[] = self::' . strtoupper($column_name) . '_ERR;' . $this->_LF;
      //$output .= $this->_TAB4 . "} else {" . $this->_LF;
      $output .= $this->_TAB6 . '$this->' . $columnMeta[0]["Field"] . ' = $' . $columnMeta[0]["Field"] . ';' . $this->_LF;
      //$output .= $this->_TAB4 . "}" . $this->_LF;
      $output .= $this->_TAB2 . "}" . $this->_CRLF;
      fwrite($this->writer, $output);
    }
  }

  public function AddGetters($columns) {
    fwrite($this->writer, $this->_TAB2 . "// GETTERS //" . $this->_LF);
    foreach ($columns as $columnName => $columnMeta) {
      $output = $this->_TAB2 . "public function " . $columnMeta[0]["Field"] . "() {" . $this->_LF;
      $output .= $this->_TAB4 . 'return $this->' . $columnMeta[0]["Field"] . ';' . $this->_LF;
      $output .= $this->_TAB2 . "}" . $this->_CRLF;
      fwrite($this->writer, $output);
    }
  }

}
