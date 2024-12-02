<?php
	function display_pagination($total_pages, $paged = 1) { ?>
        <nav class="page-nav">
            <button class="page-nav__btn prev" disabled>

            </button>
            <ul>
				<?php if ($total_pages > 1): ?>
					<?php
					$max_links = 3; // gty links
					$start = max(1, $paged - intval($max_links / 2));
					$end = min($total_pages, $start + $max_links - 1);

					if ($start > 1):?>
                        <li><button data-page="1">1</button></li>
						<?php if ($start > 2): ?>
                            <li>...</li>
						<?php endif; ?>
					<?php endif; ?>

					<?php for ($i = $start; $i <= $end; $i++): ?>
                        <li><button data-page="<?php echo $i; ?>" class="<?php echo ($i == $paged ? 'active' : ''); ?>"><?php echo $i; ?></button></li>
					<?php endfor; ?>

					<?php if ($end < $total_pages): ?>
						<?php if ($end < $total_pages - 1): ?>
                            <li>...</li>
						<?php endif; ?>
                        <li><button data-page="<?php echo $total_pages; ?>"><?php echo $total_pages; ?></button></li>
					<?php endif; ?>
				<?php endif; ?>
            </ul>

            <button class="page-nav__btn next" <?php echo $paged == $total_pages ? 'disabled' : ''; ?>>
 
            </button>
        </nav>
	<?php }

?>
