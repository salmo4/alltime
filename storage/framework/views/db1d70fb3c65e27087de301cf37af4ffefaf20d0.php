<?php if(Session::has('caffeinated.flash.message')): ?>
	<div class="alert alert-<?php echo e(Session::get('caffeinated.flash.level')); ?>">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo e(Session::get('caffeinated.flash.message')); ?>

	</div>
<?php endif; ?>
