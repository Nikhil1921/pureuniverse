<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?= form_open_multipart($url."/update/$id") ?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Category Name', 'cat_name') ?>
			<?= form_input('cat_name', $data['cat_name'], 'class="form-control" id="cat_name" required="true" maxLength="50"') ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Age Limit') ?>
			<div class="row">
				<div class="col-md-6">
					<select name="age[min]" id="min_age" class="form-control">
						<option selected readonly value="">Select Min Age</option>
						<?php
							for ($i=0; $i < 100; $i++) { 
								echo '<option value="'.$i.'" '.($data['min_age'] == $i ? 'selected' : '').' >'.$i.'</option>';
							}
						?>
					</select>
				</div>
				<div class="col-md-6">
					<select name="age[max]" id="max_age" class="form-control">
						<option selected readonly value="">Select Max Age</option>
						<?php
							for ($i=0; $i < 100; $i++) { 
								echo '<option value="'.$i.'" '.($data['max_age'] == $i ? 'selected' : '').'>'.$i.'</option>';
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Time Duration', 'time') ?>
			<?= form_input([
				'type' => 'number',
				'name' => 'time',
				'id' => 'time',
				'class' => "form-control",
				'value' => $data['time_duration']
			]) ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<?= form_label('Price', 'price') ?>
			<?= form_input([
				'type' => 'number',
				'name' => 'price',
				'id' => 'price',
				'class' => "form-control",
				'value' => $data['price']
			]) ?>
		</div>
	</div>
</div>
<?= form_close() ?>