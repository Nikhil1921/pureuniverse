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
						<li>
							<h4>Your friend tells you that he has committed a crime, and because of it he is having sleepless nights, he also tells you that because he trusts he is confessing to you. <br>
							A few days later u read in a newspaper that other person got arrested for your friend's crime... What will you do ? 
							 </h4>
							<div id="countdown"></div>
							<ul>
								<li>
									<div class="option">
										<input type="radio" id="option1-1" name="ans" >
										<label for="option1-1">Go to the police and tell them what you know.</label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans" id="option1-2">
										<label for="option1-2">Encourage your friend to confess to authorities. </label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans" id="option1-3">
										<label for="option1-3">Do nothing because you will not betray a friend's confidence in you.</label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans" id="option1-4">
										<label for="option1-4">You will simply feel sorry for the arrested person. </label>
									</div>
								</li>
							</ul>
						</li>
						<li>
							<h4>You are able to help some people, but only at the cost of harming other group of people. The number of harmed people will be only 10% of the total people getting the help. Is it morally justified to help ?? </h4>
							<ul>
								<li>
									<div class="option">
										<input type="radio" name="ans2" id="option2-1">
										<label for="option2-1">Yes </label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans2" id="option2-2">
										<label for="option2-2">Sometimes</label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans2" id="option2-3">
										<label for="option2-3">No </label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans2" id="option2-4">
										<label for="option2-4">Don't Know </label>
									</div>
								</li>
								
							</ul>
						</li>
						<li>
							<h4>A collection for the charity takes place in your office. For every 5000/- donated a blind person's sight is restored. Instead of donating you give a treat to yourself.....  are you morally responsible for the continued blindness for one person that could have been cured?  </h4>
							<ul>
								<li>
									<div class="option">
										<input type="radio" name="ans3" id="option3-1">
										<label for="option3-1">Yes, I am responsible</label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans3" id="option3-2">
										<label for="option3-2"> I am partly responsible </label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans3" id="option3-3">
										<label for="option3-3">Not responsible </label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans3" id="option3-4">
										<label for="option3-4">Can't Decide </label>
									</div>
								</li>
								
							</ul>
						</li>
						<li>
							<h4>Our Actions/Choices leads to... </h4>
							<ul>
								<li>
									<div class="option">
										<input type="radio" name="ans4" id="option4-1">
										<label for="option4-1"> Virtues 8, Vices </label>
										
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans4" id="option4-2">
										<label for="option4-2"> Destiny</label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans4" id="option4-3">
										<label for="option4-3">Habits </label>
									</div>
								</li>
								<li>
									<div class="option">
										<input type="radio" name="ans4" id="option4-4">
										<label for="option4-4">Other person controlling you</label>
									</div>
								</li>
							</ul>
						</li>
					</ul>
					<div class="text-center">
						<a class="popup-with-form btn btn-dark effect btn-md" href="#sample-form">Submit</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<form id="sample-form" class="mfp-hide white-popup-block-small">
	<div class="col-sm-12">
		<center>
			<?= img('assets/img/pure_uni.png') ?>
		</center>
		<div class="row">
			<div class="col-sm-12 text-danger" id="login-errors">
				<h4>Thanks for attending sample paper!	</h4>
				<p>Hopefully, you got an idea about the nature of questions will going to ask in the examination.</p>
			</div>
		</div>
	</div>
</form>