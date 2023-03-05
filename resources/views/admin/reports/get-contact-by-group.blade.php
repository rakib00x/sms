<div class="card card-congratulation-medal">
    <div class="card-body" >
        <input id="myInput" class="form-control input-lg" type="text" placeholder="Search..">
        <div class="table-responsive">
            <table class="table display data-table text-nowrap new-added-form">
                <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Group</th>
                    <th>Leads</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody id="myTable">
                <?php $i = 1 ;
                foreach ($result as $value) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value->group_name ; ?></td>
                    <td class="mobile"><?php echo $value->mobile; ?></td>
                    <td><a href="{{ URL::to('edit-contact') }}/{{$value->contact_id}}" target="_new" class="btn btn-warning">EDIT</a></td>
                    <td><a href="<?php echo $value->contact_id; ?>" class="btn btn-danger delete">DELETE</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

