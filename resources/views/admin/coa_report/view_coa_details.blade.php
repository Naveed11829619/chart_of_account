@extends('layouts.admin')

@section('title', 'COA Report')

@section('style')
    <link href="{{ asset('assets/template/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

<style>
    h3 {
        text-align: center;
    }
    .level2{
        margin-left: 40px;
    }
    .level3{
        margin-left: 70px;
    }
    .level4{
        margin-left: 100px;
    }

</style>

@section('content')

    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header">
                <h3>
                    Chart Of Account
                </h3>
            <a href="{{url('coa/report')}}" class="btn btn-success align-right">Download PDF</a>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($levelones as $keyl1 => $level1 )
                        
                    <li class="level1">
                       <b>{{++$keyl1}}:</b> <b>{{$level1->title}}</b>
                       <ul>
                        @foreach ($level1->get_sub_accounts as $keyl2=> $level2)
                            
                        <li class="level2">
                            @php  
                                $value = $keyl1.'.'.++$keyl2
                            @endphp
                          <b>{{$keyl1.'.'.$keyl2}}:</b>  {{$level2->title}}
                          <ul>
                            @foreach ($level2->levelThree as $keyl3 => $level3 )
                            <li class="level3">
                            <b>{{$value.'.'.++$keyl3}}:</b> {{$level3->title}}
                            <ul>
                                @foreach ($level3->finalAccount as $keyl4=> $level4 )
                                <li class="level4"> 
                                    <b>{{$value.'.'.$keyl3.'.'.++$keyl4}}: </b> {{$level4->title}} 
                                 </li>
                                @endforeach
                            </ul>
                            </li>
                            @endforeach
                          </ul>
                        </li>
                        @endforeach
                       </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('.level1').click(function (e) { 
            e.preventDefault();
            $('.level2').slideToggle('slow');
            
        });
    </script>
    <script src="{{ asset('assets/template/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/template/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/template/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>


@endsection
