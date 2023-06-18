<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
            Other Configurations
        </button>
    </h2>
    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            <br>
            <form method="post" action="{{ route('update-config') }}">
                @csrf
                @method('PUT')
                <div class="form-check form-switch" style="margin-left: 20px">
                    @if($data['config']['email_admins_on_new_user_sign_in'] == 1)
                        @php
                            $isChecked = true;
                        @endphp
                    @else
                        @php
                            $isChecked = false;
                        @endphp
                    @endif
                    <input class="form-check-input" type="checkbox" name="email_admins_on_new_user_sign_in" style="cursor: pointer" value="1" {{ $isChecked ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Email admins when a new user signs in</label>
                </div>
                <div class="form-check form-switch" style="margin-left: 20px">
                    @if($data['config']['welcome_mail_on_new_user_sign_in'] == 1)
                        @php
                            $isChecked = true;
                        @endphp
                    @else
                        @php
                            $isChecked = false;
                        @endphp
                    @endif
                    <input class="form-check-input" type="checkbox" name="welcome_mail_on_new_user_sign_in" style="cursor: pointer" value="1" {{ $isChecked ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Send welcome emails to users on first sign in</label>
                </div>
                <div class="form-check form-switch" style="margin-left: 20px">
                    @if($data['config']['promo_on_new_user_sign_in'] == 1)
                        @php
                            $isChecked = true;
                        @endphp
                    @else
                        @php
                            $isChecked = false;
                        @endphp
                    @endif
                    <input class="form-check-input" type="checkbox" name="promo_on_new_user_sign_in" style="cursor: pointer" value="1" {{ $isChecked ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Offer promo code when a new user signs in</label>
                </div>
                <div class="form-check form-switch" style="margin-left: 20px">
                    @if($data['config']['notify_admins_on_new_order'] == 1)
                        @php
                            $isChecked = true;
                        @endphp
                    @else
                        @php
                            $isChecked = false;
                        @endphp
                    @endif
                        <input class="form-check-input" type="checkbox" name="notify_admins_on_new_order" style="cursor: pointer" value="1" {{ $isChecked ? 'checked' : '' }}>
                        <label class="form-check-label">Notify admins when a new order is posted</label>
                </div>
                <div class="form-check form-switch" style="margin-left: 20px">
                    @if($data['config']['weekly_newsletter'] == 1)
                        @php
                            $isChecked = true;
                        @endphp
                    @else
                        @php
                            $isChecked = false;
                        @endphp
                    @endif
                    <input class="form-check-input" type="checkbox" name="weekly_newsletter" style="cursor: pointer" value="1" {{ $isChecked ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Send newsletters weekly to subscribers</label>
                </div>
                <hr>
                <button type="submit" class="btn">
                    <a href="#" class="btn btn-primary btn-icon-split"><span class="text">Update Configuration</span></a>
                </button>
            </form>
        </div>
    </div>
</div>
