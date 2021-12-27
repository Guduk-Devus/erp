<?php $this->load->view('components/head') ?>
<body>
  <div id="app">
    <div class="main-wrapper">
      <?php $this->load->view('components/navbar') ?>
      <?php $this->load->view('components/sidebar') ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Marketing</h1>
          </div>
		<?php if($admin == TRUE): ?>
          <div class="card">
          	<div class="card-header">
          		<h4>Data Marketing</h4>
          		<div class="card-header-action">
          			<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#picModal"><i class="fas fa-user-cog"></i> Atur PIC</a>
<!--          			<a href="--><?php //echo base_url('home/store_marketing') ?><!--" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Tambah Marketing</a>-->
          		</div>
          	</div>
			  <div class="card-body">
				  <div class="table-responsive">
					  <table class="table table-striped text-center">
						  <thead>
						  <td>#</td>
						  <td>Name</td>
						  <td>Email</td>
						  <td>No Telp</td>
						  <td>Kota</td>
<!--						  <td>Refferal Code</td>-->
						  <td></td>
						  </thead>
						  <tbody>
						  <?php foreach ($salesmen as $key => $s): ?>
							  <tr>
								  <td><?php echo $key + 1 ?></td>
								  <td><?php echo $s->user_name ?></td>
								  <td><?php echo $s->email ?></td>
								  <td><?php echo $s->no_telp ?></td>
								  <td><?php echo $s->name ?></td>
<!--								  <td>--><?php //echo $s->code_referral ?><!--</td>-->
								  <td>
									  <a href="<?php echo base_url('home/detail_marketing') ?>" class="btn btn-info"><i class="fas fa-info"></i>&nbsp; Detail</a>
									  <!--										--><?php //if($s->city_id != 0): ?>
									  <!--          									<a href="--><?php //echo base_url('city/cityPic/' . $s->id) ?><!--" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Set City PIC</a>-->
									  <!--										--><?php //else: ?>
									  <!--											<a href="#" class="btn btn-secondary" aria-disabled="true"><i class="fas fa-plus"></i>&nbsp; Set City PIC</a>-->
									  <!--										--><?php //endif ?>
									  <a href="<?php echo base_url('home/delete_marketing') ?>" class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp; Delete</a>
								  </td>
							  </tr>
						  <?php endforeach ?>
						  </tbody>
					  </table>
				  </div>
			  </div>
          </div>
		<?php else: ?>
          <div class="card">
          	<div class="card-header">
          		<h4>Data Marketing</h4>
          		<div class="card-header-action">
          			<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#picModal"><i class="fas fa-user-cog"></i> Atur PIC</a>
          			<a href="<?php echo base_url('home/store_marketing') ?>" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Tambah Marketing</a>
          		</div>
          	</div>
          	<div class="card-body">
          		<div class="table-responsive">
          			<table class="table table-striped text-center">
          				<thead>
          					<td>#</td>
          					<td>Name</td>
          					<td>Email</td>
          					<td>No Telp</td>
							<td>Kota</td>
          					<td>Refferal Code</td>
          					<td></td>
          				</thead>
          				<tbody>
          					<?php foreach ($marketing as $key => $s): ?>
          						<tr>
          							<td><?php echo $key + 1 ?></td>
          							<td><?php echo $s->user_name ?></td>
          							<td><?php echo $s->email ?></td>
          							<td><?php echo $s->no_telp ?></td>
          							<td><?php echo $s->name ?></td>
          							<td><?php echo $s->code_referral ?></td>
          							<td>
          								<a href="<?php echo base_url('home/detail_marketing') ?>" class="btn btn-info"><i class="fas fa-info"></i>&nbsp; Detail</a>
<!--										--><?php //if($s->city_id != 0): ?>
<!--          									<a href="--><?php //echo base_url('city/cityPic/' . $s->id) ?><!--" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp; Set City PIC</a>-->
<!--										--><?php //else: ?>
<!--											<a href="#" class="btn btn-secondary" aria-disabled="true"><i class="fas fa-plus"></i>&nbsp; Set City PIC</a>-->
<!--										--><?php //endif ?>
          								<a href="<?php echo base_url('home/delete_marketing') ?>" class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp; Delete</a>
          							</td>
          						</tr>
          					<?php endforeach ?>
          				</tbody>
          			</table>
          		</div>
          	</div>
          </div>
		<?php endif ?>
        </section>
      </div>
      <?php $this->load->view('components/footer') ?>
    </div>
  </div>

  <!-- Modal Set PIC -->
  <form method="POST" novalidate="">
	  <div class="modal fade" id="picModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			  <div class="modal-content">
				  <div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Set PIC</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
					  </button>
				  </div>
				  <div class="modal-body">

					  <div class="form-group">
						  <label>Marketing</label>
						  <select class="custom-select custom-select-sm" name="user_id" id="statusFilter">
							  <option value="" selected>- Pick Marketing -</option>
							  <?php foreach ($salesmen as $key => $s): ?>
							  	<option value="<?php echo $s->user_id ?>"><?php echo $s->user_name ?></option>
							  <?php endforeach ?>
						  </select>
					  </div>

					  <div class="form-group">
						  <label>Role</label>
						  <select class="custom-select custom-select-sm" name="role" id="role">
							  <option value="" selected>- Pick Role -</option>
							  <?php if ($role == null && $admin == '1'): ?>
							  	<option value="pic_pusat">PIC Pusat</option>
							  <?php endif ?>
							  <option value="pic_kota">PIC Kota</option>
						  </select>
					  </div>

					  <div class="form-group" id="city_form">
						  <label>City</label>
						  <select class="custom-select custom-select-sm select2" name="city_id" id="city_filter">
							  <option value="" selected>- Pick City -</option>
							  <?php foreach ($city as $key => $c): ?>
								  <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
							  <?php endforeach ?>
						  </select>
					  </div>

				  </div>
				  <div class="modal-footer">
					  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					  <button type="submit" class="btn btn-primary">Set PIC</button>
				  </div>
			  </div>
		  </div>
	  </div>
  </form>
  <!-- End Modal Set PIC -->


  <?php $this->load->view('components/script') ?>
  <script type="text/javascript">
  	$("table").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [5] }
      ]
    });

	// $(document).ready(function () {
		$('#role').change(function() {
			if($('#role').val() == 'pic_pusat') {
				$('#city_form').remove();
			} else {
				$('#city_form').show();
			}
		})
	// })
  </script>
</body>
</html>
