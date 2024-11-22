<div class="container">
    @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $er)
                        <li>{{$er}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
     <div class="pt-3">
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
     </div>
    @endif
    <h1>Tambah Data </h1>
    <div class="card mt-3">
        <div class="card-body bg-light">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" wire:model ="nama">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" wire:model = "email">
            </div>
            @if ($updateData == false)
                <button type="submit" class="btn btn-primary" wire:click="store()" >Simpan</button>
            @else
                <button type="submit" class="btn btn-primary" wire:click="update()" >Update</button>
            @endif

        </div>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <h2>Data </h2>
            {{ $datauser->links() }}
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datauser as $key => $user)
                        <tr>
                            <td>{{ $datauser->firstItem() + $key }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a wire:click="edit({{ $user->id }})" class="btn btn-warning">Edit</a>
                                <a wire:click="delete_confirm({{ $user->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $datauser->links() }}
        </div>
    </div>

  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Delete</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h1>Yakin Pengen Hapus?</h1>
          <p>Data lo nggak bakal bisa kembali lagi!!</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nggak Jadi</button>
          <button type="button" class="btn btn-primary" wire:click="delete()" data-bs-dismiss="modal">Iyaa</button>
        </div>
      </div>
    </div>
  </div>

</div>
