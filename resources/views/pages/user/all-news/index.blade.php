@extends('layouts.user.app')

@section('style')
    <style>
        .tag-list li a:hover {
            background-color: #175A95;
            color: var(--whiteColor);
        }
        .tag-list li a {
            color: var(--optionalColor);
            background-color: var(--whiteColor);
            border-radius: 5px;
            padding: 7px 15px 3px 17px;
            font-size: 14px;
            line-height: 30px;
            display: inline-block;
            border: 1px solid #eee;
        }
        .theme-dark .tag-list li a:hover {
            background-color: #175A95;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--whiteColor);
        }
    </style>
@endsection

@section('content')
    <div class="">
        <div class="modal fade searchModal" id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <input type="text" class="form-control" placeholder="Search here....">
                        <button type="submit"><i class="fi fi-rr-search"></i></button>
                    </form>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ri-close-line"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="">
    <div class="sports-wrap ptb-100">
    <div class="container">
    <div class="row gx-55 gx-5">
        <div class="col-lg-8">
            <div class="row">
               
                <div class="col-md-6">
                    <div class="news-card-six">
                        <div class="news-card-img">
                            <img src="{{asset('assets/img/news/news-28.webp')}}" width="400px" height="250" style="width: 100%;object-fit:cover;">
                            
                                <p class="tag">
                                    <a href="{{route('news.category')}}" class="news-cat">Pendidikan</a>
                                </p>
                        </div>
                        <div class="news-card-info">
                            <div class="news-author">
                                <div class="news-author-img">
                                    <img src="{{ asset('admin/dist/images/profile/user-1.jpg') }}"
                                        alt="Image" width="40px" height="40px"
                                        style="border-radius: 50%; object-fit:cover;" />
                                </div>
                                <h5>By <a href="#">Karin</a>
                                </h5>
                            </div>
                            <h3><a
                                href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, quis.</a>
                            </h3>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a
                                        href="javascript:void(0)">8 Juni 2024</a>
                                </li>
                                <li><i
                                        class="fi fi-rr-eye"></i>20x dilihat
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="news-card-six">
                        <div class="news-card-img">
                            <img src="{{asset('assets/img/news/news-28.webp')}}" width="400px" height="250" style="width: 100%;object-fit:cover;">
                            
                                <p class="tag">
                                    <a href="{{route('news.category')}}" class="news-cat">Pendidikan</a>
                                </p>
                        </div>
                        <div class="news-card-info">
                            <div class="news-author">
                                <div class="news-author-img">
                                    <img src="{{ asset('admin/dist/images/profile/user-1.jpg') }}"
                                        alt="Image" width="40px" height="40px"
                                        style="border-radius: 50%; object-fit:cover;" />
                                </div>
                                <h5>By <a href="#">Karin</a>
                                </h5>
                            </div>
                            <h3><a
                                href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, quis.</a>
                            </h3>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a
                                        href="javascript:void(0)">8 Juni 2024</a>
                                </li>
                                <li><i
                                        class="fi fi-rr-eye"></i>20x dilihat
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="news-card-six">
                        <div class="news-card-img">
                            <img src="{{asset('assets/img/news/news-28.webp')}}" width="400px" height="250" style="width: 100%;object-fit:cover;">
                            
                                <p class="tag">
                                    <a href="{{route('news.category')}}" class="news-cat">Pendidikan</a>
                                </p>
                        </div>
                        <div class="news-card-info">
                            <div class="news-author">
                                <div class="news-author-img">
                                    <img src="{{ asset('admin/dist/images/profile/user-1.jpg') }}"
                                        alt="Image" width="40px" height="40px"
                                        style="border-radius: 50%; object-fit:cover;" />
                                </div>
                                <h5>By <a href="#">Karin</a>
                                </h5>
                            </div>
                            <h3><a
                                href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, quis.</a>
                            </h3>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a
                                        href="javascript:void(0)">8 Juni 2024</a>
                                </li>
                                <li><i
                                        class="fi fi-rr-eye"></i>20x dilihat
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="news-card-six">
                        <div class="news-card-img">
                            <img src="{{asset('assets/img/news/news-28.webp')}}" width="400px" height="250" style="width: 100%;object-fit:cover;">
                            
                                <p class="tag">
                                    <a href="{{route('news.category')}}" class="news-cat">Pendidikan</a>
                                </p>
                        </div>
                        <div class="news-card-info">
                            <div class="news-author">
                                <div class="news-author-img">
                                    <img src="{{ asset('admin/dist/images/profile/user-1.jpg') }}"
                                        alt="Image" width="40px" height="40px"
                                        style="border-radius: 50%; object-fit:cover;" />
                                </div>
                                <h5>By <a href="#">Karin</a>
                                </h5>
                            </div>
                            <h3><a
                                href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, quis.</a>
                            </h3>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a
                                        href="javascript:void(0)">8 Juni 2024</a>
                                </li>
                                <li><i
                                        class="fi fi-rr-eye"></i>20x dilihat
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="news-card-six">
                        <div class="news-card-img">
                            <img src="{{asset('assets/img/news/news-28.webp')}}" width="400px" height="250" style="width: 100%;object-fit:cover;">
                            
                                <p class="tag">
                                    <a href="{{route('news.category')}}" class="news-cat">Pendidikan</a>
                                </p>
                        </div>
                        <div class="news-card-info">
                            <div class="news-author">
                                <div class="news-author-img">
                                    <img src="{{ asset('admin/dist/images/profile/user-1.jpg') }}"
                                        alt="Image" width="40px" height="40px"
                                        style="border-radius: 50%; object-fit:cover;" />
                                </div>
                                <h5>By <a href="#">Karin</a>
                                </h5>
                            </div>
                            <h3><a
                                href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, quis.</a>
                            </h3>
                            <ul class="news-metainfo list-style">
                                <li><i class="fi fi-rr-calendar-minus"></i><a
                                        href="javascript:void(0)">8 Juni 2024</a>
                                </li>
                                <li><i
                                        class="fi fi-rr-eye"></i>20x dilihat
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                    {{-- <div class="d-flex justify-content-center">
                        <div>
                            <img src="{{ asset('assets/img/no-data.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="text-center">
                        <h4>Tidak ada data</h4>
                    </div> --}}
            </div>

            {{-- <div class="text-center item-center mt-4 d-flex justify-content-center" style="background-color:#F6F6F6; width:100%;height:200px;">
                <h5 class="mt-5 text-dark">Iklan</h5>
            </div> --}}
            
        </div>

        <div class="col-lg-4">
            <div class="sidebar">
                <div class="sidebar-widget" style="width: 450px">
                    <h3 class="sidebar-widget-title">Kategori Populer</h3>
                    <ul class="category-widget list-style">
                        <li>
                            <a data-toggle="tooltip" data-placement="top" title="Fashion"
                                href="#"><img
                                    src="{{ asset('assets/img/icons/arrow-right.svg') }}"
                                    alt="Image">Fashion
                                <span>( 10 )</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="top" title="Fashion"
                                href="#"><img
                                    src="{{ asset('assets/img/icons/arrow-right.svg') }}"
                                    alt="Image">Fashion
                                <span>( 10 )</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="top" title="Fashion"
                                href="#"><img
                                    src="{{ asset('assets/img/icons/arrow-right.svg') }}"
                                    alt="Image">Fashion
                                <span>( 10 )</span>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tooltip" data-placement="top" title="Fashion"
                                href="#"><img
                                    src="{{ asset('assets/img/icons/arrow-right.svg') }}"
                                    alt="Image">Fashion
                                <span>( 10 )</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="sidebar-widget" style="width: 450px">
                    <h3 class="sidebar-widget-title">
                        Berita Popular
                    </h3>
                    <div class="news-card-three">
                        <div class="news-card-img" style="height: 100px; width: 100px">
                            <img src="{{asset('assets/img/news/news-3.webp')}}" alt="Image" />
                        </div>
                        <div class="news-card-info">
                            <h3><a href="business-details.html">Man Wearing Black Pullover Hoodie To Smoke Light In</a></h3>
                            <ul class="news-metainfo list-style d-flex">
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="news-by-date.html">Apr 15, 2023</a></li>
                                <li><i class="fi fi-rr-eye"></i><a href="news-by-dateus">10</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="news-card-three">
                        <div class="news-card-img" style="height: 100px; width: 100px">
                            <img src="{{asset('assets/img/news/news-3.webp')}}" alt="Image" />
                        </div>
                        <div class="news-card-info">
                            <h3><a href="business-details.html">Man Wearing Black Pullover Hoodie To Smoke Light In</a></h3>
                            <ul class="news-metainfo list-style d-flex">
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="news-by-date.html">Apr 15, 2023</a></li>
                                <li><i class="fi fi-rr-eye"></i><a href="news-by-dateus">10</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="news-card-three">
                        <div class="news-card-img" style="height: 100px; width: 100px">
                            <img src="{{asset('assets/img/news/news-3.webp')}}" alt="Image" />
                        </div>
                        <div class="news-card-info">
                            <h3><a href="business-details.html">Man Wearing Black Pullover Hoodie To Smoke Light In</a></h3>
                            <ul class="news-metainfo list-style d-flex">
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="news-by-date.html">Apr 15, 2023</a></li>
                                <li><i class="fi fi-rr-eye"></i><a href="news-by-dateus">10</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="news-card-three">
                        <div class="news-card-img" style="height: 100px; width: 100px">
                            <img src="{{asset('assets/img/news/news-3.webp')}}" alt="Image" />
                        </div>
                        <div class="news-card-info">
                            <h3><a href="business-details.html">Man Wearing Black Pullover Hoodie To Smoke Light In</a></h3>
                            <ul class="news-metainfo list-style d-flex">
                                <li><i class="fi fi-rr-calendar-minus"></i><a href="news-by-date.html">Apr 15, 2023</a></li>
                                <li><i class="fi fi-rr-eye"></i><a href="news-by-dateus">10</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sidebar-widget" style="width: 450px">
                    <h3 class="sidebar-widget-title">Tag Populer</h3>
                    <ul class="tag-list list-style">
                    <li><a href="{{route('list-tag.user')}}">BUSINESS</a></li>
                    <li><a href="{{route('list-tag.user')}}">FOOD</a></li>
                    <li><a href="{{route('list-tag.user')}}">SCIENCE</a></li>
                    <li><a href="{{route('list-tag.user')}}">LIFESTYLE</a></li>
                    <li><a href="{{route('list-tag.user')}}">SPORTS</a></li>
                    <li><a href="{{route('list-tag.user')}}">PHOTO</a></li>
                    <li><a href="{{route('list-tag.user')}}">TECHNOLOGY</a></li>
                    <li><a href="{{route('list-tag.user')}}">CONTENT</a></li>
                    <li><a href="{{route('list-tag.user')}}">FEATURED</a></li>
                    <li><a href="{{route('list-tag.user')}}">AUDIO</a></li>
                    <li><a href="{{route('list-tag.user')}}">FASHION</a></li>
                    </ul>
                    </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
@endsection
