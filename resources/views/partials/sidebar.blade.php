<div class="sidebar bg-white z-1">
    <div class="top">
        <a href="/home"><i class="fa-solid fa-camera-retro text-black instagram"></i></a>
        {{-- <i class="fa-solid fa-camera-retro"></i> --}}
    </div>
    <div class="center">
        <a href="/home"><i class="fa-solid fa-house text-black home"></i></a>
        <a href="/search" style="margin-top: -10px;"><i class="fa-solid fa-magnifying-glass text-black search"></i></a>
        <a href="/like"><i class="fa-solid fa-heart" style="color: black"></i></a>
        {{-- <a href="/createpost"><i class="fa-regular fa-square-plus text-white create"></i></a> --}}
        <a href="/profile"><img class="rounded-circle" src="{{ asset('storage/' . auth()->user()->foto_profil) }}"
                alt=""></a>
    </div>
    <div class="bottom">
        <form action="/logout" method="POST">
            @csrf
            <button onclick="return confirm('Are you sure you want to log out?')" type="submit"
                style="background: transparent; border: none;"><i
                    class="fa-solid fa-right-from-bracket text-black mb-4"></i>
        </form>
    </div>
</div>
