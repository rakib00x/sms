<option value="">Select District</option>
<?php foreach($districts as $district){ ?>
<option value="<?php echo $district->id; ?>"><?php echo $district->ds_name ; ?></option>
<?php } ?>
