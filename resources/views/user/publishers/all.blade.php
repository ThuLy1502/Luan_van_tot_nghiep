@extends('user.main')

@section('content')
<section id="popular-product" class="ecommerce">
    <div class="container">
        <!-- Shopping items content -->
        <div class="shopping-content">

            <!-- Block heading two -->
            <div class="block-heading-two text-center">
                <h3><span> {{ $title }} </span></h3>
            </div>

            <div class="row">
                @foreach($books as $book)
                <div class="col-md-3 col-sm-6">
                    <!-- Shopping items -->
                    <div class="shopping-item">
                        <form>
                            @csrf
                            <!-- Image -->
                            <a href="#" id="{{ $book->book_id }}" class="xemnhanh" data-toggle="modal"
                                data-target="#exampleModalCenter"><img class="img-responsive"
                                    src="{{URL('storage/app/public/uploads-book/'.$book->book_thumb)}}" alt="sach"
                                    width="135" height="175" /></a>

                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1"
                                role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div id="book_thumb"></div>
                                                    <div class="col-sm-9">
                                                        <h3 style="color: #32c8de;" id="book_name"></h3>
                                                        <div> Khổ sách: <span
                                                                style="font-weight: bold; line-height: 1.8;"
                                                                id="book_format"></span> cm.</div>
                                                        <div> Số trang: <span
                                                                style="font-weight: bold; line-height: 1.8;"
                                                                id="book_pages"></span> trang.</div>
                                                        <div> Trọng lượng: <span
                                                                style="font-weight: bold; line-height: 1.8;"
                                                                id="book_weight"></span> g.</div>
                                                        <div> Năm xuất bản: <span
                                                                style="font-weight: bold; line-height: 1.8;"
                                                                id="book_publishing_year"></span>.</div>
                                                        <div style="font-weight: bold; line-height: 1.8;"> Giới thiệu
                                                            tóm tắt: </div>
                                                        <div id="book_description"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="book_id"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="clearfix"></div>
                        <!-- Shopping item hover block & link -->
                        <div class="item-hover bg-color hidden-xs">
                            <a href="{{URL('sach/'.$book->book_id. '.html')}}"> Chi tiết </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            {{ $books->links('user.paginate') }}
            <!-- Pagination end-->

            <div style="padding: 30px;"></div>

        </div>
    </div>
</section>
@endsection