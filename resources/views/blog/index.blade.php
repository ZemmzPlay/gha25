@extends('master')

@section('title', 'News'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))

@section('style')
    <link rel="stylesheet" href="{{ asset('css/blog/index.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/blog/index.js') }}"></script>
@endsection


@section('content')
    <input type="hidden" id="likePostUrl" value="{{route('pages.likePost')}}" />
    <div class="contentContainer contentContainer_en">
        <div class="contentMiddleContainer">
            <div class="topSearchPanel">
                <div class="searchBlogContainer {{($word == '') ? 'searchBlogClosed' : ''}}">
                    <div class="searchIcon" data-url="{{url('blog')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 19 19" role="img" class="_38BNc blog-desktop-header-search-icon-fill"><path d="M12.8617648,11.8617648 L15.8633394,14.8633394 C15.9414442,14.9414442 15.9414442,15.0680772 15.8633394,15.1461821 L15.1461821,15.8633394 C15.0680772,15.9414442 14.9414442,15.9414442 14.8633394,15.8633394 L11.8617648,12.8617648 C10.9329713,13.578444 9.76865182,14.0047607 8.50476074,14.0047607 C5.46719462,14.0047607 3.00476074,11.5423269 3.00476074,8.50476074 C3.00476074,5.46719462 5.46719462,3.00476074 8.50476074,3.00476074 C11.5423269,3.00476074 14.0047607,5.46719462 14.0047607,8.50476074 C14.0047607,9.76865182 13.578444,10.9329713 12.8617648,11.8617648 Z M8.5,13 C10.9852814,13 13,10.9852814 13,8.5 C13,6.01471863 10.9852814,4 8.5,4 C6.01471863,4 4,6.01471863 4,8.5 C4,10.9852814 6.01471863,13 8.5,13 Z"></path></svg>
                    </div>
                    <input type="text" name="search" placeholder="Search" class="searchInput" value="{{$word}}" data-oldWord="{{($word == '') ? 'no' : 'yes'}}" />
                    <div class="closeSearchIcon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" class="RgSSa blog-desktop-header-search-icon-fill" style="fill-rule: evenodd;"><path d="M3144.99,617.882l-1.11,1.109-3.88-3.882-3.88,3.882-1.11-1.109,3.88-3.882-3.88-3.882,1.11-1.109,3.88,3.882,3.88-3.882,1.11,1.109L3141.11,614Z" transform="translate(-3135 -609)"></path></svg>
                    </div>
                </div>
            </div>

            <div class="allPostsContainer">
                @if(count($posts))
                    @foreach($posts as $post)
                        <?php
                        $linkToPost = url('post').'/'.$post->slug;
                        $postImage = ($post->thumbnail != null && Storage::exists('public/posts/' . $post->thumbnail)) ? Storage::url('public/posts/' . $post->thumbnail) : 'images/no-image.jpg';
                        ?>
                        <div class="onePostContainer">
                            <a class="view-post" href="{{$linkToPost}}"><div class="onePostImage" style="background: url('{{asset($postImage)}}');background-size: cover;background-position: center;"></div></a>
                            <div class="onePostDetail">
                                <div class="onePostAuthorDate">
                                    <div class="onePostAuthorImg">
                                        {{-- <svg width="1000" height="1000" viewBox="0 0 1000 1000" class="HOi00"><circle cx="500" cy="500" r="500" fill="#cccccc"></circle><path fill="#a0a09f" d="M830.8,874.927c-77.344-60.8-187.181-104.877-227.88-111.347-20.335-3.233-20.8-59.1-20.8-59.1s59.746-59.106,72.768-138.584c35.029,0,56.666-84.5,21.631-114.226C677.986,420.37,721.551,206,501,206S324.015,420.37,325.473,451.666c-35.033,29.729-13.4,114.226,21.632,114.226,13.021,79.478,72.77,138.584,72.77,138.584s-0.464,55.871-20.8,59.1c-40.883,6.5-151.537,50.943-228.934,112.176C65.84,784.12,0,649.751,0,500,0,223.858,223.858,0,500,0s500,223.858,500,500C1000,649.3,934.559,783.311,830.8,874.927ZM500,1000h0Z"></path></svg> --}}
                                        <img src="{{asset('icon/favicon-32x32.png')}}">
                                    </div>
                                    <div class="onePostAuthorNameDate">
                                        <div class="onePostAuthorName">{{$post->author}}</div>
                                        <div class="onePostDate">{{date('F d', strtotime($post->created_at))}} . {{$post->duration}}</div>
                                    </div>
                                </div>
                                <?php
                                $title = strlen($post->title) > 60 ? substr($post->title,0,60)."..." : $post->title;
                                $text = strip_tags($post->text);
                                $text = strlen($text) > 140 ? substr($text,0,140)."..." : $text;
                                ?>
                                <a class="view-post" href="{{$linkToPost}}">
                                    <div class="onePostTitleText">
                                        <div class="onePostTitle">{{$title}}</div>
                                        <div class="onePostText">{{$text}}</div>
                                    </div>
                                </a>
                                <div class="onePostCommentLikes">
                                    <div class="onePostLikes {{(Auth::guard('web')->check()) ? '' : 'onePostLikesDis'}}" data-loggedIn="{{(Auth::guard('web')->check()) ? 'yes' : 'no'}}" data-postSlug="{{$post->slug}}">
                                        <div class="onePostLikesNumber">{{$post->likesNumber()}}</div>
                                        <?php
                                        if(Auth::guard('web')->check())
                                        {
                                            $checkLikedByVisitor = App\PostLikes::where('user_id', Auth::guard('web')->user()->id)->where('post_id', $post->id)->first();
                                            $likedThisComment = ($checkLikedByVisitor) ? true : false;
                                        }
                                        else
                                        {
                                            $likedThisComment = false;
                                        }
                                        ?>
                                        <div class="onePostLikesIcon {{($likedThisComment) ? 'onePostLikesIconLiked' : ''}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 19 19" role="img"><path d="M9.44985848,15.5291774 C9.43911371,15.5362849 9.42782916,15.5449227 9.41715267,15.5553324 L9.44985848,15.5291774 Z M9.44985848,15.5291774 L9.49370677,15.4941118 C9.15422701,15.7147757 10.2318883,15.0314406 10.7297038,14.6971183 C11.5633567,14.1372547 12.3827081,13.5410755 13.1475707,12.9201001 C14.3829188,11.9171478 15.3570936,10.9445466 15.9707237,10.0482572 C16.0768097,9.89330422 16.1713564,9.74160032 16.2509104,9.59910798 C17.0201658,8.17755699 17.2088969,6.78363112 16.7499013,5.65913129 C16.4604017,4.81092573 15.7231445,4.11008901 14.7401472,3.70936139 C13.1379564,3.11266008 11.0475663,3.84092251 9.89976068,5.36430396 L9.50799408,5.8842613 L9.10670536,5.37161711 C7.94954806,3.89335486 6.00516066,3.14638251 4.31830373,3.71958508 C3.36517186,4.00646284 2.65439601,4.72068063 2.23964629,5.77358234 C1.79050315,6.87166888 1.98214559,8.26476279 2.74015555,9.58185512 C2.94777753,9.93163559 3.23221417,10.3090129 3.5869453,10.7089994 C4.17752179,11.3749196 4.94653811,12.0862394 5.85617417,12.8273544 C7.11233096,13.8507929 9.65858244,15.6292133 9.58280954,15.555334 C9.53938013,15.5129899 9.48608859,15.5 9.50042471,15.5 C9.5105974,15.5 9.48275828,15.5074148 9.44985848,15.5291774 Z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="noResPosts">No Posts</p>
                @endif
            </div>

        </div>
    </div>
@stop