<?php
class CartRule extends CartAppModel {
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'RuleCondition' => array(
			'foreignKey' => 'cart_rule_id',
			'order' => 'position'));

/**
 * Add a new rule
 *
 * @return boolean
 */
	public function add($data = array()) {
		if (!empty($data)) {
			$this->create();
			$result = $this->save($data);
			if ($result) {
				$this->data[$this->alias]['id'] = $this->getLastInsertId();
				return true;
			}
		}
		return false;
	}

/**
 * Edit a rule
 *
 * @param string $ruleId UUID of the record to edit
 */
	public function edit($ruleId) {
		
	}

/**
 * 
 */
	public function applyRules($cartData) {
		$rules = $this->find('all', array(
			'contain' => array(
				'RuleCondition'),
			'conditions' => array(
				$this->alias . '.active' => 1)));

		if (empty($rules)) {
			return $cartData;
		}

		foreach ($rules as $rule) {
			foreach ($rule['RuleCondition'] as $condition) {
				$this->evaluateCondition($cartData, $condition, $type);
			}
		}
	}

/**
 * 
 */
	public function evaluateCondition($condition, $data, $type = 'AND') {
		if ($type == 'AND') {
			$result = true;
		} else if ($type == 'OR') {
			$result = false;
		}
		foreach ($condition as $key => $cond) {
			$curr = true;
			$key = strtoupper($key);
			if ($key == 'AND' || $key == 'OR') {
				$curr = $this->evalCondition($cond, $data, $key);
			} elseif (strtoupper($key) == 'CURRENTQUESTION') {
				$curr = $data['current'] == $cond;
			} else {
				if (!isset($data['answers'][$key])) {
					$curr = false;
				} else {
					$curr = $data['answers'][$key] == $cond;
				}
			}

			if ($type == 'AND') {
				$result = $result && $curr;
				if (!$result) return false;

			} elseif ($type = 'OR') {
				$result = $result || $curr;
				if (!$result) return true;
			}

		}
		return $result;
	}
}