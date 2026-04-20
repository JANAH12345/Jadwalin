<?php $__env->startSection('title', 'Marketing Dashboard - Jadwalin'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.75);
        --glass-border: rgba(255, 255, 255, 0.4);
        --lilac-glow: 0 8px 32px 0 rgba(168, 85, 247, 0.15);
    }

    body {
        background: linear-gradient(135deg, #f8f7ff 0%, #f1edff 100%);
        min-height: 100vh;
    }

    .marketing-portal {
        padding: 1.5rem 1rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Header & Welcome */
    .portal-header {
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        flex-wrap: wrap;
    }

    .welcome-text h1 {
        font-size: 2.2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--lilac-700), var(--lilac-500));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.4rem;
    }

    .welcome-text p {
        color: var(--gray-500);
        font-size: 1.1rem;
    }

    .current-date {
        background: var(--white);
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--lilac-700);
        font-weight: 600;
        font-size: 0.95rem;
        border: 1px solid var(--lilac-100);
    }

    /* Dashboard Stats */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: var(--lilac-glow);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: transform 0.3s ease;
    }

    .stat-card:hover { transform: translateY(-5px); }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon.purple { background: var(--lilac-100); color: var(--lilac-600); }
    .stat-icon.blue { background: #e0f2fe; color: #0369a1; }
    .stat-icon.green { background: #dcfce7; color: #15803d; }

    .stat-icon svg { width: 26px; height: 26px; }

    .stat-info .label { font-size: 0.85rem; color: var(--gray-500); font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-info .value { font-size: 1.8rem; font-weight: 800; color: var(--gray-800); }

    /* Main Grid: Calendar + Sidebar */
    .portal-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 20px;
    }

    /* Calendar Styling */
    .calendar-container {
        background: var(--white);
        border-radius: 24px;
        padding: 1.25rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-100);
    }

    .calendar-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .nav-btn {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--gray-50);
        border: 1px solid var(--gray-100);
        color: var(--gray-600);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .nav-btn:hover { background: var(--lilac-50); color: var(--lilac-600); border-color: var(--lilac-100); }

    .month-title { font-size: 1.5rem; font-weight: 800; color: var(--gray-800); }

    .grid-header {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        margin-bottom: 10px;
    }

    .day-name { text-align: center; font-size: 0.85rem; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: 1px; }

    .days-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
    }

    .day-cell {
        aspect-ratio: 1;
        border-radius: 12px;
        border: 1px solid var(--gray-50);
        background: var(--gray-50);
        padding: 0.4rem;
        position: relative;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .day-cell:hover:not(.empty) { transform: scale(1.05); box-shadow: 0 10px 15px -3px rgba(168, 85, 247, 0.1); border-color: var(--lilac-200); background: white; }

    .day-number { font-size: 0.95rem; font-weight: 700; color: var(--gray-700); }
    .day-cell.today .day-number { color: var(--lilac-600); position: relative; }
    .day-cell.today .day-number::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 12px; height: 3px; background: var(--lilac-500); border-radius: 2px; }

    /* Event Indicators - Made more "thick"/saturated as requested */
    .day-cell.has-ada-jadwal { background: #dbeafe; border-color: #60a5fa; border-width: 1.5px; }
    .day-cell.has-hari-ini { background: #fef9c3; border-color: #facc15; border-width: 1.5px; }
    .day-cell.has-selesai { background: #dcfce7; border-color: #4ade80; border-width: 1.5px; }
    .day-cell.has-batal { background: #fee2e2; border-color: #f87171; border-width: 1.5px; }

    .calendar-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
        padding-top: 12px;
        border-top: 1px dashed var(--gray-200);
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--gray-600);
    }
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 3px;
        flex-shrink: 0;
    }

    /* Upcoming Activities Sidebar */
    .sidebar-section {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .sidebar-card {
        background: var(--white);
        border-radius: 22px;
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
    }

    .sidebar-title { font-size: 1.1rem; font-weight: 700; color: var(--gray-800); margin-bottom: 1.2rem; display: flex; align-items: center; gap: 8px; }
    .sidebar-title svg { width: 18px; height: 18px; color: var(--lilac-500); }

    .upcoming-list { display: flex; flex-direction: column; gap: 14px; }
    
    .upcoming-item {
        padding: 12px;
        border-radius: 14px;
        border: 1px solid var(--gray-50);
        background: var(--gray-50);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .upcoming-item:hover { border-color: var(--lilac-200); background: var(--lilac-50); }

    .up-date { font-size: 0.75rem; font-weight: 700; color: var(--lilac-600); text-transform: uppercase; margin-bottom: 4px; }
    .up-title { font-size: 0.9rem; font-weight: 600; color: var(--gray-800); margin-bottom: 2px; line-height: 1.3; }
    .up-place { font-size: 0.8rem; color: var(--gray-500); display: flex; align-items: center; gap: 4px; }

    /* Modal Styling */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(14, 1, 31, 0.4);
        backdrop-filter: blur(8px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-box {
        background: white;
        width: 100%;
        max-width: 500px;
        border-radius: 28px;
        box-shadow: 0 30px 60px -12px rgba(0,0,0,0.3);
        overflow: hidden;
        animation: modalIn 0.3s ease-out;
    }

    @keyframes modalIn { from { transform: scale(0.9) translateY(30px); opacity: 0; } to { transform: scale(1) translateY(0); opacity: 1; } }

    .modal-header { padding: 24px 28px; border-bottom: 1px solid var(--gray-100); display: flex; justify-content: space-between; align-items: center; }
    .modal-title { font-weight: 800; font-size: 1.3rem; color: var(--gray-800); }
    .close-modal { background: var(--gray-50); border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; color: var(--gray-400); }

    .modal-body { padding: 28px; max-height: 65vh; overflow-y: auto; }

    .event-detail-card {
        padding: 20px;
        background: #fdfcff;
        border-radius: 18px;
        border: 1px solid var(--lilac-100);
        margin-bottom: 16px;
    }
    
    .status-pill {
        display: inline-flex;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    .status-ada-jadwal { background: #dbeafe; color: #1e40af; }
    .status-hari-ini { background: #fef9c3; color: #854d0e; }
    .status-selesai { background: #dcfce7; color: #166534; }
    .status-batal { background: #fee2e2; color: #991b1b; }

    @media (max-width: 1024px) {
        .portal-grid { grid-template-columns: 1fr; }
        .stats-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
        .welcome-text h1 { font-size: 1.8rem; }
        .marketing-portal { padding: 1.5rem 1rem; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="marketing-portal">
    <!-- Header -->
    <header class="portal-header">
        <div class="welcome-text">
            <h1>Halo, <?php echo e(explode(' ', Auth::user()->name)[0]); ?>!</h1>
            <p>Selamat datang di Kelola Jadwal Marketing.</p>
        </div>
        <div class="current-date">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            <span id="headerDate"></span>
        </div>
    </header>



    <!-- Main Content Grid -->
    <div class="portal-grid">
        <!-- Calendar Section -->
        <section class="calendar-container">
            <div class="calendar-nav">
                <button class="nav-btn" onclick="changeMonth(-1)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="18">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <div class="month-title" id="monthDisplay"></div>
                <button class="nav-btn" onclick="changeMonth(1)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="18">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            <div class="grid-header">
                <div class="day-name">Ming</div>
                <div class="day-name">Sen</div>
                <div class="day-name">Sel</div>
                <div class="day-name">Rab</div>
                <div class="day-name">Kam</div>
                <div class="day-name">Jum</div>
                <div class="day-name">Sab</div>
            </div>
            <div class="days-grid" id="calendarGrid"></div>

            <div class="calendar-legend">
                <div class="legend-item">
                    <div class="legend-color" style="background: #dbeafe; border: 1px solid #60a5fa;"></div>
                    <span>Ada Jadwal</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #fef9c3; border: 1px solid #facc15;"></div>
                    <span>Hari Ini</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #dcfce7; border: 1px solid #4ade80;"></div>
                    <span>Selesai</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: #fee2e2; border: 1px solid #f87171;"></div>
                    <span>Batal</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: transparent; border: none; display: flex; flex-direction: column; align-items: center; justify-content: flex-end; padding-bottom: 2px;">
                        <div style="width: 12px; height: 3px; background: var(--lilac-500); border-radius: 2px;"></div>
                    </div>
                    <span>Hari Ini (Kalender)</span>
                </div>
            </div>
        </section>

        <!-- Sidebar Section -->
        <aside class="sidebar-section">
            <div class="sidebar-card">
                <div class="sidebar-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>
                    Kegiatan Mendatang
                </div>
                <div class="upcoming-list">
                    <?php $__empty_1 = true; $__currentLoopData = $stats['mendatang']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $up): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="upcoming-item">
                            <div class="up-date"><?php echo e(date('d M Y', strtotime($up->tanggal))); ?></div>
                            <div class="up-title"><?php echo e($up->nama_kegiatan); ?></div>
                            <div class="up-place">📍 <?php echo e($up->nama_tempat); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div style="text-align: center; color: var(--gray-400); padding: 10px; font-size: 0.9rem;">
                            Tidak ada jadwal terdekat.
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </aside>
    </div>
</div>

<!-- Modal -->
<div class="modal-overlay" id="eventModal">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title" id="modalDateTitle">Detail Jadwal</div>
            <button class="close-modal" onclick="hideModal()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body" id="modalBody"></div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const jadwals = <?php echo json_encode($jadwals, 15, 512) ?>;
    let currentDate = new Date();
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    function formatDate(date) {
        return date.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    }

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        document.getElementById('monthDisplay').textContent = `${monthNames[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const grid = document.getElementById('calendarGrid');
        grid.innerHTML = '';

        const today = new Date();
        const isCurrentMonth = today.getFullYear() === year && today.getMonth() === month;

        for(let i = 0; i < firstDay; i++) {
            const div = document.createElement('div');
            div.className = 'day-cell empty';
            grid.appendChild(div);
        }

        for(let i = 1; i <= daysInMonth; i++) {
            const div = document.createElement('div');
            div.className = 'day-cell';
            if (isCurrentMonth && today.getDate() === i) div.classList.add('today');

            const mStr = String(month + 1).padStart(2, '0');
            const dStr = String(i).padStart(2, '0');
            const targetDate = `${year}-${mStr}-${dStr}`;
            
            const dayEvents = jadwals.filter(j => j.tanggal === targetDate);
            
            if (dayEvents.length > 0) {
                const statuses = dayEvents.map(e => e.status);
                if (statuses.includes('hari ini')) div.classList.add('has-hari-ini');
                else if (statuses.includes('batal')) div.classList.add('has-batal');
                else if (statuses.includes('selesai')) div.classList.add('has-selesai');
                else if (statuses.includes('ada jadwal')) div.classList.add('has-ada-jadwal');
                
                div.onclick = () => showModal(dayEvents, `${i} ${monthNames[month]} ${year}`);
            }

            div.innerHTML += `<div class="day-number">${i}</div>`;
            grid.appendChild(div);
        }
    }

    function showModal(events, label) {
        const body = document.getElementById('modalBody');
        document.getElementById('modalDateTitle').textContent = `📅 ${label}`;
        body.innerHTML = events.map(ev => `
            <div class="event-detail-card">
                <span class="status-pill status-${ev.status.replace(' ', '-')}">${ev.status}</span>
                <h3 style="font-weight:800; color:var(--gray-800); margin-bottom:8px;">${ev.nama_kegiatan}</h3>
                <div style="display:flex; flex-direction:column; gap:6px; color:var(--gray-500); font-size:0.9rem;">
                    <div style="display:flex; align-items:center; gap:8px;">📍 ${ev.nama_tempat}</div>
                    <div style="display:flex; align-items:center; gap:8px;">🕒 ${ev.jam.substring(0,5)} WIB</div>
                </div>
                ${ev.keterangan ? `<div style="margin-top:15px; padding-top:15px; border-top:1px dashed #eee; font-size:0.85rem; color:var(--gray-600); line-height:1.5;">${ev.keterangan}</div>` : ''}
            </div>
        `).join('');
        document.getElementById('eventModal').style.display = 'flex';
    }

    function hideModal() { document.getElementById('eventModal').style.display = 'none'; }
    function changeMonth(step) { currentDate.setMonth(currentDate.getMonth() + step); renderCalendar(); }

    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('headerDate').textContent = formatDate(new Date());
        renderCalendar();
        window.onclick = (e) => { if(e.target == document.getElementById('eventModal')) hideModal(); };
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp 8.2\htdocs\skema_aplikasi\resources\views/user/kalender.blade.php ENDPATH**/ ?>