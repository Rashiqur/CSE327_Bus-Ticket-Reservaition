<?php
include('db_connect.php');
if(isset($_GET['id']) && !empty($_GET['id']) ){
	$qry = $conn->query("SELECT * FROM location where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $val){
		$meta[$k] =  $val;
	}
}
?>
<div class="container-fluid">
	<form id="manage_location">
		<div class="col-md-12">
			<div class="form-group mb-2">
				<label for="Starting_from" class="control-label"> Starting </label>
				<input type="hidden" class="form-control" id="id" name="id" value='<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>' required="">
				<input type="text" class="form-control" id="Starting_from" name="Starting_from" required="" value="<?php echo isset($meta['Starting_from']) ? $meta['Starting_from'] : '' ?>">
			</div>
			<div class="form-group mb-2">
				<label for="Destination" class="control-label">Destination</label>
				<input type="text" class="form-control" id="Destination" name="Destination" required="" value="<?php echo isset($meta['Destination']) ? $meta['Destination'] : '' ?>">
			</div>
			<div class="form-group mb-2">
				<label for="seats" class="control-label">Available seats</label>
				<input type="text" class="form-control" id="seats" name="seats" required="" value="<?php echo isset($meta['seats']) ? $meta['seats'] : '' ?>">
			</div>
		</div>
	</form>
</div>
<script>
	$('#manage_location').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'./save_location.php',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
    			end_load()
    			alert_toast('An error occured','danger');
			},
			success:function(resp){
				if(resp == 1){
    				end_load()
    				$('.modal').modal('hide')
    				alert_toast('Data successfully saved','success');
    				load_location()
				}
			}
		})
	})
</script>