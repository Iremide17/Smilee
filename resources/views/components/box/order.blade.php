
<div class="col-md-12 mb-2">
    <div class="shop-order-box">
        <ul class="order-list">
            <li>Subtotal<span class="dark">{{ trans('global.naira') }}{{ number_format($sub, 2, ',', '.') ?? ''}}</span></li>
            <li>Shipping And Handling<span>{{ trans('global.naira') }}{{ number_format($ship, 2, ',', '.') ?? ''}}</span></li>
            <li class="total">TOTAL<span class="dark">{{ trans('global.naira') }}{{ number_format($total, 2, ',', '.') ?? ''}}</span></li>
        </ul>
    </div>
</div>