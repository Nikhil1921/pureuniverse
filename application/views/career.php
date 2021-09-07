<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="edit-profile adviros-details-area default-padding">
    <div class="container about-area">
        <div class="row about-info">
            <div class="col-md-6 info">
                <h2>Together at Pure Universe</h2>
                <p>  No Global movement springs from individuals. it take an entire team united behind something big.</p>
                <p>Together, we work hard, we laugh a lot , we Brainstrom nonstop, we us hundred of post -its a week and we give the best high fives in town</p>
            </div>
            <div class="col-md-6 update-info">
                <h4>Your Personal Information</h4>
                <div class="row">
                    <form action="<?= base_url('career') ?>" method="POST" id="career-form" enctype= multipart/form-data>
                        <div class="col-md-12 text-danger" id="career-errors"></div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Your Name:</label>
                                        <input class="form-control" placeholder="Enter Name*" name="name" type="text" required="" value="<?= $user['name'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Your Email:</label>
                                        <input class="form-control" placeholder="Email" type="email" name="email" required="" value="<?= $user['email'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Your Phone:</label>
                                        <input class="form-control" placeholder="Phone" name="mobile" type="text" value="<?= $user['mobile'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Expected Salary:</label>
                                        <input class="form-control" id="sal" name="salary" placeholder="Expected Salary" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label >Gender:</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="gender-rd">Male
                                                <input type="radio" checked="checked" value="Male" name="gender">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label class="gender-rd">Famale
                                                <input type="radio" name="gender" value="Female" >
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Upload Your Resume:</label>
                                        <br>
                                        <label for="image" class="btn btn-primary">Select File</label>
                                        <input type="file" placeholder="Upload Resume" name="image" id="image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit">
                            Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>