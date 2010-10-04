<?php

error_reporting(E_ALL);

/**
 * TAO - taoItems/models/classes/QTI/class.Interaction.php
 *
 * $Id$
 *
 * This file is part of TAO.
 *
 * Automatically generated on 01.10.2010, 11:58:55 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 * @package taoItems
 * @subpackage models_classes_QTI
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include taoItems_models_classes_QTI_Choice
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 */
require_once('taoItems/models/classes/QTI/class.Choice.php');

/**
 * The QTI_Data class represent the abstract model for all the QTI objects.
 * It contains all the attributes of the different kind of QTI objects.
 * It manages the identifiers and serial creation.
 * It provides the serialisation and persistance methods.
 * And give the interface for the rendering.
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 */
require_once('taoItems/models/classes/QTI/class.Data.php');

/**
 * include taoItems_models_classes_QTI_Group
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 */
require_once('taoItems/models/classes/QTI/class.Group.php');

/**
 * include taoItems_models_classes_QTI_Item
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 */
require_once('taoItems/models/classes/QTI/class.Item.php');

/**
 * include taoItems_models_classes_QTI_Response
 *
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 */
require_once('taoItems/models/classes/QTI/class.Response.php');

/* user defined includes */
// section 127-0-1-1--56c234f4:12a31c89cc3:-8000:0000000000002341-includes begin
// section 127-0-1-1--56c234f4:12a31c89cc3:-8000:0000000000002341-includes end

/* user defined constants */
// section 127-0-1-1--56c234f4:12a31c89cc3:-8000:0000000000002341-constants begin
// section 127-0-1-1--56c234f4:12a31c89cc3:-8000:0000000000002341-constants end

/**
 * Short description of class taoItems_models_classes_QTI_Interaction
 *
 * @access public
 * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
 * @package taoItems
 * @subpackage models_classes_QTI
 */
class taoItems_models_classes_QTI_Interaction
    extends taoItems_models_classes_QTI_Data
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd :     // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute choices
     *
     * @access protected
     * @var array
     */
    protected $choices = array();

    /**
     * Short description of attribute response
     *
     * @access protected
     * @var Response
     */
    protected $response = null;

    /**
     * Short description of attribute groups
     *
     * @access protected
     * @var array
     */
    protected $groups = array();

    /**
     * Short description of attribute prompt
     *
     * @access protected
     * @var string
     */
    protected $prompt = '';

    // --- OPERATIONS ---

    /**
     * Short description of method __construct
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  string type
     * @param  string id
     * @param  array options
     * @return mixed
     */
    public function __construct($type, $id = null, $options = array())
    {
        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002488 begin
        
    	parent::__construct($id, $options);
    	
    	$this->type = $type;
    	
        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002488 end
    }

    /**
     * Short description of method __sleep
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return array
     */
    public function __sleep()
    {
        $returnValue = array();

        // section 127-0-1-1--272f4da0:12a899718bf:-8000:00000000000024DD begin
        
        $this->choices = array_keys($this->choices);
        if(!is_null($this->response)){
        	$this->response = $this->response->getSerial();
        }
		$this->groups = array_keys($this->groups);
        $returnValue = parent::__sleep();
        
        // section 127-0-1-1--272f4da0:12a899718bf:-8000:00000000000024DD end

        return (array) $returnValue;
    }

    /**
     * Short description of method __wakeup
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return mixed
     */
    public function __wakeup()
    {
        // section 127-0-1-1--272f4da0:12a899718bf:-8000:00000000000024DF begin
        
    	$choiceSerials = $this->choices; 
    	$this->choices = array();
    	foreach($choiceSerials as $serial){
    		if(Session::hasAttribute(self::PREFIX .$serial)){
    			$this->choices[$serial] = unserialize(Session::getAttribute(self::PREFIX .$serial));
    		}
    	}
		
    	$responseSerial = $this->response;
    	$this->response = null;
    	if(Session::hasAttribute(self::PREFIX .$responseSerial)){
    		$this->response = unserialize(Session::getAttribute(self::PREFIX .$responseSerial));
    	}
		
		$groupSerials = $this->groups;
		$this->groups = array();
    	foreach($groupSerials as $serial){
    		if(Session::hasAttribute(self::PREFIX .$serial)){
    			$this->groups[$serial] = unserialize(Session::getAttribute(self::PREFIX .$serial));
    		}
    	}
        // section 127-0-1-1--272f4da0:12a899718bf:-8000:00000000000024DF end
    }

    /**
     * Short description of method setChoices
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  array choices
     * @return mixed
     */
    public function setChoices($choices)
    {
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023EE begin
        
    	$this->choices = array();
    	foreach($choices as $choice){
    		$this->addChoice($choice);
    	}
    	
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023EE end
    }

    /**
     * Short description of method getChoices
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return array
     */
    public function getChoices()
    {
        $returnValue = array();

        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F1 begin
        
        $returnValue = $this->choices;
        
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F1 end

        return (array) $returnValue;
    }

    /**
     * Short description of method getChoice
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  string serial
     * @return taoItems_models_classes_QTI_Choice
     */
    public function getChoice($serial)
    {
        $returnValue = null;

        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F3 begin
        
        if(!empty($id)){
        	if(array_key_exists($id, $this->choices)){
        		$returnValue = $this->choices[$id];
        	}
        }
        
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F3 end

        return $returnValue;
    }

    /**
     * Short description of method addChoice
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  Choice choice
     * @return mixed
     */
    public function addChoice( taoItems_models_classes_QTI_Choice $choice)
    {
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F6 begin
        
    	if(!is_null($choice)){
    		$this->choices[$choice->getSerial()] = $choice;
    	}
    	
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F6 end
    }

    /**
     * Short description of method removeChoice
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  Choice choice
     * @return boolean
     */
    public function removeChoice( taoItems_models_classes_QTI_Choice $choice)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1--398d1ef5:12acc40a46b:-8000:0000000000002545 begin
        
		if(!is_null($choice)){
    		if(isset($this->choices[$choice->getSerial()])){
    			foreach($this->getGroups() as $group){
					$group->removeChoice($choice);
				}
				unset($this->choices[$choice->getSerial()]);
				
				//remove the choice from the interaction data:
				$data = $this->getData();
				$data = str_replace("{{$choice->getSerial()}}", '', $data);
				$this->setData($data);
				
    			$returnValue = true;
    		}
		
    	}
    	
        // section 127-0-1-1--398d1ef5:12acc40a46b:-8000:0000000000002545 end

        return (bool) $returnValue;
    }

    /**
     * Short description of method shuffleChoices
     *
     * @access protected
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return string
     */
    protected function shuffleChoices()
    {
        $returnValue = (string) '';

        // section 127-0-1-1-4fc32daa:12b6736cfe7:-8000:00000000000025B2 begin
        
        $returnValue = $this->data;
        
        //get choices order
        $matchs = array();
        $max = preg_match_all("/{choice_[a-z0-9]*}/", $returnValue, $matchs);
        if($max > 0){
        	$ordered = $matchs[0];
        	$shuffled = array();
        	foreach($ordered as $index => $choice){
        		do { 
        			$key = mt_rand(0, $max * 10); 
        		} while(array_key_exists($key, $shuffled));
	        	$shuffled[$key] = $choice;
        	}
        	ksort($shuffled);
        	
        	$i = 0;
        	foreach($shuffled as $sKey => $sChoice){
        		$returnValue = str_replace($ordered[$i], "{{$sKey}}", $returnValue);
        		$i++;
        	}
        	foreach($shuffled as $sKey => $sChoice){
        		$returnValue = str_replace("{{$sKey}}", $sChoice, $returnValue);
        	}
        }
        
        // section 127-0-1-1-4fc32daa:12b6736cfe7:-8000:00000000000025B2 end

        return (string) $returnValue;
    }

    /**
     * Short description of method getGroups
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return array
     */
    public function getGroups()
    {
        $returnValue = array();

        // section 127-0-1-1-7bfc492a:12ad2946c72:-8000:0000000000002544 begin
        
        $returnValue  = $this->groups;
        
        // section 127-0-1-1-7bfc492a:12ad2946c72:-8000:0000000000002544 end

        return (array) $returnValue;
    }

    /**
     * Short description of method setGroups
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  array groups
     * @return mixed
     */
    public function setGroups($groups)
    {
        // section 127-0-1-1-4b2a2e4c:12b61a11fd4:-8000:00000000000025AF begin
        
    	$this->groups = array();
    	foreach($groups as $group){
    		$this->addGroup($group);
    	}
    	
        // section 127-0-1-1-4b2a2e4c:12b61a11fd4:-8000:00000000000025AF end
    }

    /**
     * Short description of method addGroup
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  Group group
     * @return mixed
     */
    public function addGroup( taoItems_models_classes_QTI_Group $group)
    {
        // section 127-0-1-1--56a89d8b:12ad288b4f1:-8000:0000000000002546 begin
        
    	$this->groups[$group->getSerial()] = $group;
    	
        // section 127-0-1-1--56a89d8b:12ad288b4f1:-8000:0000000000002546 end
    }

    /**
     * Short description of method removeGroup
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  Group group
     * @param  boolean recursive
     * @return boolean
     */
    public function removeGroup( core_kernel_classes_Group $group, $recursive = false)
    {
        $returnValue = (bool) false;

        // section 127-0-1-1--56a89d8b:12ad288b4f1:-8000:000000000000254D begin
        
    	if(!is_null($group)){
    		
    		if(isset($this->groups[$group->getSerial()])){
    			
    			if($recursive){
    				foreach($group->getChoices() as $choice){
    					$this->removeChoice($choice);
    				}
    			}
    			unset($this->groups[$group->getSerial()]);
    			$returnValue = true;
    		}
    		
    	}
    	
        // section 127-0-1-1--56a89d8b:12ad288b4f1:-8000:000000000000254D end

        return (bool) $returnValue;
    }

    /**
     * Short description of method getResponse
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return taoItems_models_classes_QTI_Response
     */
    public function getResponse()
    {
        $returnValue = null;

        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F9 begin
        
        $returnValue = $this->response;
        
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023F9 end

        return $returnValue;
    }

    /**
     * Short description of method setResponse
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  Response response
     * @return mixed
     */
    public function setResponse( taoItems_models_classes_QTI_Response $response)
    {
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023FB begin
        
    	$this->response = $response;
    	
        // section 127-0-1-1--4be859a6:12a33452171:-8000:00000000000023FB end
    }

    /**
     * Short description of method getPrompt
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return string
     */
    public function getPrompt()
    {
        $returnValue = (string) '';

        // section 127-0-1-1--424d5b00:12ad69af5de:-8000:0000000000002573 begin
        
        $returnValue = $this->prompt;
        
        // section 127-0-1-1--424d5b00:12ad69af5de:-8000:0000000000002573 end

        return (string) $returnValue;
    }

    /**
     * Short description of method setPrompt
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @param  string text
     * @return mixed
     */
    public function setPrompt($text)
    {
        // section 127-0-1-1--424d5b00:12ad69af5de:-8000:0000000000002575 begin
        
    	$this->prompt = $text;
    	
        // section 127-0-1-1--424d5b00:12ad69af5de:-8000:0000000000002575 end
    }

    /**
     * Short description of method toXHTML
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return string
     */
    public function toXHTML()
    {
        $returnValue = (string) '';

        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002495 begin
        
   		//check first if there is a template for the given type
        $template = self::getTemplatePath() . 'interactions/xhtml.' .strtolower($this->type) . '.tpl.php';
        if(!file_exists($template)){
        	 //else get the general template
        	 $template = self::getTemplatePath() . 'xhtml.interaction.tpl.php';
       }
        
        //get the variables to used in the template
        $variables = array();
    	$reflection = new ReflectionClass($this);
		foreach($reflection->getProperties() as $property){
			if(!$property->isStatic()){
				$variables[$property->getName()] = $this->{$property->getName()};
			}
		}
		
		//change from camelCase to underscore_case the type of the interaction to be used in the JS
		$variables['_type']	= strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $this->type));
		
		//suffle the choices for the runtime if defined in the QTI
		if( ((bool)$this->getOption('shuffle')) == true){
			$variables['data'] = $this->shuffleChoices();
		}
		
   		$variables['data'] = preg_replace("/{prompt}/", "<p class='prompt'>{$this->prompt}</p>", $variables['data']);
		
   		//build back the choices in the data variable
   		if(count($this->getGroups()) > 0){
   			foreach($this->getGroups() as $group){
				$variables['data'] = preg_replace("/{".$group->getSerial()."}/", $group->toXHTML(), $variables['data']);
			}
			foreach($this->getChoices() as $choice){
				$variables['data'] = preg_replace("/{".$choice->getSerial()."}/", $choice->toXHTML(), $variables['data']);
			}
   		}
   		else{
   			if($this->type != 'hottext'){
   				$variables['data'] = preg_replace("/{choice_[a-z0-9]*}(.*){choice_[a-z0-9]*}/i", "<ul class='qti_choice_list'>$0</ul>", $variables['data']);
   			}
   			foreach($this->getChoices() as $choice){
				$variables['data'] = preg_replace("/{".$choice->getSerial()."}/", $choice->toXHTML(), $variables['data']);
			}
   		}
   		
        $tplRenderer = new taoItems_models_classes_QTI_TemplateRenderer($template, $variables);
      	$returnValue = $tplRenderer->render();
        
        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002495 end

        return (string) $returnValue;
    }

    /**
     * Short description of method toQTI
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return string
     */
    public function toQTI()
    {
        $returnValue = (string) '';

        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002497 begin
        
        //check first if there is a template for the given type
        $template = self::getTemplatePath() . 'interactions/qti.' .strtolower($this->type) . '.tpl.php';
        if(!file_exists($template)){
        	 $template = self::getTemplatePath() . 'qti.interaction.tpl.php';
        }
        
        //get the variables to used in the template
        $variables = array();
    	$reflection = new ReflectionClass($this);
		foreach($reflection->getProperties() as $property){
			if(!$property->isStatic()){
				$variables[$property->getName()] = $this->{$property->getName()};
			}
		}
		
		$variables['data'] = preg_replace("/{prompt}/", "<prompt>{$this->prompt}</prompt>", $variables['data']);
		
   		//build back the choices in the data variable
   		if(count($this->getGroups()) > 0){
   			foreach($this->getGroups() as $group){
				$variables['data'] = preg_replace("/{".$group->getSerial()."}/", $group->toQti(), $variables['data']);
			}
   		}
   		
		foreach($this->getChoices() as $choice){
			$variables['data'] = preg_replace("/{".$choice->getSerial()."}/", $choice->toQti(), $variables['data']);
		}
   		
		
		//parse and render the template
		$tplRenderer = new taoItems_models_classes_QTI_TemplateRenderer($template, $variables);
		$returnValue = $tplRenderer->render();
        
        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002497 end

        return (string) $returnValue;
    }

    /**
     * Short description of method toForm
     *
     * @access public
     * @author Bertrand Chevrier, <bertrand.chevrier@tudor.lu>
     * @return tao_helpers_form_Form
     */
    public function toForm()
    {
        $returnValue = null;

        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002499 begin
		
		//if 'block', add prompt box
		//if 'string', special attr
		//if 'graphic', object tag
		//if 'inline', nothing
		$interactionFormClass = 'taoItems_actions_QTIform_interaction_'.ucfirst(strtolower($this->getType())).'Interaction';
		if(!class_exists($interactionFormClass)){
			throw new Exception("the class {$interactionFormClass} does not exist");
		}else{
			$formContainer = new $interactionFormClass($this, $this->getChoices());//include choices or not...
			$myForm = $formContainer->getForm();
			$returnValue = $myForm;
		}
		
		
        // section 127-0-1-1-25600304:12a5c17a5ca:-8000:0000000000002499 end

        return $returnValue;
    }

} /* end of class taoItems_models_classes_QTI_Interaction */

?>