<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open_multipart($url."/update/$id") ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Category', 'cat_id') ?>
			<select class="form-control" name="cat_id" id="cat_id">
				<option selected="" disabled="">Select Category</option>
				<?php foreach ($cats as $cat): ?>
				<option value="<?= e_id($cat['id']) ?>" <?= $data['cat_id'] == $cat['id'] ? 'selected' : '' ?>><?= ucwords($cat['cat_name']) ?></option>
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
				<option value="<?= e_id($lang['id']) ?>" <?= $data['lang_id'] == $lang['id'] ? 'selected' : '' ?>><?= ucwords($lang['language']) ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Exam Type', 'exam_type') ?>
			<select class="form-control" name="exam_type" id="exam_type">
				<option selected disabled>Select Exam Type</option>
				<option value="Ethics & moral value" <?= $data['exam_type'] == 'Ethics & moral value' ? 'selected' : '' ?>>Ethics & moral value</option>
				<option value="Courage" <?= $data['exam_type'] == 'Courage' ? 'selected' : '' ?>>Courage</option>
				<option value="Honesty" <?= $data['exam_type'] == 'Honesty' ? 'selected' : '' ?>>Honesty</option>
				<option value="Discipline" <?= $data['exam_type'] == 'Discipline' ? 'selected' : '' ?>>Discipline</option>
				<option value="Self Respect" <?= $data['exam_type'] == 'Self Respect' ? 'selected' : '' ?>>Self Respect</option>
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
				'class' => 'form-control',
				'value' => $data['e_code']
			]) ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Question Duration', 'duration') ?>
			<?= form_input([
				'type' => 'number',
				'name' => 'duration',
				'id' => 'duration',
				'class' => 'form-control',
				'value' => $data['duration']
			]) ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<?= form_label('Question', 'question') ?>
			<?= form_textarea('question', $data['question'], ['id' => 'question', 'class' => 'form-control', 'style' => "height: 80px!important;"]) ?>
		</div>
	</div>
	<?php $op = json_decode($data['options'])->option; $point = json_decode($data['options'])->point; ?>
	<div class="col-md-10">
		<div class="form-group">
			<?= form_label('Option A', 'optiona') ?>
			<?= form_input('option[A]', $op->A, ['id' => 'optiona', 'class' => 'form-control']) ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?= form_label('Option A Point', 'pointa') ?>
			<?= form_input('point[A]', $point->A, ['id' => 'pointa', 'class' => 'form-control']) ?>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<?= form_label('Option B', 'optionb') ?>
			<?= form_input('option[B]', $op->B, ['id' => 'optionb', 'class' => 'form-control']) ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?= form_label('Option B Point', 'pointb') ?>
			<?= form_input('point[B]', $point->B, ['id' => 'pointb', 'class' => 'form-control']) ?>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<?= form_label('Option C', 'optionc') ?>
			<?= form_input('option[C]', $op->C, ['id' => 'optionc', 'class' => 'form-control']) ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?= form_label('Option C Point', 'pointc') ?>
			<?= form_input('point[C]', $point->C, ['id' => 'pointc', 'class' => 'form-control']) ?>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<?= form_label('Option D', 'optiond') ?>
			<?= form_input('option[D]', $op->D, ['id' => 'optiond', 'class' => 'form-control']) ?>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<?= form_label('Option D Point', 'pointd') ?>
			<?= form_input('point[D]', $point->D, ['id' => 'pointd', 'class' => 'form-control']) ?>
		</div>
	</div>
</div>
<?= form_close() ?>