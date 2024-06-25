@extends('layouts.admin.app')

@section('style')
<style>
    .content-section {
        display: none;
    }

    .content-section.active {
        display: block;
    }

</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Email Application</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="index-2.html">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Email</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{asset('admin/dist/images/breadcrumb/emailSv.png')}}" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card overflow-hidden chat-application">
        <div class="d-flex align-items-center justify-content-between gap-3 m-3 d-lg-none">
            <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#chat-sidebar" aria-controls="chat-sidebar">
                <i class="ti ti-menu-2 fs-5"></i>
            </button>
            <form class="position-relative w-100">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Contact">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
            </form>
        </div>
        <div class="d-flex w-100">
            <div class="left-part border-end w-20 flex-shrink-0 d-none d-lg-block">
                <div class="px-9 pt-4 pb-3">
                    <h4>Kotak Surat</h4>
                </div>
                {{-- <ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-inbox fs-5"></i>Pesan</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-flag fs-5"></i>Laporan</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                      <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-file fs-5"></i>Draft</a>
                  </li>
                </ul> --}}
                <ul class="list-group" style="height: calc(100vh - 400px)" data-simplebar>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1 active" href="javascript:void(0)" id="menu-pesan"><i class="ti ti-inbox fs-5"></i>Pesan</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)" id="menu-laporan"><i class="ti ti-flag fs-5"></i>Laporan</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)" id="menu-draft"><i class="ti ti-file fs-5"></i>Draft</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex w-100">
                <div class="min-width-340">
                    <div class="border-end user-chat-box h-100">
                        <div class="px-4 pt-9 pb-6 d-none d-lg-block">
                            <form class="position-relative">
                                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search" />
                                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                            </form>
                        </div>
                        <div class="app-chat">
                            <div class="px-4">
                                <p>
                                    Laporan Terbaru
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                        <path fill="#5a6a85" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6l-6-6z" /></svg>
                                </p>
                            </div>

                            <ul id="content-pesan" class="chat-users content-section" style="height: calc(100vh - 400px)" data-simplebar>
                                <li>
                                    <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start chat-user bg-light" id="chat_user_1" data-user-id="1">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </div>
                                        <div class="position-relative w-100 ms-2">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="mb-0">James Smith</h6>
                                            </div>
                                            <h6 class="fw-semibold text-dark">Kindly check this latest updated</h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="mb-0 fs-2 text-muted">09/02/2019</p>
                                                <p class="mb-0 fs-2 text-muted">04:00pm</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_2" data-user-id="2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </div>
                                        <div class="position-relative w-100 ms-2">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="mb-0">Katherine Flintoff</h6>
                                            </div>
                                            <h6 class="fw-semibold text-dark">Newsletter from AdminMart Team</h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="mb-0 fs-2 text-muted">09/02/2019</p>
                                                <p class="mb-0 fs-2 text-muted">04:00pm</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <ul id="content-laporan" class="chat-users content-section" style="height: calc(100vh - 400px)" data-simplebar>
                                <li>
                                    <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_2" data-user-id="2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        </div>
                                        <div class="position-relative w-100 ms-2">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="mb-0">Laporan</h6>
                                            </div>
                                            <h6 class="fw-semibold text-dark">Newsletter from AdminMart Team</h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="mb-0 fs-2 text-muted">09/02/2019</p>
                                                <p class="mb-0 fs-2 text-muted">04:00pm</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <ul id="content-draft" class="chat-users content-section" style="height: calc(100vh - 400px)" data-simplebar>
                              <li>
                                  <a href="javascript:void(0)" class="px-4 py-3 bg-hover-light-black d-flex align-items-start justify-content-between chat-user" id="chat_user_2" data-user-id="2">
                                      <div class="form-check mb-0">
                                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                      </div>
                                      <div class="position-relative w-100 ms-2">
                                          <div class="d-flex align-items-center justify-content-between mb-2">
                                              <h6 class="mb-0">Draft</h6>
                                          </div>
                                          <h6 class="fw-semibold text-dark">Newsletter from AdminMart Team</h6>
                                          <div class="d-flex align-items-center justify-content-between">
                                              <p class="mb-0 fs-2 text-muted">09/02/2019</p>
                                              <p class="mb-0 fs-2 text-muted">04:00pm</p>
                                          </div>
                                      </div>
                                  </a>
                              </li>
                          </ul>
                        </div>
                    </div>
                </div>
                <div class="w-100">
                    <div class="chat-container h-100 w-100">
                        <div class="chat-box-inner-part h-100">
                            <div class="chatting-box app-email-chatting-box">
                                <div class="p-9 py-3 border-bottom chat-meta-user">
                                    <ul class="list-unstyled mb-0 d-flex align-items-center">
                                        <h5>Detail Pesan</h5>
                                    </ul>
                                </div>
                                <div class="position-relative overflow-hidden">
                                    <div class="position-relative">
                                        <div class="chat-box p-9" style="height: calc(100vh - 428px)" data-simplebar>
                                            <div class="chat-list chat active-chat" data-user-id="1">
                                                <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div>
                                                            <p class="mb-0">Pelapor</p>
                                                        </div>
                                                    </div>
                                                    <span class="badge text-bg-danger fs-2 rounded-4 py-1 px-2">Laporan</span>
                                                </div>
                                                <div class="pb-7 mb-7">
                                                    <h5 class="fw-semibold text-dark">Alexanda </h5>
                                                    <p class="mb-5 text-black">hello@loremipsum.com</p>

                                                    <div>
                                                        <p class="mb-3 text-dark">
                                                            Dilaporkan:
                                                        </p>
                                                        <div class="card shadow-none border-1">
                                                            <div class="p-3">
                                                                <div class="row">
                                                                    <div class="col-lg-2">
                                                                        <img src="{{ asset('assets/img/news/news-100.webp') }}" width="100%" alt="">
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p style="color: #175A95; margin-bottom: 5px;">Fashion</p>
                                                                        <b>Jiraiya Banks Wants To Teach You How To Build A House Jiraiya Banks Wants To Teach You How To</b>
                                                                        <div class="d-flex mt-3 gap-3">

                                                                            <div class="d-flex">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                                                    <path fill="#ef6e6e" d="M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5zM5 8h14V6H5zm0 0V6z" /></svg>
                                                                                <span style="font-size: 13px;" class="ms-1">Apr 25, 2023</span>
                                                                            </div>
                                                                            <div class="d-flex">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 24 24">
                                                                                    <path fill="#ef6e6e" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5m0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5" /></svg>
                                                                                <span style="font-size: 13px;" class="ms-1">129x dilihat</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <p class="mb-3 mt-5 text-dark">
                                                            Isi Laporan:
                                                        </p>
                                                        <div class="">
                                                            <p class="text-black">berita ada unsur penghinaan pihak tertentu</p>
                                                        </div>

                                                        <p class="mb-3 mt-5 text-dark">
                                                            Bukti (opsional):
                                                        </p>
                                                        <div class="">
                                                            <img src="{{ asset('assets/img/news/news-11.webp') }}" width="283px" height="202px" style="object-fit: cover" alt="">
                                                        </div>

                                                        <p class="mb-3 mt-5 text-dark">
                                                            Aksi:
                                                        </p>
                                                        <div class="d-flex gap-2">
                                                            <button class="btn btn-light-primary text-primary">Detail</button>
                                                            <button class="btn btn-light-warning text-warning">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 256 256">
                                                                    <path fill="#ffae1f" d="M236.8 188.09L149.35 36.22a24.76 24.76 0 0 0-42.7 0L19.2 188.09a23.51 23.51 0 0 0 0 23.72A24.35 24.35 0 0 0 40.55 224h174.9a24.35 24.35 0 0 0 21.33-12.19a23.51 23.51 0 0 0 .02-23.72m-13.87 15.71a8.5 8.5 0 0 1-7.48 4.2H40.55a8.5 8.5 0 0 1-7.48-4.2a7.59 7.59 0 0 1 0-7.72l87.45-151.87a8.75 8.75 0 0 1 15 0l87.45 151.87a7.59 7.59 0 0 1-.04 7.72M120 144v-40a8 8 0 0 1 16 0v40a8 8 0 0 1-16 0m20 36a12 12 0 1 1-12-12a12 12 0 0 1 12 12" /></svg>
                                                                Banned
                                                            </button>
                                                            <button class="btn btn-light-danger text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="22" height="18" viewBox="0 0 24 24">
                                                                    <path fill="currentColor" d="M16 9v10H8V9zm-1.5-6h-5l-1 1H5v2h14V4h-3.5zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2z" /></svg>
                                                                Hapus Artikel</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="chat-list chat" data-user-id="2">
                                                <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div>
                                                            <p class="mb-0">Pengirim</p>
                                                        </div>
                                                    </div>
                                                    <span class="badge text-white fs-2 rounded-4 py-1 px-2" style="background-color: #175A95;">Pesan</span>
                                                </div>
                                                <div class="pb-7 mb-7">
                                                    <h5 class="fw-semibold text-dark">Alexanda </h5>
                                                    <p class="mb-5 text-black">hello@loremipsum.com</p>

                                                    <div>
                                                        <p class="mb-3 text-dark">
                                                            Isi Pesan:
                                                        </p>
                                                        <div class="">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum hendrerit lobortis. Nullam ut lacus eros. Sed at luctus urna, eu fermentum diam. In et tristique mauris.</p>
                                                            <p>Ut id ornare metus, sed auctor enim. Pellentesque nisi magna, laoreet a augue eget, tempor volutpat diam.</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="chat-list chat" data-user-id="3">
                                                <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="{{asset('admin/dist/images/profile/user-7.jpg')}}" alt="user8" width="48" height="48" class="rounded-circle" />
                                                        <div>
                                                            <h6 class="fw-semibold mb-0">Pengguna 3</h6>
                                                            <p class="mb-0">hello@loremipsum.com</p>
                                                        </div>
                                                    </div>
                                                    <span class="badge text-bg-primary fs-2 rounded-4 py-1 px-2">Promotional</span>
                                                </div>
                                                <div class="border-bottom pb-7 mb-7">
                                                    <h4 class="fw-semibold text-dark mb-3">Kindly check this latest updated</h4>
                                                    <p class="mb-3 text-dark">Hello Andrew,</p>
                                                    <p class="mb-3 text-dark">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum
                                                        hendrerit lobortis. Nullam ut lacus eros. Sed at luctus urna, eu fermentum diam.
                                                        In et tristique mauris.
                                                    </p>
                                                    <p class="mb-3 text-dark">Ut id ornare metus, sed auctor enim. Pellentesque nisi
                                                        magna, laoreet a augue eget, tempor volutpat diam.</p>
                                                    <p class="mb-0 text-dark">Regards,</p>
                                                    <h6 class="fw-semibold mb-0 text-dark pb-1">Alexandra Flintoff</h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold mb-0 text-dark mb-3">Attachments</h6>
                                                    <div class="d-block d-sm-flex align-items-center gap-4">
                                                        <a href="javascript:void(0)" class="hstack gap-3 mb-2 mb-sm-0">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="rounded-1 bg-light p-6">
                                                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/chat/icon-adobe.svg" alt="" width="24" height="24">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fw-semibold">service-task.pdf</h6>
                                                                    <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2
                                                                            MB</span><span>2 Dec 2023</span></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="javascript:void(0)" class="hstack gap-3 file-chat-hover">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="rounded-1 bg-light p-6">
                                                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/chat/icon-zip-folder.svg" alt="" width="24" height="24">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fw-semibold">work-project.zip</h6>
                                                                    <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2
                                                                            MB</span><span>2 Dec 2023</span></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-list chat" data-user-id="4">
                                                <div class="hstack align-items-start mb-7 pb-1 align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="{{asset('admin/dist/images/profile/user-8.jpg')}}" alt="user8" width="48" height="48" class="rounded-circle" />
                                                        <div>
                                                            <h6 class="fw-semibold mb-0">Pengguna 4</h6>
                                                            <p class="mb-0">hello@loremipsum.com</p>
                                                        </div>
                                                    </div>
                                                    <span class="badge text-bg-primary fs-2 rounded-4 py-1 px-2">Promotional</span>
                                                </div>
                                                <div class="border-bottom pb-7 mb-7">
                                                    <h4 class="fw-semibold text-dark mb-3">Kindly check this latest updated</h4>
                                                    <p class="mb-3 text-dark">Hello Andrew,</p>
                                                    <p class="mb-3 text-dark">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque bibendum
                                                        hendrerit lobortis. Nullam ut lacus eros. Sed at luctus urna, eu fermentum diam.
                                                        In et tristique mauris.
                                                    </p>
                                                    <p class="mb-3 text-dark">Ut id ornare metus, sed auctor enim. Pellentesque nisi
                                                        magna, laoreet a augue eget, tempor volutpat diam.</p>
                                                    <p class="mb-0 text-dark">Regards,</p>
                                                    <h6 class="fw-semibold mb-0 text-dark pb-1">Alexandra Flintoff</h6>
                                                </div>
                                                <div class="mb-3">
                                                    <h6 class="fw-semibold mb-0 text-dark mb-3">Attachments</h6>
                                                    <div class="d-block d-sm-flex align-items-center gap-4">
                                                        <a href="javascript:void(0)" class="hstack gap-3 mb-2 mb-sm-0">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="rounded-1 bg-light p-6">
                                                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/chat/icon-adobe.svg" alt="" width="24" height="24">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fw-semibold">service-task.pdf</h6>
                                                                    <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2
                                                                            MB</span><span>2 Dec 2023</span></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a href="javascript:void(0)" class="hstack gap-3 file-chat-hover">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <div class="rounded-1 bg-light p-6">
                                                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/chat/icon-zip-folder.svg" alt="" width="24" height="24">
                                                                </div>
                                                                <div>
                                                                    <h6 class="fw-semibold">work-project.zip</h6>
                                                                    <div class="d-flex align-items-center gap-3 fs-2 text-muted"><span>2
                                                                            MB</span><span>2 Dec 2023</span></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-9 py-3 border-top chat-send-message-footer">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <ul class="list-unstyledn mb-0 d-flex align-items-center gap-7">
                                                    <li>
                                                        <a class="text-dark bg-hover-primary d-flex align-items-center gap-1" href="javascript:void(0)">
                                                            <i class="ti ti-trash fs-5"></i>
                                                            Hapus
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="offcanvas offcanvas-start user-chat-box" tabindex="-1" id="chat-sidebar" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Email </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="px-9 pt-4 pb-3">
                    <button class="btn btn-primary fw-semibold py-8 w-100">Compose</button>
                </div>
                <ul class="list-group" style="height: calc(100vh - 150px)" data-simplebar>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-inbox fs-5"></i>Inbox</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-brand-telegram fs-5"></i>Sent</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-file-text fs-5"></i>Draft</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-inbox fs-5"></i>Spam</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-trash fs-5"></i>Trash</a>
                    </li>
                    <li class="border-bottom my-3"></li>
                    <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">IMPORTANT</li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-star fs-5"></i>Starred</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)" class="d-block "><i class="ti ti-badge fs-5"></i>Important</a>
                    </li>
                    <li class="border-bottom my-3"></li>
                    <li class="fw-semibold text-dark text-uppercase mx-9 my-2 px-3 fs-2">LABELS</li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-bookmark fs-5 text-primary"></i>Promotional</a>
                    </li>
                    <li class="list-group-item border-0 p-0 mx-9">
                        <a class="d-flex align-items-center gap-2 list-group-item-action text-dark px-3 py-8 mb-1 rounded-1" href="javascript:void(0)"><i class="ti ti-bookmark fs-5 text-warning"></i>Social</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('admin/dist/js/apps/chat.js')}}"></script>

<script>
    document.getElementById('menu-pesan').addEventListener('click', function() {
        showSection('content-pesan');
    });
    document.getElementById('menu-laporan').addEventListener('click', function() {
        showSection('content-laporan');
    });
    document.getElementById('menu-draft').addEventListener('click', function() {
        showSection('content-draft');
    });

    function showSection(sectionId) {
        // Hide all sections
        document.querySelectorAll('.content-section').forEach(function(section) {
            section.style.display = 'none';
        });

        // Show the selected section
        document.getElementById(sectionId).style.display = 'block';
    }

</script>
@endsection
