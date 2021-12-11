<div class="main-sidebar">
<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="index.html">Sales Management</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">ERP</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="nav-item">
        <a href="<?php echo base_url('/home') ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>

      <?php if ($this->session->userdata('is_admin') == TRUE) : ?>
        <li class="menu-header">Master Data</li>
        <li class="nav-item">
          <a href="<?php echo base_url('/city') ?>" class="nav-link"><i class="fas fa-map-marked-alt"></i> <span>Master Kota</span></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('/home/marketing') ?>" class="nav-link"><i class="fas fa-users"></i> <span>Master Marketing</span></a>
        </li>
      <?php endif ?>

	  <?php if ($this->session->userdata('role') == 'pic') : ?>
		  <li class="menu-header">Master Data</li>
		  <li class="nav-item">
			  <a href="<?php echo base_url('/city') ?>" class="nav-link"><i class="fas fa-map-marked-alt"></i> <span>Master Kota</span></a>
		  </li>
		  <li class="nav-item">
			  <a href="<?php echo base_url('/home/marketing') ?>" class="nav-link"><i class="fas fa-users"></i> <span>Master Marketing</span></a>
		  </li>
	  <?php endif ?>

	  <li class="menu-header">Marketing</li>
        <li class="nav-item">
          <a href="<?php echo base_url('/home/merchant') ?>" class="nav-link"><i class="fas fa-users"></i> <span>Merchant Terdaftar</span></a>
        </li>
    </ul>
</aside>
</div>
