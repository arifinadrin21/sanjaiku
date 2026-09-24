@extends('layouts.kasir')

@section('title', 'Detail Transaksi')

@section('content')

<div class="detail-header">

    <div>
        <a href="{{ route('kasir.history') }}"
           class="back-button">

            <i class="fas fa-arrow-left"></i>

            Kembali ke Riwayat

        </a>

        <h2>Detail Transaksi</h2>

        <p>
            Informasi lengkap transaksi Kasir.
        </p>
    </div>

</div>


<div class="detail-container">

    {{-- INFORMASI TRANSAKSI --}}
    <div class="detail-card">

        <div class="detail-card-header">

            <div>
                <span class="detail-label">
                    INVOICE
                </span>

                <h3>
                    {{ $order->invoice_number }}
                </h3>
            </div>

            <span class="status-success">

                <i class="fas fa-check-circle"></i>

                Lunas

            </span>

        </div>


        <div class="detail-info-grid">

            <div class="detail-info-item">

                <span>Atas Nama</span>

                <strong>
                    {{ $order->recipient_name }}
                </strong>

            </div>


            <div class="detail-info-item">

                <span>Metode Pembayaran</span>

                <strong>
                    {{ strtoupper($order->payment_method) }}
                </strong>

            </div>


            <div class="detail-info-item">

                <span>Kasir</span>

                <strong>
                    {{ $order->cashier->name ?? '-' }}
                </strong>

            </div>


            <div class="detail-info-item">

                <span>Tanggal Transaksi</span>

                <strong>
                    {{ $order->created_at->format('d F Y') }}
                </strong>

            </div>

        </div>

    </div>


    {{-- DAFTAR PRODUK --}}
    <div class="detail-card">

        <div class="detail-section-title">

            <i class="fas fa-box"></i>

            Produk yang Dibeli

        </div>


        <div class="detail-items">

            @foreach($order->items as $item)

                <div class="detail-item">

                    <div class="detail-item-icon">

                        <i class="fas fa-box"></i>

                    </div>


                    <div class="detail-item-info">

                        <strong>
                            {{ $item->product_name }}
                        </strong>

                        <span>
                            {{ $item->size }}
                        </span>

                        <small>
                            {{ $item->quantity }} ×
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </small>

                    </div>


                    <div class="detail-item-subtotal">

                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- TOTAL --}}
    <div class="detail-card total-card">

        <div class="total-row">

            <span>
                Total Item
            </span>

            <strong>
                {{ $order->items->sum('quantity') }} Item
            </strong>

        </div>


        <div class="total-row">

            <span>
                Subtotal
            </span>

            <strong>
                Rp {{ number_format($order->total, 0, ',', '.') }}
            </strong>

        </div>


        <div class="total-divider"></div>


        <div class="total-final">

            <span>
                Total Pembayaran
            </span>

            <strong>
                Rp {{ number_format($order->total, 0, ',', '.') }}
            </strong>

        </div>

    </div>


    {{-- TOMBOL --}}
    <div class="detail-actions">

        <button type="button"
                class="print-receipt-button"
                onclick="printReceipt()">

            <i class="fas fa-print"></i>

            Cetak Struk

        </button>

    </div>

</div>


@endsection
@push('styles')

<style>

    .detail-header {
        margin-bottom: 25px;
    }

    .detail-header h2 {
        margin: 12px 0 5px;
        font-size: 26px;
        font-weight: 700;
        color: var(--text, #1e293b);
    }

    .detail-header p {
        margin: 0;
        color: var(--muted, #94a3b8);
        font-size: 13px;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #64748b;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 4px;
    }

    .back-button:hover {
        color: var(--accent-dark, #d97706);
    }

    .detail-container {
        max-width: 900px;
    }

    .detail-card {
        background: var(--surface, #ffffff);
        border: 1px solid var(--border, #f0e3d1);
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 18px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
    }

    .detail-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border, #f0e3d1);
    }

    .detail-label {
        display: block;
        color: var(--muted, #94a3b8);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.8px;
        margin-bottom: 5px;
    }

    .detail-card-header h3 {
        margin: 0;
        color: var(--text, #1e293b);
        font-size: 20px;
    }

    .status-success {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ecfdf3;
        color: #027a48;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .detail-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        padding-top: 20px;
    }

    .detail-info-item span {
        display: block;
        color: var(--muted, #94a3b8);
        font-size: 12px;
        margin-bottom: 5px;
    }

    .detail-info-item strong {
        color: #344054;
        font-size: 14px;
    }

    .detail-section-title {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--text, #1e293b);
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .detail-section-title i {
        color: var(--accent, #f59e0b);
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px 0;
        border-bottom: 1px solid var(--bg, #f0f2f5);
    }

    .detail-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .detail-item:first-child {
        padding-top: 0;
    }

    .detail-item-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: var(--accent-soft, #fff7e6);
        color: var(--accent, #f59e0b);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 16px;
    }

    .detail-item-info {
        flex: 1;
    }

    .detail-item-info strong {
        display: block;
        color: #344054;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .detail-item-info span {
        display: inline-block;
        color: #667085;
        font-size: 12px;
        margin-right: 10px;
    }

    .detail-item-info small {
        color: var(--muted, #98a2b3);
        font-size: 12px;
    }

    .detail-item-subtotal {
        color: var(--text, #1e293b);
        font-weight: 700;
        font-size: 14px;
    }

    .total-card {
        background: var(--bg, #fafbfc);
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 7px 0;
        color: #667085;
        font-size: 14px;
    }

    .total-row strong {
        color: #344054;
    }

    .total-divider {
        border-top: 1px dashed #e2d3ba;
        margin: 12px 0;
    }

    .total-final {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-final span {
        color: var(--text, #1e293b);
        font-size: 16px;
        font-weight: 700;
    }

    .total-final strong {
        color: var(--accent, #f59e0b);
        font-size: 20px;
        font-weight: 800;
    }

    .detail-actions {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 30px;
    }

    .print-receipt-button {
        border: none;
        background: var(--accent, #f59e0b);
        color: #ffffff;
        border-radius: 10px;
        padding: 12px 22px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .15s ease;
    }

    .print-receipt-button:hover {
        background: var(--accent-dark, #d97706);
    }

    @media (max-width: 700px) {

        .detail-info-grid {
            grid-template-columns: 1fr;
        }

        .detail-card-header {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }

        .detail-item-subtotal {
            font-size: 13px;
        }

    }

</style>

@endpush
@push('scripts')

<script>
function printReceipt() {

    const invoice = @json($order->invoice_number);
    const customer = @json($order->recipient_name);
    const payment = @json(strtoupper($order->payment_method));
    const total = @json($order->total);

    const items = @json(
        $order->items->map(function ($item) {
            return [
                'name' => $item->product_name,
                'size' => $item->size,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
            ];
        })->values()
    );

    function rupiah(value) {
        return new Intl.NumberFormat('id-ID').format(value);
    }

    let itemHtml = '';

    items.forEach(function(item) {

        itemHtml += `
            <div class="item">
                <div>
                    <strong>${item.name}</strong>
                    <small>${item.size} × ${item.quantity}</small>
                </div>

                <span>
                    Rp ${rupiah(item.subtotal)}
                </span>
            </div>
        `;
    });


    const receiptWindow = window.open(
        '',
        '_blank',
        'width=400,height=700'
    );

    receiptWindow.document.write(`
        <!DOCTYPE html>

        <html>

        <head>

            <title>Struk ${invoice}</title>

            <style>

                * {
                    box-sizing: border-box;
                }

                body {
                    font-family: Arial, sans-serif;
                    width: 320px;
                    margin: 0 auto;
                    padding: 20px;
                    color: #222;
                    font-size: 13px;
                }

                .header {
                    text-align: center;
                    margin-bottom: 15px;
                }

                .header h2 {
                    margin: 0;
                    font-size: 22px;
                }

                .header p {
                    margin: 4px 0;
                    color: #666;
                }

                .line {
                    border-top: 1px dashed #999;
                    margin: 12px 0;
                }

                .info {
                    margin-bottom: 10px;
                }

                .info-row {
                    display: flex;
                    justify-content: space-between;
                    margin: 5px 0;
                }

                .items {
                    margin-top: 10px;
                }

                .item {
                    display: flex;
                    justify-content: space-between;
                    gap: 10px;
                    margin: 10px 0;
                }

                .item strong {
                    display: block;
                }

                .item small {
                    display: block;
                    color: #666;
                    margin-top: 3px;
                }

                .item span {
                    white-space: nowrap;
                }

                .total {
                    display: flex;
                    justify-content: space-between;
                    font-size: 16px;
                    font-weight: bold;
                    margin-top: 12px;
                }

                .footer {
                    text-align: center;
                    margin-top: 20px;
                    color: #666;
                    font-size: 12px;
                }

                @media print {

                    body {
                        width: 100%;
                    }

                }

            </style>

        </head>

        <body>

            <div class="header">

                <h2>SANJAIKU</h2>

                <p>Kerupuk Sanjai</p>

            </div>


            <div class="line"></div>


            <div class="info">

                <div class="info-row">
                    <span>Invoice</span>
                    <strong>${invoice}</strong>
                </div>

                <div class="info-row">
                    <span>Atas Nama</span>
                    <strong>${customer}</strong>
                </div>

                <div class="info-row">
                    <span>Pembayaran</span>
                    <strong>${payment}</strong>
                </div>

                <div class="info-row">
                    <span>Tanggal</span>
                    <strong>{{ $order->created_at->format('d/m/Y') }}</strong>
                </div>

            </div>


            <div class="line"></div>


            <div class="items">

                ${itemHtml}

            </div>


            <div class="line"></div>


            <div class="total">

                <span>Total</span>

                <span>
                    Rp ${rupiah(total)}
                </span>

            </div>


            <div class="footer">

                <p>Terima kasih telah berbelanja di Sanjaiku.</p>

                <p>Selamat menikmati.</p>

            </div>


        </body>

        </html>
    `);

    receiptWindow.document.close();

    receiptWindow.focus();

    setTimeout(function() {

        receiptWindow.print();

        receiptWindow.close();

    }, 300);
}
</script>

@endpush