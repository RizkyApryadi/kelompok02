@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <!-- Profil Siswa -->
                        </div>
                        <div class="profile-widget-description pb-0">
                            <!-- Deskripsi Profil Siswa -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card card-hero" style="margin-top: 36px">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <h4>Jadwal Pelajaran</h4>
                            <div class="card-description">Jadwal Pelajaran hari ini</div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Jadwal Pelajaran -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card card-hero" style="margin-top: 36px">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h4>{{ $materi->count() }}</h4>
                            <div class="card-description">Materi Tersedia</div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Materi Tersedia -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card card-hero" style="margin-top: 36px">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h4>{{ $tugas->count() }}</h4>
                            <div class="card-description">Tugas Tersedia</div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Tugas Tersedia -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
@endsection