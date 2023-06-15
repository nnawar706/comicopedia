@if ($errors->any())
    <div class="toast show fixed-bottom m-5 ms-auto text-bg-danger" style="--bs-bg-opacity: .8;" animation="true" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ $errors->first() }}
            </div>
        </div>
    </div>
@endif
