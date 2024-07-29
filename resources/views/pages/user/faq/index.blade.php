@extends('layouts.user.app')

@section('title')
    Faq
@endsection

@section('style')
<style>
    .theme-dark .accordion-item:first-of-type .accordion-button {
      background-color: var(--codColor);
      color: #ffffff;
    }

    .theme-dark .accordion-button {
      background-color: var(--codColor);
      color: #ffffff;
    }

    .theme-dark .accordion-body {
      background-color: var(--codColor);
      color: #ffffff;

    }

    .breadcrumb-wrap {
        padding: 80px 0 74px;
        background-image: url("assets/img/faq/faq-bg.png");
    }

    .theme-dark .button .accordion-button .collapsed::after{
      color: #ffffff;
    }


    .theme-dark .accordion {
        --bs-accordion-btn-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        --bs-accordion-btn-active-icon: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

</style>

@endsection

@section('content')
<div class="breadcrumb-wrap">
    <div class="container">
        <h2 class="breadcrumb-title text-white">FAQ</h2>
        <ul class="breadcrumb-menu list-style text-white">
            <li><a class="text-white" href="/">Beranda</a></li>
            <li>FAQ</li>
        </ul>
    </div>
</div>

  <div class="d-flex justify-content-center mt-5">
      <img src="{{ asset('assets/img/faq-icon.png') }}"  alt="" class="" srcset="">
  </div>
  <div class="text-center">
      <h3>
          Pertanyaan yang sering diajukan
      </h3>
      <p>
          Temukan pertanyaanmu
      </p>
  </div>
  <div class="accordion" id="accordionExample">
    <div class="container">
      <div class="card m-5">

        @forelse ($faqs as $key => $faq)
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ ++$key }}">
              <button class="accordion-button {{ $key != 1 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                {{ $faq->question }}
              </button>
            </h2>
            <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $key == 1 ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                  {{ $faq->answer }}
              </div>
            </div>
          </div>
        @empty

        @endforelse

      </div>
    </div>
  </div>
@endsection
