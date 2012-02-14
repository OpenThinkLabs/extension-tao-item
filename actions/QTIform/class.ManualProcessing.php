<?php

error_reporting(E_ALL);

/**
 * TAO - taoItems/actions/QTIform/class.ManualProcessing.php
 *
 * $Id$
 *
 * This file is part of TAO.
 *
 * Automatically generated on 31.01.2012, 17:35:13 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author Joel Bout, <joel.bout@tudor.lu>
 * @package taoItems
 * @subpackage actions_QTIform
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include taoItems_actions_QTIform_ResponseProcessingOptions
 *
 * @author Joel Bout, <joel.bout@tudor.lu>
 */
require_once('taoItems/actions/QTIform/class.ResponseProcessingOptions.php');

/* user defined includes */
// section 127-0-1-1-249123f:13519689c9e:-8000:000000000000368A-includes begin
// section 127-0-1-1-249123f:13519689c9e:-8000:000000000000368A-includes end

/* user defined constants */
// section 127-0-1-1-249123f:13519689c9e:-8000:000000000000368A-constants begin
// section 127-0-1-1-249123f:13519689c9e:-8000:000000000000368A-constants end

/**
 * Short description of class taoItems_actions_QTIform_ManualProcessing
 *
 * @access public
 * @author Joel Bout, <joel.bout@tudor.lu>
 * @package taoItems
 * @subpackage actions_QTIform
 */
class taoItems_actions_QTIform_ManualProcessing
    extends taoItems_actions_QTIform_ResponseProcessingOptions
{
    // --- ASSOCIATIONS ---


    // --- ATTRIBUTES ---

    /**
     * Short description of attribute outcome
     *
     * @access public
     * @var Outcome
     */
    public $outcome = null;

    // --- OPERATIONS ---

    /**
     * Short description of method __construct
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @param  Interaction interaction
     * @param  ResponseProcessing responseProcessing
     * @param  Outcome outcome
     * @return mixed
     */
    public function __construct( taoItems_models_classes_QTI_Interaction $interaction,  taoItems_models_classes_QTI_response_ResponseProcessing $responseProcessing,  taoItems_models_classes_QTI_Outcome $outcome)
    {
        // section 127-0-1-1--3304025a:135345a8f39:-8000:00000000000036B0 begin
        $this->outcome = $outcome;
    	parent::__construct($interaction, $responseProcessing);
        // section 127-0-1-1--3304025a:135345a8f39:-8000:00000000000036B0 end
    }

    /**
     * Short description of method initElements
     *
     * @access public
     * @author Joel Bout, <joel.bout@tudor.lu>
     * @return mixed
     */
    public function initElements()
    {
        // section 127-0-1-1-249123f:13519689c9e:-8000:0000000000003690 begin
    	parent::initElements();
        $serialElt = tao_helpers_form_FormFactory::getElement('outcomeSerial', 'Hidden');
		$serialElt->setValue($this->outcome->getSerial());
		$this->form->addElement($serialElt);
		
        //guidlines correct:
		$guidelines = tao_helpers_form_FormFactory::getElement('guidelines', 'Textarea');
		$guidelines->setDescription(__('Guidelines'));
		$guidelines->setValue($this->outcome->getOption('interpretation'));
		$this->form->addElement($guidelines);
		$correct = tao_helpers_form_FormFactory::getElement('correct', 'Textarea');
		$correct->setDescription(__('Correct answer'));
		$responses = $this->interaction->getResponse()->getCorrectResponses();
		$correct->setValue(implode("\n", $responses));
		$this->form->addElement($correct);
		
		//upperbound+lowerbound:
		$lowerBoundElt = tao_helpers_form_FormFactory::getElement('min', 'Textbox');
		$lowerBoundElt->setDescription(__('Minimum value'));
		$this->form->addElement($lowerBoundElt);
		$upperBoundElt = tao_helpers_form_FormFactory::getElement('max', 'Textbox');
		$upperBoundElt->setDescription(__('Maximum value'));
		$this->form->addElement($upperBoundElt);
        // section 127-0-1-1-249123f:13519689c9e:-8000:0000000000003690 end
    }

} /* end of class taoItems_actions_QTIform_ManualProcessing */

?>