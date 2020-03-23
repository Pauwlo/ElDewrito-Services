@auth
    @if (empty(auth()->user()->email_verified_at))
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Verify your email address') }}
            </div>
            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                
                <p>
                    {{ __('Please check your email for a verification link.') }}<br>
                    {{ __('If you did not receive the email,') }}
                    
                    <a href="{{ route('verification.resend') }}"
                       onclick="event.preventDefault();document.getElementById('resend-email-form').submit();">
                        {{ __('click here to request another') }}</a>.

                    <form id="resend-email-form" action="{{ route('verification.resend') }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </p>
            </div>
        </div>
    @endif

    @if (session('verified'))
        <div class="alert alert-success" role="alert">
            {{ __('Your e-mail is now verified, thank you.') }}
        </div>
    @endif
@endauth