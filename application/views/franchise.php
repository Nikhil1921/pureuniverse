<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="edit-profile adviros-details-area default-padding">

    <div class="container">

        <div class="row">

            <div class="col-md-12 update-info">

                <h4>Get Franchise </h4>

                <div class="row">

                    <form action="<?= base_url('franchise') ?>" id="franchise-form" class="contact-form">

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your Name:</label>

                                        <input class="form-control" maxlength="50" placeholder="Enter Name*" name="name" type="text" required="">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your Email:</label>

                                        <input class="form-control" maxlength="100" placeholder="Email" type="email" name="email" required="">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your Phone:</label>

                                        <input class="form-control" name="mobile" placeholder="Phone" type="text" maxlength="10">

                                    </div>

                                </div>

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

                                            <input type="radio" value="Famale" name="gender">

                                            <span class="checkmark"></span>

                                            </label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your city:</label>

                                        <input class="form-control" maxlength="50" placeholder="Your City" name="city" type="text">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your Pincode:</label>

                                        <input class="form-control" placeholder="Your Pincode" name="pincode" type="text" maxlength="6">

                                    </div>

                                </div>

                                

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your Taluka:</label>

                                        <input class="form-control" maxlength="50" placeholder="Your Taluka" name="taluka" type="text">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your District:</label>

                                        <input class="form-control" maxlength="50" placeholder="Your District" name="district" type="text">

                                    </div>

                                </div> 

                            </div>

                        </div>

                        <div class="col-md-12">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Your State:</label>

                                        <input class="form-control" maxlength="50" placeholder="Your State" name="state" type="text">

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label >Location for Franchise:</label>

                                        <input class="form-control" maxlength="255" placeholder="Location for Franchise" name="location" type="text">

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