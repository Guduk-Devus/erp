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
            <h1>Form Absensi Baru</h1>
          </div>

          <div class="section-body">
            <div class="card">
            	<div class="card-header"><h4>Form Absensi Baru</h4></div>
            	<div class="card-body">
            		<form method="POST">
            		  <div class="form-group">
            		    <label>Name</label>
            		    <input type="text" name="name" class="form-control" value="<?php echo $event->name ?>" required>
            		  </div>
            		  <div class="form-group">
            		    <label>Batas Pengisian</label>
            		    <input type="text" name="deadline" class="form-control datetimepicker" value="<?php echo $event->closed_at ?>" required>
            		  </div>
            		  <div class="form-group">
            		    <div class="control-label">Kelompok</div>
            		    <label class="custom-switch mt-2">
            		      <input type="checkbox" name="need_kelompok" class="custom-switch-input" 
            		      <?php echo $event->need_group == 1 ? 'checked' : '' ?>>
            		      <span class="custom-switch-indicator"></span>
            		      <span class="custom-switch-description">Form Absensi ini membutuhkan kelompok</span>
            		    </label>
            		  </div>
            		  <div class="form-group">
            		    <div class="control-label">Bukti</div>
            		    <label class="custom-switch mt-2">
            		      <input type="checkbox" name="need_bukti" class="custom-switch-input"
            		      <?php echo $event->need_file == 1 ? 'checked' : '' ?>>
            		      <span class="custom-switch-indicator"></span>
            		      <span class="custom-switch-description">Form absensi ini harus menyertakan bukti</span>
            		    </label>
            		  </div>
            		  <div class="form-group">
            		    <button class="btn btn-primary">Save</button>
            		  </div>
            		</form>
            	</div>
            </div>
          </div>
        </section>
      </div>
      <?php $this->load->view('components/footer') ?>
    </div>
  </div>

  <?php $this->load->view('components/script') ?>
</body>
</html>