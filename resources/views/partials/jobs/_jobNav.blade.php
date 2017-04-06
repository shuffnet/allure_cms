<nav class="navbar navbar-default">


    <a id="btnhome" href="{{ url('jobs/'.$job->id) }}" class="btn btn-link navbar-btn">Details </a>
    <button type="button" class="btn btn-link navbar-btn">Sessions <span class="badge">42</span></button>
    <button type="button" class="btn btn-link navbar-btn">Orders <span class="badge">42</span></button>

    <button type="button" class="btn btn-link navbar-btn">Quotes <span class="badge">42</span></button>
    <button type="button" class="btn btn-link navbar-btn">Emails <span class="badge"></span></button>

    {{--<button id="btntimeline" type="button" class="btn btn-link navbar-btn">Timeline<span class="badge">{{count($job->timeline)}}</span></button>--}}
    <a id="btntimeline" href="{{ url('jobs/timeline/index/'.$job->id) }}" class="btn btn-link navbar-btn">Timeline<span class="badge">{{count($job->timeline)}}</span></a>




</nav>
