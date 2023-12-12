@extends('layouts.master',['judul' => 'Dashboard'])
@section('content')
    <script src="{{ asset('template/assets/extensions/tinymce/tinymce.min.js')}}"></script>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card ">
                <div class="card-header">
                    <h4>Selamat Datang, <strong>{{Auth::user()->name}}</strong></h4>
                    <hr>
                    <h5>Total Semua Transaksi : Rp {{number_format($total,0,',','.')}}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green">
                                        <i>
                                            <span class="bi bi-cash"></span>
                                        </i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold mt-3">Transaksi Hari Ini</h6>
                                    <h6 class="font-extrabold mb-0">Rp {{number_format($payToday,0,',','.')}}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple">
                                        <i>
                                            <span class="bi bi-list"></span>
                                        </i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold mt-3">Transaksi Pending</h6>
                                    <h6 class="font-extrabold mb-0">{{$pending}}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green">
                                        <i>
                                            <span class="bi bi-list"></span>
                                        </i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold mt-3">Transaksi Sukses</h6>
                                    <h6 class="font-extrabold mb-0">{{$success}}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red">
                                        <i>
                                            <span class="bi bi-list"></span>
                                        </i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold mt-3">Transaksi Gagal</h6>
                                    <h6 class="font-extrabold mb-0">{{$success}}</h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeOptions = document.body.classList.contains("theme-dark") ? {
                skin: "oxide-dark",
                content_css: "dark",
            } : {
                skin: "oxide",
                content_css: "default",
            }

            tinymce.init({
                selector: "#accement",
                ...themeOptions
            })
            tinymce.init({
                selector: "#dark",
                toolbar: "undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code",
                plugins: "code",
                ...themeOptions,
            })
        })
    </script>
@endsection
