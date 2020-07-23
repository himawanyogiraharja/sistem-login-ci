 <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h4><?php echo $this->session->userdata('email') ?></h4>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          
           <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Form Order Rental Mobil</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                   <form class="user" action="<?php echo base_url('order/tambah') ?>" method="post">
                    <div class="form-group">
                      <input type="text" name="nama" class="form-control form-control-user" placeholder="Nama Mobil" value="<?php echo set_value('nama') ?>">
                      <small class="text-danger"><?php echo form_error('nama') ?></small>
                    </div>
                    <div class="form-group">
                      <select class="form-control form-control-user" id="mobil" name="mobil">
                        <option></option>
                        <?php 
                            // var_dump($getMobil); die;
                            echo '<option>'.$getMobil['nama'].'</option>';
                            echo '<option>test</option>';
                         ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" name="durasi_pinjaman" class="form-control form-control-user"  placeholder="Durasi Pinjaman" value="<?php echo set_value('durasi_pinjaman') ?>">
                      <small class="text-danger"><?php echo form_error('durasi_pinjaman') ?></small>
                    </div>
                    <div class="form-group">
                      <input type="text" name="tujuan" class="form-control form-control-user"  placeholder="Tujuan" value="<?php echo set_value('tujuan') ?>">
                      <small class="text-danger"><?php echo form_error('tujuan') ?></small>
                    </div>
                    <div class="form-group">
                      <input type="text" name="harga_sewa_mobil" class="form-control form-control-user"  placeholder="Harga Sewa Mobil" value="<?php echo set_value('harga_sewa_mobil') ?>">
                      <small class="text-danger"><?php echo form_error('harga_sewa_mobil') ?></small>
                    </div>
                    <div class="form-group float-right">
                      <button type="submit" class="btn btn-primary btn-user">
                      Simpan
                    </button>
                    </div>
                    

                      
                  
                  </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

