@foreach ($members as $member)
    <li class="media pull-right {{ isset($perRow) ? 'user-sniplet'.$perRow : '' }}">
        <a class="media-image pull-right" href="{{ route('member_path', ['id' => $member->id]) }}">
            <img src="{{ $member->image_path() }}" alt="{{ $member->name }}">
        </a>
        <div class="media-body">
            <h4 class="media-heading">
                {!! link_to_route('member_path', $member->name, ['id' => $member->id]) !!}
            </h4>
            {{ isset($showTimes) ? $member->updated_at->diffForHumans() : '' }}
        </div>
    </li>
@endforeach