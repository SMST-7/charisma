@extends('panel.layouts.master')
@section('title','لاگ ها')

@section('search')
    <input class="form-control" type="text" id="searchInput" placeholder="جستجو بر اساس عنوان ...">
@endsection

@section('search-mobile')
    <input class="form-control" type="text" id="searchInputMobile" placeholder="اینجا جستجو کنید ...">
@endsection

@section('top_page')
    <x-top-page title="لاگ ها" :items="['فروشگاه','لاگ ها']" homeUrl="/" />
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>لاگ ها</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>کاربر</th>
                        <th>عملیات</th>
                        <th>مدل</th>
                        <th>شناسه مدل</th>
                        <th>توضیحات</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody id="logTable">
                    @foreach($logs as $log)
                        <tr>
                            <th>{{ $loop->iteration + ($logs->currentPage()-1) * $logs->perPage() }}</th>
                            <td>{{ $log->user ? $log->user->username : 'کاربر ناشناس' }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->model_type }}</td>
                            <td>{{ $log->model_id }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at ? \Morilog\Jalali\Jalalian::fromDateTime($log->created_at)->format('Y/m/d H:i') : '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- صفحه‌بندی -->
                <div class="d-flex justify-content-center">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function performSearch(searchTerm) {
            const rows = document.querySelectorAll('#logTable tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm.toLowerCase()) ? '' : 'none';
            });
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            performSearch(this.value);
        });

        document.getElementById('searchInputMobile').addEventListener('input', function() {
            performSearch(this.value);
        });
    </script>
@endsection
