@extends('layouts.default')

@section('title', '| ' . Lang::get('parties.title'))

@section('nav-active-parties', 'class="active"')

@section('content')
    <div class="row">

            <?php $party = ''; ?>
            @foreach ($members as $key => $member)
                @if ($party != $member->party->name)
                    @if ($party != '')
                        </div>
                        </div>
                    @endif
                    <div class="col-md-12 clearfix">
                        <div class="page-header">
                            <h2>
                                <a href="{{ route('party_path', [$member->party]) }}">{{ $member->party->name }}
                            </h2>
                        </div>
                        <div class="users-sniplet">
                    <?php $party = $member->party->name; ?>
                @endif

                @include('layouts.partials.listMember', ['member' => $member, 'showRibbon' => true])
            @endforeach

            </div>
        </div>
    </div>
@stop