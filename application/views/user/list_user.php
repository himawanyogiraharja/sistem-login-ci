<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables User</h6>
            </div>
            <div class="card-body">
              <?php echo $this->session->flashdata('pesan') ?>
              <div class="float-right mb-2">
                 <a href="<?php echo base_url('user/tambahUser') ?>">
                <button class="btn btn-primary btn-md"><i class="fa fa-plus"></i> &nbsp;tambah</button>
              </a>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama User</th>
                      <th>No HP</th>
                      <th>Email</th>
                      <th>Foto</th>
                      <th>Tanggal Registrasi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <?php 
                    $no = 1;
                    foreach($ambilDataUser as $u){
                    ?>
                    <tr>
                       <td><?php echo $no++ ?></td>
                       <td><?php echo $u['nama'] ?></td>
                       <td><?php echo $u['no_hp'] ?></td>
                       <td><?php echo $u['email'] ?></td>
                       <td><img src="<?php echo base_url('/assets/img/user/') . $u['foto'] ?>" width="50px"></td>
                       <td><?php echo date('d M Y', $u['date_created']) ?></td> 
  
                        <td>
                        <a href="<?php echo base_url('user/updateDataUser/')?><?php echo $u['id'] ?>">
                        <span class="btn btn-primary btn-sm"><i class="fa fa-fw fa-edit"></i>&nbsp; Edit</span>
                      </a>

                      <a href="<?php echo base_url('user/delete/')?><?php echo $u['id'] ?>">
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