<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open($url . '/add') ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Category', 'cat_id') ?>
			<select class="form-control" name="cat_id" id="cat_id">
				<option selected="" disabled="">Select Category</option>
				<?php foreach ($cats as $cat): ?>
				<option value="<?= e_id($cat['id']) ?>"><?= ucwords($cat['cat_name']) ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Language', 'language') ?>
			<select class="select2" name="language[]" id="language" data-placeholder="Select Language" multiple="">
				<?php foreach ($langs as $lang): ?>
				<option value="<?= e_id($lang['id']) ?>"><?= ucwords($lang['language']) ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Date', 'e_date') ?>
			<?= form_input([
				'type' => 'date',
				'name' => 'e_date',
				'id' => 'e_date',
				'class' => 'form-control'
			]) ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Time', 'e_time') ?>
			<?= form_input([
				'type' => 'time',
				'name' => 'e_time',
				'id' => 'e_time',
				'class' => 'form-control'
			]) ?>
		</div>
	</div>
</div>
<?= form_close() ?>