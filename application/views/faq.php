<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="faq-area left-sidebar course-details-area default-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 faq-content">
                <div class="acd-items acd-arrow">
                    <div class="panel-group symb" id="accordion">
                    <?php foreach ($faqs as $k => $faq): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#<?= e_id($faq['id']) ?>">
                                        <?= $faq['question'] ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?= e_id($faq['id']) ?>" class="panel-collapse collapse <?= $k == 0 ? 'in' : '' ?>">
                                <div class="panel-body">
                                    <?= $faq['answer'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>