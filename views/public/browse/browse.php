<?php
/*
 * browseby.php 
 */
?>
<?php $head = array('title' => 'Browse digitalMETRO by ' . $eltext, 'bodyclass' => 'categorybrowse'); ?>
<?php head($head); ?>

<div id="primary">
<h1><?php echo $head['title']; ?></h1>

<table class="results">
	    <tr>
	  	<th>Sample Image</th>
	    <th>Title</th>
	    <th>Creator(s)</th>
	    <th>Tags</th>  
	    </tr>
		<?php while (loop_items()): ?>
	
			<tr>
			<div class="item-row">
				<div>
					<?php if ($text = item('Item Type Metadata', 'Text')): ?>
    				<?php $shortdesc = $text; ?>
					<?php elseif ($description = item('Dublin Core', 'Description')): ?>
    				<?php $shortdesc = $description; ?>
				<?php endif; ?>	
				<td>
				<?php if (item_has_thumbnail()): ?>
    				<div class="item-img">
    				<?php echo link_to_item(item_square_thumbnail(array('alt'=>item('Dublin Core', 'Title'), 'width'=>'70', 'height'=>'70'))); ?>						
    				</div>
				<?php endif; ?>
				</td>
				
				<td><div style="font-size: 1.1em;"><?php echo link_to_item(item('Dublin Core', 'Title'), array('class'=>'permalink', 'title'=>$shortdesc)); ?></div></td>
				
				
				<td>
				<?php if ($creator = item('Dublin Core', 'Creator', array('all'=>'true'))): ?>
                    <?php foreach($creator as $inst) {?>
                    	<div style="font-size: 1.1em;"><?php echo metadata_browser_create_link(metadata_browser_get_element_id("Creator"), $inst);?></div>
                    <?php }?>
                <?php endif; ?>
				</td>
				<td>
                
				<?php if (item_has_tags()): ?>
    				<div><p style="font-size: .9em;">
    				<?php echo item_tags_as_string(); ?></p>
    				</div>
				<?php endif; ?>
				</td>
				<!--
				<td>
				<?php //if ($subject = item('Dublin Core', 'Subject', array('all'=>'true'))): ?>
                    <?php //foreach($subject as $sub) {?>
                    <?php //echo create_browse_link("58", $sub);?>, 
                    <?php //}?>
                <?php //endif; ?>
				</td>
				-->
				<?php echo plugin_append_to_items_browse_each(); ?>
			
				</div><!-- end class="item-meta" -->
				
			</div><!-- end class="item hentry" -->	
		</tr>
		<?php endwhile; ?>
		</table>

</div>

<?php foot(); ?>