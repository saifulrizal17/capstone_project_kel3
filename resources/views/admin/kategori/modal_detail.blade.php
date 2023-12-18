<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $kategori->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail
                    Data
                    Kategori: {{ $kategori->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="gg" style="width: 100%">
                    <tr>
                        <td class="navy">ID Kategori</td>
                        <td>{{ $kategori->id }}</td>
                    </tr>
                    <tr>
                        <td class="navy">Jenis </td>
                        <td>{{ $kategori->jenis->name }}</td>
                    </tr>
                    <tr>
                        <td class="navy"> Nama Kategori</td>
                        <td>{{ $kategori->name }}</td>
                    </tr>
                    <tr>
                        <td class="navy">Deskripsi</td>
                        <td>{{ $kategori->description }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-arrow-left"></i>
                    Kembali</button>
            </div>
        </div>
    </div>
</div>
