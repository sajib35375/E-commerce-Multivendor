







<div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">

                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="fi-rs-arrow-small-left"></i></a>
                            </li>

                            @foreach($elements as $element)
                                @foreach($element as $page => $url)
                                    @if($paginator->currentPage() == $page)
                                    <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                @endforeach
                            @endforeach



                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fi-rs-arrow-small-right"></i></a>
                            </li>

                        </ul>
                    </nav>
                </div>
