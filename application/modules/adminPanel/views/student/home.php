<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-md-12">
					<h5>List of <?= ucwords($title) ?></h5>
				</div>
			</div>
		</div>
		<div class="card-header">
			<div class="row">
				<?php $cat_id = $cats[array_key_first($cats)]; foreach($cats as $cat): ?>
				<div class="col-md-4">
					<button class="btn btn-outline-primary btn-round btn-block" onclick="changeStatus('<?= e_id($cat['id']) ?>')"><?= $cat['cat_name'] ?></button>
				</div>
				<?php endforeach ?>
			</div>
		</div>
		<div class="card-block">
			<div class="dt-responsive table-responsive">
				<table class="datatable table table-striped table-bordered nowrap">
					<thead>
						<th class="target">Sr.</th>
						<th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Exam Date</th>
						<th>Exam Category</th>
						<th>Payment</th>
						<th class="target">Hard Copy</th>
						<!-- <th class="target">Action</th> -->
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="status" value="<?= e_id($cat_id['id']) ?>" />