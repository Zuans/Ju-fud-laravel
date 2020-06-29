@extends('index.app')

@section('title','PAY | Process')

@section('content')
<script src="https://js.stripe.com/v3/"></script>
<form action="/charge" method="post" id="payment-form">
    <div class="form-row">
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>

    <button id="card-button" class="btn btn-success" data-secret="<?= $intent->client_secret ?>">
        Submit Payment
    </button>
</form>
@endsection


@section('script')
<script src="/js/stripe.js"></script>
@endsection