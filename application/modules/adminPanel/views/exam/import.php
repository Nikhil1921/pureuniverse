<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open_multipart($url . '/import') ?>
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
			<select class="form-control" name="language" id="language">
				<option selected="" disabled="">Select Language</option>
				<?php foreach ($langs as $lang): ?>
				<option value="<?= e_id($lang['id']) ?>"><?= ucwords($lang['language']) ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Exam Code', 'e_code') ?>
			<?= form_input([
				'name' => 'e_code',
				'id' => 'e_code',
				'maxlength' => 50,
				'class' => 'form-control'
			]) ?>
		</div>
	</div>
    <div class="col-md-6">
		<div class="form-group">
			<?= form_label('Upload Questions', 'import') ?>
            <br>
			<?= form_label('<i class="fa fa-upload" ></i>Select File To Import', 'import', ['class' => 'btn btn-success btn-outline-success waves-effect btn-round btn-block col-md-6']) ?>
            <?= form_input([
            'style' => "display: none;",
            'type' => "file",
            'id' => "import",
            'name' => "import",
			'accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, .csv'
            ]) ?>
		</div>
	</div>
</div>
<?= form_close() ?>