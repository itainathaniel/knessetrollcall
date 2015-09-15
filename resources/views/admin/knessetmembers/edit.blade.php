@extends('admin.layout')

@section('content')
    <h1 class="page-header">{{ $knessetmember->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ action('Admin\KnessetMembersController@update', $knessetmember) }}">
                <input name="_method" type="hidden" value="PATCH">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">מספר</label>
                    <pre>{{ $knessetmember->id }}</pre>
                </div>
                <div class="form-group">
                    <label for="knesset_id">מספר מזהה כנסת</label>
                    <input type="text" name="knesset_id" id="knesset_id" class="form-control" value="{{ $knessetmember->knesset_id }}">
                </div>
                <div class="form-group">
                    <label for="party_id">מפלגה</label>
                    <select name="party_id" id="party_id" class="form-control">
                        @foreach($parties as $party)
                            <option value="{{ $party->id }}" {{ $knessetmember->party_id == $party->id ? 'selected' : '' }}>{{ $party->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">שם</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $knessetmember->name }}">
                </div>
                <div class="form-group">
                    <label for="isInside">בכנסת?</label>
                    <select name="isInside" id="isInside" class="form-control">
                        <option value="0" {{ $knessetmember->isInside == 0 ? 'selected' : '' }}>לא</option>
                        <option value="1" {{ $knessetmember->isInside == 1 ? 'selected' : '' }}>כן</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">תמונה</label>
                    <input type="text" name="image" id="image" class="form-control text-left" value="{{ $knessetmember->image }}">
                    <span id="helpBlock" class="help-block text-left">http://www.knesset.gov.il/<em><strong>URI</strong></em></span>
                </div>
                <div class="form-group">
                    <label for="active">פעיל?</label>
                    <select name="active" id="active" class="form-control">
                        <option value="0" {{ $knessetmember->active == 0 ? 'selected' : '' }}>לא</option>
                        <option value="1" {{ $knessetmember->active == 1 ? 'selected' : '' }}>כן</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">תאריך הוספה</label>
                    <pre>{{ $knessetmember->created_at->format('d/m/Y H:i:s') }}</pre>
                </div>
                <div class="form-group">
                    <label for="name">תאריך עדכון אחרון</label>
                    <pre>{{ $knessetmember->updated_at->format('d/m/Y H:i:s') }}</pre>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">שמירה</button>
                </div>
            </form>
        </div>
    </div>
@stop