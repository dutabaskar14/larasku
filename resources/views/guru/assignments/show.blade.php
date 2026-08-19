<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Kelola Tugas — {{ $assignment->judul }}
    </title>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>


        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: #0f172a;
            background:
                linear-gradient(
                    180deg,
                    #f8fafc 0%,
                    #f1f5f9 100%
                );
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        button,
        input,
        select {
            font: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            text-decoration: none;
        }

        .page {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding: 28px 30px 60px;
        }

        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 12px;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
        }

        .back-link:hover {
            color: #4f46e5;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 7px;
            color: #64748b;
            font-size: 11px;
            font-weight: 850;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #6366f1;
            box-shadow:
                0 0 0 4px #e0e7ff;
        }

        .title {
            margin: 0;
            color: #0f172a;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 900;
            letter-spacing: -.035em;
        }

        .subtitle {
            max-width: 760px;
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.65;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 14px;
            border: 1px solid transparent;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 850;
            cursor: pointer;
            transition:
                transform .18s ease,
                box-shadow .18s ease,
                background .18s ease,
                border-color .18s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            color: #fff;
            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #6366f1
                );
            box-shadow:
                0 8px 20px rgba(79,70,229,.18);
        }

        .btn-primary:hover {
            box-shadow:
                0 11px 25px rgba(79,70,229,.25);
        }

        .btn-secondary {
            color: #334155;
            background: #fff;
            border-color: #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        .btn-danger {
            color: #dc2626;
            background: #fff;
            border-color: #fecaca;
        }

        .btn-danger:hover {
            background: #fef2f2;
        }

        .icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .alert {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .alert-success {
            color: #166534;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            color: #991b1b;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .alert-close {
            border: 0;
            padding: 0;
            color: inherit;
            background: transparent;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            opacity: .7;
        }

        .hero-card {
            overflow: hidden;
            margin-bottom: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow:
                0 10px 35px rgba(15,23,42,.055);
        }

        .hero-main {
            padding: 22px;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-bottom: 14px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 9px;
            font-size: 10px;
            font-weight: 850;
            white-space: nowrap;
        }

        .badge-blue {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .badge-violet {
            color: #7e22ce;
            background: #f3e8ff;
        }

        .badge-green {
            color: #047857;
            background: #d1fae5;
        }

        .badge-gray {
            color: #475569;
            background: #f1f5f9;
        }

        .badge-amber {
            color: #b45309;
            background: #fef3c7;
        }

        .hero-title {
            margin: 0;
            color: #0f172a;
            font-size: 21px;
            line-height: 1.35;
            font-weight: 900;
        }

        .hero-description {
            max-width: 900px;
            margin: 10px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        .hero-footer {
            display: grid;
            grid-template-columns:
                repeat(4, minmax(0, 1fr));
            border-top: 1px solid #eef2f7;
        }

        .info-box {
            padding: 15px 18px;
            border-right: 1px solid #eef2f7;
        }

        .info-box:last-child {
            border-right: 0;
        }

        .info-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .info-value {
            margin-top: 5px;
            color: #334155;
            font-size: 12px;
            font-weight: 850;
        }

        .deadline-danger {
            color: #dc2626;
        }

        .layout {
            display: grid;
            grid-template-columns:
                minmax(0, 1.55fr)
                minmax(300px, .85fr);
            gap: 18px;
            align-items: start;
        }

        .stack {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: #fff;
            box-shadow:
                0 8px 28px rgba(15,23,42,.045);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 17px 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .card-heading {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 900;
        }

        .card-description {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
        }

        .card-body {
            padding: 18px;
        }

        .count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 30px;
            height: 26px;
            padding: 0 8px;
            border-radius: 8px;
            color: #4338ca;
            background: #eef2ff;
            font-size: 10px;
            font-weight: 900;
        }

        .group-list {
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .group-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            background: #f8fafc;
        }

        .group-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 13px 14px;
            background: #fff;
            border-bottom: 1px solid #e8edf3;
        }

        .group-name-wrap {
            min-width: 0;
        }

        .group-name {
            color: #0f172a;
            font-size: 13px;
            font-weight: 900;
        }

        .group-member-count {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
        }

        .group-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .mini-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 31px;
            padding: 0 9px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            background: #fff;
            font-size: 10px;
            font-weight: 850;
            cursor: pointer;
        }

        .mini-btn:hover {
            color: #4338ca;
            border-color: #c7d2fe;
            background: #eef2ff;
        }

        .mini-btn-danger:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .members {
            padding: 10px;
        }

        .member {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 9px;
        }

        .member:hover {
            background: #fff;
        }

        .member-left {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            border-radius: 9px;
            color: #4338ca;
            background: #e0e7ff;
            font-size: 10px;
            font-weight: 900;
        }

        .member-name {
            overflow: hidden;
            color: #334155;
            font-size: 11px;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .member-absen {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 9px;
        }

        .remove-member {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border: 0;
            border-radius: 7px;
            color: #94a3b8;
            background: transparent;
            cursor: pointer;
        }

        .remove-member:hover {
            color: #dc2626;
            background: #fef2f2;
        }

        .empty-small {
            padding: 20px 10px;
            color: #94a3b8;
            font-size: 11px;
            text-align: center;
        }

        .add-group-box {
            padding: 16px;
            border-top: 1px solid #eef2f7;
            background: #fafbff;
        }

        .form-row {
            display: grid;
            grid-template-columns:
                minmax(0, 1fr)
                auto;
            gap: 9px;
            align-items: end;
        }

        .form-group {
            min-width: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 10px;
            font-weight: 850;
        }

        .input,
        .select {
            width: 100%;
            height: 40px;
            padding: 0 11px;
            color: #0f172a;
            background: #fff;
            border: 1px solid #dbe3ed;
            border-radius: 10px;
            outline: none;
            font-size: 12px;
        }

        .input:focus,
        .select:focus {
            border-color: #818cf8;
            box-shadow:
                0 0 0 3px rgba(99,102,241,.10);
        }

        .member-search {
            margin-bottom: 10px;
        }

        .available-list {
            max-height: 260px;
            overflow-y: auto;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
        }

        .available-student {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 11px;
            border-bottom: 1px solid #f1f5f9;
        }

        .available-student:last-child {
            border-bottom: 0;
        }

        .student-info {
            min-width: 0;
        }

        .student-name {
            color: #334155;
            font-size: 11px;
            font-weight: 800;
        }

        .student-meta {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 9px;
        }

        .add-member-form {
            display: inline;
        }

        .add-student {
            min-height: 30px;
            padding: 0 9px;
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            color: #4338ca;
            background: #eef2ff;
            font-size: 10px;
            font-weight: 850;
            cursor: pointer;
        }

        .add-student:hover {
            background: #e0e7ff;
        }

        .submission-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .submission {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 11px;
            background: #fff;
        }

        .submission:hover {
            background: #fafbff;
            border-color: #dbeafe;
        }

        .submission-main {
            min-width: 0;
        }

        .submission-name {
            color: #334155;
            font-size: 11px;
            font-weight: 850;
        }

        .submission-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 4px;
            color: #94a3b8;
            font-size: 9px;
        }

        .submission-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .score {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 45px;
            height: 29px;
            padding: 0 8px;
            border-radius: 8px;
            color: #047857;
            background: #d1fae5;
            font-size: 11px;
            font-weight: 900;
        }

        .score.pending {
            color: #b45309;
            background: #fef3c7;
        }

        .outline-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 31px;
            padding: 0 10px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            background: #fff;
            font-size: 10px;
            font-weight: 850;
        }

        .outline-link:hover {
            color: #4338ca;
            border-color: #c7d2fe;
            background: #eef2ff;
        }

        .detail-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .detail-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 750;
        }

        .detail-value {
            color: #334155;
            font-size: 11px;
            font-weight: 850;
            text-align: right;
        }

        .instruction-box {
            padding: 13px;
            border-radius: 11px;
            color: #475569;
            background: #f8fafc;
            font-size: 11px;
            line-height: 1.7;
        }

        .instruction-box p:first-child {
            margin-top: 0;
        }

        .instruction-box p:last-child {
            margin-bottom: 0;
        }

        .modal-backdrop {
            position: fixed;
            z-index: 1000;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15,23,42,.48);
            backdrop-filter: blur(4px);
        }

        .modal-backdrop.show {
            display: flex;
        }

        .modal {
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            border-radius: 17px;
            background: #fff;
            box-shadow:
                0 25px 70px rgba(15,23,42,.22);
        }

        .modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 17px 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .modal-title {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 900;
        }

        .modal-close {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border: 0;
            border-radius: 8px;
            color: #64748b;
            background: #f8fafc;
            cursor: pointer;
            font-size: 18px;
        }

        .modal-body {
            padding: 18px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            padding: 13px 18px;
            border-top: 1px solid #eef2f7;
            background: #fafafa;
        }

        .no-data {
            padding: 25px 10px;
            color: #94a3b8;
            font-size: 11px;
            text-align: center;
        }

        @media (max-width: 1050px) {

            .layout {
                grid-template-columns: 1fr;
            }

            .hero-footer {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .info-box:nth-child(2) {
                border-right: 0;
            }

            .info-box:nth-child(-n+2) {
                border-bottom: 1px solid #eef2f7;
            }

        }

        @media (max-width: 700px) {

            .page {
                padding: 20px 14px 45px;
            }

            .topbar {
                flex-direction: column;
            }

            .top-actions {
                width: 100%;
            }

            .top-actions .btn {
                width: 100%;
            }

            .title {
                font-size: 23px;
            }

            .hero-main {
                padding: 17px;
            }

            .hero-footer {
                grid-template-columns: 1fr 1fr;
            }

            .info-box {
                padding: 12px;
            }

            .group-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .group-actions {
                width: 100%;
            }

            .group-actions .mini-btn {
                flex: 1;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .submission {
                align-items: flex-start;
                flex-direction: column;
            }

            .submission-actions {
                width: 100%;
            }

            .submission-actions .outline-link {
                flex: 1;
            }

        }

        @media (max-width: 450px) {

            .hero-footer {
                grid-template-columns: 1fr;
            }

            .info-box {
                border-right: 0 !important;
                border-bottom: 1px solid #eef2f7;
            }

            .info-box:last-child {
                border-bottom: 0;
            }

        }


        /* =========================================================
           GURU SHELL / SIDEBAR / HEADBAR
        ========================================================= */

        .guru-shell {
            min-height: 100vh;
            margin-left: 250px;
            padding-top: 72px;
        }

        .page {
            width: 100%;
            max-width: 1480px;
            margin: 0 auto;
            padding: 24px 30px 56px;
        }

        /* =========================================================
           MAIN TWO-COLUMN AREA
        ========================================================= */

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(320px, .82fr);
            gap: 18px;
            align-items: start;
        }

        .stack {
            display: flex;
            flex-direction: column;
            gap: 18px;
            min-width: 0;
        }

        /* Pengumpulan berada DI LUAR .layout agar full width */
        .submissions-full {
            width: 100%;
            margin-top: 18px;
        }

        /* Nomor kelompok harus tampil sebelum daftar kelompok */
        .group-create {
            padding: 16px 18px 18px;
            background: #fafbff;
            border-bottom: 1px solid #eef2f7;
        }

        .group-create .form-row {
            grid-template-columns: minmax(0, 1fr) auto;
        }

        /* =========================================================
           HEADBAR / SIDEBAR COMPATIBILITY
        ========================================================= */

        .guru-shell .page {
            position: relative;
        }

        /* Jika partial headbar memakai fixed positioning, konten tetap aman. */
        .guru-shell .topbar {
            margin-bottom: 12px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1180px) {
            .guru-shell {
                margin-left: 220px;
            }

            .page {
                padding-left: 22px;
                padding-right: 22px;
            }

            .layout {
                grid-template-columns: minmax(0, 1.35fr) minmax(290px, .8fr);
            }
        }

        @media (max-width: 1000px) {
            .guru-shell {
                margin-left: 0;
                padding-top: 56px;
            }

            .layout {
                grid-template-columns: 1fr;
            }

            .submissions-full {
                margin-top: 18px;
            }
        }

        @media (max-width: 700px) {
            .page {
                padding: 18px 14px 42px;
            }

            .group-create .form-row {
                grid-template-columns: 1fr;
            }

            .group-create .btn {
                width: 100%;
            }
        }


        .submissions-full > .card {
            width: 100%;
        }

        .submissions-full .submission-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .submissions-full .submission {
            min-width: 0;
        }

        @media (max-width: 800px) {
            .submissions-full .submission-list {
                grid-template-columns: 1fr;
            }
        }

    

        /* =====================================================
           GURU DASHBOARD SHELL
        ====================================================== */

        html,
        body {
            min-height: 100%;
        }

        body {
            overflow-x: hidden;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        /*
         * Sidebar dan header berasal dari partial Guru.
         * Konten utama diberi ruang agar tidak tertutup sidebar.
         */
        .guru-shell {
            min-height: 100vh;
            margin-left: 220px;
            padding-top: 58px;
            min-width: 0;
        }

        .guru-shell .page {
            width: 100%;
            max-width: 1480px;
            margin: 0 auto;
            padding: 14px 20px 56px;
            min-width: 0;
        }

        .guru-shell .layout {
            min-width: 0;
        }

        .guru-shell .stack,
        .guru-shell .card,
        .guru-shell .submission,
        .guru-shell .group-card {
            min-width: 0;
        }

        .guru-shell .submissions-full {
            width: 100%;
            min-width: 0;
        }

        /* Jangan biarkan elemen fixed/global tertutup konten */
        .guru-shell {
            position: relative;
            z-index: 1;
        }

        @media (max-width: 1180px) {
            .guru-shell {
                margin-left: 220px;
            }

            .guru-shell .page {
                padding-left: 22px;
                padding-right: 22px;
            }
        }

        @media (max-width: 1000px) {
            .guru-shell {
                margin-left: 0;
                padding-top: 64px;
            }
        }

        @media (max-width: 700px) {
            .guru-shell .page {
                padding: 12px 14px 42px;
            }
        }


        /* =========================================================
           FINAL GURU SHELL OVERRIDE
           Konten dekat sidebar + tombol header tidak terlalu jauh
        ========================================================= */

        .guru-shell {
            margin-left: 220px !important;
            padding-top: 58px !important;
            min-width: 0 !important;
            width: auto !important;
        }

        .guru-shell > .page {
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 10px 10px 50px !important;
            min-width: 0 !important;
        }

        .guru-shell .topbar {
            margin-bottom: 10px !important;
        }

        .guru-shell .hero-card {
            margin-bottom: 14px !important;
        }

        .guru-shell .layout {
            gap: 14px !important;
        }

        .guru-shell .stack {
            gap: 14px !important;
        }

        .guru-shell .submissions-full {
            margin-top: 14px !important;
        }

        @media (max-width: 1180px) {
            .guru-shell {
                margin-left: 220px !important;
            }

            .guru-shell > .page {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
        }

        @media (max-width: 1000px) {
            .guru-shell {
                margin-left: 0 !important;
                padding-top: 56px !important;
            }

            .guru-shell > .page {
                padding: 10px 14px 42px !important;
            }
        }

        @media (max-width: 700px) {
            .guru-shell > .page {
                padding: 10px 12px 40px !important;
            }
        }

    </style>

</head>


<body class="min-h-screen text-slate-800">

@include('guru.partials.sidebar')
@include('guru.partials.header')

<div class="guru-shell">
<div class="page">


    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <div class="topbar">

        <div>

            <a
                href="{{ route('guru.assignments.index') }}"
                class="back-link"
            >

                <span class="icon">
                    ←
                </span>

                Kembali ke Tugas

            </a>


            <div class="eyebrow">

                <span class="eyebrow-dot"></span>

                Guru · Kelola Tugas

            </div>


            <h1 class="title">
                Kelola Tugas
            </h1>


            <p class="subtitle">

                Atur kelompok, anggota siswa, dan pantau
                pengumpulan tugas dari halaman ini.

            </p>

        </div>


        <div class="top-actions">

            <a
                href="{{ route('guru.assignments.edit', $assignment) }}"
                class="btn btn-secondary"
            >

                <span class="icon">
                    ✎
                </span>

                Edit Tugas

            </a>


            <a
                href="{{ route('guru.assignments.submissions.index', $assignment) }}"
                class="btn btn-primary"
            >

                <span class="icon">
                    ✓
                </span>

                Pengumpulan

            </a>

        </div>

    </div>


    {{-- ============================================================
         FLASH SUCCESS
    ============================================================= --}}

    @if(session('success'))

        <div class="alert alert-success">

            <div>
                {{ session('success') }}
            </div>

            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif


    {{-- ============================================================
         VALIDATION ERRORS
    ============================================================= --}}

    @if($errors->any())

        <div class="alert alert-error">

            <div>

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif


    {{-- ============================================================
         HERO TUGAS
    ============================================================= --}}

    <section class="hero-card">

        <div class="hero-main">

            <div class="meta-row">

                <span class="badge badge-blue">
                    Pertemuan {{ $assignment->pertemuan }}
                </span>

                <span class="badge badge-violet">
                    {{ $assignment->kelas }}
                </span>


                @if($assignment->mode_pengumpulan === 'kelompok')

                    <span class="badge badge-violet">
                        Kelompok
                    </span>

                @else

                    <span class="badge badge-blue">
                        Individu
                    </span>

                @endif


                @if($assignment->aktif)

                    <span class="badge badge-green">
                        Aktif
                    </span>

                @else

                    <span class="badge badge-gray">
                        Nonaktif
                    </span>

                @endif

            </div>


            <h2 class="hero-title">
                {{ $assignment->judul }}
            </h2>


            @if($assignment->instruksi)

                <div class="hero-description">
                    {!! $assignment->instruksi !!}
                </div>

            @endif

        </div>


        <div class="hero-footer">


            <div class="info-box">

                <div class="info-label">
                    Kelas
                </div>

                <div class="info-value">
                    {{ $assignment->kelas }}
                </div>

            </div>


            <div class="info-box">

                <div class="info-label">
                    Jenis Pengumpulan
                </div>

                <div class="info-value">
                    {{ ucfirst($assignment->mode_pengumpulan) }}
                </div>

            </div>


            <div class="info-box">

                <div class="info-label">
                    Batas Waktu
                </div>

                <div
                    class="
                        info-value
                        {{ $assignment->batas_waktu && now()->greaterThan($assignment->batas_waktu)
                            ? 'deadline-danger'
                            : ''
                        }}
                    "
                >

                    @if($assignment->batas_waktu)

                        {{ $assignment->batas_waktu->format('d M Y, H:i') }}
                        WIB

                    @else

                        Tidak dibatasi

                    @endif

                </div>

            </div>


            <div class="info-box">

                <div class="info-label">
                    Dibuat
                </div>

                <div class="info-value">

                    {{ $assignment->created_at?->format('d M Y') }}

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
         MAIN LAYOUT
    ============================================================= --}}

    <div class="layout">


        {{-- ========================================================
             LEFT
        ========================================================= --}}

        <div class="stack">


            {{-- ====================================================
                 KELOMPOK
            ===================================================== --}}

            @if($assignment->mode_pengumpulan === 'kelompok')

                <section class="card">

                    <div class="card-header">

                        <div>

                            <h2 class="card-heading">
                                Kelompok Tugas
                            </h2>

                            <p class="card-description">
                                Buat kelompok dan masukkan siswa dari kelas
                                {{ $assignment->kelas }}.
                            </p>

                        </div>


                        <span class="count">

                            {{ $assignment->groups->count() }}

                        </span>

                    </div>


                    {{-- TAMBAH KELOMPOK --}}

                    <div class="group-create">

                        <form
                            method="POST"
                            action="{{ route(
                                'guru.assignments.groups.store',
                                $assignment
                            ) }}"
                        >

                            @csrf


                            <div class="form-row">


                                <div class="form-group">

                                    <label
                                        for="nomor_kelompok"
                                        class="form-label"
                                    >
                                        Nomor Kelompok
                                    </label>

                                    <input
                                        type="number"
                                        id="nomor_kelompok"
                                        name="nomor_kelompok"
                                        class="input"
                                        min="1"
                                        max="999"
                                        placeholder="Contoh: 1"
                                        required
                                    >

                                </div>


                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >

                                    + Tambah Kelompok

                                </button>

                            </div>

                        </form>

                    </div>

                    <div class="card-body">


                        @if($assignment->groups->count())

                            <div class="group-list">

                                @foreach($assignment->groups as $group)

                                    <article class="group-card">


                                        <div class="group-head">

                                            <div class="group-name-wrap">

                                                <div class="group-name">

                                                    Kelompok
                                                    {{ $group->nomor_kelompok }}

                                                </div>

                                                <div class="group-member-count">

                                                    {{ $group->members->count() }}
                                                    anggota

                                                </div>

                                            </div>


                                            <div class="group-actions">


                                                <button
                                                    type="button"
                                                    class="mini-btn"
                                                    onclick="openMemberModal(
                                                        {{ $group->id }}
                                                    )"
                                                >

                                                    + Anggota

                                                </button>


                                                <form
                                                    method="POST"
                                                    action="{{ route(
                                                        'guru.assignments.groups.destroy',
                                                        [
                                                            $assignment,
                                                            $group
                                                        ]
                                                    ) }}"
                                                    onsubmit="return confirm(
                                                        'Hapus Kelompok {{ $group->nomor_kelompok }}?'
                                                    )"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="
                                                            mini-btn
                                                            mini-btn-danger
                                                        "
                                                    >
                                                        Hapus
                                                    </button>

                                                </form>

                                            </div>

                                        </div>


                                        <div class="members">

                                            @if($group->members->count())

                                                @foreach($group->members as $member)

                                                    @php

                                                        $student =
                                                            $member->student;

                                                        $initial =
                                                            strtoupper(
                                                                mb_substr(
                                                                    $student?->nama ?? 'S',
                                                                    0,
                                                                    1
                                                                )
                                                            );

                                                    @endphp


                                                    <div class="member">

                                                        <div class="member-left">

                                                            <div class="avatar">

                                                                {{ $initial }}

                                                            </div>


                                                            <div>

                                                                <div class="member-name">

                                                                    {{ $student?->nama ?? 'Siswa' }}

                                                                </div>


                                                                <div class="member-absen">

                                                                    @if($student?->nomor_absen)

                                                                        Absen
                                                                        {{ $student->nomor_absen }}

                                                                    @else

                                                                        {{ $student?->kelas }}

                                                                    @endif

                                                                </div>

                                                            </div>

                                                        </div>


                                                        <form
                                                            method="POST"
                                                            action="{{ route(
                                                                'guru.assignments.groups.members.destroy',
                                                                [
                                                                    $assignment,
                                                                    $group,
                                                                    $member
                                                                ]
                                                            ) }}"
                                                            onsubmit="return confirm(
                                                                'Keluarkan siswa ini dari kelompok?'
                                                            )"
                                                        >

                                                            @csrf

                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                class="remove-member"
                                                                title="Hapus anggota"
                                                            >

                                                                ×

                                                            </button>

                                                        </form>

                                                    </div>

                                                @endforeach

                                            @else

                                                <div class="empty-small">

                                                    Belum ada anggota.
                                                    Klik <strong>+ Anggota</strong>
                                                    untuk menambahkan siswa.

                                                </div>

                                            @endif

                                        </div>

                                    </article>

                                @endforeach

                            </div>

                        @else

                            <div class="empty-small">

                                Belum ada kelompok untuk tugas ini.

                            </div>

                        @endif

                    </div>




                </section>

            @endif





        </div>


        {{-- ========================================================
             RIGHT SIDEBAR
        ========================================================= --}}

        <div class="stack">


            {{-- ====================================================
                 DETAIL
            ===================================================== --}}

            <section class="card">

                <div class="card-header">

                    <div>

                        <h2 class="card-heading">
                            Detail Tugas
                        </h2>

                        <p class="card-description">
                            Informasi tugas saat ini.
                        </p>

                    </div>

                </div>


                <div class="card-body">

                    <div class="detail-list">


                        <div class="detail-row">

                            <span class="detail-label">
                                Pertemuan
                            </span>

                            <span class="detail-value">
                                {{ $assignment->pertemuan }}
                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Kelas
                            </span>

                            <span class="detail-value">
                                {{ $assignment->kelas }}
                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Pengumpulan
                            </span>

                            <span class="detail-value">

                                {{ ucfirst(
                                    $assignment->mode_pengumpulan
                                ) }}

                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Kelompok
                            </span>

                            <span class="detail-value">

                                {{ $assignment->groups->count() }}

                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Pengumpulan
                            </span>

                            <span class="detail-value">

                                {{ $assignment->submissions->count() }}

                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Batas waktu
                            </span>

                            <span class="detail-value">

                                @if($assignment->batas_waktu)

                                    {{ $assignment->batas_waktu->format(
                                        'd M Y H:i'
                                    ) }}
                                    WIB

                                @else

                                    Tidak dibatasi

                                @endif

                            </span>

                        </div>


                    </div>

                </div>

            </section>


            {{-- ====================================================
                 INSTRUKSI
            ===================================================== --}}

            @if($assignment->instruksi)

                <section class="card">

                    <div class="card-header">

                        <div>

                            <h2 class="card-heading">
                                Instruksi
                            </h2>

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="instruction-box">

                            {!! $assignment->instruksi !!}

                        </div>

                    </div>

                </section>

            @endif

        </div>


    </div>


    <div class="submissions-full">

        {{-- ====================================================
             PENGUMPULAN
            ===================================================== --}}

            <section class="card">

                <div class="card-header">

                    <div>

                        <h2 class="card-heading">
                            Pengumpulan Tugas
                        </h2>

                        <p class="card-description">
                            Lihat tugas yang sudah dikirim dan lanjutkan ke penilaian.
                        </p>

                    </div>


                    <span class="count">

                        {{ $assignment->submissions->count() }}

                    </span>

                </div>


                <div class="card-body">

                    @if($assignment->submissions->count())

                        <div class="submission-list">

                            @foreach($assignment->submissions as $submission)

                                @php

                                    $score =
                                        $submission->nilai
                                        ?? null;

                                @endphp


                                <div class="submission">


                                    <div class="submission-main">

                                        <div class="submission-name">

                                            @if($assignment->mode_pengumpulan === 'kelompok')

                                                @if($submission->group)

                                                    Kelompok
                                                    {{ $submission->group->nomor_kelompok }}

                                                @else

                                                    Kelompok

                                                @endif

                                            @else

                                                @if($submission->student)

                                                    {{ $submission->student->nama }}

                                                @else

                                                    Siswa

                                                @endif

                                            @endif

                                        </div>


                                        <div class="submission-meta">

                                            @if($submission->submitted_at)

                                                <span>
                                                    Dikirim
                                                    {{ $submission->submitted_at->format('d/m/Y H:i') }}
                                                </span>

                                            @elseif($submission->created_at)

                                                <span>
                                                    {{ $submission->created_at->format('d/m/Y H:i') }}
                                                </span>

                                            @endif


                                            @if($submission->selesai)

                                                <span>
                                                    Sudah selesai
                                                </span>

                                            @else

                                                <span>
                                                    Menunggu penilaian
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    <div class="submission-actions">


                                        @if($score !== null)

                                            <span class="score">

                                                {{ number_format(
                                                    (float) $score,
                                                    0
                                                ) }}

                                            </span>

                                        @else

                                            <span class="score pending">

                                                Belum dinilai

                                            </span>

                                        @endif


                                        <a
                                            href="{{ route(
                                                'guru.assignments.submissions.show',
                                                [
                                                    $assignment,
                                                    $submission
                                                ]
                                            ) }}"
                                            class="outline-link"
                                        >

                                            Lihat

                                        </a>

                                    </div>

                                </div>

                            @endforeach

                        </div>


                        <div style="margin-top:14px;">

                            <a
                                href="{{ route(
                                    'guru.assignments.submissions.index',
                                    $assignment
                                ) }}"
                                class="btn btn-primary"
                                style="width:100%;"
                            >

                                Lihat Semua Pengumpulan

                            </a>

                        </div>

                    @else

                        <div class="no-data">

                            Belum ada pengumpulan tugas.

                        </div>

                    @endif

                </div>

        </section>

    </div>


{{-- ================================================================
     MODAL TAMBAH ANGGOTA
================================================================ --}}

<div
    id="memberModal"
    class="modal-backdrop"
>

    <div class="modal">


        <div class="modal-head">

            <h3 class="modal-title">
                Tambah Anggota Kelompok
            </h3>


            <button
                type="button"
                class="modal-close"
                onclick="closeMemberModal()"
            >
                ×
            </button>

        </div>


        <div class="modal-body">

            <div
                id="modalGroupInfo"
                style="
                    margin-bottom:12px;
                    color:#64748b;
                    font-size:11px;
                "
            >
                Pilih siswa dari kelas {{ $assignment->kelas }}.
            </div>


            <div class="member-search">

                <input
                    type="search"
                    id="studentSearch"
                    class="input"
                    placeholder="Cari nama siswa..."
                    autocomplete="off"
                >

            </div>


            <div
                id="availableStudents"
                class="available-list"
            >

                @if(isset($availableStudents) && $availableStudents->count())

                    @foreach($availableStudents as $student)

                        <div
                            class="available-student"
                            data-name="{{ strtolower($student->nama) }}"
                        >

                            <div class="student-info">

                                <div class="student-name">

                                    {{ $student->nama }}

                                </div>

                                <div class="student-meta">

                                    Kelas
                                    {{ $student->kelas }}

                                    @if($student->nomor_absen !== null)

                                        · Absen
                                        {{ $student->nomor_absen }}

                                    @endif

                                </div>

                            </div>


                            <form
                                method="POST"
                                class="add-member-form"
                                data-group-id=""
                                action="#"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="student_id"
                                    value="{{ $student->id }}"
                                >

                                <button
                                    type="submit"
                                    class="add-student"
                                >
                                    Tambah
                                </button>

                            </form>

                        </div>

                    @endforeach

                @else

                    <div class="no-data">
                        Semua siswa kelas ini sudah masuk kelompok
                        atau belum ada siswa yang tersedia.
                    </div>

                @endif

            </div>

        </div>


        <div class="modal-footer">

            <button
                type="button"
                class="btn btn-secondary"
                onclick="closeMemberModal()"
            >
                Tutup
            </button>

        </div>

    </div>

</div>
</div>

<script>

    let activeGroupId = null;


    function openMemberModal(groupId) {

        activeGroupId = groupId;

        const modal =
            document.getElementById('memberModal');

        const info =
            document.getElementById('modalGroupInfo');

        const search =
            document.getElementById('studentSearch');


        if (info) {

            info.textContent =
                'Tambahkan siswa kelas {{ $assignment->kelas }} ke Kelompok ' +
                groupId +
                '. Siswa yang sudah masuk kelompok lain tidak tersedia.';

        }


        document
            .querySelectorAll('.add-member-form')
            .forEach(function (form) {

                form.action =
                    "{{ url('/guru/assignments') }}/" +
                    "{{ $assignment->id }}" +
                    "/groups/" +
                    groupId +
                    "/members";

            });


        modal.classList.add('show');


        setTimeout(
            function () {

                if (search) {

                    search.value = '';

                    search.focus();

                    filterStudents('');

                }

            },
            80
        );

    }


    function closeMemberModal() {

        const modal =
            document.getElementById('memberModal');

        if (modal) {

            modal.classList.remove('show');

        }

        activeGroupId = null;

    }


    function filterStudents(value) {

        const query =
            value
                .toLowerCase()
                .trim();


        document
            .querySelectorAll('.available-student')
            .forEach(function (student) {

                const name =
                    student.dataset.name || '';

                if (!query || name.includes(query)) {

                    student.style.display =
                        'flex';

                } else {

                    student.style.display =
                        'none';

                }

            });

    }


    document.addEventListener(
        'DOMContentLoaded',
        function () {


            const search =
                document.getElementById('studentSearch');


            if (search) {

                search.addEventListener(
                    'input',
                    function () {

                        filterStudents(
                            this.value
                        );

                    }
                );

            }


            const modal =
                document.getElementById('memberModal');


            if (modal) {

                modal.addEventListener(
                    'click',
                    function (event) {

                        if (event.target === modal) {

                            closeMemberModal();

                        }

                    }
                );

            }


            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape'
                    ) {

                        closeMemberModal();

                    }

                }
            );

        }
    );


    /*
     * Pastikan form tambah anggota
     * tidak terkirim tanpa group ID.
     */

    document.addEventListener(
        'submit',
        function (event) {

            const form =
                event.target;


            if (
                form.classList.contains(
                    'add-member-form'
                )
            ) {

                if (!activeGroupId) {

                    event.preventDefault();

                    alert(
                        'Kelompok belum dipilih.'
                    );

                    return;

                }

                form.action =
                    "{{ url('/guru/assignments') }}/" +
                    "{{ $assignment->id }}" +
                    "/groups/" +
                    activeGroupId +
                    "/members";

            }

        }
    );

</script>


    <script>
        if (window.lucide) {
            lucide.createIcons();
        }
    </script>

</body>

</html>