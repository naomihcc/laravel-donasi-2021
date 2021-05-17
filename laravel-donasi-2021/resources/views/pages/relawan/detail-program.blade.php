@extends('layouts.master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Program</h3>
                </div>
                @include('includes.greeting')
            </div>
        </div>

        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <div class="alert alert-{{ $msg }} alert-dismissible fade show">
                    {{ Session::get('alert-' . $msg) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="card-title">{{$program->nama_program}}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="programs">
                        <tbody>
                            <tr>
                                <th width="40%">Relawan</th>
                                <td>{{$program->userProgram->nama}}</td>
                            </tr>
                            <tr>
                                <th width="40%">Target</th>
                                <td>Rp. {{$program->target}}</td>
                            </tr>
                            <tr>
                                <th width="40%">Batas akhir</th>
                                <td>{{$program->batas_akhir}}</td>
                            </tr>
                            <tr>
                                <td>
                                    {!!$program->info!!}
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-sm btn-danger "data-bs-toggle="modal"
                        data-bs-target="#program_destroy_{{$program->id}}">
                        Hapus
                    </button>

                    {{-- Modal Delete --}}
                    <div class="modal fade text-left" id="program_destroy_{{$program->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="$program_dest_ttl_{{$program->id}}">Apakah Anda yakin untuk menghapus program {{$program->nama_program}}?</h5>
                                    <button type="button" class="close rounded-pill"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Tidak</span>
                                    </button>
                                    <form action="{{route('relawan.programs.destroy', $program->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger ml-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Ya</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
