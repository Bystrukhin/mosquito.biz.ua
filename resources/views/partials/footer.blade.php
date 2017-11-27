<footer id="footer">
    <h2>Advanced search:</h2>
    <div class="footer_top">
        <div class="row">
            <form action="{{route('article.filter')}}" method="get">
                <div class="btn-group">
                    <a href="#" class="btn btn-primary">By category</a>
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                    <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                        @foreach($categories as $category)
                                <li><p><input type="checkbox" value="{{$category->id}}" style="margin-right: 10px;" name="article_category_id[]"> {{$category->name}}</p></li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group">
                    <a href="#" class="btn btn-primary">By tags</a>
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                    <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                        @foreach($tags as $tag)
                            <li><p><input type="checkbox" value="{{$tag->id}}" style="margin-right: 10px;" name="tags[]">{{$tag->name}}</p></li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-group">
                    <a href="#" class="btn btn-primary">By date</a>
                    <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                    <ul class="dropdown-menu" style="padding: 10px" id="myDiv">
                        <li><p><input type="radio" value="{{\Carbon\Carbon::now()->subDay()}}" style="margin-right: 10px;" name="date">Today</p></li>
                        <li><p><input type="radio" value="{{\Carbon\Carbon::now()->subWeek()}}" style="margin-right: 10px;" name="date">This week</p></li>
                        <li><p><input type="radio" value="{{\Carbon\Carbon::now()->subMonth()}}" style="margin-right: 10px;" name="date">This month</p></li>
                    </ul>
                </div>
                <input class="btn btn-primary" type="submit" value="Search">
            </form>
        </div>
    </div>
</footer>
<div class="footer_bottom">
    <p class="copyright">Copyright &copy; 2045 <a href="index.html">NewsFeed</a></p>
    <p class="developer">Developed By Wpfreeware</p>
</div>