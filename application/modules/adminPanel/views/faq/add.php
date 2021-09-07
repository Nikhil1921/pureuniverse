<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open($url . '/add') ?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<?= form_label('Question', 'question') ?>
			<?= form_input('question', '', 'class="form-control" id="question" maxLength="255"') ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<?= form_label('Answer', 'answer') ?>
			<?= form_textarea('answer', '', 'class="form-control ckeditor" id="answer"') ?>
		</div>
	</div>
</div>
<?= form_close() ?>
<script src="<?= b_asset('ckeditor/ckeditor.js') ?>"></script>