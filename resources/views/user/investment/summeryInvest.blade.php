@extends('user.Layout.master')
@section('title')
    Summery Of Investment || Admin
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h6 align="center" class="card-title"> Investment Summery
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-borderless">
                            <tr>
                                <th>Name</th>
                                <th>:</th>
                                <th colspan="4">{{ $invest->name }}</th>
                                <th></th>
                            <tr>
                                <th>A/c No </th>
                                <th>:</th>
                                <th>{{ $invest->id }}</th>
                                <th>Purchase Date </th>
                                <th>:</th>
                                <th>{{ $invest->date }}</th>
                            </tr>
                            <tr>
                                <th>Share Amount</th>
                                <th>:</th>
                                <th>500</th>
                                <?php $total_c_amount = ($total_share_amt + $loan_cur_prft) / $total_pshare;
                                ?>
                                <th>Current Share Value </th>
                                <th>:</th>
                                <th>{{ round($total_c_amount, 2) }}</th>
                            </tr>
                            <tr>
                                <th>Monthly Share Purchase</th>
                                <th>:</th>
                                <th>{{ $invest->pur_share }}</th>
                                <th>Total Share Purchase </th>
                                <th>:</th>
                                <th>{{ $purchase_share }}</th>
                            </tr>
                            <tr>
                                <th>Share Amount Monthly</th>
                                <th>:</th>
                                <th>{{ $invest->amount }}</th>
                                <th>New Share Amount Monthly </th>
                                <th>:</th>
                                <?php $total_sh = $invest->pur_share * $total_c_amount; ?>
                                <th>{{ round($total_sh, 2) }}</th>
                            </tr>
                            <tr>
                                <th>Total Share Amount</th>
                                <th>:</th>
                                <th>{{ $total_amt }}</th>
                                <th>Investment + Profit </th>
                                <th>:</th>
                                <?php $toal_amt = $total_c_amount * ($invest->pur_share * 12); ?>
                                <th>{{ round($toal_amt, 2) }}</th>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table">
                            @foreach ($member_detail as $key => $item)
                                <tbody>
                                    <tr>
                                        <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->p_share }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>{{ $item->date }}</td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')

    @endsection
