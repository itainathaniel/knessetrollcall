<div class="col-xs-6 col-sm-2 text-center km">
    @if ($member->isInside && isset($showRibbon) && $showRibbon)
        <div class="corner-ribbon">
            <span>{{ Lang::get('knessetmember.ribbon_inside') }}</span>
        </div>
    @endif
    <a href="{{ route('member_path', ['id' => $member->id]) }}">
        <img src="{{ $member->image_path() }}" alt="{{ $member->name }}" title="{{ $member->name }}" class="img-thumbnail">
        <h4>{{ $member->name }}</h4>
        @if (isset($showTimes))
            <span class="text-muted">{{ $member->updated_at->diffForHumans() }}</span>
        @endif
    </a>
</div>