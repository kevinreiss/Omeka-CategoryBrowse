<?php
$title = __('Browse by %s', $elname);
echo head(array(
    'title' => $title,
    'bodyclass' => 'category-browse list',
));
?>
<div id="primary">
<?php if ($total_results): ?>
    <div id="pagination-top" class="pagination"><?php echo pagination_links(); ?></div>
	<h1><?php echo $title . ' (' . $total_results . ')'; ?></h1>
	<br class="clear">
    <div class="class='metadataBrowserDisplay">
        <ul>
        <?php foreach ($elTexts as $category):
            $text = trim($category->text);
            ?>
            <li class="category">
                <a class="browse-link" href="<?php echo url(
                    'categories/browse/' . urlencode($elset) . '/' . urlencode($elname) . '/' . urlencode($text)); ?>"><?php echo $text; ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <div id="pagination-bottom" class="pagination"><?php echo pagination_links(); ?></div>
<?php else: ?>
    <?php echo __('No items to display.'); ?>
<?php endif; ?>
</div>
<?php echo foot();
