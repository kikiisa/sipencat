@extends('layouts.master', ['judul' => 'Edit Pengguna'])
@section('content')
    <script src="{{ asset('template/assets/extensions/tinymce/tinymce.min.js') }}"></script>
    <section class="row">
        <div class="col-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update',$data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input required="required" type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap"
                                value="{{$data->name}}">
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input required="required" type="text" name="username" id="username" class="form-control" placeholder="Username"
                                value="{{$data->username}}">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input required="required" type="text" name="email" id="email" class="form-control"
                                placeholder="Email" value="{{$data->email}}">
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="******">
                            <small class="text-danger">Kosongkan Jika Tidak Ingin Mengubah</small>
                        </div>
                        <div class="form-group">
                            <label for="confirm" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="confirm" id="confirm" class="form-control" placeholder="******">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
