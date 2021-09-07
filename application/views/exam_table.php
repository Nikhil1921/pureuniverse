<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="faq-area left-sidebar course-details-area default-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title">
            <div class="">
                  <h2 class="text-center">About Exam</h2>
                <table class="table exam-all">
                  <thead>
                      <tr class="t-heading">
                        <th>AGE GROUP</th>
                        <th>EXAM NAME</th>
                        <th>DURATION</th>
                        <th>Fees</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($exams as $exam): ?>
                      <tr>
                        <td>Age <?= $exam['min_age']; ?>-<?= $exam['max_age']; ?> years</td>
                        <td><?= $exam['cat_name']; ?></td>
                        <td><?= $exam['time_duration']; ?> Minutes</td>
                        <td>₹ <?= $exam['price']; ?></td>
                      </tr>
                      <?php endforeach ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
        <div class="row">
            <div class="col-md-12 faq-content">
                <div class="acd-items acd-arrow">
                  <div class="extb">
                    <ul class="nav nav-tabs exam-schedule-tab" role="tablist">
                      <?php foreach ($exams as $k => $exam): ?>
                      <li class="<?= $k == 0 ? 'active' : '' ?>">
                          <a href="#<?= $exam['min_age'].$exam['max_age'] ?>" role="tab" data-toggle="tab">
                              <?= $exam['cat_name'] ?>
                          </a>
                      </li>
                      <?php endforeach ?>
                    </ul>
                      <div class="tab-content">
                        <?php foreach ($exams as $k => $exam): ?>
                        <div class="tab-pane fade <?= $k == 0 ? 'active in' : '' ?>" id="<?= $exam['min_age'].$exam['max_age'] ?>">
                            <h2 class="text-center "><?= $exam['cat_name'] ?></h2>
                            <h4 class="text-center "><?= $exam['min_age'].' - '.$exam['max_age'] ?> YEARS AGE GROUP</h4>
                            <table class="table exam-all" style="">
                              <tr class="t-heading">
                                <th>Language</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Duration</th>
                              </tr>
                              <?php foreach ($exam['exams'] as $ex): ?>
                              <tr>
                                <td>
                                  <?php  foreach ($ex['langs'] as $lang): ?>
                                    <?= $lang['language'] ?>
                                  <?php endforeach ?>
                                </td>
                                <td>
                                  <?= date('d-m-Y', strtotime($ex['e_date'])) ?>
                                </td>
                                <td><?= date('l', strtotime($ex['e_date'])) ?></td>
                                <td><?= date('h:i A', strtotime($ex['e_time'])) ?></td>
                                <td><?= $exam['time_duration'] ?> Minutes</td>
                              </tr>
                              <?php endforeach ?>
                            </table>
                        </div>
                        <?php endforeach ?>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>