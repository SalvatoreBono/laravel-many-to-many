@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="text-center text-lg-start d-flex vh-100 flex-column align-items-center justify-content-center">
        <div class="container d-flex align-items-center ">
            <div class="row flex-column-reverse flex-lg-row justify-content-center align-items-center">
                <div class="col-12 col-md-12 col-lg-6">
                    <h3 class="display-5 fw-bold">
                        Hi, It's Me
                    </h3>
                    <h1 class="display-1 fw-bold">I'm <span style="color: #bf94ff">Salvatore</span></h1>
                    <p class="col-lg-8 fs-4">I'm a Junior Full Stack Web Developer, I'm excited to share with you the
                        projects
                        and skills I've been honing on my journey in the world of web development. My goal is continue
                        learning
                        and growing in this dynamic field.
                    </p>

                    <div class="d-flex justify-content-center  justify-content-lg-start">
                        <a class="nav-link" target="_blank" href="https://www.linkedin.com/in/salvatore-bono-692824255/">
                            <div class="link-profile d-flex align-items-center justify-content-center">
                                <i class="fa-brands fa-linkedin-in fa-xl"></i>
                            </div>
                        </a>
                        <a class="nav-link pe-3 ps-3" target="_blank" href="https://www.instagram.com/salvatore__bono/">
                            <div class="link-profile d-flex align-items-center justify-content-center">
                                <i class="fa-brands fa-instagram fa-xl"></i>
                            </div>
                        </a>
                        <a class="nav-link" target="_blank" href="https://github.com/SalvatoreBono">
                            <div class="link-profile d-flex align-items-center justify-content-center">
                                <i class="fa-brands fa-github fa-xl"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 pb-3 pb-lg-0">
                    <img class="media-width" src="/img/image.png" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
