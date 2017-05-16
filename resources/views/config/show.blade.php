@extends('main')

@section('content')

    <div class="row">
        <div class="col col-md-4 col-md-offset-2">
            <h3>Config files</h3>

            @if($configs)
                <table class="table">
                    <tr>
                        <td>
                            <a href="">Edit</a>
                        </td>
                        <td>
                            Image Path
                        </td>
                        <td>
                            {{$configs->image_path}}
                        </td>


                    </tr>



                </table>

                @else
                    <h5>No Config Files</h5>
                <a href="">Create Config</a>
            @endif






        </div>

       





    </div>


    </div>

@stop