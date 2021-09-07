<?php defined('BASEPATH') OR exit('No direct script access allowed');
$colors = ['yellow', 'green', 'pink', 'lite-green'] ?>
<div class="col-md-12">
    <div class="row">
        <?php $total = 0; foreach($students as $student): $total += $student['total']; ?>
        <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('student')) ?>'">
            <div class="card bg-c-<?= $colors[array_rand($colors)] ?> update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?= $student['total'] ?></h4>
                            <h6 class="text-white m-b-0"><?= $student['cat_name'] ?></h6>
                        </div>
                        <div class="col-4 text-right"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>
        <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('student')) ?>'">
            <div class="card bg-c-<?= $colors[array_rand($colors)] ?> update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?= $total ? $total : 0 ?></h4>
                            <h6 class="text-white m-b-0">Total Students</h6>
                        </div>
                        <div class="col-4 text-right"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('student')) ?>'">
            <div class="card bg-c-<?= $colors[array_rand($colors)] ?> update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white">₹ <?= $payment ? $payment : 0 ?></h4>
                            <h6 class="text-white m-b-0">Payment Received</h6>
                        </div>
                        <div class="col-4 text-right"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            ₹
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('examTable')) ?>'">
            <div class="card bg-c-<?= $colors[array_rand($colors)] ?> update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?= $exams ? $exams : 0 ?></h4>
                            <h6 class="text-white m-b-0">Exams Table</h6>
                        </div>
                        <div class="col-4 text-right"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <i class="fa fa-table"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('faq')) ?>'">
            <div class="card bg-c-<?= $colors[array_rand($colors)] ?> update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?= $faqs ? $faqs : 0 ?></h4>
                            <h6 class="text-white m-b-0">FAQ</h6>
                        </div>
                        <div class="col-4 text-right"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <i class="fa fa-question-circle-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('career')) ?>'">
            <div class="card bg-c-<?= $colors[array_rand($colors)] ?> update-card">
                <div class="card-block">
                    <div class="row align-items-end">
                        <div class="col-8">
                            <h4 class="text-white"><?= $careers ? $careers : 0 ?></h4>
                            <h6 class="text-white m-b-0">Careers</h6>
                        </div>
                        <div class="col-4 text-right"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>