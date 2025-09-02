@extends('master')

@section('title', 'News'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))

@section('metas')
    <?php
    $postDescription = strip_tags($post->text);
    $postDescription = strlen($postDescription) > 195 ? substr($postDescription,0,195)."..." : $postDescription;
    $postImageShare = ($post->thumbnail != null && Storage::exists('public/posts/' . $post->thumbnail)) ? Storage::url('public/posts/' . $post->thumbnail) : 'images/no-image.jpg';
    ?>
    <!-- facebook share meta -->
    <meta property="og:url"           content="{{url('post/'.$post->slug)}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{$post->title}}" />
    <meta property="og:description"   content="{{$postDescription}}" />
    <meta property="og:image"         content="{{url($postImageShare)}}" />


    <!-- twitter share meta -->
    <meta name="twitter:title" content="{{$post->title}}">
    <meta name="twitter:description" content="{{$postDescription}}">
    <meta name="twitter:image" content="{{url($postImageShare)}}">
    <meta name="twitter:card" content="summary_large_image">
@stop


@section('style')
    <link rel="stylesheet" href="{{ asset('css/blog/detail.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/blog/detail.js') }}"></script>
@endsection


@section('content')
    <div class="contentContainer contentContainer_en">
        <div class="topSearchPanel">
            <div class="searchBlogContainer searchBlogClosed">
                <div class="searchIcon" data-url="{{url('blog')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 19 19" role="img" class="_38BNc blog-desktop-header-search-icon-fill"><path d="M12.8617648,11.8617648 L15.8633394,14.8633394 C15.9414442,14.9414442 15.9414442,15.0680772 15.8633394,15.1461821 L15.1461821,15.8633394 C15.0680772,15.9414442 14.9414442,15.9414442 14.8633394,15.8633394 L11.8617648,12.8617648 C10.9329713,13.578444 9.76865182,14.0047607 8.50476074,14.0047607 C5.46719462,14.0047607 3.00476074,11.5423269 3.00476074,8.50476074 C3.00476074,5.46719462 5.46719462,3.00476074 8.50476074,3.00476074 C11.5423269,3.00476074 14.0047607,5.46719462 14.0047607,8.50476074 C14.0047607,9.76865182 13.578444,10.9329713 12.8617648,11.8617648 Z M8.5,13 C10.9852814,13 13,10.9852814 13,8.5 C13,6.01471863 10.9852814,4 8.5,4 C6.01471863,4 4,6.01471863 4,8.5 C4,10.9852814 6.01471863,13 8.5,13 Z"></path></svg>
                </div>
                <input type="text" name="search" placeholder="Search" class="searchInput" />
                <div class="closeSearchIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" class="RgSSa blog-desktop-header-search-icon-fill" style="fill-rule: evenodd;"><path d="M3144.99,617.882l-1.11,1.109-3.88-3.882-3.88,3.882-1.11-1.109,3.88-3.882-3.88-3.882,1.11-1.109,3.88,3.882,3.88-3.882,1.11,1.109L3141.11,614Z" transform="translate(-3135 -609)"></path></svg>
                </div>
            </div>
        </div>

        <div class="postContainer">
            <div class="postMiddleContainer">
                <div class="topPost">
                    <div class="postAuthorImg">
                        {{-- <svg width="1000" height="1000" viewBox="0 0 1000 1000" class="HOi00"><circle cx="500" cy="500" r="500" fill="#cccccc"></circle><path fill="#a0a09f" d="M830.8,874.927c-77.344-60.8-187.181-104.877-227.88-111.347-20.335-3.233-20.8-59.1-20.8-59.1s59.746-59.106,72.768-138.584c35.029,0,56.666-84.5,21.631-114.226C677.986,420.37,721.551,206,501,206S324.015,420.37,325.473,451.666c-35.033,29.729-13.4,114.226,21.632,114.226,13.021,79.478,72.77,138.584,72.77,138.584s-0.464,55.871-20.8,59.1c-40.883,6.5-151.537,50.943-228.934,112.176C65.84,784.12,0,649.751,0,500,0,223.858,223.858,0,500,0s500,223.858,500,500C1000,649.3,934.559,783.311,830.8,874.927ZM500,1000h0Z"></path></svg> --}}
                        <img src="{{asset('icon/favicon-32x32.png')}}">
                    </div>
                    <div class="postAuthorName">{{$post->author}}</div>
                    <div class="postPoint"></div>
                    <div class="postDate">{{date('F d', strtotime($post->created_at))}}</div>
                    <div class="postPoint"></div>
                    {{-- <div class="postDate">{{$post->duration}} read</div> --}}
                </div>
                <div class="postTitle">{{$post->title}}</div>
                <div class="postText">{!!$post->text!!}</div>

                <!-- https://www.linkedin.com/post-inspector/ -->
                <div class="shareContainer">
                    <div class="shareButton shareButton_fb" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('{{url("post/".$post->slug)}}'),'facebook-share-dialog','width=626,height=436'); return false;"><svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 19 19" role="img" class="_2KfuU blog-icon-fill"><path d="M8.08865986,17 L8.08865986,10.2073504 L5.7890625,10.2073504 L5.7890625,7.42194226 L8.08865986,7.42194226 L8.08865986,5.08269399 C8.08865986,3.38142605 9.46779813,2.00228778 11.1690661,2.00228778 L13.5731201,2.00228778 L13.5731201,4.50700008 L11.8528988,4.50700008 C11.3123209,4.50700008 10.874068,4.94525303 10.874068,5.48583089 L10.874068,7.42198102 L13.5299033,7.42198102 L13.1628515,10.2073892 L10.874068,10.2073892 L10.874068,17 L8.08865986,17 Z"></path></svg></div>
                    <div class="shareButton shareButton_tw" data-url="{{url('post/'.$post->slug)}}" id="twitter"><svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 19 19" role="img" class="_2KfuU blog-icon-fill"><path d="M18,4.65548179 C17.3664558,4.9413444 16.6940105,5.12876845 16.0053333,5.21143556 C16.7308774,4.76869949 17.2742158,4.07523994 17.5353333,3.25870539 C16.8519351,3.66952531 16.1046338,3.95967186 15.3253333,4.116758 C14.3449436,3.05903229 12.8270486,2.71461351 11.4952673,3.24769481 C10.1634861,3.78077611 9.28740204,5.08344943 9.28466667,6.53469742 C9.28603297,6.80525838 9.31643401,7.07486596 9.37533333,7.33876278 C6.57168283,7.1960128 3.95976248,5.85317869 2.19,3.64465676 C1.87608497,4.18262214 1.71160854,4.79663908 1.714,5.42164122 C1.61438697,6.56033644 2.09783469,7.6712643 2.99466667,8.36452045 C2.36720064,8.27274888 1.74900117,8.12475716 1.14733333,7.9222845 L1.14733333,7.96708243 C1.26738074,9.69877048 2.5327167,11.1265052 4.21866667,11.4326042 C3.96602896,11.5152522 3.7021383,11.5571156 3.43666667,11.55666 C3.23854288,11.557327 3.0409356,11.5361435 2.84733333,11.4934834 C3.31534048,12.9376046 4.63446966,13.9228162 6.134,13.9481801 C4.90488101,14.9328579 3.38271245,15.4661427 1.816,15.4609716 C1.5432586,15.4614617 1.27074516,15.4449665 1,15.411579 C4.05446938,17.394368 7.93290025,17.5303291 11.1152384,15.7661758 C14.2975765,14.0020226 16.2768505,10.6187983 16.2773333,6.94247342 C16.2773333,6.789701 16.266,6.63692858 16.266,6.4830075 C16.9469737,5.98359293 17.5342367,5.3646551 18,4.65548179 L18,4.65548179 Z"></path></svg></div>
                    <div class="shareButton shareButton_in" onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url='+encodeURIComponent('{{url("post/".$post->slug)}}'),'linkedin-share-dialog','width=626,height=600'); return false;"><svg xmlns="http://www.w3.org/2000/svg" width="19" viewBox="0 0 19 19" role="img" class="_2KfuU blog-icon-fill"><path d="M17,17 L13.89343,17 L13.89343,12.1275733 C13.89343,10.9651251 13.87218,9.47069458 12.2781416,9.47069458 C10.660379,9.47069458 10.4126568,10.7365137 10.4126568,12.0434478 L10.4126568,17 L7.30623235,17 L7.30623235,6.98060885 L10.2883591,6.98060885 L10.2883591,8.3495072 L10.3296946,8.3495072 C10.7445056,7.56190587 11.7585364,6.7312941 13.2709225,6.7312941 C16.418828,6.7312941 17,8.80643844 17,11.5041407 L17,17 Z M3.80289931,5.61098151 C2.80647978,5.61098151 2,4.80165627 2,3.80498046 C2,2.80903365 2.80647978,2 3.80289931,2 C4.79669898,2 5.60434314,2.80903365 5.60434314,3.80498046 C5.60434314,4.80165627 4.79669898,5.61098151 3.80289931,5.61098151 Z M2.24786773,17 L2.24786773,6.98060885 L5.35662096,6.98060885 L5.35662096,17 L2.24786773,17 Z"></path></svg></div>
                </div>
            </div>
        </div>

        
        <div class="recentPosts">

            @if(count($recentPosts))
            <div class="recentPostsTop">
                <div class="recentPostsTitle">Recent Posts</div>
                <a class="view-post" href="{{url('blog')}}"><div class="recentPostsSeeAll">See All</div></a>
            </div>
            <div class="allRecentPosts">
                @foreach($recentPosts as $recentPost)
                    <?php
                    $linkToPost = url('post').'/'.$recentPost->slug;

                    $postImage = ($recentPost->thumbnail != null && Storage::exists('public/posts/' . $recentPost->thumbnail)) ? Storage::url('public/posts/' . $recentPost->thumbnail) : 'images/no-image.jpg';
                    $title = strlen($recentPost->title) > 35 ? substr($recentPost->title,0,35)."..." : $recentPost->title; 
                    ?>
                    <div class="oneRecentPost">
                        <a class="view-post" href="{{$linkToPost}}"><div class="oneRecentPostImg" style="background: url('{{asset($postImage)}}');background-size: cover;background-position: center;"></div></a>
                        <div class="oneRecentPostContent">
                            <a class="view-post" href="{{$linkToPost}}"><div class="oneRecentPostTitle">{{$title}}</div></a>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
            
            <input type="hidden" id="postSlug" value="{{$post->slug}}" />
        </div>
    </div>
@stop