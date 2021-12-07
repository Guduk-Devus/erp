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
            <h1>Authorized User</h1>
          </div>

          <div class="section-body">
            <div class="card">
              <div class="card-header">
                <h4>Daftar Admin dan Senior Pendamping</h4>
                <div class="card-header-action">
                	<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-plus"></i> Tambah</button>
                </div>
              </div>
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
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead class="text-center">
                      <td>#</td>
                      <td></td>
                      <td>Name</td>
                      <td>Email / Username</td>
                      <td>Privileges</td>
                      <td>Action</td>
                    </thead>
                    <tbody>
                      <?php foreach ($user as $i => $e): ?>
                        <tr>
                          <td class="text-center"><?php echo $i+1 ?></td>
                          <td class="text-center">
                          	<img style="width: 30px;" alt="image" src="<?php echo base_url('/assets/img/users/'.$e->img) ?>" class="rounded-circle">
                          </td>
                          <td class="text-center"><?php echo $e->name ?></td>
                          <td class="text-center"><?php echo $e->email ?></td>
                          <td class="text-center"><?php echo $e->group_id == 0 ? "Admin" : "Senior Pendamping" ?></td>
                          <td class="text-center">
                            <div>
                              <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal2" data-id="<?php echo $e->id ?>" data-name="<?php echo $e->name ?>" data-email="<?php echo $e->email ?>" data-group="<?php echo $e->group_id ?>">
                                <i class="fas fa-pencil-alt"></i> Edit
                              </button>
                              <a onclick="return confirm('Apakah anda yakin ingin menghapus user ini ?');" href="<?php echo base_url('/auth/user_edit/'.$e->id) ?>" class="btn btn-danger">
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
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal1">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">New Authorized User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST">
                	<div class="form-group">
                		<label>Name</label>
                		<input type="text" name="name" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label>Username / Email</label>
                		<input type="text" name="email" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label>Password</label>
                		<input type="password" name="password" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label>Group</label>
                		<select class="form-control select2" name="priv" required>
                			<option value="0">Admin</option>
                			<?php foreach ($group as $g): ?>
                				<option value="<?php echo $g->id ?>"><?php echo $g->name ?></option>
                			<?php endforeach ?>
                		</select>
                	</div>
                	<div class="form-group">
                		<button class="btn btn-primary">Save</button>
                	</div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal2">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Authorized User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" id="edit_form">
                	<div class="form-group">
                		<label>Name</label>
                		<input type="text" id="edit_name" name="name" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label>Username / Email</label>
                		<input type="text" id="edit_email" name="email" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label>Password (Kosongi jika tidak ingin merubah)</label>
                		<input type="password" id="edit_password" name="password" class="form-control" >
                	</div>
                	<div class="form-group">
                		<label>Group</label>
                		<select class="form-control select2" id="edit_group" name="priv" required>
                			<option value="0">Admin</option>
                			<?php foreach ($group as $g): ?>
                				<option value="<?php echo $g->id ?>"><?php echo $g->name ?></option>
                			<?php endforeach ?>
                		</select>
                	</div>
                	<div class="form-group">
                		<button class="btn btn-primary">Save</button>
                	</div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $this->load->view('components/footer') ?>
    </div>
  </div>

  <?php $this->load->view('components/script') ?>
  <script type="text/javascript">
    $("table").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [1,5] }
      ]
    });
    $('.btn-warning').on('click', function() {
    	$('#edit_form').attr('action', `<?php echo base_url() ?>/auth/user_edit/`+$(this).attr('data-id'))
    	$('#edit_name').val($(this).attr('data-name'))
    	$('#edit_email').val($(this).attr('data-email'))
    	$('#edit_group').select2('val', $(this).attr('data-group'))
    })
  </script>
</body>
</html>
