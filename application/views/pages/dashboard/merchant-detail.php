<?php $this->load->view('components/head') ?>
<body>
<style>
	.card-menu {
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}

	.item-submit {
		background: none;
		color: inherit;
		border: none;
		padding: 0;
		font: inherit;
		cursor: pointer;
		outline: inherit;
	}
</style>
  <div id="app">
    <div class="main-wrapper">
      <?php $this->load->view('components/navbar') ?>
      <?php $this->load->view('components/sidebar') ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Penjualan Merchant</h1>
          </div>
          <div class="card">
          	<div class="card-header">
          		<h4>Data Penjualan</h4>
          		<div class="card-header-action">
          		</div>
          	</div>
          	<div class="card-body row">
				<div class="col-md-4">
					<div class="card card-menu">
						<div class="card-header">
							<h4>Barang</h4>
						</div>
						<div class="card-body">
							<ul class="list-unstyled list-unstyled-border">
								<?php foreach ($items as $item):  ?>

								<li class="media">
									<form action="" method="post" class="item-form col-md-12">
										<input type="hidden" name="id" value="<?php echo $item->id ?>">
										<input type="hidden" name="item_price" value="<?php echo $item->price ?>">
										<input type="hidden" name="merchant_id" value="
											<?php if ($merchant_type == 'MOOPO'): ?>
												<?php echo $item->merchant_id ?>
											<?php elseif ($merchant_type == 'KAMSIA'): ?>
												<?php echo $item->restaurants_id ?>
											<?php else : ?>
												<?php echo $item->restaurants_id ?>
											<?php endif; ?>
										">
										<input type="hidden" name="merchant" value="<?php echo $merchant_type ?>">
											<div class="activity-icon bg-primary text-white shadow-primary"></div>
											<div class="media-body">
												<div class="float-right text-primary"><?php echo  "Rp " . number_format($item->price,2,',','.'); ?></div>
												<div class="media-title"><?php echo $item->name ?></div>
												<span class="text-small text-muted">
												<?php if ($merchant_type == 'MOOPO'): ?>
													<?php echo $item->description ?>
												<?php elseif ($merchant_type == 'KAMSIA'): ?>
													<?php echo $item->desc ?>
												<?php else : ?>
													<?php echo $item->desc ?>
												<?php endif; ?>
												</span>
												<button type="submit" class="float-right text-primary item-submit"> Cek Sekarang</button>
											</div>
									</form>
								</li>
								<?php endforeach ?>

								<?php
								$total_sellings = 0;
								foreach ($transactions as $transaction):
									$total_sellings = $transaction->total_sale;
									$selling = $transaction->selling;
									$price = $item_price;
									$total = $item_price * $transaction->selling;
//									$subtotal = $total + $transaction->ongkir;

								endforeach
								?>

								<li class="media">
									<form action="" method="post" class="item-form col-md-12">
										<div class="activity-icon bg-primary text-white shadow-primary"></div>
										<div class="media-body">
											<div class="float-right text-primary"><?php echo $total_sellings ?></div>
											<div class="media-title">Total Penjualan</div>
										</div>
									</form>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card card-menu card-statistic-2">
						<?php
							$months = array();
							$numbMonth = array();
							$currentMonth = (int)date('m');
							$currentDateMonth = date('F');

							for ($x = $currentMonth; $x < $currentMonth + 12; $x++) {
								$months[] = date('F', mktime(0, 0, 0, $x, 1));
								$numbMonth[] = date('m', mktime(0, 0, 0, $x, 1));

								$combine = array_combine($months, $numbMonth);
							}

//							echo print_r($combine);

							if (!empty(@$transactions)):
						?>
							<div class="card-stats">
								<div class="card-stats-title">Statistik Penjualan -
									<div class="dropdown d-inline">
										<a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month" aria-expanded="false"><?php echo $currentDateMonth; ?></a>
										<ul class="dropdown-menu dropdown-menu-sm" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 18px, 0px); top: 0px; left: 0px; will-change: transform;">
											<li class="dropdown-title">Select Month</li>
											<?php foreach ($combine as $key => $month) : ?>
												<li>
<!--													<input type="hidden" name="month" value="--><?php //echo $month; ?><!--">-->
													<a href="#" data-month="<?php echo $month; ?>" class="dropdown-item btn-month"><?php echo $key; ?></a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
								<div class="card-stats-items">
										<div class="card-stats-item">
											<div class="card-stats-item-count"><?php echo number_format($selling, 0, ',', '.'); ?></div>
											<div class="card-stats-item-label">Laku</div>
										</div>
										<div class="card-stats-item">
											<div class="card-stats-item-count"><?php echo "Rp " . number_format($price, 2, ',', '.');  ?></div>
											<div class="card-stats-item-label">Harga</div>
										</div>
										<div class="card-stats-item">
											<div class="card-stats-item-count"><?php echo "Rp " . number_format($total, 2, ',', '.'); ?></div>
											<div class="card-stats-item-label">Total</div>
										</div>
								</div>
								<br>
							</div>
							<div class="card-wrap">
								<div class="card-icon shadow-primary bg-success">
									<i class="fas fa-clipboard-list"></i>
								</div>
								<div class="card-header">
									<h4>Total Penjualan</h4>
								</div>
								<div class="card-body">
									<span><?php echo  "Rp" . number_format($total,2,',','.'); ?></span>
								</div>
							</div>
						<?php endif; ?>
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
	  $(document).ready(function () {
		  $('.menu-btn').click(function () {
			  $('.item-submit').click();
		  })

		  $('.btn-month').click(function () {
		  	  val month = $(this).data('month');
			  $.post(this, {month: month}, function () {

			  });
		  })
	  })
  </script>
</body>
</html>
