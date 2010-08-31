<?php

error_reporting(E_ALL);

/**
 * This container initialize the qti item form:
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
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
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 */
require_once('tao/helpers/form/class.FormContainer.php');

/**
 * This container initialize the login form.
 *
 * @access public
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 * @package tao
 * @subpackage actions_form
 */
abstract class taoItems_actions_QTIform_Interaction
    extends tao_helpers_form_FormContainer
{
	
	/**
     * the class resource to create the form from
     *
     * @access protected
     * @var Interaction
     */
    protected $interaction = null;
	
	public function __construct(taoItems_models_classes_QTI_Interaction $interaction, $choices=array()){
		
		$this->interaction = $interaction;
		$returnValue = parent::__construct(array(), array('choices'=>$choices));
		
	}
	
	/**
     * The method initForm for all type of interaction form
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return mixed
     */
    public function initForm()
    {
		$interactionType = $this->interaction->getType();
		$this->form = tao_helpers_form_FormFactory::getForm(strtolower($interactionType).'Interaction');
		
		// $saveElt = tao_helpers_form_FormFactory::getElement('Save', 'Submit');
		// $saveElt->setValue(__('Save'));
		// $this->form->setActions(array($saveElt), 'top');//put save button on top because the bottom would be the place for the choice editing
		
		$actions = tao_helpers_form_FormFactory::getCommonActions('top', true, false);
		$addChoiceElt = tao_helpers_form_FormFactory::getElement('addchoice', 'Free');
		$addChoiceElt->setValue("<a href='#' class='form-choice-adder' ><img src='".TAOBASE_WWW."/img/add.png'  /> ".__('Add a choice')."</a>");
		$actions[] = $addChoiceElt;
		
		$this->form->setActions($actions, 'top');
		$this->form->setActions(array(), 'bottom');
		
    }
	
	public function getInteraction(){
		return $this->interaction;
	}

}

?>