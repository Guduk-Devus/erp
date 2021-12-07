<?php $this->load->view('components/head'); ?>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="login-brand">
              <img src="<?php echo base_url('/assets/img/gradasi.jpg') ?>" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4><?php echo $event->name ?></h4></div>

              <div class="card-body">

                <?php if ($this->session->flashdata('success')): ?>
                  <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>×</span>
                      </button>
                      <?php echo $this->session->flashdata('success') ?>
                    </div>
                  </div>
                <?php endif ?>
                <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Name</label>
                    <input id="email" type="text" class="form-control" name="name" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your name
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">NPM</label>
                    </div>
                    <input id="password" type="text" class="form-control" name="npm" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your npm
                    </div>
                  </div>
                  <?php if ($event->need_group): ?>
                    <div class="form-group">
                      <label for="email">Kelompok</label>
                      <?php $i = 0 ?>
                        <div class="row">
                          <?php foreach ($group as $g): ?>
                            <?php if ($i == 0): ?>
                               <div class="col-md-4">
                            <?php endif ?>
                            <?php if($i == 10): ?>
                                </div>
                                <div class="col-md-6">
                            <?php endif ?>
                            <div class="form-check">
                              <input class="form-check-input" name="group" type="radio" value="<?php echo $g->id ?>" id="defaultCheck<?php echo $g->id ?>" required>
                              <label class="form-check-label" for="defaultCheck<?php echo $g->id ?>">
                                <?php echo $g->name ?>
                              </label>
                            </div>
                            <?php $i++ ?>
                          <?php endforeach ?>
                          </div>
                        </div>
                      <div class="invalid-feedback">
                        Please fill in your group
                      </div>
                    </div>
                  <?php endif ?>
                  <?php if ($event->need_file): ?>
                    <div class="form-group">
                      <div class="d-block">
                        <label for="evidence" class="control-label">Bukti</label>
                      </div>
                      <input id="evidence" type="file" class="form-control-file" name="evidence" tabindex="2" required>
                      <div class="invalid-feedback">
                        please fill in your image
                      </div>
                    </div>
                  <?php endif ?>
                  <?php if ($event->need_special != null): ?>
                    <div class="form-group">
                      <div class="d-block">
                        <label for="password" class="control-label">NPM</label>
                      </div>
                      <textarea class="form-control" name="special" required></textarea>
                      <div class="invalid-feedback">
                        please fill in your npm
                      </div>
                    </div>
                  <?php endif ?>
                  <div class="form-group">
                    <?php  if (!$this->session->flashdata('success')): ?>
                      <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Absen Sekarang !
                      </button>
                    <?php else : ?>
                      <div class="text-danger">Anda Sudah Absen</div>
                    <?php endif ?>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Edisi 2021
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('components/script') ?>
</body>
</html>
