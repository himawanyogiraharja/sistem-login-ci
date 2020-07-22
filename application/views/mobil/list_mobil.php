<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <?php echo $this->session->flashdata('pesan') ?>
              <div class="float-right mb-2">
                 <a href="<?php echo base_url('mobil/tambah') ?>">
                <button class="btn btn-primary btn-md"><i class="fa fa-plus"></i> &nbsp;tambah</button>
              </a>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Mobil</th>
                      <th>Type</th>
                      <th>Nomor Plat</th>
                      <th>Tahun Mobil</th>
                      <th>Tanggal Input</th>
                      <th>Harga Mobil</th>
                      <th>Produsen</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <?php 
                    $no = 1;
                    foreach($list_mobil as $m){
                    ?>
                    <tr>
                       <td><?php echo $no++ ?></td>
                       <td><?php echo $m['nama'] ?></td>
                       <td><?php echo $m['type'] ?></td>
                       <td><?php echo $m['no_pol'] ?></td>
                       <td><?php echo $m['tahun_mobil'] ?></td>
                       <td><?php echo date('d M Y', $m['date_created']) ?></td> 
                       <td><?php echo $m['harga'] ?></td>
                       <td><?php echo $m['produsen'] ?></td>

                      <td>
                        <a href="<?php echo base_url('mobil/editDataMobil/')?><?php echo $m['id'] ?>">
                        <span class="btn btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i>&nbsp; Edit</span>
                      </a>

                      <a href="<?php echo base_url('mobil/deleteMobil/')?><?php echo $m['id'] ?>">
                        <span class="btn btn-danger btn-sm" onClick="return confirm('Delete entry?')"
                        ><i class="fa fa-fw fa-trash"></i>&nbsp; Delete</span>
                      </a>
                      </td>


                    </tr>

                 <?php } ?>
                </table>
              </div>
            </div>
          </div>