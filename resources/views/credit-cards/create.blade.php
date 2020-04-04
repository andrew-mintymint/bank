@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @include('includes.messages')
    <h1>Create Credit Card</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('credit_cards.store')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="numberInput">Card Number</label>
                            <input type="text" name="number" class="form-control" id="numberInput" maxlength="16" minlength="16" placeholder="Card Number" value="{{old('card_number')}}" required>
                            <button class="btn btn-block btn-outline-primary mt-2" onclick="generateNumber()">Generate</button>
                        </div>
                        <div class="form-group">
                            <label for="dateInput">Date</label>
                            <input type="date" name="date" class="form-control" id="dateInput" placeholder="Date" value="{{old('card_date')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="cvvInput">CVV</label>
                            <input type="text" name="cvv" class="form-control" id="cvvInput" placeholder="CVV"  maxlength="3" minlength="3" value="{{old('card_cvv')}}" required>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        function generateNumber(){
            $.get('/generate-card-number').then( d => {
                $('#numberInput').val(d.card);
            });
        }
    </script>
@endsection
