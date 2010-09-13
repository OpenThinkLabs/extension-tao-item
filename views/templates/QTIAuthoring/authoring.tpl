<script language="Javascript" type="text/javascript">
</script>

<script type="text/javascript" src="<?=get_data('qtiAuthoring_path')?>util.js"></script>
<script type="text/javascript" src="<?=get_data('qtiAuthoring_path')?>responseEdit.js"></script>
<script type="text/javascript" src="<?=get_data('qtiAuthoring_path')?>qtiEdit.js"></script>
<script type="text/javascript" src="<?=get_data('qtiAuthoring_path')?>interactionEdit.js"></script>
<script type="text/javascript" src="<?=get_data('qtiAuthoring_path')?>json2.js"></script>
<script type="text/javascript" src="<?=get_data('jwysiwyg_path')?>jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?=get_data('simplemodal_path')?>jquery.simplemodal.js"></script>

<link rel="stylesheet" href="<?=get_data('jwysiwyg_path')?>jquery.wysiwyg.css" type="text/css" />
<link rel="stylesheet" href="<?=get_data('jwysiwyg_path')?>jquery.wysiwyg.modal.css" type="text/css" />
<link rel="stylesheet" href="<?=get_data('simplemodal_path')?>jquery.simplemodal.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=BASE_WWW?>css/qtiAuthoring.css" />

<div id="qtiAuthoring_main_container">
	<div id="qtiAuthoring_left_container">
		<div id="qtiAuthoring_itemEditor_title" class="ui-widget-header ui-corner-top ui-state-default">
				<?=__('Item Editor:')?>
		</div>
		<div id="qtiAuthoring_itemEditor" class="ui-widget-content ui-corner-bottom">
			<div class="ext-home-container ui-state-highlight">
				<textarea name="wysiwyg" id="itemEditor_wysiwyg"><?=get_data('itemData')?></textarea>
			</div>

		</div>

		<div id='qtiAuthoring_interactionEditor'/>    
	</div>

	<div id="qtiAuthoring_right_container">
		<div id="qtiAuthoring_response_title" class="ui-widget-header ui-corner-top ui-state-default">
				<?=__('Response & Scoring Editor:')?>
		</div>
		<div id="qtiAuthoring_responseEditor" class="ui-widget-content ui-corner-bottom">
			<div class="ext-home-container ui-state-highlight_cancel">
				<table id="qtiAuthoring_response_grid"></table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
// img_url_tao = root_url + "/tao/views/img/";
// img_url = root_url + "/taoItems/views/img/";

qtiEdit.itemSerial = '<?=get_data('itemSerial')?>';
qtiEdit.itemDataContainer = '#itemEditor_wysiwyg';
qtiEdit.interactionFormContent = '#qtiAuthoring_interactionEditor';

//init the item's jwysiwyg editor here:
var addInteraction = {
	visible : true,
	className: 'addInteraction',
	exec: function(){
		CL('inserting interaction...');
		//display modal window with the list of available type of interactions
		var interactionType = 'choice';
		
		//insert location of the current interaction in the item:
		this.insertHtml('{qti_interaction_new}');
		
		//send to request to the server
		qtiEdit.addInteraction(interactionType, this.getContent(), qtiEdit.itemSerial);
		
		//go to the form:
		// qtiEdit.loadInteractionForm(interaction_id);
	},
	tooltip: 'add interaction'
};

var saveItemData = {
	visible : true,
	className: 'addInteraction',
	exec: function(){
		qtiEdit.saveItemData();
	},
	tooltip: 'save'
};
var loadXmlQti = null;
var exportXmlQti = null;

//extend the jwysi obj:
// $.extend(Wysiwyg, {
	// undo: function(){
		// var self = $.data(this, 'wysiwyg');
		// self.editorDoc.execCommand('undo', false, null);
	// }
// });
		
$(document).ready(function(){

  qtiEdit.itemEditor = $(qtiEdit.itemDataContainer).wysiwyg({
    controls: {
      strikeThrough : { visible : true },
      underline     : { visible : true },
      
      justifyLeft   : { visible : true },
      justifyCenter : { visible : true },
      justifyRight  : { visible : true },
      justifyFull   : { visible : true },
      
      indent  : { visible : true },
      outdent : { visible : true },
      
      subscript   : { visible : true },
      superscript : { visible : true },
      
      undo : { visible : true },
      redo : { visible : true },
      
      insertOrderedList    : { visible : true },
      insertUnorderedList  : { visible : true },
      insertHorizontalRule : { visible : true },

      h4: {
              visible: true,
              className: 'h4',
              command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
              arguments: ($.browser.msie || $.browser.safari) ? '<h4>' : 'h4',
              tags: ['h4'],
              tooltip: 'Header 4'
      },
      h5: {
              visible: true,
              className: 'h5',
              command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
              arguments: ($.browser.msie || $.browser.safari) ? '<h5>' : 'h5',
              tags: ['h5'],
              tooltip: 'Header 5'
      },
      h6: {
              visible: true,
              className: 'h6',
              command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
              arguments: ($.browser.msie || $.browser.safari) ? '<h6>' : 'h6',
              tags: ['h6'],
              tooltip: 'Header 6'
      },
      
      cut   : { visible : true },
      copy  : { visible : true },
      paste : { visible : true },
      html  : { visible: true },
      exam_html: { exec: function() { this.insertHtml('<abbr title="exam">Jam</abbr>') }, visible: true  },
	  addInteraction: addInteraction,
	  saveItemData: saveItemData
    },
    events: {
	  keyup : function(e){
		if(qtiEdit.getDeletedInteractions(true).length > 0){
			if(!confirm('please confirm deletion of the interaction')){
				// undo:
				qtiEdit.itemEditor.wysiwyg('undo');
			}else{
				var deletedInteractions = qtiEdit.getDeletedInteractions();
				qtiEdit.deleteInteractions(deletedInteractions);
				
			}
		}
		// if ($('#click-inform:checked').length > 0){
		  // e.preventDefault();
		  // alert('You have clicked jWysiwyg content!');
		// }
	  }
    }
  });
  
	//the binding require the modified html data to be ready
	setTimeout(qtiEdit.bindInteractionLinkListener,250);
	
});

</script>

<script type="text/javascript">
	try{
		responseEdit.buildGrid('qtiAuthoring_response_grid', 'myInteractionId');
	}catch(err){
		CL('building grid error:', err);
	}
	
</script>