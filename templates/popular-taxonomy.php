<div class="nutralife-popular-taxonomy align_center">
    <div class="popular-category-label"><?php _e('Popular category', 'nutralife_product' );?></div>
	<div class="sections_group">
		<?php
		$popular_taxs = nutralife_get_popular_tax();
		if(!empty($popular_taxs)): ?>
			<?php foreach ($popular_taxs as $tax):?>
					<div class="column mcb-column one-sixth column_column">
						<a class="tax-title-link" href="<?php echo  get_term_link($tax->term_id, 'product_cats'); ?>"><h4 class="tax-title"><?php echo  $tax->name; ?></h4></a>
						<a href="<?php echo  get_term_link($tax->term_id, 'product_cats'); ?>" class="tax-image-link"><img src="<?php echo get_term_meta($tax->term_id, 'term_sku', true)?get_term_meta($tax->term_id, 'term_sku', true):NTLFP_DEFAULT_THUMB;?>" alt="<?php echo  $tax->name; ?>"></a>
					</div>
				<?php endforeach;?>
		<?php else: ?>
			<div class="column mcb-column one column_column"><?php _e('Nothing Found', 'nutralife_product'); ?></div>
		<?php endif; ?>
        <div class="column mcb-column one column_column clearfix align_center">
            <?php $non_popular_taxs = nutralife_get_non_popular_tax();
            if(!empty($non_popular_taxs)): ?>
	            <?php foreach ($non_popular_taxs as $tax):?>
                    <a class="non-popular-tax-title-link" href="<?php echo  get_term_link($tax->term_id, 'product_cats'); ?>"><?php echo  $tax->name; ?></h4></a>
	            <?php endforeach;?>
            <?php endif; ?>

        </div>

	</div>
</div>