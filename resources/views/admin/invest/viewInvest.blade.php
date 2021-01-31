@extends('layouts.master')
@section('title')
    Investment Statement
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 align="center" class="card-title"> Investment Statement
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                <th>Buy Date </th>
                                <th>:</th>
                                <th>{{ $invest->date }}</th>
                            </tr>
                            <tr>
                                <th>Share Value</th>
                                <th>:</th>
                                <th>500</th>
                                <?php $total_c_amount = ($total_share_amt + $loan_cur_prft) / $total_pshare;
                                ?>
                                <th>Update Share</th>
                                <th>:</th>
                                <th>{{ round($total_c_amount, 2) }}</th>
                            </tr>
                            <tr>
                                <th>Monthly Share</th>
                                <th>:</th>
                                <th>{{ $invest->pur_share }}</th>
                                <th>Total Share </th>
                                <th>:</th>
                                <th>{{ $purchase_share }}</th>
                            </tr>
                            <tr>
                                <th>Share Amount</th>
                                <th>:</th>
                                <th>{{ $invest->amount }}</th>
                                <th>Update Share Amount </th>
                                <th>:</th>
                                <?php $total_sh = $invest->pur_share * $total_c_amount; ?>
                                <th>{{ round($total_sh, 2) }}</th>
                            </tr>
                            <tr>
                                <th>Total Share Amount</th>
                                <th>:</th>
                                <th>{{ $total_amt }}</th>
                                <th>Total Update Share Amount </th>
                                <th>:</th>
                                <?php $toal_amt = $total_c_amount * ($invest->pur_share * 12); ?>
                                <th>{{ round($toal_amt, 2) }}</th>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            @foreach ($member_detail as $key => $item)
                                <tr>
                                    <input type="hidden" class="serdelete_val_id" value="{{ $item->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->p_share }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->date }}</td>
                                    @if ($item->loan_status == 'Advance')
                                        <td><span class="badge badge-primary">{{ $item->loan_status }}</span></td>
                                    @else
                                        <td><span class="badge badge-success">{{ $item->loan_status }}</span></td>
                                    @endif
                                    <td> <a href="{{ url('edit-invest/' . $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-edit" aria-hidden="true"> </i></a>
                                    </td>
                                    <td> <button type="button" class="btn btn-sm btn-danger servideletebtn">
                                            <i class="fa fa-trash" aria-hidden="true"> </i> </a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.servideletebtn').click(function(e) {
                e.preventDefault();
                var del_id = $(this).closest("tr").find('.serdelete_val_id').val();
                swal({
                        title: "Are you Sure ?",
                        text: "Once Deleted, You will not able to recover this Data!",
                        icon: "warning",
                        button: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var data = {
                                "_token": $('input[name=_token]').val(),
                                "id": del_id,
                            };
                            $.ajax({
                                url: "{{ url('delete-invest') }}" + '/' + del_id,
                                type: "DELETE",
                                data: data,
                                success: function(response) {
                                    swal(response.status, {
                                            icon: "success",
                                        })
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            });
                        }
                    });
            });
        });

    </script>
@endsection
