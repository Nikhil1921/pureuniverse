<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="quiz default-padding">
	<div class="container">
		<div class="row" id="quiz-question">
			<div class="site-heading text-center">
				<h2>IMVS Preliminary</h2>
			</div>
			<form method="post" id="quiz-form" action="<?= base_url('save-answer') ?>">
				<input type="hidden" value="<?= $p_id ?>" name="p_id" id="p_id" />
				<div class="col-md-8">
					<div class="quiz-detail">
						<div class="question-list">
							<?php foreach ($exam as $j => $quiz):
                            $options = json_decode($quiz['options'])->option;
                            $point = json_decode($quiz['options'])->point;
							if (gettype($quiz['points']) === 'string') continue;
							?>
							<div id="duration" data-duration="<?= $quiz['duration'] ?>">
								<h4>Question Number <?= ++$j ?>.</h4>
								<h5>Question Type : <?= $quiz['exam_type'] ?></h5>
								<p><?= $quiz['question'] ?></p>
								<ul class="option">
                                    <input type="hidden" name="quetion" value="<?= e_id($quiz['id']) ?>">
									<li>
										<input type="radio" name="answer" id="option1" value="<?= $point->A ?>" class="my-radio" />
										<label for="option1"> <?= $options->A ?></label>
									</li>
									<li>
										<input type="radio" name="answer" id="option2" value="<?= $point->B ?>" class="my-radio" />
										<label for="option2"> <?= $options->B ?></label>
									</li>
									<li>
										<input type="radio" name="answer" id="option3" value="<?= $point->C ?>" class="my-radio" />
										<label for="option3"> <?= $options->C ?></label>
									</li>
									<li>
										<input type="radio" name="answer" id="option4" value="<?= $point->D ?>" class="my-radio" />
										<label for="option4"> <?= $options->D ?></label>
									</li>
								</ul>
							</div>
							<?php break; endforeach; ?>
						</div>
					</div>
				</div>
			</form>
			<div class="col-md-4">
				<div class="answers">
					<div class="time" id="time-left"></div>
					<div class="q-pallet">
						<h5>Question Pallete:</h5>
						<?php $ans = 0; $noans = 0; foreach ($exam as $k => $v):
							if (gettype($v['points']) === 'string') {
								$class = $v['points'] > 0 ? 'saved' : 'not-answered';
								$v['points'] > 0 ? $ans++ : $noans++;
							}else{
								$class = 'not-visited';
							}
							?>
						<div class="answers-number">
							<div class="q-number <?= $class ?>"><?= $k + 1 ?></div>
						</div>
						<?php endforeach ?>
					</div>
					<div class="ans-detail">
						<div class="answers-number">
							<div class="q-number saved"><?= $ans ?></div><span>Answered</span>
						</div>
						<div class="answers-number">
							<div class="q-number not-answered"><?= $noans ?></div><span>Not Answered</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>