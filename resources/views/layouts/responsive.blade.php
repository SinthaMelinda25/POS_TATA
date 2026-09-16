<style>
    /* ================================================================
       RESPONSIVE.BLADE.PHP
       Aturan tampilan responsif untuk semua halaman tema hijau
       (Dapur Nusantara POS). Cukup di-include sekali di layouts/app.blade.php.
    ================================================================ */

    /* ---------- Umum / Reset ---------- */
    html, body {
        overflow-x: hidden;
        width: 100%;
    }

    * {
        box-sizing: border-box;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    /* ---------- Tabel: bisa di-scroll horizontal di layar kecil ---------- */
    .table-responsive-pos {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table.table {
        min-width: 480px;
    }

    /* ---------- Navbar ---------- */
    @media (max-width: 991.98px) {
        .navbar-pos .navbar-nav {
            align-items: flex-start;
            padding-top: 1rem;
            gap: 0.5rem;
        }

        .navbar-pos .nav-link::after {
            display: none;
        }

        .navbar-pos .btn-logout {
            width: 100%;
            margin-top: 1rem;
            text-align: center;
        }

        .pos-card .card-body {
            max-height: none !important;
        }
    }

    /* ---------- Mobile (≤ 767.98px) ---------- */
    @media (max-width: 767.98px) {

        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .page-heading {
            font-size: 1.4rem;
            margin: 1.2rem 0 1.5rem;
            text-align: center;
        }

        .page-heading .tanggal-badge {
            font-size: .8rem;
            padding: .25rem .8rem;
        }

        .section-title {
            font-size: 1.2rem;
            margin: 1.2rem 0 .8rem;
        }

        .subsection-title {
            font-size: .95rem;
        }

        .summary-card .card-title {
            font-size: 1rem;
        }

        .summary-card .card-header {
            font-size: .9rem;
        }

        .table-card {
            padding: .5rem .5rem .15rem;
        }

        .green-table,
        .keranjang-table {
            font-size: .8rem;
        }

        .search-produk-pos .form-control {
            padding: .45rem .7rem;
            font-size: .9rem;
        }

        .produk-pick-btn {
            padding: .4rem !important;
        }

        .produk-pick-btn img {
            width: 36px !important;
            height: 36px !important;
        }

        .qty-input-pos,
        .qty-cart-input {
            font-size: .85rem;
        }

        .btn-add-pos,
        .btn-hapus-item {
            font-size: .8rem;
            padding: .35rem .5rem;
        }

        .total-bayar-pos {
            font-size: 1.1rem;
            text-align: center;
        }

        .payment-select-pos {
            font-size: .9rem;
        }

        .btn-checkout-pos,
        .btn-batalkan-pos {
            font-size: .9rem;
            padding: .55rem;
        }

        .search-form-stack {
            flex-direction: column !important;
            gap: .5rem;
        }

        .search-form-stack .btn,
        .search-form-stack .form-control {
            width: 100% !important;
        }
    }

    /* ---------- Mobile kecil (≤ 480px) ---------- */
    @media (max-width: 480px) {
        .page-heading {
            font-size: 1.2rem;
        }

        .section-title {
            font-size: 1.05rem;
        }

        table.table {
            min-width: 400px;
        }

        .container {
            padding-left: .75rem;
            padding-right: .75rem;
        }
    }
</style>