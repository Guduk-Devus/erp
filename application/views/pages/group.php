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
            <h1>Group</h1>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Grup</h4>
                <div class="card-header-action">
                	<button class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead class="text-center">
                      <td>#</td>
                      <td>Name</td>
                      <td>Action</td>
                    </thead>
                    <tbody>
                      <?php foreach ($group as $i => $e): ?>
                        <tr>
                          <td class="text-center"><?php echo $i+1 ?></td>
                          <td class="text-center"><?php echo $e->name ?></td>
                          <td class="text-center">
                            <div>
                              <a href="" class="btn btn-warning">
                                <i class="fas fa-pencil-alt"></i> Edit
                              </a>
                              <a href="" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                              </a>
                            </div>
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
        { "sortable": false, "targets": [2] }
      ]
    });
  </script>
</body>
</html>
