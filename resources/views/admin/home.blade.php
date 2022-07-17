@extends('admin.main')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="table-responsive pt-3">
                    <table class="table table-striped project-orders-table">
                        <thead>
                            <tr>
                                <th class="ml-5">ID</th>
                                <th>Project name</th>
                                <th>Customer</th>
                                <th>Deadline</th>
                                <th>Payouts </th>
                                <th>Traffic</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#D1</td>
                                <td>Consectetur adipisicing elit </td>
                                <td>Beulah Cummings</td>
                                <td>03 Jan 2019</td>
                                <td>$ 5235</td>
                                <td>1.3K</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                            Edit
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                            Delete
                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection