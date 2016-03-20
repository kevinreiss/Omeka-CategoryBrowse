<?php
$title = __('Browse by "%s"', $eltext);
echo head(array(
    'title' => $title,
    'bodyclass' => 'category-browse browse',
));
?>
<div id="primary">
    <h1><?php echo $title; ?></h1>
    <table class="results">
	    <tr>
            <th><?php echo __('Sample Image'); ?></th>
            <th><?php echo __('Title'); ?></th>
            <th><?php echo __('Creator(s)'); ?></th>
            <th><?php echo __('Tags'); ?></th>
            <?php /* <th><?php echo __('Subjects'); ?></th> */ ?>
	    </tr>
		<?php
        foreach (loop('items') as $item):
            $title = metadata($item, array('Dublin Core', 'Title'));
	    ?>
		<tr class="item-row">
			<td>
			<?php if ($item->has_thumbnail): ?>
				<div class="item-img">
                    <?php echo link_to_item(
                        item_image('square_thumbnail', array('alt' => $title, 'width' => '70', 'height' => '70'), 0, $item),
                        array('class' => 'item-thumbnail'),
                        'show',
                        $item); ?>
				</div>
			<?php endif; ?>
			</td>
			<td>
		        <div style="font-size: 1.1em;">
                    <?php echo link_to_item(null, array('class' => 'permalink', 'title' => $title), 'show', $item); ?>
	            </div>
	        </td>
			<td>
			<?php
            $creators = metadata($item, array('Dublin Core', 'Creator'), array('all' => 'true'));
            $element = $item->getElement('Dublin Core', 'Creator');
            foreach($creators as $creator): ?>
                <div style="font-size: 1.1em;">
                    <a class="browse-link" href="<?php
                        $value = trim(strip_formatting($creator));
                        $queryURL = url("items/browse?advanced[0][element_id]=" . $element->id . "&advanced[0][type]=contains&advanced[0][terms]=" . $value);
                    ?>" title='Browse "<?php echo $value; ?>"'><?php echo $value; ?></a>
                </div>
            <?php endforeach; ?>
			</td>
			<td>
			<?php
            $tags = tag_string($item);
			if ($tags): ?>
				<div><p style="font-size: .9em;">
			        <?php echo $tags; ?>
		        </p></div>
			<?php endif; ?>
			</td>
			<?php /*
			<td>
			<?php
            $subjects = metadata($item, array('Dublin Core', 'Subject'), array('all' => 'true'));
            foreach($subject as $sub) {
                echo create_browse_link("58", $sub) . ',';
            } ?>
			</td>
			*/ ?>
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php echo foot();
