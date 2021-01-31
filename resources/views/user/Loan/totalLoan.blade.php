@extends('user.Layout.master')
@section('title')
    Total Loan || Member
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>loan Date</th>
                                    <th>Installment</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <?php
                            $total1 = 0;
                            $total2 = 0;
                            ?>
                            @foreach ($loan_detail as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><a href="{{ url('summary-loans/' . $item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->loan_date }}</a></td>
                                    <td>{{ $item->loan_installment }}</a></td>
                                    <td>{{ $item->loan_amt }}</a></td>

                                </tr>
                                </tbody>
                                <?php
                                $total1 += $item->loan_installment;
                                $total2 += $item->loan_amt;
                                ?>

                            @endforeach
                            <thead>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th>{{ $total1 }}</th>
                                <th>{{ $total2 }}</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    @endsection
