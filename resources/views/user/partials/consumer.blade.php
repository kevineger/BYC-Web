<div class="row">
    <div class="ten wide column">
        <div class="ui stacked segment">
            <h3 class="ui dividing header">Previous Courses Taken</h3>
            <div class="ui two column grid">
                @if($user->payments->count()>0)
                    @foreach($user->payments as $payment)
                        @foreach($payment->purchases as $purchase)
                            @if($purchase->time->end_date < Carbon\Carbon::now())
                                @include('user.partials.purchasedCourse')
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="ten wide column">
        <div class="ui stacked segment">
            <h3 class="ui dividing header">Upcoming/Current Courses</h3>

            <div class="ui two column grid">
                @if($user->payments->count()>0)
                    @foreach($user->payments as $payment)
                        @foreach($payment->purchases as $purchase)
                            @if($purchase->time->end_date >= Carbon\Carbon::now())
                                @include('user.partials.purchasedCourse')
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

