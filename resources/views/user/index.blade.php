@extends('layouts.master', [
    'judul' => 'Daftar User',
])
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">Daftar Pengguna</div>
            <div class="card-body">
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#add">
                    Tambah Pengguna
                </button>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td><span class="badge bg-primary text-uppercase">{{ $item->role == 'admin' ? 'pimpinan' : 'operator' }}</span></td>
                                <td>
                                    <form action="{{ Route('master-user.destroy', $item->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Menghapus Data Ini ?')"><i
                                                class="bi bi-trash"></i></button>
                                        <a href="{{ Route('master-user.edit',$item->uuid) }}" class="btn btn-warning"><i
                                                class="bi bi-pen"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Pengguna</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                
                    <div class="modal-body">
                        <form action="{{ route('master-user.store') }}" method="post" enctype="multipart/form-data">
                        
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Nama Lengkap</label>
                                    <input required type="text" name="name" placeholder="Nama Lengkap" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input required type="text" name="username" placeholder="Username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input required type="email" name="email" placeholder="Email" class="form-control">
                                </div>    
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select required name="status" id="status" class="form-control">
                                    <option value="" selected disabled >-- Pilih Status --</option>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">NonaktifAktif</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" required name="password" id="password" placeholder="*******"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Konfirmasi Password</label>
                                <input type="password" required name="confirm" id="confirm" placeholder="*******"  class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div> 
            </div>
        </div>
    </div>
    {{-- <div class="modal fade text-left modal-borderless" id="add" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('master-user.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input required type="text" name="name" placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input required type="text" name="username" placeholder="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" name="email" placeholder="Email" class="form-control">
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select required name="status" id="status" class="form-control">
                                <option value="" selected disabled >-- Pilih Status --</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">NonaktifAktif</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" required name="password" id="password" placeholder="*******"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Konfirmasi Password</label>
                            <input type="password" required name="confirm" id="confirm" placeholder="*******"  class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button class="btn btn-primary ml-1" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
    <script src="{{ asset('template/assets/extensions/toastify-js/src/toastify.js') }}"></script>
    @if (count($errors) > 0)
        <script>
            var errors = @json($errors->all());
            Toastify({
                text: errors,
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @enderror
    @if (session()->has('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#19C37D",
            }).showToast();
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @endif
@endsection
