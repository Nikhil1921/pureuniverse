<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open($url . '/add') ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Voucher code', 'counts') ?>
			<?= form_input('counts', '', 'class="form-control" id="counts" required="true" maxLength="5"') ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Discount', 'discount') ?>
			<?= form_input('discount', '', 'class="form-control" id="discount" required="true" maxLength="2"') ?>
		</div>
	</div>
</div>
<?= form_close() ?>