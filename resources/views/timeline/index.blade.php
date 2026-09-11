@extends('layouts.layout')

@section('title', 'Timeline')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        {{-- HEADER --}}

        <div class="card-header bg-success text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="fw-bold mb-0">
                    Timeline
                </h5>


                @php
                    $unreadCount = $data->filter(function ($timeline) {
                        return ($timeline->log['status'] ?? null) === 'unread';
                    })->count();
                @endphp


                @if($unreadCount > 0)

                    <span class="badge bg-warning text-dark">

                        {{ $unreadCount }} belum dibaca

                    </span>

                @endif

            </div>

        </div>


        {{-- LIST TIMELINE --}}

        <div class="card-body p-0">

            @forelse ($data as $timeline)

                @php

                    $log = $timeline->log ?? [];

                    $status = $log['status'] ?? 'unread';

                    $action = $log['action'] ?? 'Aktivitas';

                    $openedWith =
                        $log['opened_with'] ??
                        'Tidak diketahui';

                    $record =
                        $log['data'] ??
                        [];

                @endphp


                <a
                    href="{{ route('timeline.show', $timeline->id) }}"
                    class="text-decoration-none text-dark"
                >

                    <div
                        class="p-3 border-bottom
                        {{ $status === 'unread' ? 'bg-light' : '' }}"
                    >

                        <div class="d-flex justify-content-between align-items-start">


                            {{-- INFORMASI --}}

                            <div>

                                <div class="fw-bold">

                                    {{ ucfirst($action) }}

                                </div>


                                <div class="small text-muted">

                                    {{ ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $openedWith
                                        )
                                    ) }}

                                </div>


                                <div class="small text-muted mt-1">

                                    {{ $timeline->created_at->diffForHumans() }}

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <div>

                                @if ($status === 'unread')

                                    <span class="badge bg-success">

                                        Baru

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Dibaca

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- DATA SINGKAT --}}

                        @if(count($record) > 0)

                            <div class="mt-2 small text-muted">

                                @foreach ($record as $key => $value)

                                    @if (!is_array($value))

                                        <span class="me-3">

                                            <strong>
                                                {{ ucfirst(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $key
                                                    )
                                                ) }}:
                                            </strong>

                                            {{ $value }}

                                        </span>

                                    @endif

                                @endforeach

                            </div>

                        @endif

                    </div>

                </a>


            @empty

                <div class="text-center text-muted p-5">

                    <h5>
                        Belum ada timeline.
                    </h5>

                    <div class="small">
                        Aktivitas akan muncul di sini.
                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection