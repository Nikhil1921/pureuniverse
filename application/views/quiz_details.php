<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="quiz default-padding">
	<div class="container">
		<div class="row">
			<div class="site-heading text-center">
				<h2>Nature of Questions to be asked at imvs Examination</h2>
			</div>
			<div class="example col-md-12">
				<form class="form">
					<ul>
                        <?php $total = 0; 
                        foreach($exam as $k => $quiz): 
                        $total += $quiz['points'];
                        $op = json_decode($quiz['options'])->option;
                        $po = json_decode($quiz['options'])->point ?>
                        <li>
                            <h4><?= $k+1 . '. ' . $quiz['question'] ?></h4>
                            <div id="countdown"></div>
                            <ul>
                                <li>
                                    <label>Points <?= $quiz['points'] ?></label>
                                </li>
                                <li>
                                    <label class="<?= $po->A == $quiz['points'] ? 'text-danger' : '' ?>">A. <?= $op->A ?></label>
                                </li>
                                <li>
                                    <label class="<?= $po->B == $quiz['points'] ? 'text-danger' : '' ?>">B. <?= $op->B ?></label>
                                </li>
                                <li>
                                    <label class="<?= $po->C == $quiz['points'] ? 'text-danger' : '' ?>">C. <?= $op->C ?></label>
                                </li>
                                <li>
                                    <label class="<?= $po->D == $quiz['points'] ? 'text-danger' : '' ?>">D. <?= $op->D ?></label>
                                </li>
                            </ul>
                        </li>
                        <?php endforeach ?>
                        <li>
                            <br>
                            <h3>Total Points : <?= $total ?></h3>
                        </li>
                    </ul>
				</form>
			</div>
		</div>
	</div>
</div>