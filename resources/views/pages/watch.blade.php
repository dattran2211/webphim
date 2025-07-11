@extends('layout')
@section('content')

<div class="row container" id="wrapper">
    <div class="halim-panel-filter">
       <div class="panel-heading">
          <div class="row">
             <div class="col-xs-6">
                <div class="yoast_breadcrumb hidden-xs">
                  <span>
                     {{-- <span>
                        <a href="">{{$movie->title}}</a> »  --}}
                     <span>
                        <a href="{{route('country',[$movie->country->slug])}}">{{$movie->country->title}}</a> » 
                        <span class="breadcrumb_last" aria-current="page">{{$movie->title}}</span>
                     </span>
                  </span>
               </span>
            </div>
             </div>
          </div>
       </div>
       <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
          <div class="ajax"></div>
       </div>
    </div>
    <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
       <section id="content" class="test">
          <div class="clearfix wrap-content">
            <style type="text/css">
                  .iframe_phim iframe {
                     width: 100%;
                     height: 500px;
                  }
            </style>

            <div class="iframe_phim">
            {!! $episode->linkphim !!}
            </div>

             
             {{-- <iframe width="100%" height="500" src="https://www.youtube.com/embed/r958O404e4U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
             
             {{-- <div class="button-watch">
                <ul class="halim-social-plugin col-xs-4 hidden-xs">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                </ul>
                <ul class="col-xs-12 col-md-8">
                   <div id="autonext" class="btn-cs autonext">
                      <i class="icon-autonext-sm"></i>
                      <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span>
                   </div>
                   <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                      Expand 
                   </div>
                   <div id="toggle-light"><i class="hl-adjust"></i>
                      Light Off 
                   </div>
                   <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div>
                   <div class="luotxem"><i class="hl-eye"></i>
                      <span>1K</span> lượt xem 
                   </div>
                   <div class="luotxem">
                      <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false" aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                   </div>
                </ul>
             </div> --}}
             <div class="collapse" id="moretool">
                <ul class="nav nav-pills x-nav-justified">
                   <li class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></li>
                   <div class="fb-save" data-uri="" data-size="small"></div>
                </ul>
             </div>
          
             <div class="clearfix"></div>
             <div class="clearfix"></div>
             <div class="title-block">
                <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                   <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                      <div class="halim-pulse-ring"></div>
                   </div>
                </a>
                <div class="title-wrapper-xem full">
                   <h1 class="entry-title"><a href="" title="{{$movie->title}}" class="tl">{{$movie->title}}</a></h1>
                </div>
             </div>
             <div class="entry-content htmlwrap clearfix collapse" id="expand-post-content">
                <article id="post-37976" class="item-content post-37976"></article>
             </div>
             <div class="clearfix"></div>
             <div class="text-center">
                <div id="halim-ajax-list-server"></div>
             </div>
             <div id="halim-list-server">
                <ul class="nav nav-tabs" role="tablist">
                  @if($movie->resolution==0)
                  <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>HD</a></li>

                   @elseif($movie->resolution==1)
                   <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>SD</a></li>

                   @elseif($movie->resolution==2)
                   <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>HDCam</a></li>
                   @elseif($movie->resolution==3)
                   <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>Cam</a></li>
                    @elseif($movie->resolution==4)
                    <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>FullHD</a></li>
                    @else
                    <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0" role="tab" data-toggle="tab"><i class="hl-server"></i>Trailer</a></li>
                    @endif
                </ul>


                <div class="tab-content">
                   <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                      <div class="halim-server">

                        <ul class="halim-list-eps">
                           @foreach($server as $key => $ser)
                             @foreach($episode_movie as $key => $ser_mov)
                             {{-- bên index controller function watch --}}
                           @if($ser_mov->linkserver==$ser->id)
                           {{-- server phim --}}
                           <li style="display: flex" class="halim-episode">
                                  <span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow">{{ $ser->title }}</span>
                           </li>
                           {{-- tập phim --}}
                           <ul class="halim-list-eps">
                              {{-- @foreach($movie->episode as $key => $sotap) --}}
                              <a href="{{url('xem-phim/'.$movie->slug.'/tap-'.$ser_mov->episode)}}">
                              <li class="halim-episode">
                                     <span class="halim-btn halim-btn-2 {{ $tapphim=$ser_mov->episode ? 'active' : '' }} halim-info-1-1 box-shadow" 
                                           data-post-id="37976" data-server="1" data-episode="1" data-position="first" 
                                           data-embed="0" data-title="Xem phim {{ $movie->title }} - Tập {{ $ser_mov->episode }} - {{ $movie->name_eng }} - Vietsub" 
                                           data-h1="{{ $movie->title }} - Tập {{ $ser_mov->episode }}">
                                           {{ $ser_mov->episode }}
                                     </span>
                              </li>
                              </a>
                               {{-- @endforeach --}}
                            </ul>
                           @endif
                            @endforeach
                        @endforeach

                         </ul>



                         


                         
                         <div class="clearfix"></div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="clearfix"></div>
             <div class="htmlwrap clearfix">
                <div id="lightout"></div>
             </div>
       </section>
       <section class="related-movies">
         <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
               <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
              @foreach($related as $key => $phim)
              <article class="thumb grid-item post-38498">
                  <div class="halim-item">
                    <a class="halim-thumb" href="{{ route('movie', $phim->slug) }}" title="{{ $phim->title }}">
                       <figure>
                           <img class="lazy img-responsive" src="{{ asset('uploads/movie/' . $phim->image) }}" alt="{{ $phim->title }}">
                           <span class="episode">
                             @if($phim->resolution!=5)
                             {{$phim->episode_count}}/{{$phim->sotap}}
                             @if($phim->phude==0)
                             Phụ đề @if($phim->season!=0) - Season {{$phim->season}}
                             @endif
                           @else
                             Thuyết minh @if($phim->season!=0) - Season {{$phim->season}}
                             @endif
                           @endif
                           @endif
                          </span>                            
                          <div class="icon_overlay"></div>
                           <div class="halim-post-title-box">
                               <div class="halim-post-title">
                                   <p class="entry-title">{{ $phim->title }}</p>
                                   <p class="original_title">{{ $phim->name_english }}</p>
                               </div>
                           </div>
                       </figure>
                       <span class="status">
                          @if($phim->resolution==0)
                          HD
                        @elseif($phim->resolution==1)
                         SD
                        @elseif($phim->resolution==2)
                         HDCam
                        @elseif($phim->resolution==3)
                         Cam
                         @elseif($phim->resolution==4)
                         FullHD
                        @else
                        Trailer
                        @endif
                        </span>
                   </a>
                   </div>
              </article>
              @endforeach
            </div>
            <script>
               jQuery(document).ready(function($) {				
               var owl = $('#halim_related_movies-2');
               owl.owlCarousel({loop: true,margin: 4,autoplay: true,autoplayTimeout: 4000,autoplayHoverPause: true,nav: true,navText: ['<i class="hl-down-open rotate-left"></i>', '<i class="hl-down-open rotate-right"></i>'],responsiveClass: true,responsive: {0: {items:2},480: {items:3}, 600: {items:4},1000: {items: 4}}})});
            </script>
         </div>
      </section>
    </main>
    @include('pages.include.sidebar')
</div>
 @endsection