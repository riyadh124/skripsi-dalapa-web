@extends('layouts.main')

@section('container')

<main>
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-body-tertiary">
        <div class="row">
            <div class="col-lg-6 col-md-12 p-lg-5 mx-auto my-5">
                <h1 class="display-3 fw-bold">DALAPA Mobile Apps</h1>
                <h3 class="fw-normal text-muted mb-3">DALAPA streamlines material reporting for efficient mass
                    disruption repairs.</h3>
            </div>
            <div class="col-lg-6 col-md-12 p-lg-5 mx-auto my-5">
              <div class="bg-body-tertiary me-md-3 px-3 px-md-5 text-center overflow-hidden">
                <img src="{{ asset('storage/images/mobile-ui.png') }}" class="bg-body shadow-sm mx-auto" style="width:80%;border-radius: 30px;" alt="" srcset="">
                  {{-- <div class="bg-body shadow-sm mx-auto"
                      style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                  </div> --}}
              </div>
          </div>
        </div>
    </div>
</main>

<footer class="container py-5">
    <div class="row">
        <div class="col-12 col-md">
            <img src="{{ asset('storage/images/logo.png') }}" class=" shadow-sm mx-auto" style="width:40%;border-radius: 30px;" alt="" srcset="">

            <small class="d-block mb-3 text-body-secondary">&copy; 2024</small>
        </div>
        <div class="col-6 col-md">
            <h5>Features</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary text-decoration-none" href="#">Cool stuff</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Random feature</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Team feature</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Stuff for developers</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Another one</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Last time</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary text-decoration-none" href="#">Resource name</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Resource</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Another resource</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Final resource</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Resources</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary text-decoration-none" href="#">Business</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Education</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Government</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Gaming</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
                <li><a class="link-secondary text-decoration-none" href="#">Team</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Locations</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Privacy</a></li>
                <li><a class="link-secondary text-decoration-none" href="#">Terms</a></li>
            </ul>
        </div>
    </div>
</footer>
<script src="/js/bootstrap.bundle.min.js"></script>

@endsection
