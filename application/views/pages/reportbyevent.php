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
            <h1><?php echo $event->name ?></h1>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Absensi </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead class="text-center">
                      <td>#</td>
                      <td>Name</td>
                      <td>NPM</td>
                      <td>Waktu Absen</td>
                      <td>Status</td>
                      <td>Action</td>
                    </thead>
                    <tbody>
                      <?php foreach ($peserta as $i => $p): ?>
                        <tr>
                          <td class="text-center"><?php echo $i+1 ?></td>
                          <td class="text-center"><a href="<?php echo base_url('/absensi/user/'.$p->npm)  ?>"><?php echo $p->name ?></a></td>
                          <td class="text-center"><?php echo $p->npm ?></td>
                          <td class="text-center"><?php echo $p->created_at ?></td>
                          <td class="text-center">
                            <?php if ($p->created_at < $event->closed_at): ?>
                                <div class="badge badge-success">Tepat Waktu</div>
                            <?php else : ?> 
                                <div class="badge badge-danger">Terlambat</div>
                            <?php endif ?>
                          </td>
                          <td class="text-center">
	                        <a href="<?php echo base_url('/assets/bukti-absensi/'.$p->file) ?>" target="_blank" class="btn btn-primary">
	                            <i class="fas fa-image"></i> Lihat Bukti
	                        </a>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
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
        { "sortable": false, "targets": [4] }
      ]
    });
  </script>
</body>
</html>
