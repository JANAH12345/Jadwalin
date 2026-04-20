<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Jadwalin - <?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --lilac-50: #f5f3ff;
            --lilac-100: #ede9fe;
            --lilac-200: #ddd6fe;
            --lilac-300: #c4b5fd;
            --lilac-400: #a78bfa;
            --lilac-500: #6d28d9; /* Deep Purple */
            --lilac-600: #5b21b6;
            --lilac-700: #4c1d95;
            --lilac-800: #2e1065;
            --lilac-primary: #b57bee;
            --lilac-soft: #ede9fe;
            --lilac-sidebar: #4c1d95; /* Deep Purple Sidebar */
            --lilac-sidebar-dark: #2e1065;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.08), 0 2px 4px -1px rgba(0,0,0,0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -2px rgba(0,0,0,0.04);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.08), 0 10px 10px -5px rgba(0,0,0,0.03);
            --sidebar-width: 280px;
            --navbar-height: 68px;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-50);
            color: var(--gray-700);
            min-height: 100vh;
        }

        /* ===========================
           SIDEBAR
        =========================== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(160deg, var(--lilac-700) 0%, var(--lilac-600) 50%, var(--lilac-500) 100%);
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(76, 29, 149, 0.3);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            pointer-events: none;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .sidebar-brand-icon {
            width: 42px;
            height: 42px;
            background: rgba(255,255,255,0.2);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.25);
            flex-shrink: 0;
        }

        .sidebar-brand-icon svg {
            width: 22px;
            height: 22px;
            color: white;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand-title {
            font-size: 16px;
            font-weight: 800;
            color: white;
            letter-spacing: 0.8px;
            line-height: 1.2;
            white-space: nowrap;
        }

        .sidebar-brand-sub {
            font-size: 10px;
            color: rgba(255,255,255,0.65);
            font-weight: 400;
            letter-spacing: 0.5px;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 14px;
            overflow-y: auto;
            position: relative;
            z-index: 1;
        }

        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 4px; }

        .nav-section-label {
            font-size: 9.5px;
            font-weight: 700;
            color: rgba(255,255,255,0.85);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0 10px;
            margin: 18px 0 8px;
        }

        .nav-section-label:first-child { margin-top: 0; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: var(--radius-md);
            text-decoration: none;
            color: rgba(255,255,255,0.95);
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.25s ease;
            margin-bottom: 3px;
            cursor: pointer;
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 0;
            background: rgba(255,255,255,0.15);
            border-radius: var(--radius-md);
            transition: width 0.25s ease;
        }

        .nav-item:hover {
            color: white;
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.15);
            transform: translateX(3px);
        }

        .nav-item:hover::before { width: 3px; }

        .nav-item.active {
            background: rgba(255,255,255,0.2);
            color: white;
            font-weight: 600;
            border-color: rgba(255,255,255,0.25);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .nav-item.active::before { width: 3px; background: white; }

        .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            transition: transform 0.25s ease;
        }

        .nav-item:hover svg { transform: scale(1.1); }

        .nav-item.logout-item {
            color: rgba(252, 165, 165, 0.85);
            margin-top: 8px;
        }

        .nav-item.logout-item:hover {
            background: rgba(239, 68, 68, 0.18);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.2);
        }

        .sidebar-footer {
            padding: 16px 14px;
            border-top: 1px solid rgba(255,255,255,0.1);
            position: relative;
            z-index: 1;
        }

        .sidebar-user-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: rgba(255,255,255,0.1);
            border-radius: var(--radius-md);
            border: 1px solid rgba(255,255,255,0.12);
        }

        .sidebar-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .sidebar-user-info { flex: 1; min-width: 0; }

        .sidebar-user-name {
            font-size: 12px;
            font-weight: 600;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            font-size: 10px;
            color: rgba(255,255,255,0.55);
        }

        /* ===========================
           MAIN LAYOUT
        =========================== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===========================
           NAVBAR
        =========================== */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 90;
            height: var(--navbar-height);
            background: var(--white);
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            box-shadow: var(--shadow-sm);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar-page-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--gray-800);
        }

        .navbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--gray-400);
        }

        .navbar-breadcrumb span:last-child { color: var(--lilac-600); font-weight: 500; }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar-date {
            font-size: 12.5px;
            color: var(--gray-400);
            font-weight: 400;
        }

        .navbar-notification {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-md);
            background: var(--lilac-50);
            border: 1px solid var(--lilac-100);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .navbar-notification:hover {
            background: var(--lilac-100);
            border-color: var(--lilac-200);
        }

        .navbar-notification svg { width: 18px; height: 18px; color: var(--lilac-600); }

        .notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 16px;
            height: 16px;
            background: #ef4444;
            border-radius: 50%;
            font-size: 9px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .navbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 6px 12px 6px 6px;
            border-radius: var(--radius-xl);
            border: 1px solid var(--gray-100);
            transition: all 0.2s ease;
            background: var(--white);
        }

        .navbar-profile:hover {
            background: var(--lilac-50);
            border-color: var(--lilac-200);
        }

        .profile-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--lilac-400), var(--lilac-600));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            box-shadow: 0 2px 8px rgba(168, 85, 247, 0.35);
        }

        .profile-info { display: flex; flex-direction: column; }

        .profile-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            line-height: 1.2;
        }

        .profile-role {
            font-size: 10.5px;
            color: var(--gray-400);
            font-weight: 400;
        }

        /* ===========================
           CONTENT
        =========================== */
        .main-content {
            flex: 1;
            padding: 28px;
        }

        /* Section visibility */
        .content-section { display: none; }
        .content-section.active { display: block; animation: fadeInUp 0.35s ease; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Page Header */
        .page-header {
            margin-bottom: 24px;
        }

        .page-header-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-800);
            line-height: 1.2;
        }

        .page-header-sub {
            font-size: 13.5px;
            color: var(--gray-400);
            margin-top: 4px;
        }

        /* ===========================
           STAT CARDS
        =========================== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            padding: 22px 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-100);
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: all 0.3s ease;
            cursor: default;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius-xl) var(--radius-xl) 0 0;
        }

        .stat-card:nth-child(1)::before { background: linear-gradient(90deg, #a855f7, #c084fc); }
        .stat-card:nth-child(2)::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .stat-card:nth-child(3)::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card:nth-child(4)::before { background: linear-gradient(90deg, #ef4444, #f87171); }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
            border-color: var(--lilac-100);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg { width: 22px; height: 22px; }

        .stat-icon.purple { background: linear-gradient(135deg, #ede9fe, #ddd6fe); color: var(--lilac-600); }
        .stat-icon.blue { background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #2563eb; }
        .stat-icon.green { background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #059669; }
        .stat-icon.red { background: linear-gradient(135deg, #fee2e2, #fecaca); color: #dc2626; }

        .stat-info { flex: 1; }

        .stat-label {
            font-size: 12px;
            color: var(--gray-400);
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--gray-800);
            line-height: 1.1;
            margin: 3px 0;
        }

        .stat-change {
            font-size: 11px;
            color: #10b981;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .stat-change svg { width: 12px; height: 12px; }

        /* ===========================
           CARDS
        =========================== */
        .card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-100);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
        }

        .card-body { padding: 0 24px 24px; }

        /* ===========================
           BUTTONS
        =========================== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.25s ease;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
            white-space: nowrap;
        }

        .btn svg { width: 15px; height: 15px; }

        .btn-primary {
            background: linear-gradient(135deg, var(--lilac-500), var(--lilac-600));
            color: white;
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.35);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--lilac-600), var(--lilac-700));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(168, 85, 247, 0.45);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }

        .btn-secondary:hover {
            background: var(--gray-200);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* ===========================
           TABLE
        =========================== */
        .table-wrapper {
            overflow-x: auto;
            border-radius: var(--radius-lg);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: var(--lilac-50);
            color: var(--lilac-700);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 13px 16px;
            text-align: left;
            border-bottom: 1px solid var(--lilac-100);
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.2s ease;
        }

        tbody tr:last-child { border-bottom: none; }

        tbody tr:hover { background: var(--lilac-50); }

        tbody td {
            padding: 14px 16px;
            font-size: 13.5px;
            color: var(--gray-600);
            vertical-align: middle;
        }

        /* ===========================
           STATUS BADGES
        =========================== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-blue { background: #dbeafe; color: #1d4ed8; }
        .badge-yellow { background: #fef9c3; color: #854d0e; }
        .badge-green { background: #d1fae5; color: #065f46; }
        .badge-red { background: #fee2e2; color: #991b1b; }

        /* ===========================
           MODAL
        =========================== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 200;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.2s ease;
        }

        .modal-overlay.open { display: flex; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .modal {
            background: var(--white);
            border-radius: var(--radius-2xl);
            width: 100%;
            max-width: 520px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            padding: 22px 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--gray-800);
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            background: var(--gray-100);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-500);
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
        }

        .modal-close:hover { background: var(--gray-200); color: var(--gray-700); }
        .modal-close svg { width: 16px; height: 16px; }

        .modal-body { padding: 0 24px 24px; }

        /* ===========================
           FORM
        =========================== */
        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 13.5px;
            font-family: 'Poppins', sans-serif;
            color: var(--gray-700);
            background: var(--white);
            transition: all 0.2s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--lilac-400);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.12);
        }

        .form-control::placeholder { color: var(--gray-300); }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--gray-100);
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        /* ===========================
           CALENDAR
        =========================== */
        .calendar-wrapper {
            background: #fbf8ff; /* Lilac samar */
            border-radius: var(--radius-xl);
            box-shadow: 0 4px 20px -5px rgba(168, 85, 247, 0.08);
            border: 1px solid var(--lilac-100);
            overflow: hidden;
            max-width: 500px; /* Diperkecil lagi agar lebih compact */
            margin: 0 auto;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--gray-100);
        }

        .calendar-month-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--gray-800);
        }

        .calendar-nav-btn {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-md);
            background: var(--lilac-50);
            border: 1px solid var(--lilac-100);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--lilac-600);
            transition: all 0.2s ease;
            font-family: 'Poppins', sans-serif;
        }

        .calendar-nav-btn:hover {
            background: var(--lilac-100);
            border-color: var(--lilac-200);
        }

        .calendar-nav-btn svg { width: 16px; height: 16px; }

        .calendar-grid { padding: 16px; }

        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            margin-bottom: 8px;
        }

        .calendar-weekday {
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--lilac-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 4px;
        }

        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            min-width: 0;
            background: #f5f0ff; /* Tidak putih lagi */
            border: 1px solid rgba(168, 85, 247, 0.05);
        }

        .calendar-day:hover {
            background: var(--lilac-100);
            color: var(--lilac-700);
        }

        .calendar-day.other-month { color: var(--gray-300); }

        .calendar-day.today {
            background: var(--lilac-600);
            color: white;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.35);
        }

        .calendar-day.has-jadwal { background: #dbeafe; color: #1d4ed8; font-weight: 600; }
        .calendar-day.has-hari-ini { background: #fef9c3; color: #854d0e; font-weight: 600; }
        .calendar-day.has-selesai { background: #d1fae5; color: #065f46; font-weight: 600; }
        .calendar-day.has-batal { background: #fee2e2; color: #991b1b; font-weight: 600; }

        .calendar-day-dot {
            position: absolute;
            bottom: 3px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: currentColor;
        }

        .calendar-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 16px 20px;
            border-top: 1px solid var(--gray-100);
            background: var(--gray-50);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--gray-500);
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 3px;
        }

        /* ===========================
           DASHBOARD WIDGETS
        =========================== */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-top: 18px;
        }

        .welcome-banner {
            background: linear-gradient(135deg, var(--lilac-700) 0%, var(--lilac-600) 50%, var(--lilac-500) 100%);
            border-radius: var(--radius-2xl);
            padding: 28px 32px;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 100px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .welcome-title {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .welcome-sub {
            font-size: 13.5px;
            opacity: 0.8;
            margin-bottom: 20px;
        }

        .welcome-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.2);
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 12.5px;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .welcome-date svg { width: 14px; height: 14px; }

        /* Quick action */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 18px;
        }

        .quick-action-btn {
            padding: 16px 12px;
            border-radius: var(--radius-lg);
            background: var(--white);
            border: 1.5px solid var(--gray-100);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .quick-action-btn:hover {
            border-color: var(--lilac-200);
            background: var(--lilac-50);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .quick-action-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--lilac-100), var(--lilac-200));
        }

        .quick-action-icon svg { width: 18px; height: 18px; color: var(--lilac-600); }

        .quick-action-label {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--gray-600);
            text-align: center;
        }

        /* ===========================
           CHART
        =========================== */
        .chart-container {
            position: relative;
            height: 300px;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-select {
            padding: 8px 14px;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 12.5px;
            font-family: 'Poppins', sans-serif;
            color: var(--gray-600);
            background: var(--white);
            cursor: pointer;
            outline: none;
            transition: all 0.2s ease;
        }

        .filter-select:focus {
            border-color: var(--lilac-400);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
        }

        /* ===========================
           RESPONSIVE
        =========================== */
        @media (max-width: 1100px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            :root { --sidebar-width: 0px; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); --sidebar-width: 260px; }
            .main-wrapper { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr 1fr; }
            .quick-actions { grid-template-columns: 1fr 1fr; }
            .form-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 16px; }
        }

        /* ===========================
           SCROLLBAR
        =========================== */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--gray-100); border-radius: 4px; }
        ::-webkit-scrollbar-thumb { background: var(--lilac-300); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--lilac-400); }

        /* ===========================
           TOAST
        =========================== */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            padding: 14px 18px;
            border-radius: var(--radius-md);
            background: white;
            box-shadow: var(--shadow-xl);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-700);
            border-left: 4px solid var(--lilac-500);
            animation: slideInRight 0.3s ease;
            max-width: 320px;
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .toast svg { width: 18px; height: 18px; color: var(--lilac-500); flex-shrink: 0; }
        .toast.success { border-left-color: #10b981; }
        .toast.success svg { color: #10b981; }
        .toast.error { border-left-color: #ef4444; }
        .toast.error svg { color: #ef4444; }

        /* Action buttons */
        .action-btns { display: flex; gap: 6px; }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <img src="<?php echo e(asset('images/logo-ibik.png')); ?>" alt="Logo IBIK" style="width: 32px; height: 32px; object-fit: contain;">
        </div>
        <div class="sidebar-brand-text">
            <div class="sidebar-brand-title">ADMIN JADWALIN</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu Utama</div>

        <a class="nav-item active" data-section="dashboard" onclick="showSection('dashboard', this)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            Dashboard
        </a>

        <a class="nav-item" data-section="jadwal" onclick="showSection('jadwal', this)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            Kelola Jadwal
        </a>

        <a class="nav-item" data-section="kalender" onclick="showSection('kalender', this)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
            </svg>
            Kalender Marketing
        </a>


        <a class="nav-item" data-section="laporan" onclick="showSection('laporan', this)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
            </svg>
            Laporan
        </a>

        <a class="nav-item" data-section="marketing" onclick="showSection('marketing', this)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            Manajemen Marketing
        </a>

        <a class="nav-item" data-section="petugas" onclick="showSection('petugas', this)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
            Manajemen Petugas
        </a>


        <a class="nav-item logout-item" href="#" onclick="confirmLogout()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
            </svg>
            Logout
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user-mini">
            <div class="sidebar-user-avatar"><?php echo e(strtoupper(substr(Auth::check() ? Auth::user()->name : 'Admin', 0, 1))); ?></div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name"><?php echo e(explode(' ', Auth::check() ? Auth::user()->name : 'Admin')[0]); ?></div>
                <div class="sidebar-user-role">Super Admin</div>
            </div>
        </div>
    </div>
</aside>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Navbar -->
    <header class="navbar">
        <div class="navbar-left">
            <div>
                <div class="navbar-page-title" id="navbarPageTitle">Admin Dashboard</div>
            </div>
        </div>
        <div class="navbar-right">
            <div class="navbar-date" id="navbarDate"></div>
            <div class="navbar-notification" title="Notifikasi">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                <div class="notif-badge">3</div>
            </div>
            <div class="navbar-profile">
                <div class="profile-avatar"><?php echo e(strtoupper(substr(Auth::check() ? Auth::user()->name : 'Admin', 0, 2))); ?></div>
                <div class="profile-info">
                    <div class="profile-name"><?php echo e(explode(' ', Auth::check() ? Auth::user()->name : 'Admin')[0]); ?></div>
                    <div class="profile-role">Super Admin</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</div>

<!-- Logout Confirmation Modal -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal" style="max-width: 380px;">
        <div class="modal-header">
            <div class="modal-title">Konfirmasi Logout</div>
            <button class="modal-close" onclick="closeModal('logoutModal')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <p style="font-size: 14px; color: var(--gray-500); line-height: 1.6;">Apakah kamu yakin ingin keluar dari sistem Jadwalin? Semua sesi aktif akan diakhiri.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('logoutModal')">Batal</button>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="source" value="admin">
                <button type="submit" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>
                    Ya, Logout
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // ==================
    // DATE DISPLAY
    // ==================
    function updateDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('navbarDate').textContent = now.toLocaleDateString('id-ID', options);
    }
    updateDate();

    // ==================
    // SECTION NAVIGATION
    // ==================
    const sectionTitles = {
        dashboard: { title: 'Admin Dashboard', breadcrumb: 'Dashboard' },
        jadwal: { title: 'Kelola Jadwal', breadcrumb: 'Kelola Jadwal' },
        kalender: { title: 'Kalender Marketing', breadcrumb: 'Kalender Marketing' },
        laporan: { title: 'Laporan Statistik', breadcrumb: 'Laporan' },
        marketing: { title: 'Manajemen Marketing', breadcrumb: 'User > Marketing' },
        petugas: { title: 'Manajemen Petugas', breadcrumb: 'User > Petugas' },
    };

    function showSection(sectionId, navEl) {
        // Hide all sections
        document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
        // Remove active from all nav items
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));

        // Show target section
        const section = document.getElementById('section-' + sectionId);
        if (section) section.classList.add('active');

        // Activate nav item
        if (navEl) navEl.classList.add('active');

        // Update navbar
        const info = sectionTitles[sectionId];
        if (info) {
            document.getElementById('navbarPageTitle').textContent = info.title;
        }
    }

    // ==================
    // MODAL HELPERS
    // ==================
    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    // Close modal on overlay click
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('open');
        });
    });

    // ==================
    // LOGOUT
    // ==================
    function confirmLogout() {
        openModal('logoutModal');
    }

    // ==================
    // TOAST
    // ==================
    function showToast(message, type = 'success') {
        const icons = {
            success: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>`,
            error: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>`,
        };
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `${icons[type] || icons.success} ${message}`;
        container.appendChild(toast);
        setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.3s'; setTimeout(() => toast.remove(), 300); }, 3500);
    }
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp 8.2\htdocs\skema_aplikasi\resources\views/layouts/admin.blade.php ENDPATH**/ ?>