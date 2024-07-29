<!DOCTYPE html>
<html lang="en">

<head>
    <title>GetMedia | @yield('role') - @yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/logo-get.svg') }}" />
    <!-- Owl Carousel  -->
    <!-- Core Css -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('admin/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <link id="themeColors" rel="stylesheet" href="{{ asset('admin/dist/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/libs/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
         $(window).on('load', function () {
            $('#get-preloader').addClass('loaded');
            $("#preloader").fadeOut(2000);

            if ($('#get-preloader').hasClass('loaded')) {
                $('#preloader').delay(100000).queue(function () {
                    $(this).remove();
                });
            }
        });
    </script> --}}
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $('body').addClass('loaded');
            }, 2400);
        });
    </script>


    @yield('style')
    <style>
        /*Loader*/
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white; /* Anda bisa mengganti warna sesuai kebutuhan */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /*Background Section Animation*/
        #loader-wrapper .loader-section {
            position: fixed;
            top: 0;
            width: 51%;
            height: 100%;
            background: #222;
            z-index: 1000;
        }

        .loaded #loader {
            opacity: 0;
            transition: all 0.3s ease-out;
        }
        .loaded img#loadImg{
            opacity: 0;
            transition: all 0.3s ease-out;
        }
        .loaded #loader-wrapper {
            visibility: hidden;
            transform: translateY(-100%);
            transition: all 0.3s 1s ease-out;
        }
    </style>

    <style>
        .important {
            color: red;
        }

        .bounce2 {
            animation: bounce2 3s ease infinite;
        }

        @keyframes bounce2 {
            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white; /* Anda bisa mengganti warna sesuai kebutuhan */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .preloader img {
            width: 10pc;
        }
    </style>

</head>

<body>
    <div id="loader-wrapper">
        <img src="{{ asset('assets/img/logo/preloader.gif') }}" id="loadImg" class="lds-ripple img-fluid animate-bounce" alt="loader" style="width: 12pc; top: 18pc;"/>
        <div id="loader"></div>
    </div>

    {{-- <div class="preloader" id="preloader">
        <div id="get-preloader">
            <img src="{{ asset('assets/img/logo/preloader.gif') }}" class="lds-ripple img-fluid animate-bounce" alt="loader" />
        </div>
    </div> --}}


    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @role('author')
            @include('layouts.author.sidebar')
        @endrole
        @role('admin')
            @include('layouts.admin.sidebar')
        @endrole
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.user.header')
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>


        </div>
    </div>
    <!--  Import Js Files -->
    <script src="{{ asset('admin/dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!--  core files -->
    <script src="{{ asset('admin/dist/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/app.init.js') }}"></script>
    <script src="{{ asset('admin/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('admin/dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin/dist/js/custom.js') }}"></script>
    <!--  current page js files -->
    <script src="{{ asset('admin/dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/custom.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/forms/form-wizard.js') }}"></script>

    <script src="{{ asset('admin/dist/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/forms/select2.init.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/forms/bootstrap-switch.js') }}"></script>
    <script src="{{ asset('admin/dist/libs/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>


    {{-- <script>
        $(window).on('load', function () {
            $('#get-preloader').addClass('loaded');

            // Hilangkan preloader setelah 10 detik
            setTimeout(function() {
                $("#preloader").fadeOut(1000, function() {
                    $(this).remove();
                });
            }, 9000000); // 10000 milidetik = 10 detik
        });
    </script> --}}
    <script>
        const authToken = localStorage.getItem('token')
        $.ajaxSetup({
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + authToken,
            }
        });

        function handleValidate(messages, type) {
            const keys = Object.keys(messages);
            for (const key of keys) {
                const text = messages[key];
                var ErrorList = $('<li>').text(text[0])
                let inputElement = $(`#${type}-${key}`)
                let select2Element = $(`#${type}-${key}`).siblings('.select2-container');
                if (!inputElement.is('div')) {
                    inputElement.addClass('error')
                    select2Element.addClass('error');
                }
                inputElement.next('ul').html(ErrorList)
                select2Element.next('ul').html(ErrorList)
            }
            $('.error').change(function() {
                $(this).removeClass('error')
                $(this).next('ul').html('')
            })
        }

        function handlePaginate(pagination) {
            const paginate = $('<ul>').addClass('pagination')
            const currentPage = pagination.current_page
            const lastPage = pagination.last_page
            if (lastPage >= 11) {
                var startPage = currentPage
                var endPage = currentPage + 1
                if (startPage > 1) startPage = currentPage - 1
                if (currentPage == lastPage) endPage -= 1
                for (var page = startPage; page <= endPage; page++) {
                    const pageItem = $('<li>').addClass('page-item')
                    page == currentPage ? pageItem.addClass('active') : '';
                    const pageLink =
                        `<button class="page-link" onclick="get(${page})" >${page}</button>`
                    pageItem.html(pageLink)
                    paginate.append(pageItem)
                }
                const morePage = `<li class="page-item disabled">
                            <button
                            class="page-link"
                            tabindex="-1"
                            aria-disabled="true"
                            >...</button>
                        </li>`
                if (currentPage >= 3) {
                    var leftPage = 3;
                    if (currentPage == 3) leftPage = 1
                    if (currentPage == 4) leftPage = 2
                    if (currentPage >= 6) paginate.prepend(morePage)
                    for (var page = leftPage; page >= 1; page--) {
                        const pageItem = $('<li>').addClass('page-item')
                        const pageLink =
                            `<button  class="page-link" onclick="get(${page})">${page}</button>`
                        pageItem.html(pageLink)
                        paginate.prepend(pageItem)
                    }
                }
                if (currentPage <= (lastPage - 2)) {
                    var rightPage = 1
                    if (currentPage == (lastPage - 2)) rightPage = 0
                    if (currentPage == (lastPage - 3)) rightPage = 1
                    if (currentPage < (lastPage - 4)) paginate.append(morePage)
                    for (var page = (lastPage - rightPage); page <= lastPage; page++) {
                        const pageItem = $('<li>').addClass('page-item')
                        const pageLink = `<button class="page-link" onclick="get(${page})">${page}</button>`
                        pageItem.html(pageLink)
                        paginate.append(pageItem)
                    }
                }
            } else {
                for (var page = 1; page <= lastPage; page++) {
                    const pageItem = $('<li>').addClass('page-item')
                    page == currentPage ? pageItem.addClass('active') : '';
                    const pageLink = `<button class="page-link" onclick="get(${page})">${page}</button>`
                    pageItem.append(pageLink)
                    paginate.append(pageItem)
                }
            }
            const previous = `<li class="page-item ${currentPage == 1 ? 'disabled' : ''}" ${currentPage != 1 ? 'onclick="get('+(currentPage - 1)+')"' : ''}>
                            <button
                            class="page-link"
                            tabindex="-1"
                            aria-disabled="true"
                            >Previous</button>
                        </li>`
            const next = `<li class="page-item ${currentPage == lastPage ? 'disabled' : ''}" ${currentPage != lastPage ? 'onclick="get('+(pagination.current_page + 1)+')"' : ''}>
                                <button class="page-link" href="#">Next</button>
                        </li>`
            paginate.prepend(previous)
            paginate.append(next)
            return paginate
        }

        function emptyForm(formId) {
            const form = $('#' + formId)
            form.find('input').each(function() {
                if ($(this).attr('type') === 'checkbox' || $(this).attr('type') === 'radio') {
                    $(this).prop('checked', false);
                } else if ($(this).attr('type') === 'file') {
                    $(this).val(null);
                } else {
                    $(this).val('');
                }
            });
            form.find('select').prop('selectedIndex', 0);
            form.find('.select2-with-bg').val(null).trigger('change');
            form.find('.select2').val(null).trigger('change');
            form.find('textarea').val('');
        }

        function getDataAttributes(elementId) {
            const dataAttributes = {};
            const element = $('#' + elementId);
            if (element.length === 0) {
                console.error('Element with ID "' + elementId + '" not found.');
                return null;
            }
            $.each(element[0].attributes, function() {
                if (this.name.startsWith('data-')) {
                    const key = this.name.substring(5);
                    const value = this.value;
                    dataAttributes[key] = value;
                }
            });
            return dataAttributes;
        }

        function setFormValues(formId, values) {
            const form = $('#' + formId);
            for (const key in values) {
                if (values.hasOwnProperty(key)) {
                    const value = values[key];
                    const input = form.find('[name="' + key + '"]');
                    if (input.length > 0) {
                        const type = input.attr('type');
                        if (type === 'radio') {
                            input.filter('[value="' + value + '"]').prop('checked', true);
                        } else if (input.is('select')) {
                            if (input.hasClass('select2')) {
                                input.val(value).trigger('change'); // Trigger change event for Select2
                            } else {
                                input.val(value).trigger('change');
                            }
                        } else {
                            input.val(value);
                        }
                    } else {
                        const textarea = form.find('textarea[name="' + key + '"]');
                        if (textarea.length > 0) {
                            textarea.html(value);
                        }
                    }
                }
            }
        }

        function handleDetail(data) {
            const keys = Object.keys(data);
            for (const key of keys) {
                const text = data[key];
                $('#detail-' + key).html(text)
            }
        }

        function showLoading() {
            return `<div class="d-flex justify-content-center" style="margin-top:11rem">
                        <div class="spinner-border my-auto" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>`
        }

        function showNoData(message) {
            return `<div class="d-flex justify-content-center" style="min-height:16rem">
                        <div class="my-auto ">
                            <img src="{{ asset('no-data.svg') }}" width="400" height="400"/>
                            <h4 class="text-center">${message}</h4>
                            </div>
                    </div>`
        }
        $("#inputDate").on("change", function() {
            const inputDateValue = $(this).val();
            const parts = inputDateValue.split("-");
            const year = parts[0];
            const month = parts[1];
            const day = parts[2];
            const formattedDate = `${year}/${month}/${day}`;
            $(this).val(formattedDate);
        });

        function formatDate(dateString) {
            var date = new Date(dateString);

            var options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            var formattedDate = date.toLocaleDateString('id-ID', options);

            return formattedDate;
        }
    </script>

    @yield('script')
</body>

</html>
