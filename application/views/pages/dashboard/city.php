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
          								<a href="<?php echo base_url('city/target') ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i>&nbsp; Set Target</a>
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
<!--							<td></td>-->
							</thead>
							<tbody>
							<?php foreach ($picCity as $key => $s): ?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><?php echo $s->city ?></td>
									<td><?php echo $s->province ?></td>
									<td><?php echo $s->target ?></td>
<!--									<td>-->
<!--										<a href="--><?php //echo base_url('city/target') ?><!--" class="btn btn-warning"><i class="fas fa-pencil-alt"></i>&nbsp; Set Target</a>-->
<!--									</td>-->
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

  <?php $this->load->view('components/script') ?>
  <script type="text/javascript">
  	$("table").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [4] }
      ]
    });
  </script>
</body>
</html>
