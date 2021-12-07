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
          <div class="card">
          	<div class="card-header">
          		<h4>Data Marketing</h4>
          		<div class="card-header-action">
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
          					<td>Refferal Code</td>
          					<td></td>
          				</thead>
          				<tbody>
          					<?php foreach ($salesmen as $key => $s): ?>
          						<tr>
          							<td><?php echo $key + 1 ?></td>
          							<td><?php echo $s->name ?></td>
          							<td><?php echo $s->email ?></td>
          							<td><?php echo $s->no_telp ?></td>
          							<td><?php echo $s->code_referral ?></td>
          							<td>
          								<a href="<?php echo base_url('home/detail_marketing') ?>" class="btn btn-info"><i class="fas fa-info"></i>&nbsp; Detail</a>
          								<a href="<?php echo base_url('home/delete_marketing') ?>" class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp; Delete</a>
          							</td>
          						</tr>
          					<?php endforeach ?>
          				</tbody>
          			</table>
          		</div>
          	</div>
          </div>
        </section>
      </div>
      <?php $this->load->view('components/footer') ?>
    </div>
  </div>

  <?php $this->load->view('components/script') ?>
  <script type="text/javascript">
  	$("table").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [5] }
      ]
    });
  </script>
</body>
</html>
