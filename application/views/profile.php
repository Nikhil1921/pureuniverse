<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="students-profiel adviros-details-area default-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12 info main-content">
				<div class="tab-info">
					<ul class="nav nav-pills">
						<li class="active">
							<a data-toggle="tab" href="#tab1" aria-expanded="true">
								Current Exam
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab2" aria-expanded="false">
								Upcoming Exam
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab3" aria-expanded="false">
								History
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#tab4" aria-expanded="false">
								Edit Profile
							</a>
						</li>
					</ul>
					<div class="tab-content tab-content-info">
						<div id="tab1" class="tab-pane fade active in">
							<div class="info title">
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>Exam Category</th>
												<th>Exam Language</th>
												<th>Exam Date / Time</th>
												<th>Access</th>
											</tr>
										</thead>
										<tbody>
										<?php if ($current): ?>
										<?php foreach ($current as $k => $v): $date = $v['e_date'].' '.$v['e_time'] ?>
											<tr>
												<td><?= ++$k ?>.</td>
												<td><?= $v['cat_name']; ?></td>
												<td><?= $v['language']; ?></td>
												<td><?= date('d-m-Y', strtotime($v['e_date'])).' - '.date('h:i A', strtotime($v['e_time'])) ?></td>
												<td>
													<?php 
														$t2 = time();
														$t1 = strtotime( $date );
														$hours = round(($t1 - $t2) / (60 * 60));
														$minutes = round(($t1 - $t2) / (60));
														if ($hours >= 72): 
													?>
														<a class="popup-with-form" href="#reschedule-form" onclick="getRescheduleList('<?= e_id($v['id']) ?>', '<?= e_id($v['lang_id']) ?>', '<?= e_id($v['exam_id']) ?>')">Reschedule</a>
													<?php endif ?>
													<?php if ($minutes <= 0): ?>
														<a href="<?= base_url('quiz/'.e_id($v['id'])) ?>">Start Test</a>
													<?php endif ?>
												</td>
											</tr>
										<?php endforeach ?>
										<?php else: ?>
											<tr>
												<td class="text-center" colspan="5"><h5>No exams available.</h5></td>
											</tr>
										<?php endif ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="tab2" class="tab-pane fade">
							<div class="info title">
								<div class="table-responsive">
									<table class="table table-striped">
										<caption class="text-right">
											<a class="popup-with-form btn btn-info" href="#pay-form">Schedule Test</a>
										</caption>
										<thead>
											<tr>
												<th>NO</th>
												<th>Exam Category</th>
												<th>Exam Language</th>
												<th>Exam Date / Time</th>
											</tr>
										</thead>
										<tbody>
										<?php if ($upcomming): ?>
										<?php foreach ($upcomming as $k => $v): ?>
											<tr>
												<td><?= ++$k ?>.</td>
												<td><?= $v['cat_name']; ?></td>
												<td><?php $last = array_key_last($v['langs']); array_walk($v['langs'], function($langs, $la, $l){ 
														echo $langs['language'].($l != $la ? ', ' : '');
													}, $last) ?></td>
												<td><?= date('d-m-Y', strtotime($v['e_date'])).' - '.date('h:i A', strtotime($v['e_time'])) ?></td>
											</tr>
										<?php endforeach ?>
										<?php else: ?>
											<tr>
												<td class="text-center" colspan="4"><h5>No exams available.</h5></td>
											</tr>
										<?php endif ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="tab3" class="tab-pane fade">
							<div class="info title">
								<div class="table-responsive">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>NO</th>
												<th>Exam Category</th>
												<th>Exam Language</th>
												<th>Exam Date</th>
												<th>Result</th>
											</tr>
										</thead>
										<tbody>
										<?php if ($history): ?>
										<?php foreach ($history as $k => $v): ?>
											<tr>
												<td><?= ++$k ?>.</td>
												<td><?= $v['cat_name']; ?></td>
												<td><?= $v['language']; ?></td>
												<td><?= date('d-m-Y', strtotime($v['e_date'])).' - '.date('h:i A', strtotime($v['e_time'])) ?></td>
												<td><a href="<?= base_url('quiz-details/'.e_id($v['id'])) ?>">Result</a></td>
											</tr>
										<?php endforeach ?>
										<?php else: ?>
											<tr>
												<td class="text-center" colspan="5"><h5>No exams available.</h5></td>
											</tr>
										<?php endif ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="tab4" class="tab-pane">
							<div class="info title">
								<div class="row">
									<form method="post" id="profile-form" action="<?= base_url('update-profile') ?>">
										<div class="col-md-12 text-danger" id="profile-errors"></div>
										<div class="col-md-6">
											<div class="form-group">
												<input class="form-control" value="<?= $this->user['name'] ?>" placeholder="Name*" name="name" type="text" required="" maxlength="50">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input class="form-control" value="<?= $this->user['mobile'] ?>" placeholder="Phone" name="mobile" type="text" maxlength="10">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input class="form-control" value="<?= $this->user['email'] ?>" placeholder="Email" name="email" type="email" maxlength="100">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input class="form-control" placeholder="Password*" type="password" name="password">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group comments">
												<textarea class="form-control" placeholder="Address*" maxlength="255" name="address"><?= $this->user['address'] ?></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<button type="submit">
												Update
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<form method="post" id="reschedule-form" action="<?= base_url('reschedule') ?>" class="mfp-hide white-popup-block-small">
	<div class="col-sm-12">
		<center>
			<?= img('assets/img/pure_uni.png') ?>
			<h4>Reschedule Exam</h4>
		</center>
		<input type="hidden" name="pay_id" id="pay_id" />
		<div class="row">
			<div class="col-sm-12 text-danger" id="reschedule-errors"></div>
			<div class="col-md-12">
				<div class="form-group">
					<select class="form-control" name="exam_id" id="exam_id">
						
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<button type="submit">
					Reschedule
				</button>
			</div>
		</div>
	</div>
</form>
<form method="post" id="pay-form" action="<?= base_url('pay-test') ?>" class="mfp-hide white-popup-block-small">
	<div class="col-sm-12">
		<center>
			<?= img('assets/img/pure_uni.png') ?>
			<h4>Schedule Exam</h4>
		</center>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Select Exam Paper Date</label>
					<select class="form-control" name="exam_id" data-dependent="exam_langs" onchange="getLang(this)">
						<option selected disabled>Select Exam Paper Date</option>
						<?php foreach ($upcomming as $v): ?>
							<option value="<?= e_id($v['id']) ?>">
								<?= date('d-m-Y', strtotime($v['e_date'])).' - '.date('h:i A', strtotime($v['e_time'])) ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Select Exam Language</label>
					<select class="form-control" name="exam_langs" id="exam_langs" readonly="">
						<option disabled selected>Select Exam Language</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="copy_profile">
						<input type="checkbox" name="extra" id="copy_profile">Want a copy of Physical Certificate? (60/-Rs. Charge of Courier)</label>
				</div>
			</div>
			<div class="col-md-12">
				<button type="submit">
					Schedule
				</button>
			</div>
		</div>
	</div>
</form>