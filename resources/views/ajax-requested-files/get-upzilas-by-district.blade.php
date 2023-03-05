<option value="">Select District</option>
<?php foreach($upazilas as $upazila){ ?>
<option value="<?php echo $upazila->id; ?>"><?php echo $upazila->up_name; ?></option>
<?php } ?>
