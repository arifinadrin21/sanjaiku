@extends('layouts.app')

@section('title','Data Testimoni')

@section('content')

{{-- ✅ WAJIB: load Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    .testi-list-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .testi-list-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .testi-list-wrapper .card-header .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        color: #1e293b;
    }

    .testi-list-wrapper .card-header .card-title i {
        color: #2563eb;
    }

    .testi-list-wrapper .alert {
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .testi-list-wrapper .alert-success {
        background: #eafaf0;
        border: 1px solid #dcf3e4;
        color: #16a34a;
    }

    .testi-list-wrapper .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.4px;
        color: #94a3b8;
        background: #fafbfc;
        border-top: none;
        border-bottom: 1px solid #eef1f6;
        vertical-align: middle;
    }

    .testi-list-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .testi-list-wrapper .table-bordered,
    .testi-list-wrapper .table-bordered th,
    .testi-list-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .testi-list-wrapper .stars {
        color: #f59e0b;
        letter-spacing: 1px;
        font-size: 1rem;
    }

    .testi-list-wrapper .comment-cell {
        max-width: 280px;
        white-space: normal;
    }

    .testi-list-wrapper .badge {
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
        white-space: nowrap;
    }

    .testi-list-wrapper .badge i {
        margin-right: 4px;
    }

    .testi-list-wrapper .badge.bg-success {
        background: #eafaf0 !important;
        color: #16a34a !important;
    }

    .testi-list-wrapper .btn-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        transition: opacity .15s ease;
        margin-right: 4px;
    }

    .testi-list-wrapper .btn-icon:hover {
        opacity: 0.85;
    }

    .testi-list-wrapper .btn-icon.btn-delete {
        background: #fdeef0;
        color: #ef4444;
    }
</style>

<div class="testi-list-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-comments"></i>
                Data Testimoni
            </h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">

                <table id="example1" class="table table-bordered table-striped mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                <i class="fas fa-user me-1"></i>
                                Pelanggan
                            </th>
                            <th>
                                <i class="fas fa-file-invoice me-1"></i>
                                Invoice
                            </th>
                            <th>
                                <i class="fas fa-star me-1"></i>
                                Rating
                            </th>
                            <th>
                                <i class="fas fa-comment-dots me-1"></i>
                                Komentar
                            </th>
                            <th>
                                <i class="fas fa-info-circle me-1"></i>
                                Status
                            </th>
                            <th width="100">
                                <i class="fas fa-cog me-1"></i>
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($testimonials as $testimonial)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $testimonial->user->name ?? '-' }}
                            </td>

                            <td>
                                {{ $testimonial->order->invoice_number ?? '-' }}
                            </td>

                            <td>
                                <span class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            ⭐
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                            </td>

                          <td class="comment-cell">
    {{ $testimonial->review }}
</td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i>
                                    Tampil
                                </span>
                            </td>

                            <td>

                                <form
                                    action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Hapus testimoni?')"
                                        class="btn-icon btn-delete"
                                        title="Hapus">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada testimoni.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection