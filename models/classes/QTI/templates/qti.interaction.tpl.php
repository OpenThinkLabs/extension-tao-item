<<?=$type?>Interaction <?=$rowOptions?>>
    
    <?if(!empty($prompt)):?>
    	<prompt><?=$prompt?></prompt>
    <?endif?>
     <?if(count($object) > 0):?>
     	<?if(trim($object_alt) == ''):?>
     		<object <?=$objectAttributes?> />
     	<?else:?>
    		<object <?=$objectAttributes?> ><?=$object_alt?></object>
    	<?endif?>
    <?endif?>

	<?=$data?>
       
</<?=$type?>Interaction>
