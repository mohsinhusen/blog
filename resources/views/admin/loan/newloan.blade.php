@extends('layouts.master')
@section('title')
    New Loan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('role-loan') }}">
                        <button type="button" class="btn btn-sm btn-primary">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i></button></a>
                    <h5 class="card-title float-right">
                        <i class="fa fa-inr" aria-hidden="true"> || </i> New Loan
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ url('store-loan') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Type of Loan</label>
                                    <select id="loan_type" name="loan_type" class="form-control">
                                        <option value="" disabled selected>--Select--</option>
                                        <option value="Muarabaha">Muarabaha</option>
                                        <option value="Karz-e-Hasna">Karz-e-Hasna</option>
                                        <option value="Medical Help">Medical Help</option>

                                    </select>
                                </div>
                                @error('loan_type')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Loan Duration</label>
                                    <select name="loan_duration" class="form-control">
                                        <option value="" disabled selected>--Select--</option>
                                        <option value="24">24@Month (2 Years)</option>
                                        <option value="6">6@Month Medical Help</option>
                                        
                                    </select>
                                </div>
                                @error('loan_duration')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Loan Reason</label>
                                    <select name="loan_reason" id="loan_reason" class="form-control">
                                        <option value="" disabled selected>--Select--</option>
                                        <option value="Farming Material">Farming Material</option>
                                        <option value="New Vehicle">New Vehicle</option>
                                        <option value="Business">Business</option>
                                        <option value="Make New House Material">Make New House Material</option>
                                        <option value="Furniture">Furniture</option>
                                        <option value="Animal Purchase">Animal Purchase</option>
                                        <option value="Broiler Food">Broiler Food</option>
                                        <option value="Goat Farming">Goat Farming</option>
                                        <option value="Poultry Farming">Poultry Farming</option>
                                        <option value="Medical">Medical</option>
                                        <option value="Other">Other</option>

                                    </select>
                                </div>
                                @error('loan_reason')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Loan Date</label>
                                    <input type="date" name="loan_date" value="{{ old('loan_date') }}" class="form-control">
                                </div>
                                @error('loan_date')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Select Member Name</label>
                                    <select name="loan_holder" class="form-control">
                                        <option value="" disabled selected>--Select--</option>
                                        @foreach ($member as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('loan_holder')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Loan Amount </label>
                                    <input type="number" id="loan_amt" name="loan_amt" value="{{ old('loan_amt') }}" class="form-control"
                                        placeholder="Enter Loan Amount">
                                </div>
                                @error('loan_amt')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Enter Profit Base on Contarct </label>
                                    <input type="number" id="loan_profit" name="loan_profit" value="{{ old('loan_profit') }}"
                                        class="form-control" placeholder="Enter Profit Base on Contarct">
                                </div>
                                @error('loan_profit')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Enter Installment</label>
                                    <input type="number" id="loan_installment" name="loan_installment" value="{{ old('loan_installment') }}"
                                        class="form-control" placeholder="Enter Installment">
                                </div>
                                @error('loan_installment')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Guarantor - 1 </label>
                                    <select name="loan_g_1" id="loan_g_1" class="form-control">
                                        <option value="" disabled selected>--Select--</option>
                                        @foreach ($member as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('loan_g_1')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Guarantor - 2 </label>
                                    <select name="loan_g_2" id="loan_g_2" class="form-control">
                                        <option value="" disabled selected>--Select--</option>
                                        @foreach ($member as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('loan_g_2')
                                    <div class="alert-success"><strong>{{ $message }}</strong></span></div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-right">Save Loan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    <script>
    $(document).ready(function() {
        $("#loan_type").change(function () {
       
            if ($(this).val() == "Karz-e-Hasna" || $(this).val() == "Medical Help") {
                $("#loan_profit").attr("disabled", "disabled");
                $("#loan_installment").attr("disabled", "disabled");
                $("#loan_g_1").attr("disabled",true);
                $("#loan_g_2").attr("disabled",true);
                $("#loan_reason").attr("disabled",true);
                $("#loan_duration").attr("disabled",true);
            
            }elseif($(this).val() == "Muarabaha")
            {
                $("#loan_profit").attr("enabled", "enabled");
                $("#loan_installment").attr("enabled", "enabled");
                $("#loan_g_1").attr("enabled",true);
                $("#loan_g_2").attr("enabled",true);
                $("#loan_reason").attr("enabled",true);
                $("#loan_duration").attr("enabled",true);
                }
            })
    });
</script>
    @endsection
