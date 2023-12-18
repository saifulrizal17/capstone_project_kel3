<a href="{{ route('admin.kategori.edit', ['kategori' => $kategori->id]) }}" class="btn btn-info btn-sm">
    <i class='fas fa-edit'></i> Edit
</a>
<a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal{{ $kategori->id }}">
    <i class='fas fa-info-circle'></i> Detail
</a>
<a href="#" class="btn btn-danger btn-sm btn-delete" data-id="{{ $kategori->id }}">
    <i class='fas fa-trash-alt'></i> Hapus
</a>


@include('admin.kategori.modal_detail')
