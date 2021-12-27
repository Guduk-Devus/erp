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
            <h1>Data Kota</h1>
          </div>
		<?php if($admin == TRUE): ?>
		  <div class="card">
				<div class="card-header">
					<h4>PIC Kota</h4>
					<div class="card-header-action">
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center">
							<thead>
								<td>#</td>
								<td>Name</td>
								<td>Email</td>
								<td>City</td>
	<!--          					<td></td>-->
							</thead>
							<tbody>
								<?php foreach ($cityPic as $key => $pic): ?>
									<tr>
										<td><?php echo $key + 1 ?></td>
										<td><?php echo $pic->name ?></td>
										<td><?php echo $pic->email ?></td>
										<td><?php echo $pic->cities ?></td>
	<!--									<td>-->
	<!--          								<a href="--><?php //echo base_url('city/target') ?><!--" class="btn btn-warning"><i class="fas fa-pencil-alt"></i>&nbsp; Set Target</a>-->
	<!--          							</td>-->
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			  </div>
          <div class="card">
          	<div class="card-header">
          		<h4>Target Per Kota</h4>
          		<div class="card-header-action">
          		</div>
          	</div>
          	<div class="card-body">
          		<div class="table-responsive">
          			<table class="table table-striped text-center">
          				<thead>
          					<td>#</td>
          					<td>Name</td>
          					<td>Province</td>
          					<td>Target</td>
          					<td></td>
          				</thead>
          				<tbody>
          					<?php foreach ($city as $key => $s): ?>
          						<tr>
          							<td><?php echo $key + 1 ?></td>
          							<td><?php echo $s->city ?></td>
          							<td><?php echo $s->province ?></td>
          							<td><?php echo $s->target ?></td>
          							<td>
          								<a href="#" class="btn btn-warning btn_set" data-id="<?php echo $s->city_id ?>" data-name="<?php echo $s->city ?>"><i class="fas fa-pencil-alt"></i>&nbsp; Set Target</a>
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
					<h4>Target Per Kota</h4>
					<div class="card-header-action">
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped text-center">
							<thead>
							<td>#</td>
							<td>Name</td>
							<td>Province</td>
							<td>Target</td>
							</thead>
							<tbody>
							<?php foreach ($picCity as $key => $s): ?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><?php echo $s->city ?></td>
									<td><?php echo $s->province ?></td>
									<td><?php echo $s->target ?></td>
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

  <!-- Modal Set Target -->
  <form method="POST" novalidate="">
	  <div class="modal fade" id="targetModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			  <div class="modal-content">
				  <div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLabel">Set City Target</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
					  </button>
				  </div>
				  <div class="modal-body">

					  <div class="form-group">
						  <label for="target" id="name"></label>
						  <input class="form-control" type="number" id="target" onkeypress="return onlyNumber(event)" name="target" maxlength="10">
						  <input type="hidden" id="id" name="id">
					  </div>
				  </div>
				  <div class="modal-footer">
					  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					  <button type="submit" class="btn btn-primary">Set Target</button>
				  </div>
			  </div>
		  </div>
	  </div>
  </form>
  <!-- End Modal Set Target -->


  <?php $this->load->view('components/script') ?>
  <script type="text/javascript">
	  $(document).ready(function () {
		  $(document).on('click', '.btn_set', function () {
			  let id = $(this).data('id');
			  let name = $(this).data('name');

			  // console.log(urlImg);

			  $('#id').val(id);
			  document.getElementById('name').innerHTML = name;

			  $('#targetModal').modal('show');

		  })
	  })

	  function onlyNumber(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		  if (charCode > 31 && (charCode < 48 || charCode > 57))

			  return false;
		  return true;
	  }


	  $("table").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [4] }
      ]
    });
  </script>
</body>
</html>
