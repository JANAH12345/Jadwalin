@extends('layouts.user')

@section('title', 'Beranda - Jadwalin')

@push('styles')
<style>
    /* ── Hero ── */
    .hero {
        position: relative;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 70px);
        text-align: center;
        scroll-margin-top: 80px;
        overflow: hidden;
    }

    .hero-slider {
        position: absolute;
        inset: 0;
        z-index: -2;
    }

    .hero-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .hero-slide.active {
        opacity: 1;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.82);
        z-index: -1;
    }

    /* Memastikan konten hero berada di atas background */
    .hero-badge, .hero-title, .hero-subtitle, .hero-actions {
        position: relative;
        z-index: 10;
    }

    .hero-badge {
        background: var(--lilac-200);
        color: var(--lilac-700);
        padding: 0.4rem 1.1rem;
        border-radius: 9999px;
        font-size: 0.82rem;
        font-weight: 600;
        margin-bottom: 1.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        letter-spacing: 0.3px;
    }

    .hero-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--lilac-500);
        display: inline-block;
    }

    .hero-title {
        font-size: 3.6rem;
        font-weight: 800;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        line-height: 1.15;
        letter-spacing: -1px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-title span {
        color: var(--lilac-600);
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: var(--gray-600);
        margin: 0 auto 2.5rem;
        line-height: 1.75;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 3.5rem;
    }

    /* Stats bar */
    .hero-stats {
        display: flex;
        gap: 2.5rem;
        flex-wrap: wrap;
        justify-content: center;
        padding-top: 2rem;
        border-top: 1px solid var(--gray-200);
        width: 100%;
        max-width: 560px;
    }

    .hero-stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .hero-stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--lilac-600);
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .hero-stat-label {
        font-size: 0.82rem;
        color: var(--gray-500);
        font-weight: 500;
    }

    /* ── Section Global ── */
    .section {
        padding: 5rem 2rem;
        scroll-margin-top: 80px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.75rem;
        letter-spacing: -0.5px;
    }

    .section-subtitle {
        font-size: 1.05rem;
        color: var(--gray-500);
        max-width: 560px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ── About Cards ── */
    #tentang {
        background: var(--white);
    }

    .about-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .about-card {
        background: var(--gray-50);
        padding: 2.25rem;
        border-radius: 1.25rem;
        border: 1px solid var(--gray-200);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--lilac-300);
    }

    .about-icon {
        width: 56px;
        height: 56px;
        background: var(--lilac-100);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: var(--lilac-600);
    }

    .about-icon svg { width: 28px; height: 28px; }

    .about-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.85rem;
        color: var(--gray-800);
    }

    .about-card p {
        color: var(--gray-600);
        line-height: 1.75;
        font-size: 1.05rem;
    }

    /* ── Before/After Section ── */
    .compare-section {
        background: linear-gradient(135deg, var(--lilac-50) 0%, var(--white) 100%);
        padding: 5rem 2rem;
    }

    .compare-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
    }

    .compare-card {
        background: var(--white);
        border-radius: 1.25rem;
        padding: 2rem;
        border-left: 4px solid #e2e8f0;
        box-shadow: var(--shadow-sm);
    }

    .compare-card.bad { border-left-color: #f87171; }
    .compare-card.good { background: var(--lilac-600); border-left-color: var(--lilac-700); }

    .compare-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.6rem;
    }

    .compare-card.good h4 { color: var(--white); }

    .compare-card p {
        font-size: 0.92rem;
        color: var(--gray-600);
        line-height: 1.65;
    }

    .compare-card.good p { color: rgba(255,255,255,0.88); }

    /* ── Kontak ── */
    #kontak {
        background: var(--lilac-50);
        border-top: 1px solid var(--gray-200);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2.5rem;
        margin-top: 2rem;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    .contact-item {
        background: var(--white);
        padding: 2.5rem 2rem;
        border-radius: 1.5rem;
        text-align: center;
        border: 1px solid var(--gray-200);
        transition: all 0.3s ease;
        text-decoration: none;
        display: block;
        box-shadow: var(--shadow-sm);
    }

    .contact-item:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--lilac-400);
    }

    .contact-item-icon {
        width: 56px;
        height: 56px;
        background: var(--lilac-50);
        color: var(--lilac-600);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .contact-item-icon svg { width: 28px; height: 28px; }

    .contact-item-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--lilac-600);
        text-transform: uppercase;
        margin-bottom: 0.75rem;
        letter-spacing: 1.5px;
    }

    .contact-item-value {
        font-size: 1.1rem;
        color: var(--gray-800);
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .contact-grid { grid-template-columns: 1fr; gap: 1.5rem; }
        .hero {
            padding: 4rem 1.5rem 3rem;
            align-items: center;
            text-align: center;
        }
        .hero-title { font-size: 2.4rem; letter-spacing: -0.5px; }
        .hero-subtitle { margin-left: auto; margin-right: auto; }
        .hero-stats { justify-content: center; }
        .section { padding: 3rem 1.5rem; }
        .hero-actions { justify-content: center; }
    }
</style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <!-- Background Slider -->
        <div class="hero-slider">
            <div class="hero-slide active" style="background-image: url('{{ asset("images/ruang marketing.jpeg") }}');"></div>
            <div class="hero-slide" style="background-image: url('{{ asset("images/market.jpeg") }}');"></div>
        </div>
        <div class="hero-overlay"></div>

        <h1 class="hero-title">
            Jadwal Promosi Lebih<br>
            <span>Teratur dan Transparan</span>
        </h1>

        <p class="hero-subtitle">
            Atur dan pantau jadwal promosi dalam satu sistem terpusat.
        </p>

        <div class="hero-actions">
            <a href="#tentang" class="btn btn-primary" style="padding: 0.85rem 2.2rem; font-size: 1rem; display: inline-flex; align-items: center; gap: 0.5rem;">
                Pelajari Lebih Lanjut
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </a>
            <a href="{{ route('user.jadwal') }}" class="btn btn-outline" style="padding: 0.85rem 2.2rem; font-size: 1rem;">Lihat Jadwal</a>
        </div>


    </section>

    <!-- Tentang Section -->
    <section class="section" id="tentang" style="padding-top: 2.5rem;">
        <div class="section-header">
            <h2 class="section-title">Tentang Jadwalin</h2>
        </div>

        <div class="about-grid">
            <div class="about-card">
                <div class="about-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </div>
                <h3>Manajemen Agenda Terpadu</h3>
                <p>Susun dan kelola seluruh jadwal kunjungan promosi sekolah secara terpusat. Detail waktu, lokasi, dan penanggung jawab terdokumentasi dengan rapi demi efisiensi tim.</p>
            </div>

            <div class="about-card">
                <div class="about-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
                <h3>Kolaborasi Tim Real-Time</h3>
                <p>Akses informasi jadwal secara transparan bagi seluruh anggota tim marketing. Sinkronisasi data memastikan setiap personel mendapatkan update terbaru secara instan.</p>
            </div>

            <div class="about-card">
                <div class="about-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </div>
                <h3>Monitoring Status Akurat</h3>
                <p>Pantau progres setiap kegiatan mulai dari perencanaan hingga selesai. Sistem pelaporan status yang terintegrasi memudahkan evaluasi dan tindak lanjut program promosi.</p>
            </div>
        </div>
    </section>



    <!-- Kontak Section -->
    <section class="section" id="kontak">
        <div class="section-header">
            <h2 class="section-title">Informasi Kontak</h2>
        </div>

        <div class="contact-grid">
            <!-- Email -->
            <a href="mailto:info@ibik.ac.id" class="contact-item">
                <div class="contact-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </div>
                <div class="contact-item-label">Email</div>
                <div class="contact-item-value">info@ibik.ac.id</div>
            </a>

            <!-- Telepon -->
            <a href="tel:+622518337733" class="contact-item">
                <div class="contact-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25z" />
                    </svg>
                </div>
                <div class="contact-item-label">Telepon</div>
                <div class="contact-item-value">+62 251 8337733</div>
            </a>

            <!-- Whatsapp -->
            <a href="https://wa.me/6285179750489" target="_blank" class="contact-item">
                <div class="contact-item-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785c-.442.496.103 1.228.713.97a7.211 7.211 0 0 0 1.944-1.218 1.411 1.411 0 0 1 1.134-.343c.96.14 1.957.212 2.973.212z" />
                    </svg>
                </div>
                <div class="contact-item-label">WhatsApp</div>
                <div class="contact-item-value">+62 851 7975 0489</div>
            </a>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        function nextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        // Jalankan transisi setiap 3 detik
        setInterval(nextSlide, 3000);
    });
</script>
@endpush
