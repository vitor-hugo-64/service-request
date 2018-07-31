<?php

namespace SR;

class Model {

	private $values = [];

	public function __call($name, $args) {

		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		for ($i=0; $i < strlen($fieldName); $i++) { 
			if ( ctype_upper($fieldName[$i])) {
				$temp = $fieldName[$i];
				$fieldName = str_replace( $fieldName[$i], ($i == 0) ? strtolower($fieldName[$i]) : '_'.strtolower($fieldName[$i]), $fieldName);
			}
		}

		switch ($method) {
			case 'get':
			return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : null;
			break;

			case 'set':
			return $this->values[$fieldName] = $args[0];
			break;

		}
	}

	public function setDatas($data = array())
	{
		foreach ($data as $key => $value) {
			$this->{"set".$key}($value);
		}
	}

	public function getDatas():array
	{
		return $this->values;
	}
}