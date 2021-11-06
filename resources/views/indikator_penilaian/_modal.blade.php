{{-- modal sekolah --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="{{ route('simpan.indikator.sekolah.p1') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <p class="text-hapus">Anda yakin ingin menghapus indikator ini!</p>
                        <p class="text-non-hapus">Indiktor sudah terkait dengan penilaian, tidak bisa di hapus</p>
                    </div>
                    <input type="hidden" name="id_indikator" id="id_indikator">
                    <input type="hidden" name="aspek" id="aspek">
                    <div class="form-group">
                        <label>Indikator :</label>
                        <textarea type="text" class="form-control" id="indikator" name="indikator" rows="6"
                            placeholder="Input indikator"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai :</label>
                        <input type="number" class="form-control" id="nilai" name="nilai" placeholder="Input nilai">
                    </div>
                    <div class="form-group" id="grade">
                        <label for="exampleInputEmail1">Grade :</label>
                        <input type="text" class="form-control" id="grade_nilai" name="grade_nilai"
                            placeholder="Input Grade">
                        <small class="text-danger">Note*: Nilai Grade dari A - E</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger batal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary simpan">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


{{-- modal plp dpl --}}
<div class="modal fade" id="modal-dpl">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="{{ route('simpan.indikator.dpl') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_indikator_dpl" id="id_indikator_dpl">
                    <input type="hidden" name="aspek_dpl" id="aspek_dpl">
                    <div class="form-group">
                        <label>Indikator :</label>
                        <textarea type="text" class="form-control" id="indikator_dpl" name="indikator_dpl" rows="6"
                            placeholder="Input indikator"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nilai :</label>
                        <input type="number" class="form-control" id="nilai_dpl" name="nilai_dpl"
                            placeholder="Input nilai">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger batal_dpl" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary simpan_dpl">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{-- modal dpl non hapus --}}
<div class="modal fade" id="non-hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Indikator</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Indiktor sudah terkait dengan penilaian, tidak bisa di hapus</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger batal_dpl" data-dismiss="modal">Keluar</button>
                {{-- <button type="submit" class="btn btn-primary simpan_dpl">Simpan</button> --}}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{-- modal dpl non hapus --}}
<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Indikator</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('hapus-indikator-n1-p1') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_hapus_indikator" name="id_hapus_indikator">
                    <p class="text-center">Anda yakin ingin menghapus indikator ini!</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger batal_dpl" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary simpan_dpl">Hapus</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
