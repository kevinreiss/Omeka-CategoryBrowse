<?php
/*
 * 
 */
?>
<?php $head = array('title' => 'Browse digitalMETRO by ' . $elname, 'bodyclass' => 'categorybrowse'); ?>
<?php head($head); ?>


<div id="primary">
<div id="pagination-top" class="pagination"><?php echo pagination_links(); ?></div>
	<h1><?php echo $head['title']; ?>: <?php echo $total_results; ?></h1>
<div class="class='metadataBrowserDisplay">
<?php if (count($this->paginator)): ?>
<ul>
<?php foreach ($this->paginator as $category): ?>
  <li class="category">
  <?php echo '<a class="browse-link" href="' . uri("categories/browse/$elset/$elname/" . urlencode($category['text']) ) . '">' . $category['text'] . '</a>'; ?>
  </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</div>

<div id="pagination-bottom" class="pagination"><?php echo pagination_links(); ?></div>

</div>

<?php foot(); ?>
