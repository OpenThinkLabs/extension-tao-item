<?php

error_reporting(E_ALL);

/**
 * This container initialize the qti item form:
 *
 * @author CRP Henri Tudor - TAO Team - {@link http://www.tao.lu}
 * @package tao
 * @subpackage actions_form
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * This class provide a container for a specific form instance.
 * It's subclasses instanciate a form and it's elements to be used as a
 *
 * @author CRP Henri Tudor - TAO Team - {@link http://www.tao.lu}
 */
require_once('tao/helpers/form/class.FormContainer.php');

/**
 * This container initialize the login form.
 *
 * @access public
 * @author CRP Henri Tudor - TAO Team - {@link http://www.tao.lu}
 * @package tao
 * @subpackage actions_form
 */
abstract class taoItems_actions_QTIform_interaction_StringInteraction
    extends taoItems_actions_QTIform_interaction_Interaction
{
	
	public function setCommonElements(){
	
		$interaction = $this->getInteraction();
		$response = $interaction->getResponse();
		$isNumeric = false;
		if(!is_null($response)){
			if($response->getOption('baseType') == 'integer' || $response->getOption('baseType') == 'float'){
				$isNumeric = true;
			}
		}
		
		parent::setCommonElements();
		
		$baseElt = tao_helpers_form_FormFactory::getElement('base', 'Textbox');
		$baseElt->setDescription(__('Number base for value interpretation'));
		$baseElt->addValidator(tao_helpers_form_FormFactory::getValidator('Integer'));
		$base = $interaction->getOption('base');
		if(!$isNumeric){
			$baseElt->addAttribute('disabled', true);
			if(!empty($base)){
				$baseElt->setValue($base);
			}
		}
		else{
			if(!empty($base)){
				$baseElt->setValue($base);
			}
			else{
				$baseElt->setValue(10);
			}
		}
		$this->form->addElement($baseElt);
		
		$stringIdentifierElt = tao_helpers_form_FormFactory::getElement('stringIdentifier', 'Textbox');
		$stringIdentifierElt->setDescription(__('String identifier'));
		$stringIdentifier = $interaction->getOption('stringIdentifier');
		if(!$isNumeric){
			$stringIdentifierElt->addAttribute('disabled', true);
		}		
		
		if(!empty($stringIdentifier)){
			$stringIdentifierElt->setValue($stringIdentifier);
		}
		$this->form->addElement($stringIdentifierElt);
		
		$expectedLengthElt = tao_helpers_form_FormFactory::getElement('expectedLength', 'Textbox');
		$expectedLengthElt->setDescription(__('Expected length'));
		$expectedLengthElt->addValidator(tao_helpers_form_FormFactory::getValidator('Integer'));
		$expectedLength = $interaction->getOption('expectedLength');
		if(!empty($expectedLength)){
			$expectedLengthElt->setValue($expectedLength);
		}
		$this->form->addElement($expectedLengthElt);
		
		$patternMaskElt = tao_helpers_form_FormFactory::getElement('patternMask', 'Textbox');
		$patternMaskElt->setDescription(__('Pattern mask'));
		$patternMask = $interaction->getOption('patternMask');
		if(!empty($patternMask)){
			$patternMaskElt->setValue($patternMask);
		}
		$this->form->addElement($patternMaskElt);
		
		$placeHolderTextElt = tao_helpers_form_FormFactory::getElement('placeHolderText', 'Textbox');
		$placeHolderTextElt->setDescription(__('Place holder text'));
		$placeHolderText = $interaction->getOption('placeHolderText');
		if(!empty($placeHolderText)){
			$placeHolderTextElt->setValue($placeHolderText);
		}
		$this->form->addElement($placeHolderTextElt);
		
	}
}

?>