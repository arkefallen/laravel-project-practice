<div class="links" >
    <a href="/name" style="text-decoration: none; color:white;">Name</a>
    <a href="/major"  style="text-decoration: none; color:white;">Major</a>
    <a href="/city"  style="text-decoration: none; color:white;">City</a>
    <a href="/book"  style="text-decoration: none; color:white;">Book</a>
    @if (Auth::check() && Auth::user()->level == 'admin')
        <a href="/user"  style="text-decoration: none; color:white;">Users</a>
    @else
        
    @endif
</div>