<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Chart Of Account</title>
</head>
<style>
   html{
    font-family: sans-serif;
   }
   body{
    font-family: sans-serif;
   }
     h3 {
        text-align: center;
    }
    li{
        list-style: none;
    }
    h3 {
        text-align: center;
    }
    .level2{
        margin-left: 20px;
    }
    .level3{
        margin-left: 40px;
    }
    .level4{
        margin-left: 60px;
    }
    
</style>
<body>
    
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-header">
                <h3>
                    Chart Of Account
                </h3>
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($levelones as $keyl1 => $level1 )
                        
                    <li>
                       <b>{{++$keyl1}}:</b> <b> {{$level1->title}} </b>
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
</body>
</html>