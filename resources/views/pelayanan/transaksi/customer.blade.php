@extends('layouts.karyawan_template')
@section('title','Karyawan - Data Customer')
@section('header','Data Customer')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">     
            <div class="table-responsive m-t-5">
                    <a href="{{url('list-customer-add')}}" class="btn btn-sm btn-primary">Tambah Customer</a>       
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr align="center" style="color:black; font-weight:bold">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telpon</th>
                            <th>Kelamin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($customer as $item)
                        <tr align="center" style="color:black;">
                            <td>{{$no}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->no_telp}}</td>
                            <td>
                                @if ($item->kelamin == 'L')
                                    <span class="label label-success">Laki-laki</span>
                                @else
                                    <span class="label label-info">Perempuan</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{url('customer-delete', $item->id_customer)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{url('add-order')}}" class="btn btn-sm btn-primary" style="color:white">Add Order</a>
                                    {{-- <a href="{{url('customer-edit', $item->id_customer)}}" class="btn btn-sm btn-info">Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button> --}}
                                </form>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
// DataTable
$(document).ready(function() {
    $('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
    });
});
</script>
@endsection