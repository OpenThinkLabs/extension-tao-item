<gapMatchInteraction
<?foreach($options as $key => $value):?>
   	<?=$key?>="<?=$value?>" 
<?endforeach?> >

<?foreach($groups as  $group):?>

	<?foreach($group->getChoices() as  $groupChoiceSerial):?>
	
	    <?foreach($choices as  $choice):?>
	    	<?if($groupChoiceSerial == $choice->getSerial()):?>
	    		<gapText identifier="<?=$choice->getIdentifier()?>"><?=$choice->getData()?></gapText>
	    		<?break?>
	    	<?endif?>
	    <?endforeach?>
	    
	<?endforeach?>
	
	<?break?>
<?endforeach?>

	<?=$data?>
            
</gapMatchInteraction>