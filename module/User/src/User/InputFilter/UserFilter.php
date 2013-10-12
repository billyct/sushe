<?php

namespace User\InputFilter;

use Zend\InputFilter\InputFilterInterface;

use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class UserFilter implements InputFilterAwareInterface {
	
	protected $inputFilter;
	/*
	 * (non-PHPdoc) @see
	* \Zend\InputFilter\InputFilterAwareInterface::setInputFilter()
	*/
	public function setInputFilter(InputFilterInterface $inputFilter) {
		// TODO Auto-generated method stub
	}
	
	/*
	 * (non-PHPdoc) @see
	* \Zend\InputFilter\InputFilterAwareInterface::getInputFilter()
	*/
	public function getInputFilter() {
		// TODO Auto-generated method stub
	
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();
				
			$inputFilter->add($factory->createInput(array(
					'name' => 'username',
					'required' => true,
					'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name' => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 50,
									),
	
							),
					),
						
			)));
				
			$inputFilter->add($factory->createInput(array(
					'name' => 'email',
					'required' => true,
					'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name' => 'EmailAddress',
							),
					),
	
			)));
				
			$inputFilter->add($factory->createInput(array(
					'name' => 'password',
					'required' => true,
					'filters' => array(
							array('name' => 'StripTags'),
							array('name' => 'StringTrim'),
					),
					'validators' => array(
							array(
									'name' => 'StringLength',
									'options' => array(
											'encoding' => 'UTF-8',
											'min' => 1,
											'max' => 100,
									),
										
							),
					),
	
			)));
				
			$this->inputFilter = $inputFilter;
		}
	
		return $this->inputFilter;
	}
	
}

?>