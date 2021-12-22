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
            <h1>Data Merchant yang Terdaftar</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon badge-irg">
                  <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>IRG</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $count_merchant['irg'] ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon badge-moopo">
                  <i class="fas fa-crosshairs"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Moopo</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $count_merchant['moopo'] ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon badge-kamsia">
                  <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Kamsia</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $count_merchant['kamsia'] ?>
                  </div>
                </div>
              </div>
            </div>                  
          </div>
          <div class="card">
          	<div class="card-header">
          		<h4>Data Merchant</h4>
          		<div class="card-header-action">
          		</div>
          	</div>
          	<div class="card-body">
          		<div class="table-responsive">
          			<table class="table table-striped text-center">
          				<thead>
          					<td>#</td>
          					<td>Nama Merchant</td>
          					<td>Jenis Merchant</td>
          					<td>Tgl Masuk</td>
          					<td></td>
          				</thead>
          				<tbody>
          					<?php foreach ($merchant as $key => $m): ?>
          						<tr>
          							<td><?php echo $key + 1 ?></td>
          							<td><?php echo $m->merchant_name ?></td>
          							<td>
          								<?php if ($m->merchant_type == 'KAMSIA'): ?>
          									<div class="badge badge-kamsia">KAMSIA</div>
          								<?php elseif($m->merchant_type == 'MOOPO') : ?>
          									<div class="badge badge-moopo">MOOPO</div>
          								<?php else : ?>
          									<div class="badge badge-irg">IRG</div>
          								<?php endif ?>
          							</td>
          							<td><?php echo date_format(date_create($m->created_at), 'd M Y') ?></td>
          							<td>
          								<a href="<?php echo base_url('home/merchant_detail/' . $m->merchant_id . '/' . $m->merchant_type) ?>" class="btn btn-info"><i class="fas fa-info"></i>&nbsp; Detail</a>
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
  </script>
</body>
</html>
