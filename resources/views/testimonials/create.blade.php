@extends('layouts.landing')

@section('title','Berikan Testimoni')

@section('content')

<style>
    .testi-wrapper .card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .testi-wrapper .card-header {
        background: linear-gradient(135deg, #ffc107, #ff9f1c);
        border-bottom: none;
        padding: 1.25rem 1.5rem;
    }

    .testi-wrapper .card-header h4 {
        font-weight: 800;
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #2d2d2d;
    }

    .testi-wrapper .card-body {
        padding: 2rem;
    }

    .testi-wrapper .order-info {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.75rem;
        border-left: 4px solid #ffc107;
    }

    .testi-wrapper .order-info h5 {
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
        color: #212529;
    }

    .testi-wrapper .order-info p {
        margin: 0;
        font-weight: 500;
        color: #495057;
    }

    .testi-wrapper .order-info strong {
        font-weight: 800;
        color: #198754;
    }

    .testi-wrapper .form-label {
        font-weight: 700;
        color: #343a40;
        margin-bottom: 8px;
    }

    .testi-wrapper .form-label i {
        color: #ffc107;
        margin-right: 6px;
    }

    .testi-wrapper .form-control {
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
        font-weight: 500;
        padding: 10px 14px;
    }

    .testi-wrapper .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255,193,7,0.2);
    }

    .testi-wrapper .btn {
        font-weight: 700;
        border-radius: 10px;
        padding: 10px 22px;
        letter-spacing: 0.2px;
    }

    .testi-wrapper .btn i {
        margin-right: 6px;
    }

    .testi-wrapper .btn-success {
        background: #198754;
        border: none;
        box-shadow: 0 3px 10px rgba(25,135,84,0.3);
    }

    .testi-wrapper .btn-success:hover {
        background: #157347;
        transform: translateY(-1px);
    }

    .testi-wrapper .btn-secondary {
        font-weight: 700;
    }

    /* Notifikasi kata kasar */
    .bad-word-alert {
        display: none;
        background: #fff3cd;
        color: #664d03;
        border: 1px solid #ffecb5;
        border-left: 5px solid #ffc107;
        border-radius: 10px;
        padding: 13px 16px;
        margin-bottom: 20px;
        font-weight: 600;
        animation: alertShow 0.25s ease;
    }

    .bad-word-alert i {
        color: #d39e00;
        margin-right: 7px;
    }

    @keyframes alertShow {
        from {
            opacity: 0;
            transform: translateY(-5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container py-5 testi-wrapper">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-star"></i>
                        Berikan Testimoni
                    </h4>
                </div>

                <div class="card-body">

                    {{-- Notifikasi dari Laravel --}}
                    @if(session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Tutup"></button>
                        </div>
                    @endif

                    {{-- Error validasi --}}
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>Periksa kembali:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="order-info">
                        <h5>
                            <i class="fas fa-file-invoice"></i>
                            {{ $order->invoice_number }}
                        </h5>

                        <p>
                            Total :
                            <strong>
                                Rp {{ number_format($order->total,0,',','.') }}
                            </strong>
                        </p>
                    </div>

                    <form
                        id="testimonialForm"
                        action="{{ route('testimonials.store', $order) }}"
                        method="POST">

                        @csrf

                        {{-- Notifikasi kata kasar --}}
                        <div
                            id="badWordAlert"
                            class="bad-word-alert"
                            role="alert">

                            <i class="fas fa-exclamation-triangle"></i>

                            <strong>Ulasan tidak dapat dikirim.</strong>
                            <br>

                            Silakan gunakan bahasa yang sopan dan hindari kata-kata kasar.
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-star-half-alt"></i>
                                Rating
                            </label>

                            <select
                                name="rating"
                                class="form-control"
                                required>

                                <option value="">Pilih Rating</option>
                                <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                                <option value="4">⭐⭐⭐⭐ Puas</option>
                                <option value="3">⭐⭐⭐ Cukup</option>
                                <option value="2">⭐⭐ Kurang</option>
                                <option value="1">⭐ Sangat Kurang</option>

                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-comment-dots"></i>
                                Komentar
                            </label>

                            <textarea
                                name="comment"
                                rows="5"
                                class="form-control"
                                placeholder="Bagaimana pengalaman Anda?"
                                required>{{ old('comment') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Testimoni
                        </button>

                        <a
                            href="{{ route('orders.show', $order->id) }}"
                            class="btn btn-secondary">

                            <i class="fas fa-times"></i>
                            Batal
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('testimonialForm');
    const commentInput = document.querySelector('textarea[name="comment"]');
    const badWordAlert = document.getElementById('badWordAlert');

    const badWords = [
        'anjing',
        'bangsat',
        'kontol',
        'memek',
        'tolol',
        'goblok',
        'bego',
        'idiot',
        'brengsek',
        'jancok',
        'asu',
        'kampret',
        'sialan',
        'tai',
        'monyet',
        'pantek',
        'ngentot',
        'pepek',
        'lonte',
        'pelacur',
        'bajingan',
        'basi',
        'bau',
        'banci',
        'sawit',
        'babi',
        'bajingan',
        'bangsat',
        'poke',
        'celeng',

    ];

    function containsBadWord(text) {
        const comment = text.toLowerCase();

        return badWords.some(function (word) {
            return comment.includes(word);
        });
    }

    form.addEventListener('submit', function (event) {

        const comment = commentInput.value.trim();

        if (containsBadWord(comment)) {

            event.preventDefault();

            badWordAlert.style.display = 'block';

            badWordAlert.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            commentInput.focus();

            return;
        }

        badWordAlert.style.display = 'none';
    });

    // Hilangkan notifikasi ketika pelanggan mulai memperbaiki komentar
    commentInput.addEventListener('input', function () {

        if (!containsBadWord(commentInput.value)) {
            badWordAlert.style.display = 'none';
        }

    });

    /*
     * TEST:
     * containsBadWord('produk ini goblok') === true
     * containsBadWord('produknya enak dan bagus') === false
     */
});
</script>

@endsection