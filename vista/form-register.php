<div class="col-md-12" id="d_form_register">
	
	<div class="col-md-12">
		To enter Richmond you must create your profile by entering the following data:
	</div>
	
	<form onsubmit="return false" id="f-register">
		<div class="col-md-6">
			<div class="form-group">
				<label>Names</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Names" form-data="form" />
			</div>
			<div class="form-group">
				<label>Lastname</label>
				<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Lastname" form-data="form" />
			</div>
			<div class="form-group col-md-6">
				<label>Id</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-type_id"></span>
					<select class="form-control" id="type_id" name="type_id">
					</select>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label>Number</label>
				<input type="text" class="form-control" id="identity_card" onpaste="return false" name="identy_card" placeholder="" form-data="form" />
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" id="email_register" onpaste="return false" name="email_register" placeholder="email"  />
			</div>
			<div class="form-group">
				<label>Confirm Email</label>
				<input type="email" class="form-control" id="email_confirm" onpaste="return false" name="email_register" placeholder="email"  />
			</div>
			<div class="form-group">
				<label>Mobile Phone</label>
				<input type="text" class="form-control" id="mobile_phone" name="mobile_phone" onpaste="return false" placeholder="Mobile Phone" form-data="form" />
			</div>
			<div class="form-group">
				<label>Type of user</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-profile"></span>
					<select class="form-control" id="profile" name="profile">
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Birth date</label>
				<input type="text" class="form-control" id="birth_date" name="birth_date" onpaste="return false" placeholder="Birth date" form-data="form" />
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" id="password_register" onpaste="return false" name="password_register" placeholder="Password"  />
			</div>
			<div class="form-group">
				<label>Verify password</label>
				<input type="password" class="form-control" id="verify_password" onpaste="return false" name="verify_password" placeholder="Repeat password"  />
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">
				<label>Country</label>
				<input class="form-control" id="country" name="country" type="text" placeholder="Colombia" value="Colombia" disabled  />
			</div>
			<div class="form-group">
				<label id="lb-department">Department</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-department"></span>
					<select class="form-control" id="department" name="department"  >
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>City</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-city"></span>
					<select class="form-control" id="city" name="city" disabled  >
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>School</label>
				<div class="input-group">
					<span class="input-group-addon sp" id="sp-school"></span>
					<select class="form-control" id="school" name="school" disabled  >
					</select>
				</div>
			</div>
			<div class="form-group col-md-12" align="left" style="padding: 0px;">
				<div class="col-md-8" align="left" style="padding: 0px;">
					<label>Enter PIN</label>
					<input type="text" class="form-control" id="pin_register" name="pin_register" placeholder="Enter your pin" form-data="form" />
				</div>
				<div class="col-md-4" align="right" style="padding: 0px;">
					<button type="button" id="verify_pin" class="btn" onclick="javascript: get_data_pin('controllers/consult_pin.php', {pin: $('#pin_register').val()});" >Verify PIN</button>
				</div>
			</div>
			<div class="form-group">
				<label>Status PIN</label>
				<input type="text" class="form-control" id="status_pin" name="status_pin" placeholder="Status PIN is:" disabled  />
			</div>
			<div class="form-group">
				<label>Serie</label>
				<input type="text" class="form-control" id="serie_register" name="serie_register" placeholder="Your serie is:" disabled  />
			</div>
			<div class="form-group">
				<label>Book</label>
				<input type="text" class="form-control" id="book" name="book" placeholder="Your book is:" disabled  />
			</div>
			
			<div class="checkbox">
				<label>
					<input type="checkbox" id="terms"  />
					I accept terms and conditions
				</label>
			</div>
		</div>
		<div class="col-md-12" align="center">
			<button type="submit" class="btn btn-primary" onclick="javascript: submit_form_register()">Register</button>
		</div>
	</form>
	<div class="col-md-12" id="errors">
		
	</div>
</div>
<script>
	$(document).ready(function()
	{
		$('#birth_date').datepicker({
			format: "yyyy-mm-dd",
			startView: 2,
			todayBtn: true,
			clearBtn: true,
			language: "es",
			multidate: false,
			autoclose: true
		});
	});
</script>