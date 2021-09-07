<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open($url . '/add') ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Language', 'language') ?>
			<?= form_input('language', '', 'class="form-control" id="language" required="true" maxLength="50"') ?>
		</div>
	</div>
</div>
<?= form_close() ?>