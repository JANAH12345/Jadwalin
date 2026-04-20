@extends('layouts.admin')

@section('title', 'Admin Dashboard - Jadwalin')

@section('content')

{{-- ============================================================
     SECTION 1: DASHBOARD OVERVIEW
============================================================ --}}
<div class="content-section active" id="section-dashboard">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-title">Selamat Datang, {{ explode(' ', Auth::check() ? Auth::user()->name : 'Admin')[0] }}!</div>
        <div class="welcome-sub">Pantau semua jadwal promosi sekolah dalam satu tempat.</div>
        <div class="welcome-date">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            <span id="currentDateBanner"></span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Jadwal</div>
                <div class="stat-value" id="statTotal">{{ $jadwals->count() }}</div>
                <div class="stat-change">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    +{{ $jadwals->where('created_at', '>=', now()->startOfMonth())->count() }} bulan ini
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Jadwal Hari Ini</div>
                <div class="stat-value" id="statHariIni">{{ $jadwals->where('status', 'hari ini')->count() }}</div>
                <div class="stat-change" style="color: #3b82f6;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    Sedang berlangsung
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Jadwal Selesai</div>
                <div class="stat-value" id="statSelesai">{{ $jadwals->where('status', 'selesai')->count() }}</div>
                <div class="stat-change">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    {{ $jadwals->count() > 0 ? round(($jadwals->where('status', 'selesai')->count() / $jadwals->count()) * 100) : 0 }}% selesai
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Jadwal Batal</div>
                <div class="stat-value" id="statBatal">{{ $jadwals->where('status', 'batal')->count() }}</div>
                <div class="stat-change" style="color: #ef4444;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                    {{ $jadwals->count() > 0 ? round(($jadwals->where('status', 'batal')->count() / $jadwals->count()) * 100, 1) : 0 }}% dari total
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Grid: Quick Actions + Recent Activity -->
    <div class="dashboard-grid">
        <!-- Quick Activity -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Jadwal Terbaru</div>
                <button class="btn btn-primary btn-sm" onclick="showSection('jadwal', document.querySelector('[data-section=jadwal]'))">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                    </svg>
                    Lihat Semua
                </button>
            </div>
            <div class="card-body">
                <div style="display: flex; flex-direction: column; gap: 12px;" id="recentJadwal">
                    <!-- filled by JS -->
                </div>
            </div>
        </div>

        <!-- Quick Actions + Mini Chart -->
        <div style="display: flex; flex-direction: column; gap: 18px;">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Aksi Cepat</div>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <div class="quick-action-btn" onclick="showSection('jadwal', document.querySelector('[data-section=jadwal]')); setTimeout(() => openAddModal(), 400);">
                            <div class="quick-action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <span class="quick-action-label">Tambah Jadwal</span>
                        </div>
                        <div class="quick-action-btn" onclick="showSection('kalender', document.querySelector('[data-section=kalender]'))">
                            <div class="quick-action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                            </div>
                            <span class="quick-action-label">Lihat Kalender</span>
                        </div>
                        <div class="quick-action-btn" onclick="showSection('laporan', document.querySelector('[data-section=laporan]'))">
                            <div class="quick-action-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                                </svg>
                            </div>
                            <span class="quick-action-label">Laporan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mini Bar Chart -->
            <div class="card" style="flex: 1;">
                <div class="card-header">
                    <div class="card-title">Aktivitas Mingguan</div>
                </div>
                <div class="card-body" style="padding-top: 0;">
                    <div class="chart-container" style="height: 180px;">
                        <canvas id="miniChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ============================================================
     SECTION 2: KELOLA JADWAL
============================================================ --}}
<div class="content-section" id="section-jadwal">
    <!-- Search & Filter Bar -->

    <!-- Search & Filter Bar -->
    <div class="card" style="margin-bottom: 18px;">
        <div class="card-body" style="padding: 16px 20px;">
            <div style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
                <div style="flex: 1; min-width: 200px; position: relative;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--gray-400); pointer-events: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari kegiatan..." style="padding-left: 38px;" oninput="filterTable()">
                </div>
                <select class="filter-select" id="filterStatus" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    <option value="ada jadwal">Ada Jadwal</option>
                    <option value="hari ini">Hari Ini</option>
                    <option value="selesai">Selesai</option>
                    <option value="batal">Batal</option>
                </select>
                <button class="btn btn-secondary btn-sm" onclick="resetFilter()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Reset
                </button>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Daftar Jadwal Kegiatan</div>
            <button class="btn btn-primary btn-sm" onclick="openAddModal()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Jadwal
            </button>
        </div>
        <div class="card-body">
            <div class="table-wrapper">
                <table id="jadwalTable">
                    <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tempat</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th style="text-align: center; width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="jadwalTableBody">
                        <!-- Filled by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


{{-- ============================================================
     SECTION 3: KALENDER PROMOSI
============================================================ --}}
<div class="content-section" id="section-kalender">

    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 18px; align-items: start;">
        <!-- Calendar -->
        <div class="calendar-wrapper">
            <div class="calendar-nav">
                <button class="calendar-nav-btn" id="prevMonth" onclick="changeMonth(-1)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <div class="calendar-month-title" id="calendarMonthTitle">April 2026</div>
                <button class="calendar-nav-btn" id="nextMonth" onclick="changeMonth(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
            <div class="calendar-grid">
                <div class="calendar-weekdays">
                    <div class="calendar-weekday">Min</div>
                    <div class="calendar-weekday">Sen</div>
                    <div class="calendar-weekday">Sel</div>
                    <div class="calendar-weekday">Rab</div>
                    <div class="calendar-weekday">Kam</div>
                    <div class="calendar-weekday">Jum</div>
                    <div class="calendar-weekday">Sab</div>
                </div>
                <div class="calendar-days" id="calendarDays">
                    <!-- Filled by JS -->
                </div>
            </div>
            <div class="calendar-legend">
                <div class="legend-item"><div class="legend-dot" style="background: #3b82f6;"></div> Ada Jadwal</div>
                <div class="legend-item"><div class="legend-dot" style="background: #eab308;"></div> Hari Ini</div>
                <div class="legend-item"><div class="legend-dot" style="background: #10b981;"></div> Selesai</div>
                <div class="legend-item"><div class="legend-dot" style="background: #ef4444;"></div> Batal</div>
                <div class="legend-item"><div class="legend-dot" style="background: var(--lilac-500);"></div> Hari Ini (Calendar)</div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">Jadwal Mendatang</div>
            </div>
            <div class="card-body" id="upcomingEvents">
                <!-- filled by JS -->
            </div>
        </div>
    </div>
</div>


{{-- ============================================================
     SECTION 4: LAPORAN
============================================================ --}}
<div class="content-section" id="section-laporan">
    <!-- Filter Bar -->

    <!-- Filter Bar -->
    <div class="card" style="margin-bottom: 18px;">
        <div class="card-body" style="padding: 16px 20px;">
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <span style="font-size: 13px; font-weight: 600; color: var(--gray-600);">Filter Periode:</span>
                <select class="filter-select" id="filterBulan" onchange="updateChart()">
                    <option value="0">Semua Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <select class="filter-select" id="filterTahun" onchange="updateChart()">
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                </select>
                <button class="btn btn-secondary btn-sm" onclick="resetFilter2()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Main Chart -->
    <div class="card" style="margin-bottom: 18px;">
        <div class="card-header">
            <div class="card-title">Grafik Jumlah Promosi Per Bulan</div>
            <div style="display: flex; gap: 8px;">

                <button class="btn btn-sm" id="btnBar" onclick="switchChart('bar')" style="background: var(--lilac-100); color: var(--lilac-700); border: 1.5px solid var(--lilac-200);">
                    Bar
                </button>
                <button class="btn btn-sm btn-secondary" id="btnLine" onclick="switchChart('line')">
                    Line
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="mainChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Kegiatan</div>
                <div class="stat-value">{{ $jadwals->count() }}</div>
                <div class="stat-change">Seluruh jadwal yang terdata</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Tingkat Keberhasilan</div>
                <div class="stat-value">{{ $jadwals->count() > 0 ? round(($jadwals->where('status', 'selesai')->count() / $jadwals->count()) * 100) : 0 }}%</div>
                <div class="stat-change">{{ $jadwals->where('status', 'selesai')->count() }} kegiatan selesai</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Sekolah Dikunjungi</div>
                <div class="stat-value">{{ $jadwals->where('status', 'selesai')->unique('nama_tempat')->count() }}</div>
                <div class="stat-change">Lokasi unik yang sudah selesai</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label">Jadwal Dibatalkan</div>
                <div class="stat-value">{{ $jadwals->where('status', 'batal')->count() }}</div>
                <div class="stat-change" style="color: #ef4444;">{{ $jadwals->count() > 0 ? round(($jadwals->where('status', 'batal')->count() / $jadwals->count()) * 100, 1) : 0 }}% dari total</div>
            </div>
        </div>
    </div>
</div>


{{-- ============================================================
     SECTION 5: MANAJEMEN MARKETING
============================================================ --}}
<div class="content-section" id="section-marketing">

    <div class="card">
        <div class="card-header">
            <div class="card-title">Daftar Akun Marketing</div>
            <button class="btn btn-primary btn-sm" onclick="openUserModal('marketing')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                Tambah
            </button>
        </div>
        <div class="card-body">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Username</th>
                            <th>Password Login</th>
                            <th style="text-align: center; width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="marketingTableBody">
                        <!-- Filled by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     SECTION 6: MANAJEMEN PETUGAS
============================================================ --}}
<div class="content-section" id="section-petugas">

    <div class="card">
        <div class="card-header">
            <div class="card-title">Daftar Akun Petugas</div>
            <button class="btn btn-primary btn-sm" onclick="openUserModal('admin')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v9m-1.25-3h1.25m0 0h1.25m-12-3h12m0 0v-3.75m0 3.75v3.75m-12 0V7.5m0 0v3.75m0-3.75H3.75m1.25 11.25h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                Tambah
            </button>
        </div>
        <div class="card-body">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Username</th>
                            <th>Password Login</th>
                            <th style="text-align: center; width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="adminTableBody">
                        <!-- Filled by JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     MODAL: TAMBAH JADWAL
============================================================ --}}
<div class="modal-overlay" id="modalTambahJadwal">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title">
                <span id="modalTambahTitle">➕ Tambah Jadwal Baru</span>
            </div>
            <button class="modal-close" onclick="closeModal('modalTambahJadwal')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <form id="formJadwal" onsubmit="submitJadwal(event)">
                <input type="hidden" id="editIndex" value="">

                <div class="form-group">
                    <label class="form-label">Nama Kegiatan *</label>
                    <input type="text" class="form-control" id="inputNama" placeholder="Contoh: Promosi ke SMPN 1 Kota" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Tempat *</label>
                    <input type="text" class="form-control" id="inputTempat" placeholder="Nama sekolah / lokasi" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tanggal *</label>
                        <input type="date" class="form-control" id="inputTanggal" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jam *</label>
                        <input type="time" class="form-control" id="inputJam" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select class="form-control" id="inputStatus" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="ada jadwal">Ada Jadwal</option>
                        <option value="hari ini">Hari Ini</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control" id="inputKeterangan" rows="3" placeholder="Catatan tambahan tentang kegiatan ini..." style="resize: vertical;"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" onclick="closeModal('modalTambahJadwal')">
                Batal
            </button>
            <button class="btn btn-primary" type="button" onclick="submitJadwal(event)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span id="btnSimpanText">Simpan</span>
            </button>
        </div>
    </div>
</div>

{{-- ============================================================
     MODAL: DETAIL KALENDER
============================================================ --}}
<div class="modal-overlay" id="modalDetailKalender">
    <div class="modal" style="max-width: 460px;">
        <div class="modal-header">
            <div class="modal-title">📌 Detail Jadwal</div>
            <button class="modal-close" onclick="closeModal('modalDetailKalender')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body" id="modalDetailBody">
            <!-- Filled by JS -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalDetailKalender')">Tutup</button>
        </div>
    </div>
</div>

{{-- ============================================================
     MODAL: KONFIRMASI HAPUS
============================================================ --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal" style="max-width: 380px;">
        <div class="modal-header">
            <div class="modal-title">🗑️ Hapus Jadwal</div>
            <button class="modal-close" onclick="closeModal('modalHapus')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size: 14px; color: var(--gray-500); line-height: 1.65;">
                Apakah kamu yakin ingin menghapus jadwal <strong id="hapusNama" style="color: var(--gray-800);"></strong>? Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalHapus')">Batal</button>
            <button class="btn btn-danger" onclick="confirmHapus()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                Ya, Hapus
            </button>
        </div>
    </div>
</div>

{{-- ============================================================
     MODAL: TAMBAH/EDIT USER
============================================================ --}}
<div class="modal-overlay" id="modalUser">
    <div class="modal" style="max-width: 400px;">
        <div class="modal-header">
            <div class="modal-title">
                <span id="modalUserTitle">Tambah User</span>
            </div>
            <button class="modal-close" onclick="closeModal('modalUser')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <form id="formUser" onsubmit="submitUser(event)">
                <input type="hidden" id="userId" value="">
                <input type="hidden" id="userRole" value="">

                <div class="form-group">
                    <label class="form-label">Username *</label>
                    <input type="text" class="form-control" id="inputUsername" placeholder="Contoh: budi_marketing" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Password * (Fixed)</label>
                    <input type="text" class="form-control" id="inputUserPassword" readonly style="background: var(--gray-50); color: var(--gray-400);">
                    <small style="font-size: 11px; color: var(--gray-400); margin-top: 4px; display: block;">
                        Password diset otomatis sesuai peran user.
                    </small>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" onclick="closeModal('modalUser')">Batal</button>
            <button class="btn btn-primary" type="button" onclick="submitUser(event)">
                <span id="btnUserSimpanText">Simpan</span>
            </button>
        </div>
    </div>
</div>

{{-- ============================================================
     MODAL: KONFIRMASI HAPUS USER
============================================================ --}}
<div class="modal-overlay" id="modalHapusUser">
    <div class="modal" style="max-width: 380px;">
        <div class="modal-header">
            <div class="modal-title">🗑️ Hapus User</div>
            <button class="modal-close" onclick="closeModal('modalHapusUser')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size: 14px; color: var(--gray-500); line-height: 1.65;">
                Apakah kamu yakin ingin menghapus user <strong id="hapusUsernameLabel" style="color: var(--gray-800);"></strong>?
            </p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalHapusUser')">Batal</button>
            <button class="btn btn-danger" onclick="confirmHapusUser()">Ya, Hapus</button>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
// ============================================================
// SAMPLE DATA
// ============================================================
let jadwalData = @json($jadwals);
let marketingData = @json($marketings);
let adminData = @json($admins);

let hapusIndex = null;
let hapusUserObj = null; // {id, role, index}
let mainChartInstance = null;
let miniChartInstance = null;
let currentChartType = 'bar';
let calendarCurrentDate = new Date();

// ============================================================
// INITIALIZE
// ============================================================
document.addEventListener('DOMContentLoaded', function() {
    // Date banner
    const now = new Date();
    const opts = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateEl = document.getElementById('currentDateBanner');
    if (dateEl) dateEl.textContent = now.toLocaleDateString('id-ID', opts);

    renderTable();
    renderRecentJadwal();
    renderCalendar();
    renderUpcomingEvents();
    renderUserTables(); // Init User Tables
    initMiniChart();
    initMainChart();
});

// ============================================================
// BADGE HTML
// ============================================================
function getBadge(status) {
    const map = {
        'ada jadwal': 'badge-blue',
        'hari ini': 'badge-yellow',
        'selesai': 'badge-green',
        'batal': 'badge-red',
    };
    const labels = {
        'ada jadwal': 'Ada Jadwal',
        'hari ini': 'Hari Ini',
        'selesai': 'Selesai',
        'batal': 'Batal',
    };
    return `<span class="badge ${map[status] || 'badge-blue'}">${labels[status] || status}</span>`;
}

// ============================================================
// FORMAT DATE
// ============================================================
function formatDate(dateStr) {
    const d = new Date(dateStr + 'T00:00:00');
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
}

// ============================================================
// RENDER TABLE
// ============================================================
function renderTable(data) {
    const source = data || jadwalData;
    const tbody = document.getElementById('jadwalTableBody');
    const countEl = document.getElementById('rowCount');
    if (!tbody) return;

    if (source.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8" style="text-align: center; padding: 40px; color: var(--gray-400);">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 40px; height: 40px; margin: 0 auto 10px; display: block; opacity: 0.4;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            Tidak ada data jadwal
        </td></tr>`;
        if (countEl) countEl.textContent = '0';
        return;
    }

    tbody.innerHTML = source.map((item, idx) => `
        <tr>
            <td style="font-weight: 600; color: var(--gray-400);">${idx + 1}</td>
            <td>
                <div style="font-weight: 600; color: var(--gray-700);">${item.nama_kegiatan}</div>
            </td>
            <td>
                <div style="display: flex; align-items: center; gap: 6px; color: var(--gray-500);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px; flex-shrink: 0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    ${item.nama_tempat}
                </div>
            </td>
            <td>${formatDate(item.tanggal)}</td>
            <td>
                <span style="background: var(--lilac-50); color: var(--lilac-700); padding: 3px 8px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                    ${item.jam}
                </span>
            </td>
            <td>${getBadge(item.status)}</td>
            <td style="max-width: 180px;">
                <span style="font-size: 12.5px; color: var(--gray-400); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    ${item.keterangan || '-'}
                </span>
            </td>
            <td>
                <div class="action-btns" style="justify-content: center;">
                    <button class="btn btn-sm" onclick="editJadwal(${jadwalData.indexOf(item)})" style="background: var(--lilac-50); color: var(--lilac-700); border: 1.5px solid var(--lilac-200);" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                        </svg>
                    </button>
                    <button class="btn btn-sm" onclick="deleteJadwal(${jadwalData.indexOf(item)})" style="background: #fee2e2; color: #dc2626; border: 1.5px solid #fecaca;" title="Hapus">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');

    if (countEl) countEl.textContent = source.length;
}

// ============================================================
// FILTER TABLE
// ============================================================
function filterTable() {
    const search = (document.getElementById('searchInput')?.value || '').toLowerCase();
    const status = (document.getElementById('filterStatus')?.value || '').toLowerCase();
    const filtered = jadwalData.filter(item => {
        const matchSearch = item.nama_kegiatan.toLowerCase().includes(search) || item.nama_tempat.toLowerCase().includes(search);
        const matchStatus = !status || item.status.toLowerCase() === status;
        return matchSearch && matchStatus;
    });
    renderTable(filtered);
}

function resetFilter() {
    const search = document.getElementById('searchInput');
    const statusFilter = document.getElementById('filterStatus');
    if (search) search.value = '';
    if (statusFilter) statusFilter.value = '';
    renderTable();
}

// ============================================================
// TAMBAH / EDIT JADWAL
// ============================================================
function openAddModal() {
    document.getElementById('modalTambahTitle').textContent = '➕ Tambah Jadwal Baru';
    document.getElementById('btnSimpanText').textContent = 'Simpan';
    document.getElementById('editIndex').value = '';
    document.getElementById('formJadwal').reset();
    openModal('modalTambahJadwal');
}

function editJadwal(index) {
    const item = jadwalData[index];
    document.getElementById('modalTambahTitle').textContent = '✏️ Edit Jadwal';
    document.getElementById('btnSimpanText').textContent = 'Update';
    document.getElementById('editIndex').value = index;
    document.getElementById('inputNama').value = item.nama_kegiatan;
    document.getElementById('inputTempat').value = item.nama_tempat;
    document.getElementById('inputTanggal').value = item.tanggal;
    document.getElementById('inputJam').value = item.jam.substring(0, 5);
    document.getElementById('inputStatus').value = item.status;
    document.getElementById('inputKeterangan').value = item.keterangan;
    openModal('modalTambahJadwal');
}

async function submitJadwal(e) {
    if (e && e.preventDefault) e.preventDefault();
    const nama_kegiatan = document.getElementById('inputNama').value.trim();
    const nama_tempat = document.getElementById('inputTempat').value.trim();
    const tanggal = document.getElementById('inputTanggal').value;
    const jam = document.getElementById('inputJam').value;
    const status = document.getElementById('inputStatus').value;
    const keterangan = document.getElementById('inputKeterangan').value.trim();

    if (!nama_kegiatan || !nama_tempat || !tanggal || !jam || !status) {
        showToast('Harap lengkapi semua field wajib!', 'error');
        return;
    }

    const payload = { nama_kegiatan, nama_tempat, tanggal, jam, status, keterangan };
    const editIndex = document.getElementById('editIndex').value;
    const isEdit = editIndex !== '';
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const url = isEdit ? `/admin/jadwal/${jadwalData[parseInt(editIndex)].id}` : '/admin/jadwal';
    const method = isEdit ? 'PUT' : 'POST';

    const btn = document.getElementById('btnSimpanText').parentElement;
    const btnText = document.getElementById('btnSimpanText');
    const originalText = btnText.textContent;

    try {
        btn.disabled = true;
        btnText.textContent = 'Menyimpan...';

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (response.ok && result.success) {
            if (isEdit) {
                jadwalData[parseInt(editIndex)] = result.data;
            } else {
                jadwalData.unshift(result.data);
            }
            closeModal('modalTambahJadwal');
            renderTable();
            renderRecentJadwal();
            renderCalendar();
            renderUpcomingEvents();
            updateSummaryStats();
            showToast(result.message, 'success');
        } else {
            const msg = (response.status === 419 || result.message === 'CSRF token mismatch.') 
                ? 'Sesi kadaluwarsa, silakan REFRESH halaman ini (F5)!' 
                : (result.message || 'Terjadi kesalahan sistem!');
            showToast(msg, 'error');
        }
    } catch (error) {
        showToast('Terjadi kesalahan koneksi!', 'error');
        console.error(error);
    } finally {
        btn.disabled = false;
        btnText.textContent = originalText;
    }
}

// ============================================================
// HAPUS JADWAL
// ============================================================
function deleteJadwal(index) {
    hapusIndex = index;
    document.getElementById('hapusNama').textContent = jadwalData[index].nama_kegiatan;
    openModal('modalHapus');
}

async function confirmHapus() {
    if (hapusIndex !== null) {
        const item = jadwalData[hapusIndex];
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(`/admin/jadwal/${item.id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                jadwalData.splice(hapusIndex, 1);
                hapusIndex = null;
                closeModal('modalHapus');
                renderTable();
                renderRecentJadwal();
                renderCalendar();
                renderUpcomingEvents();
                updateSummaryStats();
                showToast(result.message, 'success');
            } else {
                showToast(result.message || 'Gagal menghapus jadwal!', 'error');
            }
        } catch (error) {
            showToast('Kesalahan koneksi saat menghapus!', 'error');
        }
    }
}

// ============================================================
// RECENT JADWAL (DASHBOARD)
// ============================================================
function renderRecentJadwal() {
    const container = document.getElementById('recentJadwal');
    if (!container) return;
    const recent = jadwalData.slice(0, 5);
    container.innerHTML = recent.map(item => `
        <div style="display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: var(--radius-md); background: var(--gray-50); border: 1px solid var(--gray-100); transition: all 0.2s ease;" onmouseover="this.style.background='var(--lilac-50)'" onmouseout="this.style.background='var(--gray-50)'">
            <div style="width: 40px; height: 40px; border-radius: var(--radius-md); background: var(--lilac-100); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 18px; height: 18px; color: var(--lilac-600);">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </div>
            <div style="flex: 1; min-width: 0;">
                <div style="font-weight: 600; font-size: 13px; color: var(--gray-700); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item.nama_kegiatan}</div>
                <div style="font-size: 12px; color: var(--gray-400);">${item.nama_tempat} · ${formatDate(item.tanggal)}</div>
            </div>
            ${getBadge(item.status)}
        </div>
    `).join('');
}

// ============================================================
// UPDATE SUMMARY STATS
// ============================================================
function updateSummaryStats() {
    const total = jadwalData.length;
    const hariIni = jadwalData.filter(i => i.status === 'hari ini').length;
    const selesai = jadwalData.filter(i => i.status === 'selesai').length;
    const batal = jadwalData.filter(i => i.status === 'batal').length;

    const totalEl = document.getElementById('statTotal');
    const hariIniEl = document.getElementById('statHariIni');
    const selesaiEl = document.getElementById('statSelesai');
    const batalEl = document.getElementById('statBatal');

    if (totalEl) totalEl.textContent = total;
    if (hariIniEl) hariIniEl.textContent = hariIni;
    if (selesaiEl) selesaiEl.textContent = selesai;
    if (batalEl) batalEl.textContent = batal;
}

// ============================================================
// CALENDAR
// ============================================================
function renderCalendar() {
    const year = calendarCurrentDate.getFullYear();
    const month = calendarCurrentDate.getMonth();
    const today = new Date();

    const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const titleEl = document.getElementById('calendarMonthTitle');
    if (titleEl) titleEl.textContent = `${monthNames[month]} ${year}`;

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const daysInPrev = new Date(year, month, 0).getDate();

    const container = document.getElementById('calendarDays');
    if (!container) return;

    // Build date → status map
    const dateMap = {};
    jadwalData.forEach(item => {
        const d = new Date(item.tanggal + 'T00:00:00');
        if (d.getFullYear() === year && d.getMonth() === month) {
            const key = d.getDate();
            if (!dateMap[key]) dateMap[key] = [];
            dateMap[key].push(item.status);
        }
    });

    let html = '';

    // Previous month days
    for (let i = firstDay - 1; i >= 0; i--) {
        html += `<div class="calendar-day other-month">${daysInPrev - i}</div>`;
    }

    // Current month days
    for (let d = 1; d <= daysInMonth; d++) {
        const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();
        const statuses = dateMap[d] || [];
        let cls = 'calendar-day';

        if (isToday && statuses.length === 0) cls += ' today';
        else if (statuses.includes('hari ini')) cls += ' has-hari-ini';
        else if (statuses.includes('batal')) cls += ' has-batal';
        else if (statuses.includes('selesai')) cls += ' has-selesai';
        else if (statuses.includes('ada jadwal')) cls += ' has-jadwal';

        const hasDot = statuses.length > 0 ? '<div class="calendar-day-dot"></div>' : '';
        html += `<div class="${cls}" onclick="openDayDetail(${d}, ${month}, ${year})">${d}${hasDot}</div>`;
    }

    // Next month days
    const totalCells = Math.ceil((firstDay + daysInMonth) / 7) * 7;
    let nextDay = 1;
    for (let i = firstDay + daysInMonth; i < totalCells; i++) {
        html += `<div class="calendar-day other-month">${nextDay++}</div>`;
    }

    container.innerHTML = html;
}

function changeMonth(delta) {
    calendarCurrentDate.setMonth(calendarCurrentDate.getMonth() + delta);
    renderCalendar();
}

function openDayDetail(day, month, year) {
    const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    const events = jadwalData.filter(i => i.tanggal === dateStr);
    const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const body = document.getElementById('modalDetailBody');
    if (!body) return;

    if (events.length === 0) {
        body.innerHTML = `
            <div style="text-align: center; padding: 24px 0; color: var(--gray-400);">
                <div style="font-size: 40px; margin-bottom: 10px;">📅</div>
                <div style="font-weight: 600; font-size: 15px; color: var(--gray-600);">${day} ${monthNames[month]} ${year}</div>
                <div style="font-size: 13px; margin-top: 6px;">Tidak ada jadwal di tanggal ini</div>
            </div>`;
    } else {
        body.innerHTML = `
            <div style="margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--gray-100);">
                <div style="font-size: 14px; font-weight: 700; color: var(--lilac-700);">📅 ${day} ${monthNames[month]} ${year}</div>
                <div style="font-size: 12px; color: var(--gray-400); margin-top: 2px;">${events.length} kegiatan terjadwal</div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                ${events.map(ev => `
                    <div style="padding: 14px; border-radius: var(--radius-md); background: var(--lilac-50); border: 1px solid var(--lilac-100);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                            <div style="font-weight: 700; font-size: 14px; color: var(--gray-800);">${ev.nama_kegiatan}</div>
                            ${getBadge(ev.status)}
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <div style="font-size: 12.5px; color: var(--gray-500); display: flex; align-items: center; gap: 6px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px; color: var(--lilac-400); flex-shrink: 0;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                ${ev.nama_tempat}
                            </div>
                            <div style="font-size: 12.5px; color: var(--gray-500); display: flex; align-items: center; gap: 6px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px; color: var(--lilac-400); flex-shrink: 0;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Pukul ${ev.jam} WIB
                            </div>
                            ${ev.keterangan ? `<div style="font-size: 12.5px; color: var(--gray-500); display: flex; align-items: flex-start; gap: 6px; margin-top: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px; color: var(--lilac-400); flex-shrink: 0; margin-top: 2px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span>${ev.keterangan}</span>
                            </div>` : ''}
                        </div>
                    </div>
                `).join('')}
            </div>`;
    }
    openModal('modalDetailKalender');
}

// ============================================================
// UPCOMING EVENTS
// ============================================================
function renderUpcomingEvents() {
    const container = document.getElementById('upcomingEvents');
    if (!container) return;
    const today = new Date().toISOString().split('T')[0];
    const upcoming = jadwalData
        .filter(i => i.tanggal >= today && i.status !== 'batal' && i.status !== 'selesai')
        .sort((a, b) => a.tanggal.localeCompare(b.tanggal))
        .slice(0, 6);

    if (upcoming.length === 0) {
        container.innerHTML = `<div style="text-align: center; padding: 20px; color: var(--gray-400); font-size: 13px;">Tidak ada jadwal mendatang</div>`;
        return;
    }

    container.innerHTML = upcoming.map(item => `
        <div style="display: flex; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--gray-100); cursor: pointer;" onclick="openDayDetail(${parseInt(item.tanggal.split('-')[2])}, ${parseInt(item.tanggal.split('-')[1])-1}, ${parseInt(item.tanggal.split('-')[0])})">
            <div style="min-width: 38px; text-align: center;">
                <div style="font-size: 18px; font-weight: 800; color: var(--lilac-600); line-height: 1;">${parseInt(item.tanggal.split('-')[2])}</div>
                <div style="font-size: 10px; font-weight: 600; color: var(--gray-400); text-transform: uppercase;">${['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'][parseInt(item.tanggal.split('-')[1])-1]}</div>
            </div>
            <div style="flex: 1; min-width: 0;">
                <div style="font-size: 12.5px; font-weight: 600; color: var(--gray-700); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item.nama_kegiatan}</div>
                <div style="font-size: 11.5px; color: var(--gray-400); margin-top: 2px;">🕐 ${item.jam} • ${item.nama_tempat}</div>
            </div>
        </div>
    `).join('');
}

// ============================================================
// CHARTS
// ============================================================
function getChartData() {
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const counts = Array(12).fill(0);
    const selesaiCounts = Array(12).fill(0);

    jadwalData.forEach(item => {
        const m = parseInt(item.tanggal.split('-')[1]) - 1;
        counts[m]++;
        if (item.status === 'selesai') selesaiCounts[m]++;
    });

    return { labels: months, counts, selesaiCounts };
}

function initMiniChart() {
    const ctx = document.getElementById('miniChart');
    if (!ctx) return;
    const { labels, counts } = getChartData();

    if (miniChartInstance) miniChartInstance.destroy();
    miniChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Kegiatan',
                data: counts,
                backgroundColor: 'rgba(168, 85, 247, 0.25)',
                borderColor: 'rgba(168, 85, 247, 0.8)',
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { family: 'Poppins', size: 10 }, color: '#9ca3af' } },
                y: { grid: { color: '#f3f4f6' }, ticks: { font: { family: 'Poppins', size: 10 }, color: '#9ca3af', stepSize: 1 }, beginAtZero: true },
            }
        }
    });
}

function initMainChart() {
    const ctx = document.getElementById('mainChart');
    if (!ctx) return;
    const { labels, counts, selesaiCounts } = getChartData();

    if (mainChartInstance) mainChartInstance.destroy();
    mainChartInstance = new Chart(ctx, {
        type: currentChartType,
        data: {
            labels,
            datasets: [
                {
                    label: 'Total Kegiatan',
                    data: counts,
                    backgroundColor: currentChartType === 'bar' ? 'rgba(168, 85, 247, 0.2)' : 'transparent',
                    borderColor: 'rgba(168, 85, 247, 0.9)',
                    borderWidth: 2.5,
                    borderRadius: currentChartType === 'bar' ? 8 : 0,
                    borderSkipped: false,
                    fill: currentChartType === 'line',
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(168, 85, 247, 1)',
                    pointRadius: 5,
                },
                {
                    label: 'Selesai',
                    data: selesaiCounts,
                    backgroundColor: currentChartType === 'bar' ? 'rgba(16, 185, 129, 0.2)' : 'transparent',
                    borderColor: 'rgba(16, 185, 129, 0.9)',
                    borderWidth: 2.5,
                    borderRadius: currentChartType === 'bar' ? 8 : 0,
                    borderSkipped: false,
                    fill: false,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                    pointRadius: 5,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { labels: { font: { family: 'Poppins', size: 12 }, color: '#374151' } },
                tooltip: {
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1f2937',
                    bodyColor: '#6b7280',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 12,
                    titleFont: { family: 'Poppins', weight: '600' },
                    bodyFont: { family: 'Poppins' },
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Poppins', size: 12 }, color: '#9ca3af' }
                },
                y: {
                    grid: { color: '#f3f4f6', drawBorder: false },
                    ticks: { font: { family: 'Poppins', size: 11 }, color: '#9ca3af', stepSize: 1 },
                    beginAtZero: true
                }
            }
        }
    });
}

function switchChart(type) {
    currentChartType = type;
    const btnBar = document.getElementById('btnBar');
    const btnLine = document.getElementById('btnLine');
    if (type === 'bar') {
        btnBar.style.background = 'var(--lilac-100)';
        btnBar.style.color = 'var(--lilac-700)';
        btnBar.style.border = '1.5px solid var(--lilac-200)';
        btnLine.style.background = 'var(--gray-100)';
        btnLine.style.color = 'var(--gray-600)';
        btnLine.style.border = '1px solid var(--gray-200)';
    } else {
        btnLine.style.background = 'var(--lilac-100)';
        btnLine.style.color = 'var(--lilac-700)';
        btnLine.style.border = '1.5px solid var(--lilac-200)';
        btnBar.style.background = 'var(--gray-100)';
        btnBar.style.color = 'var(--gray-600)';
        btnBar.style.border = '1px solid var(--gray-200)';
    }
    initMainChart();
}

function updateChart() {
    initMainChart();
}

function resetFilter2() {
    const bulan = document.getElementById('filterBulan');
    const tahun = document.getElementById('filterTahun');
    if (bulan) bulan.value = '0';
    if (tahun) tahun.value = '2026';
    updateChart();
}



// ============================================================
// USER MANAGEMENT LOGIC
// ============================================================
function renderUserTables() {
    renderUserTable('marketing');
    renderUserTable('admin');
}

function renderUserTable(role) {
    const data = role === 'marketing' ? marketingData : adminData;
    const tbody = document.getElementById(role + 'TableBody');
    if (!tbody) return;

    if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" style="text-align: center; padding: 20px; color: var(--gray-400);">Tidak ada data user</td></tr>`;
        return;
    }

    const fixedPwd = role === 'admin' ? 'adminibik123' : 'marketingibik123';

    tbody.innerHTML = data.map((user, idx) => `
        <tr>
            <td style="font-weight: 600; color: var(--gray-400);">${idx + 1}</td>
            <td style="font-weight: 600; color: var(--gray-700);">${user.name}</td>
            <td>
                <span style="background: var(--gray-100); color: var(--gray-600); padding: 4px 10px; border-radius: 6px; font-family: monospace; font-size: 12px;">
                    ${fixedPwd}
                </span>
            </td>
            <td>
                <div class="action-btns" style="justify-content: center;">
                    <button class="btn btn-sm" onclick="editUser('${role}', ${idx})" style="background: var(--lilac-50); color: var(--lilac-700); border: 1.5px solid var(--lilac-200);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                        </svg>
                    </button>
                    <button class="btn btn-sm" onclick="deleteUser('${role}', ${idx})" style="background: #fee2e2; color: #dc2626; border: 1.5px solid #fecaca;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 13px; height: 13px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

function openUserModal(role) {
    const isEditing = false;
    document.getElementById('modalUserTitle').textContent = role === 'admin' ? '➕ Tambah Petugas' : '➕ Tambah Marketing';
    document.getElementById('btnUserSimpanText').textContent = 'Simpan';
    document.getElementById('userId').value = '';
    document.getElementById('userRole').value = role;
    document.getElementById('inputUsername').value = '';
    document.getElementById('inputUserPassword').value = role === 'admin' ? 'adminibik123' : 'marketingibik123';
    openModal('modalUser');
}

function editUser(role, index) {
    const data = role === 'marketing' ? marketingData : adminData;
    const user = data[index];
    document.getElementById('modalUserTitle').textContent = role === 'admin' ? '✏️ Edit Petugas' : '✏️ Edit Marketing';
    document.getElementById('btnUserSimpanText').textContent = 'Update';
    document.getElementById('userId').value = user.id;
    document.getElementById('userRole').value = role;
    document.getElementById('inputUsername').value = user.name;
    document.getElementById('inputUserPassword').value = role === 'admin' ? 'adminibik123' : 'marketingibik123';
    openModal('modalUser');
}

async function submitUser(e) {
    if (e && e.preventDefault) e.preventDefault();
    const id = document.getElementById('userId').value;
    const role = document.getElementById('userRole').value;
    const username = document.getElementById('inputUsername').value.trim();
    
    if (!username) {
        showToast('Username harus diisi!', 'error');
        return;
    }

    const payload = { username, role };
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const isEdit = id !== '';
    const url = isEdit ? `/admin/users/${id}` : '/admin/users';
    const method = isEdit ? 'PUT' : 'POST';

    const btn = document.getElementById('btnUserSimpanText').parentElement;
    const btnText = document.getElementById('btnUserSimpanText');
    const originalText = btnText.textContent;

    try {
        btn.disabled = true;
        btnText.textContent = 'Memproses...';

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (response.ok && result.success) {
            if (isEdit) {
                const data = role === 'marketing' ? marketingData : adminData;
                const idx = data.findIndex(u => u.id == id);
                if (idx !== -1) data[idx] = result.data;
            } else {
                if (role === 'marketing') marketingData.unshift(result.data);
                else adminData.unshift(result.data);
            }
            closeModal('modalUser');
            renderUserTable(role);
            showToast(result.message, 'success');
        } else {
            const msg = (response.status === 419 || result.message === 'CSRF token mismatch.') 
                ? 'Sesi kadaluwarsa, silakan REFRESH halaman ini (F5)!' 
                : (result.message || 'Terjadi kesalahan!');
            showToast(msg, 'error');
        }
    } catch (error) {
        showToast('Koneksi bermasalah!', 'error');
        console.error(error);
    } finally {
        btn.disabled = false;
        btnText.textContent = originalText;
    }
}

function deleteUser(role, index) {
    const data = role === 'marketing' ? marketingData : adminData;
    const user = data[index];
    hapusUserObj = { id: user.id, role, index };
    document.getElementById('hapusUsernameLabel').textContent = user.name;
    openModal('modalHapusUser');
}

async function confirmHapusUser() {
    if (!hapusUserObj) return;
    const { id, role, index } = hapusUserObj;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const response = await fetch(`/admin/users/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const result = await response.json();

        if (response.ok && result.success) {
            const data = role === 'marketing' ? marketingData : adminData;
            data.splice(index, 1);
            renderUserTable(role);
            closeModal('modalHapusUser');
            showToast(result.message, 'success');
        } else {
            showToast(result.message || 'Gagal menghapus user!', 'error');
        }
    } catch (error) {
        showToast('Koneksi bermasalah!', 'error');
    }
}

</script>
@endpush
