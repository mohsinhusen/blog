@extends('layouts.master')
@section('title')
    Total Paid Loan Details
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-wrap float-right" style="width:autorem;">
                        PaidUp Loan Details
                    </h5>
                    <a href="{{ url('paidup-loan') }}">
                        <button type="button" class="btn btn-sm btn-primary float-left py-1"><i
                                class="fas fa-arrow-left fa-0x" aria-hidden="true"></i></button></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Loan Holder</th>
                                <th>Installment</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <?php
                        $total1 = 0;
                        $total2 = 0;
                        ?>
                        @foreach ($paid_loandetail as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->loan_date }}</td>
                                <td><a href="{{ url('view-installment/' . $item->id) }}">{{ $item->name }}</a></td>
                                <td>{{ $item->loan_installment }}</td>
                                <td>{{ $item->loan_amt }}</td>
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
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=" csrf-token"]').attr('content')
                }
            });
            $('.servideletebtn').click(function(e) {
                e.preventDefault();
                var
                    del_id = $(this).closest("tr").find('.serdelete_val_id').val();
                swal({
                    title: "Are you Sure ?",
                    text: "Once Deleted, You will not able to recover this Data!",
                    icon: "warning",
                    button: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": del_id,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: '/delete-loan/' + del_id,
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
