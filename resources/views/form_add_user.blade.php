@extends('template/template_admin')
@section('conten')
{{-- secction header --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Tambah Data User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="">User Role</a></li>
              <li class="breadcrumb-item">Tambah User</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
  {{-- end section header --}}

  {{-- section conten --}}
    <section class="content">
      <div class="card">
            <div class="card-header">
                  <h3 class="card-title">Tambah Data User</h3>

                  <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                  </div>
            </div>
            
            <form action="{{route('proses.add.user')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                  <label for="exampleSelectRounded0">Pilih Role</label>
                  <select class="custom-select rounded-0" id="role" name="role">
                    <option value="" selected disabled>Pilih Role</option>
                    @foreach ($list_role as $item)
                        <option value="{{$item}}">{{strtoupper($item)}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="load-form">
                </div>
                <div class="btn-group">
                    <div style="margin-right: 10px">
                        <button id="add" type="button" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                    <div>
                        <button id="res" type="button" class="btn btn-default btn-sm">Batal</button>
                    </div>
                </div>
                {{-- <div class="btn-group">
                    <button type="submit" class="btn btn-block btn-primary btn-flat">Simpan</button>
                    <button type="reset" class="btn btn-block btn-danger btn-flat">Batal</button>
                </div> --}}
            </div>
            </form>
      </div>
    </section>

    <script>
        $(document).on('change','#role', function(){
            var role = $('#role').val();
            var DataHtml = '';
            if (role == 'Admin') {

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">NIK/NIDN</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nik" name="nik" placeholder="NIK/NIDN">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Nama User</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nama" name="nama" placeholder="Nama User">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Jenis Kelamin</label>';
                DataHtml += '<select class="custom-select rounded-0" id="jk" name="jk">';
                DataHtml += '<option value="" selected disabled>Pilih Jenis Kelamin</option>'
                DataHtml += '<option value="1">Laki-Laki</option>'
                DataHtml += '<option value="2">Perempuan</option>'
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Alamat</label>';
                DataHtml += '<textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat ..."></textarea>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">No Telpon</label>';
                DataHtml += '<input type="number" min="0" class="form-control rounded-0" id="no_hp" name="no_hp" placeholder="No Telpon">';
                DataHtml += '</div>';

                $('#add').prop('type','submit');
                $('#res').prop('type','reset');

            }

            if (role == 'DPL') {
                
                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">NIK/NIDN</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nik" name="nik" placeholder="NIK/NIDN">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Nama User</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nama" name="nama" placeholder="Nama User">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Jenis Kelamin</label>';
                DataHtml += '<select class="custom-select rounded-0" id="jk" name="jk">';
                DataHtml += '<option value="" selected disabled>Pilih Jenis Kelamin</option>';
                DataHtml += '<option value="1">Laki-Laki</option>';
                DataHtml += '<option value="2">Perempuan</option>';
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Program Studi</label>';
                DataHtml += '<select class="custom-select rounded-0" id="prodi" name="prodi">';
                DataHtml += '<option value="" selected disabled>Pilih Program Studi</option>';
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Fakultas</label>';
                DataHtml += '<select class="custom-select rounded-0" id="fakultas" name="fakultas">';
                DataHtml += '<option value="" selected disabled>Pilih Fakultas</option>';
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Alamat</label>';
                DataHtml += '<textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat ..."></textarea>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">No Telpon</label>';
                DataHtml += '<input type="number" min="0" class="form-control rounded-0" id="no_hp" name="no_hp" placeholder="No Telpon">';
                DataHtml += '</div>';

                $.ajax({
                  type: "GET",
                  url: "{{url('ajax/prodi')}}",
                  dataType: "json",
                  success: function (response) {
                    var DataProdi = response.prodi;
                    var DataFakultas = response.fakultas;
                    var BodyData = '';
                    var BodyFakul = '';
                    $.each(DataProdi, function (index, value) { 
                      BodyData += '<option value="'+index+'">'+value+'</option>';
                    });
                    $('#prodi').html(BodyData);
                    $.each(DataFakultas, function (index, value) { 
                       BodyFakul += '<option value="'+index+'">'+value+'</option>';
                    });
                       $('#fakultas').html(BodyFakul);
                  }
                });

                $('#add').prop('type','submit');
                $('#res').prop('type','reset');
                
            }

            if (role == 'Kepala Sekolah') {
                
                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">NIK/NIDN</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nik" name="nik" placeholder="NIK/NIDN">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Nama User</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nama" name="nama" placeholder="Nama User">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Jenis Kelamin</label>';
                DataHtml += '<select class="custom-select rounded-0" id="jk" name="jk">';
                DataHtml += '<option value="" selected disabled>Pilih Jenis Kelamin</option>';
                DataHtml += '<option value="1">Laki-Laki</option>';
                DataHtml += '<option value="2">Perempuan</option>';
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Sekolah</label>';
                DataHtml += '<select class="custom-select rounded-0" id="kode_sekolah" name="kode_sekolah">';
                DataHtml += '<option value="" selected disabled>Pilih Sekolah</option>';
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Alamat</label>';
                DataHtml += '<textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat ..."></textarea>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">No Telpon</label>';
                DataHtml += '<input type="number" min="0" class="form-control rounded-0" id="no_hp" name="no_hp" placeholder="No Telpon">';
                DataHtml += '</div>';

                 $.ajax({
                  type: "GET",
                  url: "{{url('ajax/mitra-sekolah')}}",
                  dataType: "json",
                  success: function (response) {
                    var Data = response;
                    var BodyData = '';
                    $.each(Data, function (index, value) { 
                      BodyData += '<option value="'+value.kode_sekolah+'">'+value.kode_sekolah+ ' ~ '+value.nama_sekolah+'</option>';
                    });
                    $('#kode_sekolah').html(BodyData);
                  }
                });

                $('#add').prop('type','submit');
                $('#res').prop('type','reset');

            }
            if (role == 'Guru Pamong') {
                
                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">NIK/NIDN</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nik" name="nik" placeholder="NIK/NIDN">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Nama User</label>';
                DataHtml += '<input type="text" class="form-control rounded-0" id="nama" name="nama" placeholder="Nama User">';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Jenis Kelamin</label>';
                DataHtml += '<select class="custom-select rounded-0" id="jk" name="jk">';
                DataHtml += '<option value="" selected disabled>Pilih Jenis Kelamin</option>';
                DataHtml += '<option value="1">Laki-Laki</option>';
                DataHtml += '<option value="2">Perempuan</option>';
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Kepala Sekolah</label>';
                DataHtml += '<select class="custom-select rounded-0" id="id_kepsek" name="id_kepsek">';
                DataHtml += '<option value="" selected disabled>Pilih Kepala Sekolah</option>';
                DataHtml += '</select>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">Alamat</label>';
                DataHtml += '<textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat ..."></textarea>';
                DataHtml += '</div>';

                DataHtml += '<div class="form-group">';
                DataHtml += '<label for="exampleInputRounded0">No Telpon</label>';
                DataHtml += '<input type="number" min="0" class="form-control rounded-0" id="no_hp" name="no_hp" placeholder="No Telpon">';
                DataHtml += '</div>';

                $.ajax({
                  type: "GET",
                  url: "{{url('ajax/kepsek')}}",
                  dataType: "json",
                  success: function (response) {
                    var Data = response;
                    var BodyData = '';
                    $.each(Data, function (index, value) { 
                      BodyData += '<option value="'+value.id_kepsek+'">'+value.nik+ ' ~ '+value.nama_kepsek+'</option>';
                    });
                    $('#id_kepsek').html(BodyData);
                  }
                });

                $('#add').prop('type','submit');
                $('#res').prop('type','reset');

            }

            $('.load-form').html(DataHtml);
        });
    </script>

@endsection